<?php

// Database Connection
session_start();
include '../config.php';

$addFavorites = "DELETE FROM `favorites_profil` WHERE `id_client`=$_SESSION[id] AND `id_candidate`=$_POST[condidatId]";
$conn->exec($addFavorites);
$prev = $_GET['prev'];

if ($prev == 2) {
    //if on click remouve fav  from list interface
    header("Location: /Dashboard_startZupv1/les-stagiaires");
} else {
    //if on click remouve fav interns interface
    header("Location: /Dashboard_startZupv1/les-stagiaires");
}
