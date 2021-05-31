<?php

require_once '../../Http/Controllers/admin/ManageParkingController.php';


if(isset($_POST['fetchParkingAreasTrigger']) == true){
    
    $fetchParkingAreas = new ManageParkingController();
    $fetchParkingAreas->fetchParkingAreas();
}



if(isset($_POST['fetchPAreasForPMeterTrig']) == true){
    
    $fetchPAreasForPMeter = new ManageParkingController();
    $fetchPAreasForPMeter->fetchPAreasForPMeter();
}




if(isset($_POST['countAreasSlotsTrig']) == true){
    
    $countAreasSlots = new ManageParkingController();
    $countAreasSlots->countAreasSlots();
}


if(isset($_POST['addNewParkingArea']) == true){
    $data = [
        'newAreaNameInput' => $_POST['newAreaNameInput'],
        'new4WSlotinput' => $_POST['new4WSlotinput'],
        'new2WSlotinput' => $_POST['new2WSlotinput'],
        'adminAuthenticate' => $_POST['adminAuthenticate'],
        'adminID' => $_POST['adminID']
    ];

    $addNewParkingArea = new ManageParkingController();
    $addNewParkingArea->addNewParkingArea($data);
}


if(isset($_POST['configParkingArea']) == true){
    $data = [
        'parkingID' => $_POST['parkingID'],
        'areaNameDefVal' => $_POST['areaNameDefVal'],
        'FWSlotDefVal' => $_POST['FWSlotDefVal'],
        'TWSlotDefVal' => $_POST['TWSlotDefVal'],
        'newAreaName' => $_POST['areaName'],
        'newFWSlotVal' => $_POST['newFWSlotVal'],
        'newTWSlotVal' => $_POST['newTWSlotVal'],
        'adminPass' => $_POST['adminPass'],
        'adminID' => $_POST['adminID']
    ];

    $configParkingArea = new ManageParkingController();
    $configParkingArea->configParkingArea($data);
}



if(isset($_POST['deactParkingArea']) == true){
    $data = [
        'parkingID' => $_POST['parkingID'],
        'adminPass' => $_POST['adminPass'],
        'adminID' => $_POST['adminID']
    ];

    $deactParkingArea = new ManageParkingController();
    $deactParkingArea->deactParkingArea($data);
}


if(isset($_POST['reactivateParkingArea']) == true){
    $data = [
        'parkingID' => $_POST['parkingID'],
        'adminPass' => $_POST['adminPass'],
        'adminID' => $_POST['adminID']
    ];

    $reactivateParkingArea = new ManageParkingController();
    $reactivateParkingArea->reactivateParkingArea($data);
}


if(isset($_POST['deleteParkingArea']) == true){
    $data = [
        'parkingID' => $_POST['parkingID'],
        'adminPass' => $_POST['adminPass'],
        'adminID' => $_POST['adminID']
    ];

    $deleteParkingArea = new ManageParkingController();
    $deleteParkingArea->deleteParkingArea($data);
}