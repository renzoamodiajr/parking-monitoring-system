// SIDEBAR
function toggleSidebar(value){
    if($(window).width() > 768){
        if(value == 'hide'){
            $(".sidebar").animate({'margin-left':'-285px'});
            $(".page-content").animate({'margin-left':'0'});
        }
        if(value == 'show'){
            $(".sidebar").animate({'margin-left':'0'});
            $(".page-content").animate({'margin-left':'265px'});
        }
    }else if($(window).width() == 768){
        if(value == 'hide'){
            $(".sidebar").animate({'margin-left':'-285px'});
        }
        if(value == 'show'){
            $(".sidebar").animate({'margin-left':'0'});
        }
    }


    if($(window).width() <= 1440 && $(window).width() > 1024){
        if(value == 'hide'){
            $("#admin-dashboard .col").css({"flex":"1"});
        }
        if(value == 'show'){
            $("#admin-dashboard .col").css({"flex":"none"});
        }
    }
}




// POP-UP TOAST MESSAGE
function showToastMsg(toastMsg){
    $("#myToastMsg").fadeIn('slow').delay(3500).fadeOut('slow');
    $("#toastMsg").html(toastMsg);
}


// NAVIGATION HAS CHILD TOGGLE
$(".sidebar-list-item-has-child").click(function(){
    $(".nav-toggle", this).slideToggle('slow');
});



// MODAL TABLE ROW OPTIONS
$(document).on('click', '.modal-opt', function(){
    let icon = $(this).data('form-icon');
    let title = $(this).data('form-title');
    let form = $(this).data('form-target');
    if(form){
        $("." + form).show();
        $(".modal-title span").html('<i class="' + icon + '"></i> ' + title);

        $(".modal-form").not("." + form).hide();
        $(".btn-form").not("." + form).hide();
    }
});


//  ############################################################ ADMIN ############################################################




//  ============================================= MANAGE PARKING =============================================

// ---------------------- ADDING PARKING AREAS ----------------------
$(document).on('keyup', '.mangeParkingInput', function(){
    if($('#newAreaNameInput').val() != ""){
        if($("#new4WSlotinput").val() != 0 || $("#new2WSlotinput").val() != 0){
            if($("#new4WSlotinput").val() != "" && $("#new2WSlotinput").val() != ""){
                $(".authenticate_action").show();
            }else{
                $(".authenticate_action").hide();
                $("#addnewParkingAreaBtn").hide();
            }
        }
    }
})


$(document).on('keyup', '.adminAuthenticate', function(){
    if($(this).val() != ""){
        $("#addnewParkingAreaBtn").show();
    }else{
        $("#addnewParkingAreaBtn").hide();
    }
})



// ---------------------- MANAGE PARKING TABLE ----------------------

// -------- CONFIGURE PARKING AREA --------

// EDIT PARKING AREA FIELD
$(document).on("click", ".editFld", function(){
    // EDIT INPUT FIELD
    if(!$(this).data('clicked')){
        $(this).closest('div').find('input').removeAttr('disabled');
        $(this).removeClass('fa-edit').addClass('fa-times');
        $(this).data('clicked', true);
    }
    // CANCEL EDIT
    else{
        let defVal = $(this).closest('div').find('input').data('def-val');
        $(this).closest('div').find('input').attr('disabled', true);
        $(this).closest('div').find('input').val(defVal);
        $(this).removeClass('fa-times').addClass('fa-edit');
        $(this).data('clicked', false);
    }
    
})

// 4 WHEELER ADD - REDUCE SLOT QUANTITY BUTTON
$(document).on("click", ".fwASlotBtn", function(){
    let id = $(this).data('id');
    let fwSlot = $("#fwSlot" + id).val();
    
    // ADD QTY
    if($(this).data('slot-btn') == "add"){
        fwSlot++;
    }
    
    // REDUCE QTY
    if($(this).data('slot-btn') == "reduce"){
        if(fwSlot == 0){
            $("#fwSlot" + id).val(0);
        }else{
            fwSlot--;
        }
    }

    $("#fwSlot" + id).val(fwSlot);
    
})

// 2 WHEELER ADD - REDUCE SLOT QUANTITY BUTTON
$(document).on("click", ".twASlotBtn", function(){
    let id = $(this).data('id');
    let twSlot = $("#twSlot" + id).val();
    
    // ADD QTY
    if($(this).data('slot-btn') == "add"){
        twSlot++;
    }
    
    // REDUCE QTY
    if($(this).data('slot-btn') == "reduce"){
        if(twSlot == 0){
            $("#twSlot" + id).val(0);
        }else{
            twSlot--;
        }
    }

    $("#twSlot" + id).val(twSlot);
    
})

// SLOT QUANTITY VALIDATION FIELD
$(document).on("keyup", ".slotQty", function(e){
    let newVal = $(this).val();
    let valLen = $(this).val().length;

    // RESTRICT USER TO PUT 0 AS A FIRST DIGIT
    if(newVal != 0){
        value = newVal.replace(/^(0*)/,"");
        $(this).val(value);
    }
    if($(this).val() == 01 || $(this).val() == 02 || $(this).val() == 03 || $(this).val() == 04 || $(this).val() == 05 || $(this).val() == 06 || $(this).val() == 07 || $(this).val() == 08 || $(this).val() == 09 ){
        $(this).val(newVal.replace([0], ""));
    }

    // RESTRICT USER TO PUT SPECIAL CHARACTERS
    if(/\D/g.test(newVal)){
        this.value = this.value.replace(/\D/g,'');
    }

    // RESTRICT USER TO INPUT MORE THAN ONE 0 VALUE
    if(valLen > 1 && newVal == 00){
        $(this).val(0);
    }
});




//  ============================================= CHECK-IN DRIVER =============================================
$(document).on('click', '.vhType', function(){
   let input = $(this).find('input');
    $(".vhType").popover('dispose').removeClass('has-error');
    if($(this).find('input').is(':checked')){
        $(this).find('input').prop('checked', false);
    }else{
        $(this).find('input').prop('checked', true);
        $('input[type="checkbox"]').not(input).prop('checked', false);
    }
})


$(document).on('click', 'input[type="checkbox"]', function(){
   $('input[type="checkbox"]').not(this).prop('checked', false);
   $(".vhType").popover('dispose').removeClass('has-error');
})