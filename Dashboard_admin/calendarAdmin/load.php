<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=start_zup', 'root', '');

$data = array();

$query = "SELECT `Email`,`username` ,`code_profile` ,`designation` , RDVInfo.id,`start_event`,`end_event`,nom,prenom FROM `users` INNER JOIN (SELECT `code_profile` ,`designation` , C.creneauxID as id,`start_event`,`end_event`,clientID,nom,prenom FROM student INNER JOIN (SELECT creneaux.id as creneauxID,`start_event`,`end_event`,rdv.student_id as student ,rdv.users_id as clientID FROM `creneaux` INNER JOIN rdv ON creneaux.`id_rdv`=rdv.id where creneaux.status='oui') as C ON student.id=C.student)as RDVInfo ON users.id= RDVInfo.clientID  ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   =>'Entretien de  '.$row["nom"] .' '.$row["prenom"] .'_ '.$row["designation"] .'  chez : '.$row["username"].' avec  code profile : '.$row["code_profile"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"],
  'email'   => $row["Email"],
  'code_profile' => $row["code_profile"],
  'designation' => $row["designation"]

 );
}

echo json_encode($data);

?>
