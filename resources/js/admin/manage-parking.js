$("#manageParkingTable").DataTable({
    responsive: true,
    ajax: {
        url: 'app/Models/admin/ManageParkingModel.php',
        method: 'POST',
        data:{
            'fetchParkingAreasTrigger' : true
        },
        dataSrc: ''
    }
});





// POPULATE PARKING METER DROPDOWN ON SIDEBAR
function fetchPAreasForPMeter(){
    $.ajax({
        url: 'app/Models/admin/ManageParkingModel.php',
        method: 'POST',
        data:{
            'fetchPAreasForPMeterTrig': true
        },
        success: function(jsonResp){
            let response = JSON.parse(jsonResp);
           
            if(response.countData > 0){
                $("#parking-meter-areas").html(response.dropdowns);
            }else{
                $("#parking-meter-areas").closest('li').find('a').css({'cursor': 'not-allowed'}).attr('title', 'Add Parking Areas first');
            }
            
        }
    });
}
fetchPAreasForPMeter();





// POPULATE DASHLETS
function countAreasSlots(){
    $.ajax({
        url: 'app/Models/admin/ManageParkingModel.php',
        method: 'POST',
        data:{
            'countAreasSlotsTrig': true
        },
        success: function(jsonResp){
            let response = JSON.parse(jsonResp);
            $("#totParkingAreas").html(response.totAReas);
            $("#activeParkingAreas").html(response.totActive);
            $("#deactivatedParkingAreas").html(response.totDeact);
            if(response.totSlots4W == null || response.totSlots2W == null || response.overallTotSlots == null){
                $("#totSlot4W").html(0);
                $("#totSlot2W").html(0);
                $("#overAllPSlots").html(0);
            }else{
                $("#totSlot4W").html(response.totSlots4W);
                $("#totSlot2W").html(response.totSlots2W);
                $("#overAllPSlots").html(response.overallTotSlots);
            }
            
            
        }
    });
}
countAreasSlots();




// ADD NEW PARKING AREA
$(document).on('click', '#addnewParkingAreaBtn', function(){
    let tr = $(this).closest('tr');

    let newAreaNameInput = $("#newAreaNameInput").val();
    let new4WSlotinput = $("#new4WSlotinput").val();
    let new2WSlotinput = $("#new2WSlotinput").val();
    let adminAuthenticate = $("#adminAuthenticate").val();
    let adminID = $("#adminID").val();

    if(newAreaNameInput != "" && new4WSlotinput != "" || new2WSlotinput){
        $.ajax({
            url: 'app/Models/admin/ManageParkingModel.php',
            method: 'POST',
            data: {
                'newAreaNameInput' : newAreaNameInput,
                'new4WSlotinput' : new4WSlotinput,
                'new2WSlotinput' : new2WSlotinput,
                'adminAuthenticate' : adminAuthenticate,
                'adminID' : adminID,
                'addNewParkingArea': true
            },
            beforeSend: function(){
                $('#addnewParkingAreaBtn').html('<i class="fas fa-spinner fa-pulse"></i>');
            },
            success: function(jsonResp){
                let response = JSON.parse(jsonResp);
                if(response.statusCode == 200){
                    
                    setTimeout(function(){
                        $("#newParkingAreaModal").modal('hide');
                        showToastMsg('New Parking Area has been added');
                        tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                    }, 2000);
                    setTimeout(function(){
                        $('#manageParkingTable').DataTable().ajax.reload();
                        countAreasSlots();
                    }, 3000);
                }
                if(response.statusCode == 201){
                    setTimeout(function(){
                        $('#addnewParkingAreaBtn').html('ADD');
                        $("#adminAuthenticate").popover('show').addClass('has-error');
                    }, 2000);
                }
            }
        });
    }

});






// MANAGE PARKING AREA

