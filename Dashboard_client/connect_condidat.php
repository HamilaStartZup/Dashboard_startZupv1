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
 $addCR = "INSERT INTO `creneaux`( `start_event`, `id_rdv` , `end_event`) VALUES ('$_POST[C1]',$resultlastId[id],ADDTIME('$_POST[C1]', '01:00:00') ),('$_POST[C2]','$resultlastId[id]',ADDTIME('$_POST[C2]', '01:00:00') ),('$_POST[C3]','$resultlastId[id]',ADDTIME('$_POST[C3]', '01:00:00') )";
                   $conn->exec($addCR);         


?>
<script>
    
      var email = 'start-zup@gmail.com';
      var subject = 'Intérêt pour le profil <?php echo$_GET['code_profile'] ?>';
       var body = 'Salut star_ZUP \n, je vais choisir le candidat avec le code : <?php echo$_GET['code_profile'] ?> pour un entretien. Je suis disponible pour les trois plages horaires suivantes  : <?php echo$_POST['C1'] ?> \t <?php echo$_POST['C2'] ?> \t<?php echo$_POST['C3'] ?> \n cordialement  <?php echo $_SESSION['username'] ?>';
      var mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
      window.location.href = mailtoLink;
      document.location.href="./profile.php?code_profile=<?php echo$_GET['code_profile'] ?>"; 

    
</script>
