<?php
include('../../config.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $etudiants = $_POST['etudiants']; 

    // Appeler la fonction pour enregistrer les données en base de données
    $result = saveAppelData($etudiants, $conn);

    // Appeler la fonction pour générer le fichier Excel
    $excelFilePath = generateExcelFile($etudiants);

    // Renvoyer un popup de confirmation
    echo "<script>
    alert('L appel a été enregistré avec succès.')

    window.location.href = '/Dashboard_startZupv1/liste-des-appels'
    </script>";


    exit; // Arrêter l'exécution du reste de la page
}

// Fonction pour enregistrer les données en base de données
function saveAppelData($etudiants, $conn)
{
    try {
        // Préparez et exécutez la requête d'insertion pour chaque étudiant
        $dateEnregistrement = date('Y-m-d');

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
            $stmtInsert = $conn->prepare("INSERT INTO appel (nom, prenom, status, matin, apres_midi, commentaire, date_enregistrement) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmtInsert->execute([$nom, $prenom, $status, $matin, $apresMidi, $commentaire, $dateEnregistrement]);
        }
        return ['success' => true, 'message' => 'Les données de l\'appel ont été enregistrées avec succès.'];
    } catch (PDOException $e) {
        return ['success' => false, 'message' => 'Erreur lors de l\'enregistrement des données de l\'appel: ' . $e->getMessage()];
    }
}

// Fonction pour générer le fichier Excel
function generateExcelFile($etudiants)
{
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
        $sheet->setCellValue('A' . $row, $etudiant['nom']);
        $sheet->setCellValue('B' . $row, $etudiant['prenom']);
        // Récupérer les données du formulaire
        $sheet->setCellValue('C' . $row, empty($_POST['presentM'][$index]) ? 'n' : 'yes'); // Utilisation de empty() pour vérifier si la case est cochée
        $sheet->setCellValue('D' . $row, empty($_POST['presentAM'][$index]) ? 'n' : 'yes');
        $sheet->setCellValue('E' . $row, isset($_POST['commentaire' . $index]) ? $_POST['commentaire' . $index] : ''); // Utilisation de isset() pour vérifier si le commentaire existe
        $row++; // Incrémenter le numéro de ligne
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
?>
