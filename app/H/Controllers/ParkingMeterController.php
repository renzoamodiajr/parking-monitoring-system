<?php require_once '../../config/dbcon.php';

date_default_timezone_set('Asia/Manila');

class ParkingMeter extends DatabaseConnection{


    public function fetchPMeterData($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $arr = array();
            $stmt = $this->connectDb()->prepare("SELECT * FROM parking_transaction INNER JOIN parking_area_info ON parking_transaction.parking_info_id = parking_area_info.parking_info_id WHERE parking_status = 'Unpaid' AND parking_transaction.parking_info_id = :areaID");
            $stmt->bindParam(':areaID', $data['areaID']);
            $stmt->execute();
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                
                $subArr = array();
                $subArr[] = $row['plate_num'];
                $subArr[] = $row['vehicle_type'];
                $subArr[] = $row['time_check_in'];
                $subArr[] = $row['duration'];
                $subArr[] = '₱'.$row['parking_rate'];
                $subArr[] = '<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#checkOutModal'.$row['transactionID'].'"><i class="fas fa-arrow-circle-up"></i></button>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#rePrintTicketModal'.$row['transactionID'].'"><i class="fas fa-print"></i></button>';
                $arr[] = $subArr;

                // UPDATES PARKING DURATION AND PARKING RATE DYNAMICALLY
                $plate_num = $row['plate_num'];
                $timeIn = $row['time_check_in'];
                $currentTime = Date('H:i');
                $diff = date_diff(date_create($timeIn), date_create($currentTime));
                $duration = $diff->format('%H:%I');
                $explode = explode(':', $duration);
                $minDuration = ($explode[0]*60) + ($explode[1]);
                $rate = round($minDuration * 0.33);
                $dur = $explode[0].'hr '.$explode[1].'min';
                $upd = $this->connectDb()->prepare("UPDATE parking_transaction SET duration = :duration, parking_rate = :rate WHERE plate_num = :plateNum AND time_checked_out = '' AND transactionID = :transactID");
                $upd->bindParam(":duration", $dur);
                $upd->bindParam(":rate", $rate);
                $upd->bindParam(":plateNum", $plate_num);
                $upd->bindParam(":transactID", $row['transactionID']);
                $upd->execute();
            }
            echo json_encode($arr);
        }
    }


    public function countSlots($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // 4 WHEELER TOTAL SLOTS
            $stmt1 = $this->connectDb()->prepare("SELECT SUM(tot_4Wheel_slot) as totSlots4W FROM parking_area_info WHERE parking_info_id = :areaID");
            $stmt1->bindParam(':areaID', $data['areaID']);
            $stmt1->execute();
            $totSlots4W = $stmt1->fetch();
            
            // 4 WHEELER VACANT SLOTS
            $stmt2 = $this->connectDb()->prepare("SELECT * FROM parking_transaction WHERE parking_info_id = :areaID AND time_checked_out = '' AND parking_status = 'Unpaid' AND vehicle_type = '4 Wheeler'");
            $stmt2->bindParam(':areaID', $data['areaID']);
            $stmt2->execute();
            $vacSlots4W = $totSlots4W['totSlots4W'] - $stmt2->rowCount();


            // 2 WHEELER TOTAL SLOTS
            $stmt3 = $this->connectDb()->prepare("SELECT SUM(tot_2Wheel_slot) as totSlots2W FROM parking_area_info WHERE parking_info_id = :areaID");
            $stmt3->bindParam(':areaID', $data['areaID']);
            $stmt3->execute();
            $totSlots2W = $stmt3->fetch();

            // 2 WHEELER VACANT SLOTS
            $stmt4 = $this->connectDb()->prepare("SELECT * FROM parking_transaction WHERE parking_info_id = :areaID AND time_checked_out = '' AND parking_status = 'Unpaid' AND vehicle_type = '2 Wheeler'");
            $stmt4->bindParam(':areaID', $data['areaID']);
            $stmt4->execute();
            $vacSlots2W = $totSlots2W['totSlots2W'] - $stmt4->rowCount();

            
            // TOTAL SLOTS 
            $stmt5 = $this->connectDb()->prepare("SELECT (SUM(tot_4Wheel_slot) + SUM(tot_2Wheel_slot)) as totSlots FROM parking_area_info WHERE parking_info_id = :areaID");
            $stmt5->bindParam(':areaID', $data['areaID']);
            $stmt5->execute();
            $totSlots = $stmt5->fetch();

            echo json_encode(
                    array(
                        'totSlots' => $totSlots['totSlots'],
                        'vacSlots4W' => $vacSlots4W.'/'.$totSlots4W['totSlots4W'],
                        'vacSlots2W' => $vacSlots2W.'/'.$totSlots2W['totSlots2W']
                    )
                );
        }
    }

    public function checkInDriver($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dateIn = Date('Y-m-d');
            $timeIn = Date('H:i');
            $stmt = $this->connectDb()->prepare("INSERT INTO parking_transaction VALUES (default, :userID, :parking_info_id, :plate_num, :vehicle_type, :date_in, :time_check_in, '', default, default, default)");
            $stmt->bindParam(":userID", $data['userID']);
            $stmt->bindParam(":parking_info_id", $data['areaID']);
            $stmt->bindParam(":plate_num", $data['plateNum']);
            $stmt->bindParam(":vehicle_type", $data['vhType']);
            $stmt->bindParam(":date_in", $dateIn);
            $stmt->bindParam(":time_check_in", $timeIn);
            
            if($stmt->execute()){

                $this->activityLogQuery($data['userID'], 'checked-in a '.$data['vhType'].' vehicle with a Plate Number '.$data['plateNum'].' at '.$data['areaName']);

                echo json_encode(array('statusCode' => 'checkedIn', 'timeIn' => $timeIn));
            }
        }
        
    }
    

    public function checkOutDriver($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $time_checked_out = Date('H:i');
            $stmt = $this->connectDb()->prepare("UPDATE parking_transaction SET time_checked_out = :time_checked_out, parking_status = 'Paid' WHERE transactionID = :transactID");
            $stmt->bindParam(":time_checked_out", $time_checked_out);
            $stmt->bindParam(":transactID", $data['transactID']);
            
            $selSTMT = $this->connectDb()->prepare("SELECT * FROM parking_transaction INNER JOIN parking_area_info ON parking_transaction.parking_info_id = parking_area_info.parking_info_id WHERE transactionID = :transactID");
            $selSTMT->bindParam(":transactID", $data['transactID']);
            $selSTMT->execute();
            $row = $selSTMT->fetch();

            if($stmt->execute()){

                $this->activityLogQuery($data['userID'], 'checked-out a '.$row['vehicle_type'].' vehicle with a Plate Number '.$row['plate_num'].' from '.$row['parking_area_name']);

                echo json_encode(
                                array(
                                    'statusCode' => 'checkedOut', 
                                    'vhType' => $row['vehicle_type'],
                                    'dateIn' => $row['date_parked_in'],
                                    'timeIn' => $row['time_check_in'],
                                    'timeOut' => $time_checked_out,
                                    'duration' => $row['duration'],
                                    'amountDue' => $row['parking_rate']
                                )
                            );
            }
        }
        
    }


    // ================================== CHARTS ===================================

    // PARKING FREQUENCY
    public function dailyFreqChart($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $today = Date('Y-m-d');
           
            
            $freqArr = array();
            for($i = 0; $i < 24; $i++){
                $num = 0 + $i;
                $time = sprintf("%02d", $num);
                $stmt = $this->connectDb()->prepare("SELECT COUNT(*) as freq FROM parking_transaction WHERE time_check_in = $time AND date_parked_in = :today AND parking_status = 'Paid' AND parking_info_id = :areaID");
                $stmt->bindParam(":today", $today);
                $stmt->bindParam(":areaID", $data['areaID']);
                $stmt->execute();
                foreach($stmt as $row){
                    $freqArr[] = $row['freq'];
                }
            }
            echo json_encode(array('freq' => $freqArr));
        }
        
    }


    // PARKING REVENUE
    public function dailyRevChart($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $today = Date('Y-m-d');
           
            
            $revArr = array();
            for($i = 0; $i < 24; $i++){
                $num = 0 + $i;
                $time = sprintf("%02d", $num);
                $stmt = $this->connectDb()->prepare("SELECT SUM(parking_rate) as rev FROM parking_transaction WHERE time_check_in = $time AND date_parked_in = :today AND parking_status = 'Paid' AND parking_info_id = :areaID");
                $stmt->bindParam(":today", $today);
                $stmt->bindParam(":areaID", $data['areaID']);
                $stmt->execute();
                foreach($stmt as $row){
                    $revArr[] = $row['rev'];
                }
            }
            echo json_encode(array('rev' => $revArr));
        }
        
    }
   
}