<div class="card">
  <div class="card-body">
    <h2><i class="fas fa-list"></i> Activity Log</h2>

<?php 
    require_once 'config/dbcon.php';
    $pdo = new DatabaseConnection();
    $userID = $_SESSION['userID'];
    $stmt = $pdo->connectDb()->prepare("SELECT * FROM activity_log WHERE userID = :userID ORDER BY log_id DESC");
    $stmt->bindParam(':userID',$userID);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        foreach($result as $row):
?>
            <div class="logs-list">
                <hr>
                <strong class="card-title"><i class="fas fa-clock"></i> <?php echo $row['log_date']; ?></strong>
                <p class="card-text"><?php echo 'You '.$row['activity']; ?></p>
            </div>
<?php 
        endforeach; 
    }
    else{
?>
            <div class="logs-list text-center">
                <hr>
                <p class="card-title text-danger">You have no Activity yet</p>
                <hr>
            </div>
<?php
    }
?>    
   
  </div>
</div>