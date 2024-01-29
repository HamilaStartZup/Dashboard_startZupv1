<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nom_language'];
    $code = $_POST['code'];
    $flag = uploadFlag();
    addLanguage($conn, $name, $code, $flag);
    // header("Location: ./addLanguage.php");
}

function addLanguage($conn, $name, $code, $flag) {
  $sql = "INSERT INTO languages (nom_language, code, flag) VALUES (:nom_language, :code, :flag)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':nom_language', $name);
  $stmt->bindParam(':code', $code);
  $stmt->bindParam(':flag', $flag);
  $stmt->execute();
}

function uploadFlag(){
    $name = $_POST['nom_language'];
    $target_dir = "../images/drapeau/";
    $target_file = $target_dir . basename($_FILES["flag"]["tmp_name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    
    $check = getimagesize($_FILES["flag"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('Le fichier n'est pas une image.')</script>";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["flag"]["tmp_name"], $target_file)) {
        return $target_file;
        } else {
        echo "<script>alert('Une erreur est survenue lors de l'upload du fichier.')</script>";
        }
    }
}
?>
