<!-- ======================== DON'T REMOVE ============================= -->
<input type="hidden" value="<?php echo $_SESSION['userID']; ?>" id="userID">
<input type="hidden" value="<?php echo $_GET['id']; ?>" id="areaID">
<input type="hidden" value="<?php echo $_GET['name']; ?>" id="areaName">

<!-- ============================ END ================================= -->

<h1 class="text-center"><i class="fas fa-layer-group"></i> <?php echo $_GET['name']; ?> Area</h1>

<div class="row my-5 justify-content-between">
    <div class="col col-md-3 align-items-center" id="pmeter_dashlet">
        <div class="card mb-3 pMeterTotSlots">
            <div class="card-body">
                <div class="card-content">
                    <span class="mb-2">Total Parking Slots</span>
                    <h2 class="fw-bold" id="pMeterTotSlotsCount">XXXX</h2>
                </div>
            </div>
        </div>
        <div class="card mb-3 pMeter4WSlotStat">
            <div class="card-body">
                <div class="card-content">
                    <span class="mb-2">4 Wheeler Slot Status</span>
                    <h2 class="fw-bold" id="pMeterTot4WSlotsCount"></h2>
                </div>
            </div>
        </div>
        <div class="card mb-3 pMeter2WSlotStat">
            <div class="card-body">
                <div class="card-content">
                    <span class="mb-2">2 Wheeler Slot Status</span>
                    <h2 class="fw-bold" id="pMeterTot2WSlotsCount"</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="card col col-md-9">
        <div class="card-body">
            <div class="btn-group float-end">
                <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#checkInModal"><i class="fas fa-arrow-circle-down"></i> CHECK-IN</button>
            </div>
            <div class="pb-4">
                <h5 class="my-2"><i class="fas fa-stopwatch-20"></i> Parking Meter</h5>
            </div>
            
            <table class="table table-bordered" id="parkingMeterTable">
                <thead>
                    <tr>
                        <th scope="col"><i class="fas fa-id-card"></i> Plate #</th>
                        <th scope="col"><i class="fas fa-question-circle"></i> Vehicle Type</th>
                        <th scope="col"><i class="fas fa-clock"></i> Time-in</th>
                        <th scope="col"><i class="fas fa-hourglass-half"></i> Duration</th>
                        <th scope="col"><i class="fas fa-percent"></i> Rate</th>
                        <th scope="col"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<h2 class="mt-5 mb-3 text-center">Hourly report from current day</h2>
<div class="row">
  <div class="col col-6 mb-5">
    <div class="card">
      <div class="card-body">
        <canvas id="dailyFreqChart" width="215px"></canvas>
      </div>
    </div>
  </div>
  <div class="col col-6">
    <div class="card">
      <div class="card-body">
        <canvas id="dailyRevChart" width="215px"></canvas>
      </div>
    </div>
  </div>
</div>








<!-- ======================================= MODAL =========================================== -->

<div class="modal fade" id="checkInModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title"><i class="fas fa-arrow-circle-down"></i> Check-in driver</h5>
      </div>
      <div class="modal-body py-5">
        <div class="form-group input-icons mb-3">
            <i class="fas fa-id-card" style="top: 11px;left: 13px;"></i>
            <input type="text" class="form-control"  id="plateNum" placeholder="Enter Plate number" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="This field is required" style="padding-left: 47px; text-transform:uppercase">
        </div>
        <div class="row">
            <div class="form-check form-check-inline card col vhType" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Please select vehicle type">
                <div class="card-body">
                    <input class="form-check-input" type="checkbox" name="checkIn-vhType" id="vhType1" value="4 Wheeler">
                    <label class="form-check-label" for="vhType1"><i class="fas fa-car"></i> 4 Wheeler</label>
                </div>
            </div>
            <div class="form-check form-check-inline card col vhType" style="margin-right:0">
                <div class="card-body">
                    <input class="form-check-input" type="checkbox" name="checkIn-vhType" id="vhType2" value="2 Wheeler">
                    <label class="form-check-label" for="vhType2"><i class="fas fa-motorcycle"></i> 2 Wheeler</label>
                </div>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel-modal-btn" data-bs-dismiss="modal">Cancel  </button>
        <button type="button" class="btn btn-success" id="checkInBtn"><i class="fas fa-arrow-circle-down"></i> Check-in</button>
      </div>
    </div>
  </div>
</div>





