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
           $C=$competences[0];
           for($i=1;$i<count($competences);$i++){
              $C.= ','.$competences[$i];
           }
           echo'hi'. var_dump($competences);
           // $filename = $_FILES["uploadfile"]["name"];
            //$tempname = $_FILES["uploadfile"]["tmp_name"];
           // $folder = "./image/" . $filename;

            // Verification de la présence dans la DB avec l'email
           $sql_verif = "SELECT COUNT(*) from student WHERE email = '$Email'";
            $verif = $conn->prepare($sql_verif);
            $verif->execute();

            // Insertion dans DB
            if ($verif->fetchColumn() == 0) {
              
                    $sql = " INSERT INTO student (nom, Prenom, phone, adresse, email,date_naissance,disponibility,designation,code_profile,competence) VALUES ('$Nom', '$Prenom','$Tel', '$Adresse', '$Email', '$Birthday','$Disponibility','$Designation','$code_profile','$C')";
                    $conn->exec($sql);
             echo '<script> alert("Le candidat a été ajouté avec succès.");
                   location.replace("addCandidats.php");
</script>';
                
                  
                
            } else {
                echo '<script> alert("Le compte est déjà existant avec cette adresse email!");
                location.replace("addCandidats.php");
                </script>';
            }
        }
   
   
   
        
        ?>

