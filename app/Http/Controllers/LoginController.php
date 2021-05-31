<?php require_once '../../config/dbcon.php';


class LoginController extends DatabaseConnection{

    public function loginUser($loginData){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $stmt = $this->connectDb()->prepare("SELECT * FROM users WHERE username = :username");
                $stmt->bindParam(':username', $loginData['loginUsername']);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($stmt->rowCount() > 0 && password_verify($loginData['loginPass'], $row['password'])){
                    session_start();
                    $_SESSION['name'] = $row['first_name'] . " " . $row['last_name'];
                    $_SESSION['role'] = $row['user_role'];
                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['assignArea'] = $row['assigned_pArea'];
                    
                    echo 'success';
                }else{
                    echo 'fail';
                }

            }
            
        }
}