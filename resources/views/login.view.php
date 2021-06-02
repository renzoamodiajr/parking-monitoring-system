<div id="login-con">
    <div class="form-container" id="loginForm">
        <div class="logo-con">
            <img src="resources/images/logo.png" id="logo">
        </div>
        <span id="loginErr" class="badge bg-danger col-md-10"><i class="fas fa-exclamation-triangle"></i> Invalid credentials</span>
        <div class="form-group input-icons">
            <i class="fas fa-user icon"></i>
            <input type="text" class="form-control input-field"  id="loginUsername" placeholder="Enter username" input-event="keyup" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="This field is required">
        </div>

        <div class="form-group input-icons">
            <i class="fas fa-lock icon"></i>
            <input type="password" class="form-control input-field" id="loginPass" placeholder="Enter password" input-event="keyup" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="This field is required">
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="button" id="loginBtn" btn-event="click" class="btn btn-primary">Login</button>
        </div>
    </div>

    <footer id="loginFooter">
        <p>&#169; Copyright 2021</p>
        <p>LORENZO N. AMODIA JR</p>
        <p>All rights reserved.</p>
    </footer>
</div>


