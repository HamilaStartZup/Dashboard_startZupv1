<?php
require('config.php');
$query= $conn->prepare("SELECT*FROM users WHERE Email = ?");
$query->execute([$_POST['email']]);
$user=$query->fetch();

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $emailUser = $_POST['email'];
    $checkIfUserAlreadyExists = $conn->prepare("SELECT * FROM users WHERE Email = '$emailUser'");
    $checkIfUserAlreadyExists->execute();

    if($checkIfUserAlreadyExists->rowCount() > 0){
        $mdpUser = $_POST['password'];
        // if ($user &&($_POST['password']==$user['password']))
        if (password_verify($mdpUser, $user['password'])){
            session_start();
            $_SESSION['username']=$user['username'];
            $_SESSION['email']=$user['Email'];
            $_SESSION['status']=$user['status'];
            $_SESSION['id']=$user['id'];
            //compare different permission
            if($user['status']=='Admin'){
                header("Location:Dashboard_admin/dashboard.php");
            } else {
                header("Location:Dashboard_client/dashboard_client.html");
            }
        } else {
            echo "<script >
            window.alert('email ou mot de passe incorrect');
            // window.location.href='index.php';
            </script>";
        }
    }
    else {
        echo "<script >
        window.alert('Compte inexistant');
        window.location.href='index.php';
        </script>";
    }
}


?>