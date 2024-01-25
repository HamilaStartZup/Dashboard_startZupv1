<?php

// Database Connection
session_start();
include '../config.php';

$addFavorites = "INSERT INTO `favorites_profil`(`id_client`, `id_candidate`) VALUES (:id_client, :id_candidate)";
$stmtAddFavorites = $conn->prepare($addFavorites);
$stmtAddFavorites->bindParam(':id_client', $_SESSION['id'], PDO::PARAM_INT);
$stmtAddFavorites->bindParam(':id_candidate', $_POST['condidatId'], PDO::PARAM_INT);
$stmtAddFavorites->execute();

header("Location: /Dashboard_startZupv1/les-stagiaires");
