<?php session_start(); 
if(empty($_SESSION['name'])){
    header('location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>

    <?php include_once 'includes/css_links.php' ?>
    
</head>
<body>

    <div class="container-fluid" style="padding:0">
        <?php include_once 'resources/views/admin.sidebar.view.php'; ?>

        <div class="page-content">
            <?php include_once 'resources/views/top-nav.view.php'; ?>
            <main>
                <?php include_once 'resources/views/manage-users.view.php'; ?>
            </main>
        </div>
        <div class="card restrictSmallScrns" style="display: none;"><div class="card-body text-center"><h4 class="text-danger">YOU SHOULD NOT BE HERE DUDE!</h4><p></p></div></div>
    </div>
        
    <?php include_once 'resources/views/toastMsg.php'; ?>     
    <?php include_once 'includes/js_links.php' ?>
</body>
</html>