<?php
include('config.php');
$query= $conn->prepare("SELECT*FROM users WHERE Email = ?");
$query->execute([$_POST['email']]);
$user=$query->fetch();

if ($user &&($_POST['password']==$user['password']))

{session_start();
    $_SESSION['username']=$user['username'];
    $_SESSION['email']=$user['Email'];
    //compare different permission
    if($user['status']=='Admin'){
        header("Location:Dashboard_admin/dashboard.html");
       }else{
        header("Location:Dashboard_client/dashboard_client.html");
       }
   
}else{
    header("Location:index.php");
}
//require('config.php');
?>