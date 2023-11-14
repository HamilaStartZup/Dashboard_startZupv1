<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $etudiants = $_POST['etudiants']; 

    // Appeler la fonction pour enregistrer les données en base de données
    $result = saveAppelData($etudiants, $conn);

    // Renvoyer une réponse JSON
    header('Content-Type: application/json');
    echo json_encode($result);
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
?>
