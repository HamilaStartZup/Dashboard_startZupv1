<?php

// Database Connection
session_start();
include '../config.php';

$addFavorites = "INSERT INTO `favorites_profil`(`id_client`, `id_candidate`) VALUES ($_SESSION[id],$_POST[condidatId]);";
$conn->exec($addFavorites);
header("Location: /Dashboard_startZupv1/les-stagiaires");
