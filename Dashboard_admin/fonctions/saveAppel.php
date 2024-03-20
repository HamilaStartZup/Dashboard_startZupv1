<?php
include('../../config.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    $etudiants = $_POST['etudiants']; 

    // Appeler la fonction pour enregistrer les données en base de données
    $result = saveAppelData($etudiants, $conn);

    // Déclancher la fonction lors du clique sur le btn de validation
    if ($_POST['btn-submit']){
        // Appeler la fonction pour générer le fichier Excel
        $excelFilePath = generateExcelFile($etudiants);

        foreach ($etudiants as $index => $etudiant) {
            $presentMValue = isset($_POST['presentM'][$index]) ? 'présent' : 'absent';
            $presentAMValue = isset($_POST['presentAM'][$index]) ? 'présent' : 'absent';

            if ($etudiant['status'] == 'active'){
                $messageAbsence = ''; // initialiser la variable pour stocker le message d'absence
                // Vérifier si l'étudiant était absent le matin
                if ($presentMValue == 'absent' && $presentAMValue == 'présent') {
                    $messageAbsence .= ' le matin';
                    sendMail($etudiant, $messageAbsence , $conn);
                }
                // Vérifier si l'étudiant était absent l'après-midi
                elseif ($presentAMValue == 'absent' && $presentMValue == 'présent') {
                    $messageAbsence .= ' l\'après-midi';
                    sendMail($etudiant, $messageAbsence , $conn);
                }
                // Vérifier si l'étudiant était absent toute la journée
                elseif ($presentMValue == 'absent' && $presentAMValue == 'absent') {
                    $messageAbsence = ' toute la journée';
                    sendMail($etudiant, $messageAbsence , $conn);
                }
                else {
                    // Ne rien faire
                }
            }
        }

    }

    // Renvoyer à la page avec la liste des appels
    echo "
        <script>
            window.location.href = '/Dashboard_startZupv1/liste-des-appels'
        </script>";

    exit; // Arrêter l'exécution du reste de la page
}

