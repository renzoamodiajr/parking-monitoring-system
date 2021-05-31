// ============================= FORM VALIDATION =============================
// INPUT EVENT LISTENERS 
$(document).on("keyup", "input", function(e){
    // if(e.keyCode == 10 || e.keyCode == 13 ){
    //     $(this).find('button').click();
    // }
    

    if($(this).val() != ""){
        $(this).popover('dispose').removeClass('has-error');
    }
})

// CHANGE/SELECT EVENT LISTENERS 
$(document).on("change", "select", function(){
    if($(this).val() != null || $(this).val() != "" || $(this).val() != "Choose"){
        $(this).popover('dispose').removeClass('has-error');
    }
})




function showErrorMsg(selector){
    $(selector).popover('show').addClass('has-error');
}



// ============================= PASSWORD VALIDATION =============================
// checking pass length
function checkPassLength(){
    if(document.getElementById('regPass').value.length < 1){
        $("#err").html('');
        $("#regPass").css({'border-color':'', 'box-shadow':''});
    } else if(document.getElementById('regPass').value.length < 8){
        $("#err").html('Too weak! (atleast 8-12 characters)');
        $("#regPass").css({'border-color':'#E70303', 'box-shadow':'0 0 0 0.25rem rgb(231 3 3 / 25%)'});
    }
    else{
        $("#err").html('');
        $("#regPass").css({'border-color':'', 'box-shadow':''});
    }

    if(document.getElementById('regCPass').value != ""){
        if(document.getElementById('regCPass').value != regPass.value){
            $("#err2").html('Password mismatch!');
            $("#regCPass").css({'border-color':'#E70303', 'box-shadow':'0 0 0 0.25rem rgb(231 3 3 / 25%)'});
        }
        if(document.getElementById('regCPass').value == regPass.value){
            $("#err2").html('');
            $("#regCPass").css({'border-color':'', 'box-shadow':''});
        }
    }
    
}
// compare password
function comparePass(){
    if(document.getElementById('regCPass').value != regPass.value){
        $("#err2").html('Password mismatch!');
        $("#regCPass").css({'border-color':'#E70303', 'box-shadow':'0 0 0 0.25rem rgb(231 3 3 / 25%)'});
    }
    if(document.getElementById('regCPass').value == regPass.value){
        $("#err2").html('');
        $("#regCPass").css({'border-color':'', 'box-shadow':''});
    }
}



