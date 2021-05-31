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
    <title>Parking Meter</title>

    <?php include_once 'includes/css_links.php' ?>
    
</head>
<body>

    <div class="container-fluid" style="padding:0">
        <?php 
            if($_SESSION['role'] == 'admin'):
                include_once 'resources/views/admin.sidebar.view.php'; 
            endif;

            if($_SESSION['role'] == 'cashier'):
                include_once 'resources/views/cashier.sidebar.view.php'; 
            endif;
        ?>

        <div class="page-content" id="parking-meter">
            <?php include_once 'resources/views/top-nav.view.php'; ?>
            <main class="psy-4 mb-5">
                    <?php 
                     
                        include_once 'resources/views/parking-meter-view.php'; 
                       
                    ?>
            </main>
        </div>

        <div class="card restrictSmallScrns" style="display: none;"><div class="card-body text-center"><h4 class="text-danger">YOU SHOULD NOT BE HERE DUDE!</h4><p></p></div></div>
    </div>
        
    <?php include_once 'resources/views/toastMsg.php'; ?>     
    <?php include_once 'includes/js_links.php' ?>
    <script src="resources/js/parking-meter.js"></script>
</body>
</html>