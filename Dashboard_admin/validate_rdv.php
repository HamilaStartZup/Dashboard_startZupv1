<?php 
session_start();
include ('../config.php');

$idCreneaux = $_POST['creneaux'];


$validateCreneaux = "UPDATE `creneaux` SET `status`='oui' WHERE `id`=$_POST[creneaux]";
$conn->exec($validateCreneaux);
$delOldCreneaux = "DELETE FROM `creneaux` WHERE `status`!= 'oui' AND `id_rdv` = (SELECT id_rdv FROM `creneaux` WHERE `id` = $idCreneaux)";
$conn->exec($delOldCreneaux);

$validateRDV_rdv = "UPDATE `rdv` SET `validate`='oui' WHERE `id` = (SELECT id_rdv FROM `creneaux` WHERE `id` = $idCreneaux)";
$conn->exec($validateRDV_rdv);
   
?>
<script>
    
    var email = ['start-zup@gmail.com','<?php echo$_GET['userMail']?>'];
    var mail2='halimailtoLink@gmail';
    var subject = 'Entretien de planification pour le candidat:  <?php echo$_GET['code'];?>';
     var body = 'Salut star_ZUP \n, je vais choisir le candidat avec le code : pour un entretien. Je suis disponible pour les trois plages horaires suivantes  :';
    var mailtoLink = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.location.href = mailtoLink;
    document.location.href="./manage_rdv.php?users_id=<?php echo$_GET['id']?>&email=<?php echo$_GET['userMail']?>"; 
   
  
</script>