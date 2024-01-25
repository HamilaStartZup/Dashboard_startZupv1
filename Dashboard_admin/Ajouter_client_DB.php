<?php
session_start();
require('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nom = $_POST['nomClient'];
    $Email = $_POST['emailClient'];
    $Designation = $_POST['descriptionClient'];
    $Comment = $_POST['comentaireClient'];
    $Password = $_POST['passwordClient'];
    $HashPass = password_hash($Password, PASSWORD_DEFAULT);

    // Vérification de la présence dans la DB avec l'email
    $sql_verif = "SELECT COUNT(*) FROM users WHERE Email = :email";
    $verif = $conn->prepare($sql_verif);
    $verif->bindParam(':email', $Email, PDO::PARAM_STR);
    $verif->execute();

    // Insertion dans DB
    if (!empty($Nom) && !empty($Email) && !empty($Designation) && !empty($Comment) && !empty($Password)) {
        if ($verif->fetchColumn() == 0) {
            $upload_dir = '../uploads/clients/logo/' . $Nom . '/';
            
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $logo = "logo";
            $logoPath = $upload_dir . $logo;

            if (!empty($_FILES['logoClient']['name'])) {
                move_uploaded_file($_FILES['logoClient']['tmp_name'], $logoPath);
            } else {
                $logoPath = null;
            }

            $sql = "INSERT INTO users(`Email`, `firstname`, `description`, `comment`, `status`, `password`, `logo`) VALUES (:email, :firstname, :description, :comment, 'Client', :password, :logo)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $Email, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $Nom, PDO::PARAM_STR);
            $stmt->bindParam(':description', $Designation, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $Comment, PDO::PARAM_STR);
            $stmt->bindParam(':password', $HashPass, PDO::PARAM_STR);
            $stmt->bindParam(':logo', $logoPath, PDO::PARAM_STR);

            $stmt->execute();

            echo '<script>alert("Le client a été enregistré avec succès.");
                location.replace("/Dashboard_StartZupv1/ajouter-client-admin");
                </script>';
        } else {
            echo '<script>alert("Le compte est déjà existant avec cette adresse email!");
                location.replace("/Dashboard_StartZupv1/ajouter-client-admin");
                </script>';
        }
    } else {
        echo '<script>alert("Veuillez remplir tous les champs!");
            location.replace("/Dashboard_StartZupv1/ajouter-client-admin");
            </script>';
    }
}
?>
