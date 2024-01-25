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
            $sql = "INSERT INTO users(`Email`, `firstname`, `description`, `comment`, `status`, `password`) VALUES (:email, :Nom, :Designation, :Comment, 'Admin', :HashPass)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $Email, PDO::PARAM_STR);
            $stmt->bindParam(':Nom', $Nom, PDO::PARAM_STR);
            $stmt->bindParam(':Designation', $Designation, PDO::PARAM_STR);
            $stmt->bindParam(':Comment', $Comment, PDO::PARAM_STR);
            $stmt->bindParam(':HashPass', $HashPass, PDO::PARAM_STR);
            $stmt->execute();

            echo '<script>alert("L\'administrateur a été enregistré avec succès.");
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

