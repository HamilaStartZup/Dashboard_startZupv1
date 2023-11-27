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


     // Verification de la présence dans la DB avec l'email
     $sql_verif = "SELECT COUNT(*) from users WHERE Email = '$Email'";
     $verif = $conn->prepare($sql_verif);
     $verif->execute();

     // Insertion dans DB
     if ($verif->fetchColumn() == 0) {

          $sql = "INSERT INTO users(`Email`, `firstname`, `description`, `comment`,`status`, `password`) VALUES ('$Email','$Nom','$Designation','$Comment','Client', '$HashPass')";
          $conn->exec($sql);
          echo '<script> alert("Le client a été enregistré avec succès.");
                   location.replace("add_client_admin.php");
</script>';



     } else {
          echo '<script> alert("Le compte est déjà existant avec cette adresse email!");
                location.replace("add_client_admin.php");
                </script>';
     }
}




?>