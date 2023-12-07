<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=start_zup', 'root', '');

$data = array();

$query = "SELECT username as titles, status ,creneaux.id as id , start_event,end_event FROM `creneaux` INNER JOIN (SELECT username, description , rdv.id FROM `rdv` INNER JOIN users ON rdv.users_id=users.id) as R ON R.id=creneaux.id_rdv where status='oui'   ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   =>'entretien de dhdhd  chez : '.$row["titles"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);

?>
