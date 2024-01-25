<?php
require('config.php');

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $emailUser = $_POST['email'];

    // Utilisation d'une requête préparée pour éviter les injections SQL
    $checkIfUserAlreadyExists = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $checkIfUserAlreadyExists->execute([$emailUser]);

    if ($checkIfUserAlreadyExists->rowCount() > 0) {
        $user = $checkIfUserAlreadyExists->fetch();
        $mdpUser = $_POST['password'];

        // Utilisation de password_verify pour vérifier le mot de passe haché
        if (password_verify($mdpUser, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['status'] = $user['status'];
            $_SESSION['id'] = $user['id'];

            // Comparaison des différentes permissions
            if ($user['status'] == 'Admin') {
                header("Location: /Dashboard_startZupv1/accueil");
            } elseif ($user['status'] == 'Formateur') {
                header("Location: /Dashboard_startZupv1/appel");
            } else {
                header("Location: /Dashboard_startZupv1/home");
            }
        } else {
            echo "<script>
                window.alert('Email ou mot de passe incorrect');
                window.location.href='index.php';
                </script>";
        }
    } else {
        echo "<script>
            window.alert('Compte inexistant');
            window.location.href='index.php';
            </script>";
    }
}
?>
