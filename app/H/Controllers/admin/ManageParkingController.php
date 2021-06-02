<?php require_once '../../../config/dbcon.php';


class ManageParkingController extends DatabaseConnection{

    public function fetchParkingAreas(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = array();
            $stmt = $this->connectDb()->prepare("SELECT * FROM parking_area_info");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($result as $row) {
                
                $subArr = array();
                $subArr[] = '<i class="fas fa-layer-group"></i> '.$row['parking_area_name'];
                $subArr[] = '<i class="fas fa-car"></i> '.$row['tot_4Wheel_slot'];
                $subArr[] = '<i class="fas fa-motorcycle"></i> '.$row['tot_2Wheel_slot'];

                $totPslot = $row['tot_4Wheel_slot'] + $row['tot_2Wheel_slot'];
                $subArr[] = '<i class="fas fa-parking"></i> '.$totPslot;

               
                $subArr[] = '<i class="fas fa-calendar-alt"></i> '.$row['date_added'];
                if($row['pa_status'] == 'Active'){

                    $subArr[] = '<span class="badge bg-success">Active</span>';

                    $subArr[] = '<button class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["parking_info_id"].'" data-form-target="edit_form" data-form-title="Configuring" data-bs-toggle="modal" data-form-icon="fas fa-wrench" data-bs-target="#manageParkingModal'.$row['parking_info_id'].'">
                                                <i class="fas fa-wrench"></i> Configure
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["parking_info_id"].'" data-form-target="deactivate_form" data-form-title="Deactivating" data-bs-toggle="modal" data-form-icon="fas fa-power-off" data-bs-target="#manageParkingModal'.$row['parking_info_id'].'">
                                                <i class="fas fa-power-off"></i> Deactivate
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["parking_info_id"].'" data-form-target="delete_form" data-form-title="Deleting" data-bs-toggle="modal" data-form-icon="fas fa-trash" data-bs-target="#manageParkingModal'.$row['parking_info_id'].'">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </li>
                                    </ul>


                                    <div class="modal fade" id="manageParkingModal'.$row['parking_info_id'].'" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><span>XXXX</span> '.$row['parking_area_name'].' area</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>



                                                <div class="modal-body modal-form edit_form" style="display:none">
                                                    <div class="row mb-3">
                                                        <div class="col position-relative">
                                                            <label class="form-label"><i class="fas fa-layer-group"></i> Area name</label>
                                                            <input type="text" class="form-control" id="areaName'.$row['parking_info_id'].'" data-def-val="'.$row['parking_area_name'].'" value="'.$row['parking_area_name'].'" disabled>

                                                            <i class="fas fa-edit editFld" data-clicked="false" style="position:absolute; cursor:pointer; right: 21px; top: 41px;" title="Click to edit"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3 align-items-end add-red-slot">
                                                        <div class="col-md-9 position-relative">
                                                            <label class="form-label"><i class="fas fa-car"></i> 4 Wheeler slots</label>
                                                            <input type="text" class="form-control text-center slotQty" data-def-val="'.$row['tot_4Wheel_slot'].'" id="fwSlot'.$row['parking_info_id'].'" value="'.$row['tot_4Wheel_slot'].'" disabled>

                                                            <i class="fas fa-edit editFld" data-clicked="false" style="position:absolute; cursor:pointer; right: 21px; top: 41px;" title="Click to manually add or deduct"></i>
                                                        </div>
                                                        <div class="col-md-1 me-3">
                                                            <button class="btn btn-success fwASlotBtn" data-slot-btn="add" data-id="'.$row['parking_info_id'].'" title="Each click will add 1 quantity"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="btn btn-dark fwASlotBtn" data-slot-btn="reduce" data-id="'.$row['parking_info_id'].'" title="Each click will deduct 1 quantity"><i class="fas fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3 align-items-end ">
                                                        <div class="col-md-9 position-relative">
                                                            <label class="form-label"><i class="fas fa-motorcycle"></i> 2 Wheeler slots</label>
                                                            <input type="text" class="form-control text-center slotQty" data-def-val="'.$row['tot_2Wheel_slot'].'" id="twSlot'.$row['parking_info_id'].'" value="'.$row['tot_2Wheel_slot'].'" disabled>

                                                            <i class="fas fa-edit editFld" data-clicked="false" style="position:absolute; cursor:pointer; right: 21px; top: 41px;" title="Click to manually add or deduct"></i>
                                                        </div>
                                                        <div class="col-md-1 me-3">
                                                            <button class="btn btn-success twReduceSlotBtn twASlotBtn" data-slot-btn="add" data-id="'.$row['parking_info_id'].'" title="Each click will add 1 quantity"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="btn btn-dark twReduceSlotBtn twASlotBtn" data-slot-btn="reduce" data-id="'.$row['parking_info_id'].'" title="Each click will deduct 1 quantity"><i class="fas fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-body modal-form deactivate_form" style="display:none">
                                                    Are you sure you want to deactivate this parking area?
                                                </div>

                                                <div class="modal-body modal-form delete_form" style="display:none">
                                                    Are you sure you want to delete this parking area?
                                                </div>



                                                <div class="modal-footer">
                                                    <div class="col input-icons">
                                                        <form>
                                                            <i class="fas fa-lock icon"></i>
                                                            <input type="password" class="form-control input-field text-start ps-5" id="needAdminPassFld'.$row["parking_info_id"].'" placeholder="To proceed, please enter your password" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Incorrect password">
                                                        </form>
                                                    </div>
                                                    
                                                   
                                                    <button type="button" class="btn btn-success btn-form edit_form confirm-mp-btn" data-btn-name="configBtn'.$row["parking_info_id"].'" data-id="'.$row["parking_info_id"].'" style="display:none;">Confirm</button>

                                                    <button type="button" class="btn btn-success btn-form deactivate_form confirm-mp-btn" data-btn-name="deactBtn'.$row["parking_info_id"].'" data-id="'.$row["parking_info_id"].'" style="display:none;">Confirm</button>
                                                
                                                    <button type="button" class="btn btn-success btn-form delete_form confirm-mp-btn" data-btn-name="delBtn'.$row["parking_info_id"].'" data-id="'.$row["parking_info_id"].'" style="display:none;">Confirm</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                }
                if($row['pa_status'] == 'Deactivated'){

                    $subArr[] = '<span class="badge bg-danger">Deactivated</span>';
                    
                    $subArr[] = '<button class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["parking_info_id"].'" data-form-target="reactivate_form" data-form-title="Reactivating" data-bs-toggle="modal" data-form-icon="fas fa-toggle-on" data-bs-target="#manageParkingModal'.$row['parking_info_id'].'">
                                <i class="fas fa-toggle-on"></i> Reactivate
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["parking_info_id"].'" data-form-target="delete_form" data-form-title="Deleting" data-bs-toggle="modal" data-form-icon="fas fa-trash" data-bs-target="#manageParkingModal'.$row['parking_info_id'].'">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </li>
                    </ul>


                    <div class="modal fade" id="manageParkingModal'.$row['parking_info_id'].'" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            
                                <div class="modal-header">
                                    <h5 class="modal-title"><span>XXXX</span> '.$row['parking_area_name'].' area</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body modal-form reactivate_form" style="display:none">
                                    Are you sure you want to reactivate this parking area?
                                </div>

                                <div class="modal-body modal-form delete_form" style="display:none">
                                    Are you sure you want to delete this parking area?
                                </div>



                                <div class="modal-footer">
                                    <div class="col input-icons">
                                        <form>
                                            <i class="fas fa-lock icon"></i>
                                            <input type="password" class="form-control input-field text-start ps-5" id="needAdminPassFld'.$row["parking_info_id"].'" placeholder="To proceed, please enter your password" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Incorrect password">
                                        </form>
                                    </div>
                                    
                                    <button type="button" class="btn btn-success btn-form reactivate_form confirm-mp-btn" data-btn-name="reactivateBtn'.$row["parking_info_id"].'" data-id="'.$row["parking_info_id"].'" style="display:none;">Confirm</button>
                                
                                    <button type="button" class="btn btn-success btn-form delete_form confirm-mp-btn" data-btn-name="delBtn'.$row["parking_info_id"].'" data-id="'.$row["parking_info_id"].'" style="display:none;">Confirm</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                $data[] = $subArr;
            }
            echo json_encode($data);
        }
    }


    
    public function fetchPAreasForPMeter(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           
            $stmt = $this->connectDb()->prepare("SELECT * FROM parking_area_info WHERE pa_status = 'Active'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $htmlBlock = '';

            if($stmt->rowCount() > 0){
                foreach ($result as $row) {
                    $htmlBlock .= '<li><a class="dropdown-item" href="parking-meter.php?id='.$row["parking_info_id"].'&&name='.$row["parking_area_name"].'"><i class="fas fa-layer-group"></i>'.$row["parking_area_name"].'</a></li>';
   
               }
            } 
            

            echo json_encode(array("dropdowns" => $htmlBlock, "countData" => $stmt->rowCount()));
        }
    }