<!-- =================================================== PRINT TICKET =================================================== -->
<div class="modal fade" id="printTicketModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-print"></i> Print Ticket</h5>
      </div>
      <div class="modal-body ticket" id="printTicketSection">
        <table class="table table-bordered">
        	<thead>
			    <tr>
			      <th>Parking Area</th>
			      <th>Plate #</th>
			    </tr>
		  	</thead>
		  	<tbody>
		  		<tr>
		  			<td id="prntPArea">XXX</td>
		  			<td id="printPlateNum">XXX</td>
		  		</tr>
		  	</tbody>
		  	<table class="table table-bordered" style="margin-top: -17px;text-align:center">
		  		<thead>
			  		<tr>
			  			<th>Time-in: <span id="timeIn">xxx</span></th>
			  		</tr>
			  	</thead>
		  	</table>
        </table>
        
        <p><strong>Note:</strong>  Present this to our parking-attendant. Thank you!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="btnPrintTicket()"><i class="fas fa-print"></i> Print</button>
      </div>
    </div>
  </div>
</div>



<!-- =================================================== REPRINT TICKET =================================================== -->
<?php require_once 'config/dbcon.php';
$pdo = new DatabaseConnection();
$stmt = $pdo->connectDb()->prepare("SELECT * FROM parking_transaction INNER JOIN parking_area_info ON parking_transaction.parking_info_id = parking_area_info.parking_info_id");
$stmt->execute();

foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row):
?>
<div class="modal fade" id="rePrintTicketModal<?php echo $row['transactionID']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-print"></i> Reprint Ticket</h5>
          </div>
          <div class="modal-body" id="rePrintTicketSection<?php echo $row['transactionID']?>">
              <table class="table table-bordered">
                  <thead>
                      <tr>
                      <th>Parking Area</th>
                      <th>Plate #</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td><?php echo $row['parking_area_name']?></td>
                          <td><?php echo $row['plate_num']?></td>
                      </tr>
                  </tbody>
                  <table class="table table-bordered" style="margin-top: -17px;text-align:center">
                      <thead>
                          <tr>
                              <th>Time-in: <?php echo $row['time_check_in']?></th>
                          </tr>
                      </thead>
                  </table>
              </table>
              
              <p><strong>Note:</strong>  Present this to our parking-attendant. Thank you!</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary cancel-modal-btn" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" onclick="btnRePrintTicket(this)" data-id="<?php echo $row['transactionID']?>"><i class="fas fa-print"></i> Print</button>
          </div>
        </div>
    </div>
</div>





<!-- ======================================= CHECKOUT MODAL =========================================== -->

<div class="modal fade" id="checkOutModal<?php echo $row['transactionID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-arrow-circle-up"></i> Check-out driver</h5>
      </div>
      <div class="modal-body py-4">
        <p>Are you sure you want to proceed checking-out this driver?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel-modal-btn" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger checkOutBtn" data-id="<?php echo $row['transactionID']?>"><i class="fas fa-arrow-circle-up"></i> Proceed</button>
      </div>
    </div>
  </div>
</div>

<?php endforeach; ?>






<!-- ======================================= PRINT RECEIPT =========================================== -->

<div class="modal fade" id="printReceiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-print"></i> Print Receipt</h5>
      </div>
      	<div class="modal-body">
          <div id="printReceipt" class="printReceipt col-md-8 ms-auto me-auto text-center">
            <div>
              <p style="margin-bottom: 0; border-top: 1px dashed #333; border-bottom: 1px dashed #333">PARKING RECEIPT</p>
            </div>
            <table class="table table-borderless" style="margin-top: 20px">
            <tbody>
              <tr>
                <td style="text-align: left;padding: 0">VEHICLE TYPE:</td>
                <td id="printReceiptVType" style="text-align: right;padding: 0">XXXXXX</td>
              </tr>
              <tr>
                <td style="text-align: left;padding: 0">DATE:</td>
                <td id="printReceiptDate" style="text-align: right;padding: 0">XXXXXX</td>
              </tr>
              <tr>
                <td style="text-align: left;padding: 0">TIME PARKED-IN:</td>
                <td id="printReceiptIn" style="text-align: right;padding: 0">XXXXXX</td>
              </tr>
              <tr>
                <td style="text-align: left;padding: 0">TIME PARKED-OUT:</td>
                <td id="printReceiptOut" style="text-align: right;padding: 0">XXXXXX</td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td style="text-align: left;padding: 0">DURATION:</td>
                <td id="printReceiptDuration" style="text-align: right;padding: 0">XXXXXX</td>
              </tr>
              <tr>
                <td style="text-align: left;padding: 0">AMOUNT DUE:</td>
                <td id="printReceiptAmount" style="text-align: right;padding: 0">XXXXXX</td>
              </tr>
            </tbody>
            </table>
          </div>
		</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="btnPrintReceipt()"><i class="fas fa-print"></i> Print</button>
      </div>
    </div>
  </div>
</div>
