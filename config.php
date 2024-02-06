<?php
//connection locale
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "start_zup";
//connection OVH
// $servername = "startzldashboard.mysql.db";
// $username = "startzldashboard";
// $password = "ENgiML0xml6uzxqr";
// $dbname = "startzldashboard";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
  // set the PDO error mode to
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "successfully connected";
} catch(PDOException $e) {
  echo  "<br>" . $e->getMessage();
}

?>

