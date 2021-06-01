<?php 

class DatabaseConnection{
   
   private $host = 'localhost';
   private $dbname = 'parkingmonitoring';
   private $username = 'root';
   private $password = '';
  
   public function connectDb(){
      try {
         $pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname."", $this->username, $this->password);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $pdo;
      } catch (PDOException $e) {
         die("Could not established database connection</br>" . $e->getMessage());
      }
   }

   public function activityLogQuery($userID, $activity){
      $stmt = $this->connectDb()->prepare("INSERT INTO activity_log VALUES (default, :userID, :activity, current_timestamp)");
      $stmt->bindParam(':userID', $userID);
      $stmt->bindParam(':activity', $activity);
      $stmt->execute();
   }


}

$db = new DatabaseConnection();
$db->connectDb();