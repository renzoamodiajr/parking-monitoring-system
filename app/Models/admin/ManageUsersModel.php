<?php

require_once '../../Http/Controllers/admin/ManageUsersController.php';



// AUTO INCREMENT THE VALUE OF [USERNAME FIELD] WHEN CREATING NEW ACCOUNT
if(isset($_POST['fetchLastAcctTrig']) == true){
    $fetchLastAcct = new ManageUserController();
    $fetchLastAcct->fetchLastAcct();
}

// FETCH ALL DATA FROM USERS TABLE
if(isset($_POST['fetchUsersTrigger']) == true){
    $fetchUsers = new ManageUserController();
    $fetchUsers->fetchUsers();
}

// FETCH ALL PARKING AREAS FOR [ASSIGN/REASSIGN PARKING AREA FIELD] WHEN CREATING NEW ACCOUNT
if(isset($_POST['fetchAreaNamesTrig']) == true){
    $fetchAreaNames = new ManageUserController();
    $fetchAreaNames->fetchAreaNames();
}

// FOR DASHLETS
if(isset($_POST['countUsersTrig']) == true){
    $countUsers = new ManageUserController();
    $countUsers->countUsers();
}


// CREATE NEW ACCOUNT
if(isset($_POST['regUserTrigger']) == true){
    $data = [
        'fnameFld' => $_POST['fnameFld'],
        'lnameFld' => $_POST['lnameFld'],
        'unameFld' => $_POST['unameFld'],
        'passFld' => $_POST['passFld'],
        'assignPAreaFld' => $_POST['assignPAreaFld'],
        'adminID' => $_POST['adminID'],
        'adminAuthenticate' => $_POST['adminAuthenticate']
    ];

    $createAcc = new ManageUserController();
    $createAcc->createAcct($data);
}


// REASSIGN USER
if(isset($_POST['reassignUserTrigger']) == true){
    $data = [
        'newParkingArea' => $_POST['newVal'],
        'adminPassFld' => $_POST['needAdminPassFld'],
        'userID' => $_POST['userID'],
        'adminID' => $_POST['adminID']
    ];

    $reassignUser = new ManageUserController();
    $reassignUser->reassignUser($data);
}


// DEACTIVATE USER
if(isset($_POST['deactAcctTrigger']) == true){
    $data = [
        'adminPassFld' => $_POST['needAdminPassFld'],
        'userID' => $_POST['userID'],
        'adminID' => $_POST['adminID']
    ];

    $deactivateUser = new ManageUserController();
    $deactivateUser->deactivateUser($data);
}

// REACTIVATE USER
if(isset($_POST['reactivateAcctTrigger']) == true){
    $data = [
        'adminPassFld' => $_POST['needAdminPassFld'],
        'userID' => $_POST['userID'],
        'adminID' => $_POST['adminID']
    ];

    $reactivateUser = new ManageUserController();
    $reactivateUser->reactivateUser($data);
}


// DELETE USER
if(isset($_POST['deleteAcctTrigger']) == true){
    $data = [
        'adminPassFld' => $_POST['needAdminPassFld'],
        'userID' => $_POST['userID'],
        'adminID' => $_POST['adminID']
    ];

    $deleteUser = new ManageUserController();
    $deleteUser->deleteUser($data);
}