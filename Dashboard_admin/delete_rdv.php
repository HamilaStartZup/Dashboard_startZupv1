<?php 
session_start();
include '../config.php';
$validateRDV = "  DELETE FROM `creneaux` WHERE `id_rdv`=$_GET[id] ; DELETE FROM `rdv` WHERE id=$_GET[id]; ";

$conn->exec($validateRDV);
echo "<script> alert('Le RDV a été suprime.');
location.replace('./mange_rdv.php?users_id=$_GET[id_student]');
</script>"
   
?>