// Fonction pour enregistrer les données en base de données
function saveAppelData($etudiants, $conn){
    try {
        // Préparez et exécutez la requête d'insertion pour chaque étudiant
        $dateEnregistrement = date('Y-m-d');

        // Vérifier si un enregistrement existe déjà pour cette date
        $stmtCheckDate = $conn->prepare("SELECT COUNT(*) FROM appel WHERE date_enregistrement = ?");
        $stmtCheckDate->execute([$dateEnregistrement]);
        $count = $stmtCheckDate->fetchColumn();

        foreach ($etudiants as $index => $etudiant) {
            $nom = $etudiant['nom'];
            $prenom = $etudiant['prenom'];
            
            // Recupérer le status de la bdd
            $stmtSelect = $conn->prepare("SELECT status FROM student WHERE nom = ? AND prenom = ?");
            $stmtSelect->execute([$nom, $prenom]);
            $status = $stmtSelect->fetchColumn();

            // Recupérer le matin du formulaire
            $matin = isset($_POST['presentM'][$index]) ? 'présent' : 'absent';

            // Recupérer l'apres midi du formulaire
            $apresMidi = isset($_POST['presentAM'][$index]) ? 'présent' : 'absent';

            // Recupérer le commentaire du formulaire
            $commentaire = isset($_POST['commentaire' . $index]) ? $_POST['commentaire' . $index] : '';


            // Enregistrer les données en base de données
            if ($count > 0) {
                $stmtUpdate = $conn->prepare("UPDATE appel SET matin = ?, apres_midi = ?, commentaire = ? WHERE date_enregistrement= ? AND nom = ? AND prenom = ?");
                $stmtUpdate->execute([$matin, $apresMidi, $commentaire, $dateEnregistrement, $nom, $prenom]);
            } else {
                $stmtInsert = $conn->prepare("INSERT INTO appel (nom, prenom, status, matin, apres_midi, commentaire, date_enregistrement) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmtInsert->execute([$nom, $prenom, $status, $matin, $apresMidi, $commentaire, $dateEnregistrement]);
            }
        }
        return ['success' => true, 'message' => 'Les données de l\'appel ont été enregistrées avec succès.'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Erreur lors de l\'enregistrement des données de l\'appel: ' . $e->getMessage()];
    }
}

// Fonction pour générer le fichier Excel
function generateExcelFile($etudiants){
    require_once '../../vendor/autoload.php'; // Inclure le fichier d'autoloading de PhpSpreadsheet

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // En-têtes du tableau Excel
    $sheet->setCellValue('A1', 'Nom');
    $sheet->setCellValue('B1', 'Prénom');
    $sheet->setCellValue('C1', 'Présent le matin');
    $sheet->setCellValue('D1', 'Présent l\'après-midi');
    $sheet->setCellValue('E1', 'Commentaire');

    // Remplissage des données du tableau Excel
    $row = 2;
    // Régler la largeur des colonnes
    $sheet->getColumnDimension('A')->setWidth(25);
    $sheet->getColumnDimension('B')->setWidth(25);
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(20);
    $sheet->getColumnDimension('E')->setWidth(40);
    foreach ($etudiants as $index => $etudiant) {
        if ($etudiant['status'] == 'not active') {
            continue; // Passer à l'itération suivante si l'étudiant est inactif
        } else {
        $sheet->setCellValue('A' . $row, $etudiant['nom']);
        $sheet->setCellValue('B' . $row, $etudiant['prenom']);
        // Récupérer les données du formulaire
        $sheet->setCellValue('C' . $row, empty($_POST['presentM'][$index]) ? 'n' : 'yes'); // Utilisation de empty() pour vérifier si la case est cochée
        $sheet->setCellValue('D' . $row, empty($_POST['presentAM'][$index]) ? 'n' : 'yes');
        $sheet->setCellValue('E' . $row, isset($_POST['commentaire' . $index]) ? $_POST['commentaire' . $index] : ''); // Utilisation de isset() pour vérifier si le commentaire existe
        $row++; // Incrémenter le numéro de ligne
        };
    }

    // Création d'un répertoire pour stocker les fichiers Excel
    $dir = '../appel/' . date('m_Y') . '/';
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    // Nom du fichier Excel
    $excelFilePath = $dir . date('d') . '.xlsx';

    // Sauvegarde du fichier Excel
    $writer = new Xlsx($spreadsheet);
    $writer->save($excelFilePath);

    return $excelFilePath;
}

// Fonction qui va envoyer un mail pour prévenir de l'absence d'un étudiant, l'administrateur et l'étudiant recevront le mail
function sendMail($etudiants, $messageAbsence, $conn){
    $stmtGenre = $conn->prepare("SELECT gender FROM student WHERE nom = ? AND prenom = ?");
    $stmtGenre->execute([$etudiants['nom'], $etudiants['prenom']]);
    $genre = $stmtGenre->fetchColumn();

    if ($genre == 'homme') {
        $genre = 'Monsieur';
    } elseif ($genre == 'femme'){
        $genre = 'Madame';
    }
    require '../../config.php'; // Inclure le fichier de configuration pour PHPMailer
    var_dump($etudiants);
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    try {
        // server setting
        // Encoding utf-8
        $mail->CharSet = 'UTF-8';
        //Send using SMTP
        $mail->isSMTP();
        //Set the SMTP server to send through
        $mail->Host = 'smtp.gmail.com';
        //Enable SMTP authentication
        $mail->SMTPAuth   = true;
        //SMTP username
        $mail->Username = 'anaselkhiat78@gmail.com';
        // $mail->Username = 'contact@start-zup.com';
        //SMTP password
        $mail->Password = 'pdubmyiprdgsqvmg';
        // $mail->Password = 'mqkeyidmxdijurxa';
        //Enable implicit TLS encryption
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Port       = 465;

        //Recipients
        $mail->addAddress($etudiants['email']);
        $mail->addAddress('anaselkhiat78@gmail.com');
        // $mail->addAddress('contact@start-zup.com');
        
        $mail->isHTML(true);
        $mail->Subject = 'Absence le ' . date('d/m/Y');
        $mail->Body = $genre . ' '. $etudiants['nom'] . ' ' . $etudiants['prenom'] .
        '<br>  vous avez été absent(e) à l\'appel le ' . date('d/m/Y') . $messageAbsence . '. <br>
        Merci de nous envoyer un justificatif à l\'adresse mail suivante : contact@start-zup.com ou de prévenir votre formateur/trice
        <br> Cordialement, <br> L\'équipe StartZup';
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
