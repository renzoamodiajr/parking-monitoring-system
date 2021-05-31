<div class="col-md-5 px-5 py-5 me-auto card login-col-2">
    <h3>Login</h3>
    <hr>
    
    <span id="loginErr" class="text-danger col-md-10" style="background: #fff;padding:5px;display:none;box-shadow: 1px 1px 5px;"><i class="fas fa-exclamation-triangle"></i> Invalid credentials</span>
    <div class="form-container mt-3" id="loginForm">

        <div class="form-group input-icons pb-4 col-md-10">
            <i class="fas fa-user icon"></i>
            <input type="text" class="form-control input-field"  id="loginUsername" placeholder="Enter username" input-event="keyup" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="This field is required">
        </div>

        <div class="form-group input-icons col-md-10">
            <i class="fas fa-lock icon"></i>
            <input type="password" class="form-control input-field" id="loginPass" placeholder="Enter password" input-event="keyup" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="This field is required">
        </div>

        <hr class="mt-4 mb-4">

        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="button" id="loginBtn" btn-event="click" class="btn btn-primary">Login</button>
        </div>
    </div>
</div>
