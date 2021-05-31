function genPassBtn(){
    
    $("#genPassBtn").html('<i class="fas fa-spinner fa-pulse"></i>').css({'margin-right': '31px'});

    setTimeout(function(){
        let chars = 'abcdefghjiklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*()_+';
        let charLen = chars.length;
        let strholder = '';
        for (let index = 0; index <= 12; index++) {
            const num = Math.floor(Math.random() * charLen);
            strholder += chars[num];
        }
        $("#passFld").val(strholder).popover('dispose').addClass('has-success').removeClass('has-error');


        $("#genPassBtn").html('Generate').css({'margin-right': '0'});

    }, 1000);

    setTimeout(function(){
        $("#passFld").removeClass('has-success');
    }, 2000);
    
}