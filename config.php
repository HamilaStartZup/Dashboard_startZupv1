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

// PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//SMTP username
$userMailer = $mail->Username   = 'contact@start-zup.com';
//SMTP password
$pwdMailer = $mail->Password   = 'mqkeyidmxdijurxa';



try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
  // set the PDO error mode to
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "successfully connected";
} catch(PDOException $e) {
  echo  "<br>" . $e->getMessage();
}

?>

