<?php

// Database Connection
session_start();
include '../config.php';


$addRDV = "INSERT INTO `rdv`( `student_id`, `users_id`) VALUES ( $_POST[condidatId],$_SESSION[id]);";
$conn->exec($addRDV);
$lastIdRDV= "SELECT `id`FROM `rdv` ORDER BY `reg_date` DESC LIMIT 1";
                   //GET LAST STUDENT ID 
                   $lastIdCon= $conn->prepare($lastIdRDV);
                   $lastIdCon->execute();
                   $resultlastId=$lastIdCon->fetch(PDO::FETCH_ASSOC);
                   $addCR = "INSERT INTO `creneaux` (`start_event`, `id_rdv`, `end_event`) VALUES (:C1, :id_rdv1, ADDTIME(:C1, '01:00:00')), (:C2, :id_rdv2, ADDTIME(:C2, '01:00:00')), (:C3, :id_rdv3, ADDTIME(:C3, '01:00:00'))";

                   $stmtAddCR = $conn->prepare($addCR);
                   $stmtAddCR->bindParam(':C1', $_POST['C1'], PDO::PARAM_STR);
                   $stmtAddCR->bindParam(':C2', $_POST['C2'], PDO::PARAM_STR);
                   $stmtAddCR->bindParam(':C3', $_POST['C3'], PDO::PARAM_STR);
                   $stmtAddCR->bindParam(':id_rdv1', $resultlastId['id'], PDO::PARAM_INT);
                   $stmtAddCR->bindParam(':id_rdv2', $resultlastId['id'], PDO::PARAM_INT);
                   $stmtAddCR->bindParam(':id_rdv3', $resultlastId['id'], PDO::PARAM_INT);
                   
                   $stmtAddCR->execute();        


?>
<script>
    
      var email = 'start-zup@gmail.com';
      var subject = 'Intérêt pour le profil <?php echo$_GET['code_profile'] ?>';
       var body = 'Salut star_ZUP \n, je vais choisir le candidat avec le code : <?php echo$_GET['code_profile'] ?> pour un entretien. Je suis disponible pour les trois plages horaires suivantes  : <?php echo$_POST['C1'] ?> \t <?php echo$_POST['C2'] ?> \t<?php echo$_POST['C3'] ?> \n cordialement  <?php echo $_SESSION['username'] ?>';
      var mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
      window.location.href = mailtoLink;
      document.location.href="./profile.php?code_profile=<?php echo$_GET['code_profile'] ?>"; 

    
</script>
