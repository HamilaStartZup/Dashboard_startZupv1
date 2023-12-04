<?php 
session_start();
include '../config.php';

$validateRDV = "UPDATE `creneaux` SET `status`='oui' WHERE `id`=$_POST[creneaux]";
$conn->exec($validateRDV);
   
?>
<script>
    
    var email = ['start-zup@gmail.com','<?php echo$_GET['userMail']?>'];
    var mail2='halimailtoLink@gmail';
    var subject = 'Entretien de planification pour le candidat:  <?php echo$_GET['code'];?>';
     var body = 'Salut star_ZUP \n, je vais choisir le candidat avec le code : pour un entretien. Je suis disponible pour les trois plages horaires suivantes  :';
    var mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.location.href = mailtoLink;
   
  
</script>