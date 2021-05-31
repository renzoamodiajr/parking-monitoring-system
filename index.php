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
<body>

<div class="container">
    <div class="wrapper" style="margin-top: 250px;">
        <div class="row">
            <?php include "resources/views/register.view.php"; ?>
            
            <?php include "resources/views/login.view.php"; ?>
        </div>
    </div>
</div>  

<div class="card restrictSmallScrns" style="display: none;"><div class="card-body text-center"><h4 class="text-danger">YOU SHOULD NOT BE HERE DUDE!</h4><p></p></div></div>
    <?php include_once 'includes/js_links.php' ?>
</body>
</html>