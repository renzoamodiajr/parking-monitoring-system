<?php

require_once '../H/Controllers/LoginController.php';


if(isset($_POST['loginUserTrigger']) == true){
    $data = [
        'loginUsername' => $_POST['loginUsername'],
        'loginPass' => $_POST['loginPass']
    ];

    $loginUser = new LoginController();
    $loginUser->loginUser($data);
}