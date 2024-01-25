<?php
session_start();
require('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $Tel = $_POST['Tel'];
    $genre = $_POST['gender'];
    $Vehicule = $_POST['vehicule'];
    $Adresse = $_POST['Adresse'];
    $Email = $_POST['Email'];
    $Birthday = $_POST['birthday'];
    $description = $_POST['description'];
    $Designation = $_POST['designation'];
    $Disponibility = $_POST['disponibility'];
    $code_profile = 'SZ_' . rand(100, 900);
    $dossier = $Nom . "_" . $Prenom;
    $upload_dir = './uploads/candidats/' . $dossier . '/';

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $photo = $Nom . "_" . $Prenom . "_avatar.jpg";
    $photoPath = $upload_dir . $photo;

    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] == UPLOAD_ERR_NO_FILE) {
        $initialsImage = generateInitialsImage($Nom, $Prenom, $upload_dir);
        $photoPath = $initialsImage;
    } else {
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $photoPath)) {
            // L'upload s'est bien déroulé
        } else {
            echo '<script>alert("Erreur lors de l\'upload du fichier.");
                  location.replace("/Dashboard_startZupv1/ajouter-un-candidat");
                  </script>';
            exit;
        }
    }

    $competences = $_POST['ary'];
    $selectedSoftSkills = $_POST['softSkills'];

    // Vérification de la présence dans la DB avec l'email
    $sql_verif = "SELECT COUNT(*) FROM student WHERE email = :email";
    $verif = $conn->prepare($sql_verif);
    $verif->bindParam(':email', $Email, PDO::PARAM_STR);
    $verif->execute();

    // Insertion dans DB
    if ($verif->fetchColumn() == 0) {
        $sql = "INSERT INTO student (avatar, nom, Prenom, phone, gender, Vehicule, adresse, email, date_naissance, disponibility, designation, code_profile, description ) VALUES (:photoPath, :Nom, :Prenom, :Tel, :genre, :Vehicule, :Adresse, :Email, :Birthday, :Disponibility, :Designation, :code_profile, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':photoPath', $photoPath, PDO::PARAM_STR);
        $stmt->bindParam(':Nom', $Nom, PDO::PARAM_STR);
        $stmt->bindParam(':Prenom', $Prenom, PDO::PARAM_STR);
        $stmt->bindParam(':Tel', $Tel, PDO::PARAM_STR);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->bindParam(':Vehicule', $Vehicule, PDO::PARAM_STR);
        $stmt->bindParam(':Adresse', $Adresse, PDO::PARAM_STR);
        $stmt->bindParam(':Email', $Email, PDO::PARAM_STR);
        $stmt->bindParam(':Birthday', $Birthday, PDO::PARAM_STR);
        $stmt->bindParam(':Disponibility', $Disponibility, PDO::PARAM_STR);
        $stmt->bindParam(':Designation', $Designation, PDO::PARAM_STR);
        $stmt->bindParam(':code_profile', $code_profile, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        $stmt->execute();

        // Obtenir l'ID du dernier candidat inséré
        $lastId = $conn->lastInsertId();

        if (!empty($competences)) {
            foreach ($competences as $competence) {
                $skills = "INSERT INTO student_skills (id_student, id_skills) VALUES (:lastId, :competence)";
                $stmtSkills = $conn->prepare($skills);
                $stmtSkills->bindParam(':lastId', $lastId, PDO::PARAM_INT);
                $stmtSkills->bindParam(':competence', $competence, PDO::PARAM_INT);
                $stmtSkills->execute();
            }
        }

        if (!empty($selectedSoftSkills)) {
            $insertQuery = "INSERT INTO student_soft_skills (student_id, soft_skills_id) VALUES (?, ?)";
            $stmtSoftSkills = $conn->prepare($insertQuery);

            foreach ($selectedSoftSkills as $softSkillId) {
                $stmtSoftSkills->execute([$lastId, $softSkillId]);
            }
        }

        echo '<script>alert("Le candidat a été ajouté avec succès.");
                location.replace("/Dashboard_startZupv1/accueil");
                </script>';
    } else {
        echo '<script>alert("Le compte est déjà existant avec cette adresse email!");
                location.replace("/Dashboard_startZupv1/ajouter-un-candidat");
                </script>';
    }
}

function generateInitialsImage($nom, $prenom, $upload_dir){
    $initials = strtoupper(substr($nom, 0, 1) . substr($prenom, 0, 1));
    $image = imagecreate(100, 100);
    $background_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    $text_color = imagecolorallocate($image, 255, 255, 255);
    $font = realpath('./fonts/arial.ttf');
    imagettftext($image, 40, 0, 20, 70, $text_color, $font, $initials);

    $initialsImage = $upload_dir . $nom . "_" . $prenom . ".png";
    imagepng($image, $initialsImage);
    imagedestroy($image);

    return $initialsImage;
}
?>
