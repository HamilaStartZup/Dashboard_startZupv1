<?php
require('config.php');
$query= $conn->prepare("SELECT*FROM users WHERE Email = ?");
$query->execute([$_POST['email']]);
$user=$query->fetch();

if ($user &&($_POST['password']==$user['password']))

{session_start();
    $_SESSION['username']=$user['username'];
    $_SESSION['email']=$user['Email'];
    //compare different permission
    if($user['status']=='Admin'){
        header("Location:Dashboard_admin/dashboard.php");
       }else{
        header("Location:Dashboard_client/dashboard_client.html");
       }
   
}else{
    echo "<script >
    window.alert('email ou mot de passe incorrect');
    window.location.href='index.php';
    </script>";
    //header("Location:index.php");
}
//require('config.php');
?>