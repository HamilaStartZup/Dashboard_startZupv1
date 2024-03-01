<?php
include("../config.php");

session_start();
// Si l'utilisateur n'ai pas administrateur, il est redirigé vers la page d'accueil
if ($_SESSION['status'] != "Admin") {
  header("Location: /Dashboard_startZupv1/acces-echoue");
}

// Vérifiez si l'ID est défini et n'est pas vide
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Utilisation de requêtes préparées pour éviter les injections SQL
    $deleteCreneauQuery = "DELETE FROM `creneaux` WHERE `id_rdv` = :id";
    $deleteRdvQuery = "DELETE FROM `rdv` WHERE id = :id";

    $stmtCreneau = $conn->prepare($deleteCreneauQuery);
    $stmtRdv = $conn->prepare($deleteRdvQuery);

    // Liaison des paramètres
    $stmtCreneau->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtRdv->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécution des requêtes
    $stmtCreneau->execute();
    $stmtRdv->execute();

    // Vérification du succès de la suppression
    if ($stmtCreneau->rowCount() < 0 && $stmtRdv->rowCount() < 0) {
        $users_id = isset($_GET['id_student']) ? $_GET['id_student'] : '';
        echo "<script>window.location.href='/Dashboard_startZupv1/gerer-rdv-$users_id-{$_GET['email']}';</script>";
    } else {
        $users_id = isset($_GET['id_student']) ? $_GET['id_student'] : '';
        echo "<script>window.location.href='/Dashboard_startZupv1/gerer-rdv-$users_id-{$_GET['email']}';</script>";

    }
} else {
    echo "<script>windows.location.href='/Dashboard_startZupv1/gerer-rdv';</script>";
}

?>
