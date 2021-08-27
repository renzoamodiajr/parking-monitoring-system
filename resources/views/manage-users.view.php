<!-- ======================== DON'T REMOVE ============================= -->
 <input type="hidden" value="<?php echo $_SESSION['userID']; ?>" id="adminID"> 
<!-- ============================ END ================================= -->

<div class="d-flex flex-row justify-content-between" id="mng_users_dashlet">
    <div class="card col me-4 active-users-box">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">Active Users</span>
                <h2 class="fw-bold" id="activeUsers">XXX</h2>
            </div>
        </div>
    </div>
    <div class="card col deactivated-users-box">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">Deactivated Users</span>
                <h2 class="fw-bold" id="deactUsers">XXX</h2>
            </div>
        </div>
    </div>
    <div class="card col ms-4 total-users-box">
        <div class="card-body">
            <div class="card-content">
                <span class="mb-2">Total Users</span>
                <h2 class="fw-bold" id="totalUsers">XXX</h2>
            </div>
        </div>
    </div>
</div>


<div class="row my-5">
    <div class="card">
        <div class="card-body">
            <div class="pb-4">
                <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#createAcctModal"><i class="fas fa-plus-square"></i> NEW USER</button>
                <h5 class="my-2"><i class="fas fa-cog"></i> Manage Users</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="manageUsersTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            <th scope="col">Assigned area</th>
                            <th scope="col">Date Created</th>
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

<div class="modal fade" id="createAcctModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create Account Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="form-group mb-3">
                    <label class="form-label">Assign Parking area:</label>
                    <select class="form-select" id="assignPAreaFld" input-event="change" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Please select an option"></select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" id="unameFld" readonly>
                </div>
                <div class="col form-group mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control" id="fnameFld" input-event="keyup" placeholder="Enter First name"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="This field is required">
                </div>
                <div class="col form-group mb-3">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control" id="lnameFld" input-event="keyup" placeholder="Enter Last name"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="This field is required">
                </div>
                
                <div class="col-md-9 form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" id="passFld" input-event="keyup" placeholder="Add/Generate password" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="This field is required">
                </div>
                <div class="col text-end">
                    <button type="button" class="btn btn-dark" id="genPassBtn" onclick="genPassBtn()" style="margin-top:32px">Generate</button>
                </div>

                <hr class="my-5">
                <i class="mb-3"><strong>To proceed, please enter your password:</strong></i>
                <div class="form-group">
                    <input type="password" class="form-control adminAuthenticate" input-event="keyup" placeholder="Enter your password"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="This field is required">
                    <span id="authFailedMsg" class="text text-danger" style="display: none;">Password is incorrect!</span>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" id="createAcctBtn" btn-event="click">Create</button>
      </div>
    </div>
  </div>
</div>












