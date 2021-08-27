<?php session_start(); 
if(!empty($_SESSION['name'])){
    header('location: dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Monitoring</title>

    <?php include_once 'includes/css_links.php' ?>
    
</head>
<body id="login-page">


  <?php include "resources/views/login.view.php"; ?>
 <?php include_once 'includes/js_links.php' ?>
</body>
</html>