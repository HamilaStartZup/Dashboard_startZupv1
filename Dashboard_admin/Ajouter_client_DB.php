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
     $dossier = $Nom;
     $upload_dir = '../uploads/clients/logo/' . $dossier . '/';

     if (!file_exists($upload_dir)) { // si le dossier n'existe pas
          mkdir($upload_dir, 0777, true); // on le crée
     }

     $logo = "logo"; // nom du fichier
     $logoPath = $upload_dir . $logo; // chemin complet avec nom du fichier



     // Verification de la présence dans la DB avec l'email
     $sql_verif = "SELECT COUNT(*) from users WHERE Email = '$Email'";
     $verif = $conn->prepare($sql_verif);
     $verif->execute();

     // Insertion dans DB
     if ($verif->fetchColumn() == 0) {
          if ($logo == "") {
               $logoPath = null;
          } else {
               move_uploaded_file($_FILES['logoClient']['tmp_name'], $logoPath); // 
          }

          $sql = "INSERT INTO users(`Email`, `firstname`, `description`, `comment`,`status`, `password`, `logo`) VALUES ('$Email','$Nom','$Designation','$Comment','Client', '$HashPass', '$logoPath')";
          $conn->exec($sql);
          echo '<script> alert("Le client a été enregistré avec succès.");
                   location.replace("/Dashboard_StartZupv1/ajouter-client-admin");
               </script>';



     } else {
          echo '<script> alert("Le compte est déjà existant avec cette adresse email!");
                location.replace("/Dashboard_StartZupv1/ajouter-client-admin");
                </script>';
     }
}




?>