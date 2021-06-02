<?php require_once '../../../config/dbcon.php';


class ManageUserController extends DatabaseConnection{

    public function createAcct($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //CHECK ADMIN PASSWORD
            $checkStmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $checkStmt->bindParam(':adminID', $data['adminID']);
            $checkStmt->execute();
            $row = $checkStmt->fetch(PDO::FETCH_ASSOC);

            //IF CORRECT
            if($checkStmt->rowCount() > 0 && password_verify($data['adminAuthenticate'], $row['password'])){
                
                $hashedPass = password_hash($data['passFld'], PASSWORD_DEFAULT);
                $stmt = $this->connectDb()->prepare('INSERT INTO users VALUES (default, default, :assigned_pArea, :first_name, :last_name, :username, :password, default, current_timestamp)');
                $stmt->bindParam(':assigned_pArea', $data['assignPAreaFld']);
                $stmt->bindParam(':first_name', $data['fnameFld']);
                $stmt->bindParam(':last_name', $data['lnameFld']);
                $stmt->bindParam(':username', $data['unameFld']);
                $stmt->bindParam(':password', $hashedPass);

                if($stmt->execute()){
                    $this->activityLogQuery($data['adminID'], 'created new account for '. $data['fnameFld']. ' '.$data['lnameFld']);
                    echo json_encode(array("statusCode" => 200));
                }
            }
            // IF INCORRECT
            else{
                echo json_encode(array("statusCode" => 201));
            }

            
        }
       
    }


    public function fetchLastAcct(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE user_role = 'cashier' ORDER by userID DESC");
            $stmt->execute();
            $row_count = $stmt->rowCount();
            if($row_count >= 0){
                echo json_encode(array('total'=> $row_count + 1));
            }
        }
    }

    
    public function countUsers(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // COUNT ACTIVE USERS
            $stmt1 = $this->connectDb()->prepare("SELECT * FROM users WHERE acct_status = 'Active' AND  user_role = 'cashier'");
            $stmt1->execute();
            $row_count1 = $stmt1->rowCount();
            

            // COUNT TOTAL USERS
            $stmt2 = $this->connectDb()->prepare("SELECT * FROM users WHERE user_role = 'cashier'");
            $stmt2->execute();
            $row_count2 = $stmt2->rowCount();
           


            // COUNT DEACTIVATED USERS
            $stmt3 = $this->connectDb()->prepare("SELECT * FROM users WHERE user_role = 'cashier' AND acct_status = 'Deactivated'");
            $stmt3->execute();
            $row_count3 = $stmt3->rowCount();
            

            echo json_encode(array(
                'countActive'=> $row_count1,
                'countTotal'=> $row_count2,
                'countDeactivated'=> $row_count3
            ));
           
        }
    }


    public function fetchUsers(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = array();
            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE user_role != 'admin'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            
            foreach ($result as $row) {
               $subArr = array();
               $subArr[] = '<i class="fas fa-user-circle"></i> '.$row['username'];
               $subArr[] = '<i class="fas fa-user-tie"></i> '.$row['first_name'].' '.$row['last_name'];
               $subArr[] = '<i class="fas fa-layer-group"></i> '.$row['assigned_pArea'];
              
               $subArr[] = '<i class="fas fa-calendar-alt"></i> '.$row['date_created'];

               if($row['acct_status'] == 'Active'){
                   
                    $subArr[] = '<span class="badge bg-success">Active</span>';

                    $subArr[] = '<button class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["userID"].'" data-form-target="reassigning_form" data-form-title="Reassingning user" data-bs-toggle="modal" data-form-icon="fas fa-retweet" data-bs-target="#manageUserModal'.$row['userID'].'">
                                                <i class="fas fa-retweet"></i> Reassign
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["userID"].'" data-form-target="deactivation_form" data-form-title="Deactivating user" data-bs-toggle="modal" data-form-icon="fas fa-user-times" data-bs-target="#manageUserModal'.$row['userID'].'">
                                                <i class="fas fa-user-times"></i> Deactivate
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["userID"].'" data-form-target="delete_form" data-form-title="Deleting user" data-bs-toggle="modal" data-form-icon="fas fa-trash" data-bs-target="#manageUserModal'.$row['userID'].'">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </li>
                                    </ul>


                                    <div class="modal fade" id="manageUserModal'.$row['userID'].'" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><span>XXXX</span> '.$row['first_name'].' '.$row['last_name'].'</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>



                                                <div class="modal-body modal-form reassigning_form" style="display:none">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Currently assigned at</label>
                                                        <input type="text" class="form-control" value="'.$row['assigned_pArea'].'" readonly>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Reassign to</label>
                                                        <select class="form-select reAssignFld" id="reAssignFld'.$row['userID'].'" data-default-val="'.$row['assigned_pArea'].'" input-event="change" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Please select new Parking Area"></select>
                                                    </div>
                                                </div>



                                                <div class="modal-body modal-form deactivation_form" style="display:none">
                                                    Are you sure you want to deactivate this user?
                                                </div>



                                                <div class="modal-body modal-form delete_form" style="display:none">
                                                    Are you sure you want to delete this user?
                                                </div>



                                                <div class="modal-footer">
                                                    <div class="col input-icons">
                                                        <form>
                                                            <i class="fas fa-lock icon"></i>
                                                            <input type="password" class="form-control input-field text-start ps-5" id="needAdminPassFld'.$row["userID"].'" placeholder="To proceed, please enter your password" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Incorrect password">
                                                        </form>
                                                    </div>
                                                    
                                                    <button type="button" class="btn btn-success btn-form reassigning_form confirmMngUserBtn" data-btn-name="reAssignBtn'.$row["userID"].'" data-id="'.$row["userID"].'" style="display:none;">Confirm</button>
                                                
                                                
                                                    <button type="button" class="btn btn-success btn-form deactivation_form confirmMngUserBtn" data-btn-name="deactBtn'.$row["userID"].'" data-id="'.$row["userID"].'" style="display:none;">Confirm</button>
                                                
                                                
                                                    <button type="button" class="btn btn-success btn-form delete_form confirmMngUserBtn" data-btn-name="delBtn'.$row["userID"].'" data-id="'.$row["userID"].'" style="display:none;">Confirm</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                }
                if($row['acct_status'] == 'Deactivated'){

                    $subArr[] = '<span class="badge bg-danger">Deactivated</span>';

                    $subArr[] = '<button class="btn" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["userID"].'" data-form-target="reactivation_form" data-form-title="Reactivating user" data-bs-toggle="modal" data-form-icon="fas fa-user-times" data-bs-target="#manageUserModal'.$row['userID'].'">
                                                <i class="fas fa-user-check"></i> Reactivate
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item modal-opt" href="#" data-id="'.$row["userID"].'" data-form-target="delete_form" data-form-title="Deleting user" data-bs-toggle="modal" data-form-icon="fas fa-trash" data-bs-target="#manageUserModal'.$row['userID'].'">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </li>
                                    </ul>


                                    <div class="modal fade" id="manageUserModal'.$row['userID'].'" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><span>XXXX</span> '.$row['first_name'].' '.$row['last_name'].'</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>



                                                <div class="modal-body modal-form reactivation_form" style="display:none">
                                                    Are you sure you want to reactivate this user?
                                                </div>



                                                <div class="modal-body modal-form delete_form" style="display:none">
                                                    Are you sure you want to delete this user?
                                                </div>



                                                <div class="modal-footer">
                                                    <div class="col input-icons">
                                                        <form>
                                                            <i class="fas fa-lock icon"></i>
                                                            <input type="password" class="form-control input-field text-start ps-5" id="needAdminPassFld'.$row["userID"].'" placeholder="To proceed, please enter your password" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Incorrect password">
                                                        </form>
                                                    </div>
                                                    
                                                    <button type="button" class="btn btn-success btn-form reactivation_form confirmMngUserBtn" data-btn-name="reactivateBtn'.$row["userID"].'" data-id="'.$row["userID"].'" style="display:none;">Confirm</button>
                                                
                                                
                                                    <button type="button" class="btn btn-success btn-form delete_form confirmMngUserBtn" data-btn-name="delBtn'.$row["userID"].'" data-id="'.$row["userID"].'" style="display:none;">Confirm</button>
                                                    
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



    public function fetchAreaNames(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $option = '';
            $stmt = $this->connectDb()->prepare("SELECT parking_area_name FROM parking_area_info");
            $stmt->execute();

            $option .= '<option disabled selected>Choose</option>';
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
                $option .= '<option value="'.$row["parking_area_name"].'">'.$row["parking_area_name"].'</option>';
            }
            
            echo json_encode(array('areaNames'=> $option));
        }
    }


    public function reassignUser($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            
            if(password_verify($data['adminPassFld'], $row['password'])){
                $updStmt = $this->connectDb()->prepare("UPDATE users SET assigned_pArea = :newArea WHERE userID = :userID");
                $updStmt->bindParam(':newArea', $data['newParkingArea']);
                $updStmt->bindParam(':userID', $data['userID']);

                if($updStmt->execute()){

                    $selUser = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :userID");
                    $selUser->bindParam(':userID', $data['userID']);
                    $selUser->execute();
                    $user = $selUser->fetch();

                    $this->activityLogQuery($data['adminID'], 'reassigned user '.$user['first_name']. ' '.$user['last_name'].' to '.$data['newParkingArea']);

                    echo json_encode(array('statusCode' => 200));
                }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
            
        }
    }


    public function deactivateUser($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            
            if(password_verify($data['adminPassFld'], $row['password'])){
                $updStmt = $this->connectDb()->prepare("UPDATE users SET acct_status = 'Deactivated' WHERE userID = :userID");
                $updStmt->bindParam(':userID', $data['userID']);

                if($updStmt->execute()){

                    $selUser = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :userID");
                    $selUser->bindParam(':userID', $data['userID']);
                    $selUser->execute();
                    $user = $selUser->fetch();

                    $this->activityLogQuery($data['adminID'], 'deactivated the account of '.$user['first_name']. ' '.$user['last_name']);

                    echo json_encode(array('statusCode' => 200));
                }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
            
        }
    }
    

    public function reactivateUser($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            
            if(password_verify($data['adminPassFld'], $row['password'])){
                $updStmt = $this->connectDb()->prepare("UPDATE users SET acct_status = 'Active' WHERE userID = :userID");
                $updStmt->bindParam(':userID', $data['userID']);

                if($updStmt->execute()){

                    $selUser = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :userID");
                    $selUser->bindParam(':userID', $data['userID']);
                    $selUser->execute();
                    $user = $selUser->fetch();

                    $this->activityLogQuery($data['adminID'], 'reactivated the account of '.$user['first_name']. ' '.$user['last_name']);

                    echo json_encode(array('statusCode' => 200));
                }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
            
        }
    }


    public function deleteUser($data){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :adminID");
            $stmt->bindParam(':adminID', $data['adminID']);
            $stmt->execute();
            $row = $stmt->fetch();
            
            $selUser = $this->connectDb()->prepare("SELECT * FROM users WHERE userID = :userID");
            $selUser->bindParam(':userID', $data['userID']);
            $selUser->execute();
            $user = $selUser->fetch();

            if(password_verify($data['adminPassFld'], $row['password'])){
                $delStmt = $this->connectDb()->prepare("DELETE FROM users WHERE userID = :userID");
                $delStmt->bindParam(':userID', $data['userID']);

                if($delStmt->execute()){
                    $this->activityLogQuery($data['adminID'], 'deleted the account of '.$user['first_name']. ' '.$user['last_name']);

                    echo json_encode(array('statusCode' => 200));
                }
            }
            else{
                echo json_encode(array('statusCode' => 201));
            }
            
        }
    }
   
}
