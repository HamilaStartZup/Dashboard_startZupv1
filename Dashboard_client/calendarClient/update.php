<?php

//update.php

$connect = new PDO('mysql:host=localhost;dbname=start_zup', 'root', '');

if(isset($_POST["id"]))
{
 $query = "UPDATE `creneaux` SET  `id`=:id,`start_event`=:start_event,`end_event`=:end_event WHERE `id`=:id;";

 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end'],
   ':id'   => $_POST['id']
  )
 );
}

?>