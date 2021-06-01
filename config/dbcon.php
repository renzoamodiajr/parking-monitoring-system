<?php 

class DatabaseConnection{
   
   private $host = 'us-cdbr-east-04.cleardb.com';
   private $dbname = 'heroku_fed7d30855c5d5f';
   private $username = 'b234051e92c132';
   private $password = 'a9ed2f24';
  
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