$(document).on('click', '.confirm-mp-btn', function(){
    let btn = $(this);
    let tr = $(this).closest('tr');

    let id = $(this).data('id');
    let btnName = $(this).data("btn-name");
    let adminPass = $("#needAdminPassFld" +id).val();
    let adminID = $("#adminID").val();


    // CONFIGURE FORM
    if(btnName == "configBtn" + id){
        let areaName = $("#areaName" + id).val();
        let newFWSlotVal = $("#fwSlot" + id).val();
        let newTWSlotVal = $("#twSlot" + id).val();

        let areaNameDefVal = $("#areaName" + id).data('def-val');
        let FWSlotDefVal = $("#fwSlot" + id).data('def-val');
        let TWSlotDefVal = $("#twSlot" + id).data('def-val');

        if(adminPass == ""){
            $("#needAdminPassFld" +id).attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $.ajax({
                url: 'app/Models/admin/ManageParkingModel.php',
                method: 'POST',
                data: {
                    'parkingID': id,
                    'areaNameDefVal' : areaNameDefVal,
                    'FWSlotDefVal' : FWSlotDefVal,
                    'TWSlotDefVal' : TWSlotDefVal,
                    'areaName' : areaName,
                    'newFWSlotVal' : newFWSlotVal,
                    'newTWSlotVal' : newTWSlotVal,
                    'adminPass' : adminPass,
                    'adminID' : adminID,
                    'configParkingArea': true
                },
                beforeSend: function(){
                    $(btn).html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){
                        
                        setTimeout(function(){
                            $("#manageParkingModal" + id).modal('hide');
                            showToastMsg(areaName + ' area info has been updated');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageParkingTable').DataTable().ajax.reload();
                            countAreasSlots();
                        }, 3000);

                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $(btn).html('Confirm');
                            $("#needAdminPassFld" +id).attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                        }, 2000);
                    }
                }
            });
        }

    } // configure btn



    // DEACTIVATE FORM
    if(btnName == "deactBtn" + id){

        if(adminPass == ""){
            $("#needAdminPassFld" +id).attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $.ajax({
                url: 'app/Models/admin/ManageParkingModel.php',
                method: 'POST',
                data: {
                    'parkingID': id,
                    'adminPass' : adminPass,
                    'adminID' : adminID,
                    'deactParkingArea': true
                },
                beforeSend: function(){
                    $(btn).html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){
                        
                        setTimeout(function(){
                            $("#manageParkingModal" + id).modal('hide');
                            showToastMsg(response.areaName + ' area has been deactivated');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageParkingTable').DataTable().ajax.reload();
                            countAreasSlots();
                        }, 3000);

                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $(btn).html('Confirm');
                            $("#needAdminPassFld" +id).attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                        }, 2000);
                    }
                }
            });
        }

    } // deactivate btn


    // REACTIVATE FORM
    if(btnName == "reactivateBtn" + id){

        if(adminPass == ""){
            $("#needAdminPassFld" +id).attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $.ajax({
                url: 'app/Models/admin/ManageParkingModel.php',
                method: 'POST',
                data: {
                    'parkingID': id,
                    'adminPass' : adminPass,
                    'adminID' : adminID,
                    'reactivateParkingArea': true
                },
                beforeSend: function(){
                    $(btn).html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){
                        
                        setTimeout(function(){
                            $("#manageParkingModal" + id).modal('hide');
                            showToastMsg(response.areaName + ' area has been reactivated');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageParkingTable').DataTable().ajax.reload();
                            countAreasSlots();
                        }, 3000);

                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $(btn).html('Confirm');
                            $("#needAdminPassFld" +id).attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                        }, 2000);
                    }
                }
            });
        }

    } // reactivate btn


    // DELETE FORM
    if(btnName == "delBtn" + id){

        if(adminPass == ""){
            $("#needAdminPassFld" +id).attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $.ajax({
                url: 'app/Models/admin/ManageParkingModel.php',
                method: 'POST',
                data: {
                    'parkingID': id,
                    'adminPass' : adminPass,
                    'adminID' : adminID,
                    'deleteParkingArea': true
                },
                beforeSend: function(){
                    $(btn).html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){
                        
                        setTimeout(function(){
                            $("#manageParkingModal" + id).modal('hide');
                            showToastMsg(response.areaName + ' area has been deleted');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageParkingTable').DataTable().ajax.reload();
                            countAreasSlots();
                        }, 3000);

                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $(btn).html('Confirm');
                            $("#needAdminPassFld" +id).attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                        }, 2000);
                    }
                }
            });
        }

    } // delete btn
    
})