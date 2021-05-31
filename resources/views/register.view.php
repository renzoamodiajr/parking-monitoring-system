<div class="col-md-5 px-5 py-5 ms-auto card reg-col" id="reg-col">
    <div id="welcomeTxt">
        <h2>WELCOME!</h2>
        <hr>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
        <hr class="mt-4">
        <div style="display: none;">
            <span style="color:#00A876;">No account yet?</span>  <a onclick="regformlink()" class="reglink" id="reglink">Register</a>
        </div>
    </div>

    <div id="regForm" style="display: none;">
        <h3>Create New Account</h3>
        <h6>Please fill the following:</h6>
        <hr>
        <div class="row"> 
            <div class="mb-3 col"> 
                <input type="text" class="form-control" id="regFname" placeholder="First name"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="This field is required"> 
            </div> 
            <div class="mb-3 col"> 
                <input type="text" class="form-control" id="regLname" placeholder="Last name"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="This field is required"> 
            </div> 
            <div class="mb-3"> 
                <input type="email" class="form-control" id="regEmail" placeholder="Email Address"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="This field is required"> 
                <span class="text text-danger" id="errEmail" style="font-size: 14px; display: none;">This email address has already been taken. Try something else.</span>
            </div> 
            <div class="mb-3 col"> 
                <input type="password" class="form-control" id="regPass" placeholder="Password" onkeyup="checkPassLength()"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="This field is required"> 
                <span class="text text-danger" id="err" style="font-size: 12px;"></span>
            </div> 
            <div class="mb-3 col"> 
                <input type="password" class="form-control" id="regCPass" placeholder="Confirm Password" onkeyup="comparePass()"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="This field is required"> 
                <span class="text text-danger" id="err2" style="font-size: 12px;"></span>
            </div> 
        </div> 
        <hr> 
        <button class="btn cancel-btn" onclick="cancelReg()">Cancel</button> 
        <button class="btn regbtn" onclick="register()" id="submitReg">Submit</button>;
    </div>
</div>