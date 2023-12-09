<?php

//load.php

session_start();
include '../../config.php';

$data = array();

$query = "SELECT `code_profile` ,`designation` , C.creneauxID as id,`start_event`,`end_event`,C.status FROM student INNER JOIN (SELECT creneaux.id as creneauxID,`start_event`,`end_event`,rdv.student_id as student ,`creneaux`.`status` FROM `creneaux` INNER JOIN rdv ON creneaux.`id_rdv`=rdv.id WHERE rdv.users_id=$_SESSION[id]) as C ON student.id=C.student WHERE C.`status`='oui' ORDER BY id;";

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   =>'Entretien avec candidat de code :  '.$row["code_profile"]." _ ".$row["designation"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>
