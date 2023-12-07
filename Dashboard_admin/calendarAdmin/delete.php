
<?php

//delete.php

if(isset($_POST["id"]))
{
    $connect = new PDO('mysql:host=localhost;dbname=start_zup', 'root', '');
 $query = "
 DELETE from  `creneaux` WHERE id=:id
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}

?>