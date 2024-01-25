<?php

// Database Connection
session_start();
include '../config.php';

$addFavorites = "DELETE FROM `favorites_profil` WHERE `id_client`=:id_client AND `id_candidate`=:id_candidate";
$stmtDelete = $conn->prepare($addFavorites);
$stmtDelete->bindParam(':id_client', $_SESSION['id'], PDO::PARAM_INT);
$stmtDelete->bindParam(':id_candidate', $_POST['condidatId'], PDO::PARAM_INT);
$stmtDelete->execute();
$prev = $_GET['prev'];


if ($prev == 2) {
    //if on click remouve fav  from list interface
    header("Location: /Dashboard_startZupv1/les-stagiaires");
} else {
    //if on click remouve fav interns interface
    header("Location: /Dashboard_startZupv1/les-stagiaires");
}
