<?php require_once '../Http/Controllers/ParkingMeterController.php';


if(isset($_POST['fetchPMeterDataTrig']) == true){
    $data = [
        'areaID' => $_POST['areaID']
    ];
    $fetchPMeterData = new ParkingMeter();
    $fetchPMeterData->fetchPMeterData($data);
}

if(isset($_POST['countSlotsTrig']) == true){
    $data = [
        'areaID' => $_POST['areaID'],
        'areaName' => $_POST['areaName']
    ];
    $countSlots = new ParkingMeter();
    $countSlots->countSlots($data);
}



if(isset($_POST['checkInTrig']) == true){
    $data = [
        'userID' => $_POST['userID'],
        'areaID' => $_POST['areaID'],
        'areaName' => $_POST['areaName'],
        'plateNum' => $_POST['plateNum'],
        'vhType' => $_POST['vhType']
    ];

    $checkIn = new ParkingMeter();
    $checkIn->checkInDriver($data);
}


if(isset($_POST['checkOutTrig']) == true){
    $data = [
        'userID' => $_POST['userID'],
        'transactID' => $_POST['transactID']
    ];

    $checkOutDriver = new ParkingMeter();
    $checkOutDriver->checkOutDriver($data);
}




// ================== PARKING METER CHARTS ==================
if(isset($_POST['dailyFreqChartTrig']) == true){
    $data = [
        'areaID' => $_POST['areaID']
    ];
    $dailyFreqChart = new ParkingMeter();
    $dailyFreqChart->dailyFreqChart($data);
}

if(isset($_POST['dailyRevChartTrig']) == true){
    $data = [
        'areaID' => $_POST['areaID']
    ];
    $dailyRevChart = new ParkingMeter();
    $dailyRevChart->dailyRevChart($data);
}