    public function countAreasSlots(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // COUNT TOTAL PARKING AREAS
            $stmt1 = $this->connectDb()->prepare("SELECT * FROM parking_area_info");
            $stmt1->execute();
            $totAReas = $stmt1->rowCount();

            // COUNT TOTAL ACTIVE PARKING AREAS
            $selActive = $this->connectDb()->prepare("SELECT * FROM parking_area_info WHERE pa_status = 'Active'");
            $selActive->execute();
            $countActive = $selActive->rowCount();

            // COUNT TOTAL DEACTIVATED PARKING AREAS
            $selDeact = $this->connectDb()->prepare("SELECT * FROM parking_area_info WHERE pa_status = 'Deactivated'");
            $selDeact->execute();
            $countDeact = $selDeact->rowCount();
            

            // COUNT TOTAL SLOTS 4 WHEELERS
            $stmt2 = $this->connectDb()->prepare("SELECT SUM(tot_4Wheel_slot) as tot4Wslots FROM parking_area_info");
            $stmt2->execute();
            $row4W = $stmt2->fetch(PDO::FETCH_ASSOC);
            $totSlots4W = $row4W['tot4Wslots'];
           


            // COUNT TOTAL SLOTS 2 WHEELERS
            $stmt3 = $this->connectDb()->prepare("SELECT SUM(tot_2Wheel_slot) as tot2Wslots FROM parking_area_info");
            $stmt3->execute();
            $row2W = $stmt3->fetch(PDO::FETCH_ASSOC);
            $totSlots2W = $row2W['tot2Wslots'];


            // COUNT OVERALL PARKING SLOTS 
            $stmt4 = $this->connectDb()->prepare("SELECT (SUM(tot_4Wheel_slot) + SUM(tot_2Wheel_slot)) as overAllTotSlots FROM parking_area_info");
            $stmt4->execute();
            $rowOverAll = $stmt4->fetch(PDO::FETCH_ASSOC);
            $overallTotSlots = $rowOverAll['overAllTotSlots'];
            

            echo json_encode(array(
                'totAReas'=> $totAReas,
                'totActive'=> $countActive,
                'totDeact'=> $countDeact,
                'totSlots4W'=> $totSlots4W,
                'totSlots2W'=> $totSlots2W,
                'overallTotSlots'=> $overallTotSlots,
            ));
           
        }
    }


    public function addNewParkingArea($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            if(password_verify($data['adminAuthenticate'], $row['password'])){
               $insertStmt = $this->connectDb()->prepare("INSERT INTO parking_area_info VALUES (default, :areaName, :tot4Wslot, :tot2Wslot, default, current_timestamp)");
               $insertStmt->bindParam(":areaName", $data['newAreaNameInput']);
               $insertStmt->bindParam(":tot4Wslot", $data['new4WSlotinput']);
               $insertStmt->bindParam(":tot2Wslot", $data['new2WSlotinput']);
               
               if($insertStmt->execute()){
                    $this->activityLogQuery($data['adminID'], 'added new parking area '.$data['newAreaNameInput']);
                    echo json_encode(array('statusCode' => 200));
               }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
        }
    }


    public function configParkingArea($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            if(password_verify($data['adminPass'], $row['password'])){
               $updStmt = $this->connectDb()->prepare("UPDATE parking_area_info SET parking_area_name = :newAreaName, tot_4Wheel_slot = :newFWSlotVal, tot_2Wheel_slot = :newTWSlotVal WHERE parking_info_id = :parkingID");
               $updStmt->bindParam(":newAreaName", $data['newAreaName']);
               $updStmt->bindParam(":newFWSlotVal", $data['newFWSlotVal']);
               $updStmt->bindParam(":newTWSlotVal", $data['newTWSlotVal']);
               $updStmt->bindParam(":parkingID", $data['parkingID']);
               
               if($updStmt->execute()){
                    $this->activityLogQuery($data['adminID'], 'updated parking area '.$data['areaNameDefVal']. ' with '.$data['FWSlotDefVal'].' slot(s) for 4-wheeled and '.$data['TWSlotDefVal']. ' slot(s) for 2-wheeled to ' .$data['newAreaName']. ' with ' .$data['newFWSlotVal']. ' slot(s) for 4-wheeled and ' .$data['newTWSlotVal']. ' slot(s) for 2-wheeled.');
                    echo json_encode(array('statusCode' => 200));
               }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
        }
    }



    public function deactParkingArea($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            if(password_verify($data['adminPass'], $row['password'])){
               $updStmt = $this->connectDb()->prepare("UPDATE parking_area_info SET pa_status = 'Deactivated' WHERE parking_info_id = :parkingID");
               $updStmt->bindParam(":parkingID", $data['parkingID']);
               
               if($updStmt->execute()){
                    $selPAstmt = $this->connectDb()->prepare("SELECT * FROM parking_area_info WHERE parking_info_id = :parkingID");
                    $selPAstmt->bindParam(':parkingID', $data['parkingID']);
                    $selPAstmt->execute();
                    $row2 = $selPAstmt->fetch();

                    $this->activityLogQuery($data['adminID'], 'deactivated '.$row2['parking_area_name'].' area');
                    echo json_encode(array('statusCode' => 200, 'areaName' => $row2['parking_area_name']));
               }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
        }
    }

    public function reactivateParkingArea($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            if(password_verify($data['adminPass'], $row['password'])){
               $updStmt = $this->connectDb()->prepare("UPDATE parking_area_info SET pa_status = 'Active' WHERE parking_info_id = :parkingID");
               $updStmt->bindParam(":parkingID", $data['parkingID']);
               
               if($updStmt->execute()){
                    $selPAstmt = $this->connectDb()->prepare("SELECT * FROM parking_area_info WHERE parking_info_id = :parkingID");
                    $selPAstmt->bindParam(':parkingID', $data['parkingID']);
                    $selPAstmt->execute();
                    $row2 = $selPAstmt->fetch();

                    $this->activityLogQuery($data['adminID'], 'reactivated '.$row2['parking_area_name'].' area');
                    echo json_encode(array('statusCode' => 200, 'areaName' => $row2['parking_area_name']));
                }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
        }
    }


    public function deleteParkingArea($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();

            $selPAstmt = $this->connectDb()->prepare("SELECT * FROM parking_area_info WHERE parking_info_id = :parkingID");
            $selPAstmt->bindParam(':parkingID', $data['parkingID']);
            $selPAstmt->execute();
            $row2 = $selPAstmt->fetch();

            if(password_verify($data['adminPass'], $row['password'])){
               $delStmt = $this->connectDb()->prepare("DELETE FROM parking_area_info WHERE parking_info_id = :parkingID");
               $delStmt->bindParam(":parkingID", $data['parkingID']);
               
               if($delStmt->execute()){
                    $this->activityLogQuery($data['adminID'], 'deleted '.$row2['parking_area_name'].' area');
                    echo json_encode(array('statusCode' => 200, 'areaName' => $row2['parking_area_name']));
                }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
        }
    }

}