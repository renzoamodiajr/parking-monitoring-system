<?php 

class DatabaseConnection{
   
   //Get Heroku ClearDB connection information
   private $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
   private $cleardb_server = $this->cleardb_url["host"];
   private $cleardb_username = $this->cleardb_url["user"];
   private $cleardb_password = $this->cleardb_url["pass"];
   private $cleardb_db = substr($this->cleardb_url["path"],1);
   public $active_group = 'default';
   public $query_builder = TRUE;
   
   // private $host = $this->cleardb_server;
   // private $dbname = $this->cleardb_db;
   // private $username = $this->cleardb_username;
   // private $password = $this->cleardb_password;
  
   public function connectDb(){
      try {
         $pdo = new PDO("mysql:host=".$this->cleardb_server.";dbname=".$this->cleardb_db."", $this->cleardb_username, $this->cleardb_password);
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