$(document).on("click", "#loginBtn", function(){
 
    $("#loginErr").css({'display':'none'});
    let loginUsername = $('#loginUsername').val();
    let loginPass = $('#loginPass').val();
    
    if(!loginUsername){
        showErrorMsg('#loginUsername');
    }
    if(!loginPass){
        showErrorMsg('#loginPass');
    }
    if(loginUsername && loginPass){
        
        $("#loginBtn").html('<i class="fas fa-spinner fa-pulse"></i> Logging in...');
        $.ajax({
            url: 'app/Models/LoginModel.php',
            method: 'POST',
            data: {
                'loginUsername' : loginUsername,
                'loginPass' : loginPass,
                'loginUserTrigger' : true
            },
            success: function(success){
                $("#loginUsername").attr('disabled', true);
                $("#loginPass").attr('disabled', true);

                if(success == 'success'){
                    setTimeout(function(){
                        window.location.href = 'dashboard.php';
                    }, 2000);
                    
                }
                if(success == 'fail'){
                    
                    setTimeout(function(){
                        $("#loginUsername").attr('disabled', false).css({'border-color':'#E70303', 'box-shadow':'0 0 0 0.25rem rgb(231 3 3 / 25%)'});;
                        $("#loginPass").attr('disabled', false).val("").css({'border-color':'#E70303', 'box-shadow':'0 0 0 0.25rem rgb(231 3 3 / 25%)'});;
                        $("#loginBtn").html('Login');
                        $("#loginErr").css({'display':'block'});
                    }, 2000);
                }
            }
        })
    }
});
    