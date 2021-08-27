<!-- ======================== DON'T REMOVE ============================= -->
<input type="hidden" value="<?php echo $_SESSION['userID']; ?>" id="adminID">
<!-- ============================ END ================================= -->

<div class="d-flex flex-row justify-content-between mb-3 mng_parking_areas_dashlet">
    <div class="card col me-4 activeParkingAreas">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">Active Parking Areas</span>
                <h2 class="fw-bold" id="activeParkingAreas">0</h2>
            </div>
        </div>
    </div>
    <div class="card col me-4 deactivatedParkingAreas">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">Deactivated Parking Areas</span>
                <h2 class="fw-bold" id="deactivatedParkingAreas">0</h2>
            </div>
        </div>
    </div>
    <div class="card col totPAreas">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">Total Parking Areas</span>
                <h2 class="fw-bold" id="totParkingAreas">0</h2>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-row justify-content-between mng_parking_areas_dashlet">
    <div class="card col me-4 totPSlots4W">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">4 Wheeled slots</span>
                <h2 class="fw-bold" id="totSlot4W">0</h2>
            </div>
        </div>
    </div>
    <div class="card col me-4 totPSlots2W">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">2 Wheeled slots</span>
                <h2 class="fw-bold" id="totSlot2W">0</h2>
            </div>
        </div>
    </div>
    <div class="card col overallPSlots">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">Overall Parking Slots</span>
                <h2 class="fw-bold" id="overAllPSlots">0</h2>
            </div>
        </div>
    </div>
</div>

<div class="row my-5">
    <div class="card">
        <div class="card-body">
            <div class="pb-4">
                <div class="btn-group float-end">
                    <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#newParkingAreaModal"><i class="fas fa-plus-square"></i> NEW PARKING AREA</button>
                </div>
                <h5 class="my-2"><i class="fas fa-cog"></i> Manage Parking</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="manageParkingTable">
                    <thead>
                        <tr>
                            <th scope="col">Area name</th>
                            <th scope="col">4 Wheel Slots</th>
                            <th scope="col">2 Wheel Slots</th>
                            <th scope="col">Total Parking Slots</th>
                            <th scope="col">Date Added</th>
                            <th scope="col">Status</th>
                            <th scope="col"><i class="fas fa-cog"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>








<!-- ======================================= MODAL =========================================== -->

<div class="modal fade" id="newParkingAreaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Parking Area Form</h5>
      </div>
      <div class="modal-body">

      
        <div class="row align-items-center">
            <div class="col-md-2 text-center me-3">
                <i class="fas fa-layer-group" style="font-size: 64px;"></i>
            </div>
            <div class="col">
                <div class="form-group mb-3 4Wfield">
                    <label class="form-label">Area name</label>
                    <input type="text" class="form-control mangeParkingInput" id="newAreaNameInput" placeholder="Enter Parking area name">
                </div>
            </div>
        </div>
        <div class="row y-3 align-items-center">
            <div class="col-md-2 text-center me-3">
                <i class="fas fa-car" style="font-size: 64px;"></i>
            </div>
            <div class="col">
                <div class="form-group mb-3 4Wfield">
                    <label class="form-label">Slot quantity</label>
                    <input type="number" class="form-control mangeParkingInput" value="0" id="new4WSlotinput" placeholder="Enter slot qty for 4 wheelers">
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-2 text-center me-3">
                <i class="fas fa-motorcycle" style="font-size: 60px;"></i>
            </div>
            <div class="col">
                <div class="form-group mb-3 4Wfield">
                    <label class="form-label">Slot quantity</label>
                    <input type="number" class="form-control mangeParkingInput" value="0" id="new2WSlotinput" placeholder="Enter slot qty for 2 wheelers">
                </div>
            </div>
        </div>
        
        <div class="authenticate_action" style="display: none;">
            <hr class="my-3">
            <i class="mb-3"><strong>To proceed, please enter your password:</strong></i>
            <div class="form-group">
                <input type="password" class="form-control adminAuthenticate" id="adminAuthenticate" placeholder="Enter your password" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Incorrect password">
                <span id="authFailedMsg" class="text text-danger" style="display: none;">Password is incorrect!</span>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cancel-modal-btn" data-bs-dismiss="modal">CANCEL  </button>
        <button type="button" class="btn btn-success" id="addnewParkingAreaBtn" style="display: none;">ADD</button>
      </div>
    </div>
  </div>
</div>








<!-- <div class="modal fade" id="newParkingAreaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Parking Area Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

            <div class="card modal-option" data-title="Both 4 Wheeler and 2 Wheeler" data-modal-form-class="mngUserGenSettingsForm">
                <div class="card-body">
                    <h5 class="card-title" style="color:#18593F"><i class="fas fa-car"></i> <i class="fas fa-motorcycle"></i> Both 4 Wheeler and 2 Wheeler</h5>
                    <p class="card-text">New Parking Area for both.</p>
                </div>
            </div>
           
            <div class="card modal-option my-4" data-title="4 Wheeler Slots only" data-modal-form-class="mngUserGenSettingsForm">
                <div class="card-body">
                    <h5 class="card-title" style="color:#18593F"><i class="fas fa-car"></i> 4 Wheeler Slots only</h5>
                    <p class="card-text">New Parking Area for 4 Wheeled vehicle only.</p>
                </div>
            </div>
            <div class="card modal-option" data-title="2 Wheeler Slots only" data-modal-form-class="mngUserGenSettingsForm">
                <div class="card-body">
                    <h5 class="card-title" style="color:#18593F"><i class="fas fa-motorcycle"></i> 2 Wheeler Slots only</h5>
                    <p class="card-text">New Parking Area for 2 Wheeled vehicle only.</p>
                </div>
            </div>

            <nav aria-label="breadcrumb" class="modal-breadcrumb" style="display:none">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page">XXX</li>
                </ol>
            </nav>

            <div class="row" style="display: none;">
                <div class="form-group mb-3">
                <label class="form-label">Area name</label>
                    <input type="text" class="form-control" id="" placeholder="Enter Parking Area name">
                </div>
                <div class="col form-group mb-3">
                    <label class="form-label">4 Wheeler slots quantity</label>
                    <input type="number" class="form-control" id="" placeholder="Slot qty">
                </div>
                <div class="col form-group mb-3">
                    <label class="form-label">2 Wheeler slots quantity</label>
                    <input type="number" class="form-control" id="" placeholder="Slot qty">
                </div>
                
                <div class="authenticate_action">
                    <hr class="my-3">
                    <i class="mb-3"><strong>To proceed, please enter your password:</strong></i>
                    <div class="form-group">
                        <input type="password" class="form-control adminAuthenticate" input-event="keyup" placeholder="Enter your password">
                        <span id="authFailedMsg" class="text text-danger" style="display: none;">Password is incorrect!</span>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL  </button>
        <button type="button" class="btn btn-success" id="createAcctBtn" btn-event="click">ADD</button>
      </div>
    </div>
  </div>
</div> -->