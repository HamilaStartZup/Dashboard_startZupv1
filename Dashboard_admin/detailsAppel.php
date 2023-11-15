<?php
session_start();
require('../config.php');

if ($_SESSION['status'] == "Admin") {
    // Récupérer la date envoyée par l'URL
    $date = $_GET['date'];

    // Vérifier si la date est définie dans l'URL
    if (!isset($date)) {
        echo "La date n'est pas définie dans l'URL.";
        exit; // Arrêter l'exécution du script
    }

    // Convertir la date en format aaaa-mm-dd
    $dateTime = DateTime::createFromFormat('d/m/Y', $date);

    // Vérifier si la conversion de date est réussie
    if (!$dateTime) {
        echo "La conversion de la date a échoué.";
        exit; // Arrêter l'exécution du script
    }

    // Récupérer la date au format aaaa-mm-dd car elle à été convertie dans listeAppel.php ligne 485
    $dateParams = $dateTime->format('Y-m-d');

    $sql = "SELECT * FROM `appel` WHERE `appel`.`date_enregistrement` = '$dateParams'"; // selectionner tous les appels de la date envoyée par l'URL
    $result = $conn->prepare($sql);
    $result->execute();
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);

    // Afficher les résultats
    echo "Date récupérée de l'URL : " . $date . "<br>";
    echo "Date convertie : " . $dateParams . "<br>";
    echo json_encode($rows);
} else {
    header('Location: ../index.php');
}
?>
