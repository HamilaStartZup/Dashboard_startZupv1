<?php
session_start();
        require('../config.php');
      
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Nom = $_POST['Nom'];
            $Prenom = $_POST['Prenom'];
            $Tel = $_POST['Tel'];
            $Adresse = $_POST['Adresse'];
            $Email = $_POST['Email'];
            $Birthday =$_POST['birthday'];
           $Designation=$_POST['designation'];
           $Disponibility=$_POST['disponibility'];
           $code_profile='SZ_'.rand(100, 900);
     
           $competences =$_POST['ary'];

            // Verification de la présence dans la DB avec l'email
         $sql_verif = "SELECT COUNT(*) from student WHERE email = '$Email'";
            $verif = $conn->prepare($sql_verif);
            $verif->execute();

            // Insertion dans DB
            if ($verif->fetchColumn() == 0) {
              
                    $sql = " INSERT INTO student (nom, Prenom, phone, adresse, email,date_naissance,disponibility,designation,code_profile) VALUES ('$Nom', '$Prenom','$Tel', '$Adresse', '$Email', '$Birthday','$Disponibility','$Designation','$code_profile')";
                    $conn->exec($sql);
                   $lastIdSql= "SELECT `id`FROM `student` ORDER BY `reg_date` DESC LIMIT 1";
                   //GET LAST STUDENT ID 
                   $lastIdCon= $conn->prepare($lastIdSql);
                   $lastIdCon->execute();
                   $resultlastId=$lastIdCon->fetch(PDO::FETCH_ASSOC);
                   for ($x = 0; $x <= count($competences)-1; $x++) {
                     //INSERT KILLS WITH  USERS  ID 
                     $skills ="INSERT INTO `student_skills`( `id_student`, `id_skills`) VALUES ('$resultlastId[id]','$competences[$x]')";
                     $conn->exec($skills);
                   }
                  
                  
   
                   echo'jddjeje'.$resultlastId['id'];
            // echo '<script> alert("Le candidat a été ajouté avec succès.");
                   //location.replace("addCandidats.php");
//</script>';
                     
                  
                
            } else {
                echo '<script> alert("Le compte est déjà existant avec cette adresse email!");
                location.replace("addCandidats.php");
                </script>';
            }
        }
   
   
       
        ?>

