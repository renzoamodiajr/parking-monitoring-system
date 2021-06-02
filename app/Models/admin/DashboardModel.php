<?php

require_once '../../H/Controllers/admin/DashboardController.php';


if(isset($_POST['slotStatFreqRevDashletTrig']) == true){
    
    $slotStatFreqRevDashlet = new DashboardController();
    $slotStatFreqRevDashlet->slotStatFreqRevDashlet();
}


if(isset($_POST['weeklyDynamicReportTrig']) == true){
    
    $weeklyDynamicReport = new DashboardController();
    $weeklyDynamicReport->weeklyDynamicReport();
}


if(isset($_POST['monthlyDynamicReportTrig']) == true){
    
    $monthlyDynamicReport = new DashboardController();
    $monthlyDynamicReport->monthlyDynamicReport();
}



if(isset($_POST['yearlyDynamicReportTrig']) == true){
    
    $yearlyDynamicReport = new DashboardController();
    $yearlyDynamicReport->yearlyDynamicReport();
}