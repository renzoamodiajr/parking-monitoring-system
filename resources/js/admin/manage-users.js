
// ================================= FETCHING DATAS =================================

// MANAGE USERS TABLE
$("#manageUsersTable").DataTable({
    responsive: true,
    ajax: {
        url: 'app/Models/admin/ManageUsersModel.php',
        method: 'POST',
        data:{
            'fetchUsersTrigger' : true
        },
        dataSrc: ''
    }
});

// AUTO INCREMENT THE VALUE OF [USERNAME FIELD] WHEN CREATING NEW ACCOUNT
function fetchLastAcct(){
    $.ajax({
        url: 'app/Models/admin/ManageUsersModel.php',
        method: 'POST',
        data:{
            'fetchLastAcctTrig': true
        },
        success: function(jsonResp){
           
            let response = JSON.parse(jsonResp);
            $("#unameFld").val('cashier' + response.total);
        }
    });

}
fetchLastAcct();


// DASHLETS
function countUsers(){
    $.ajax({
        url: 'app/Models/admin/ManageUsersModel.php',
        method: 'POST',
        data:{
            'countUsersTrig': true
        },
        success: function(jsonResp){
           
            let response = JSON.parse(jsonResp);
            $("#activeUsers").html(response.countActive);
            $("#totalUsers").html(response.countTotal);
            $("#deactUsers").html(response.countDeactivated);
        }
    });
}
countUsers();



// FETCH ALL PARKING AREAS FOR [ASSIGN/REASSIGN PARKING AREA FIELD] WHEN CREATING NEW ACCOUNT
function fetchAreaNames(){
    $.ajax({
        url: 'app/Models/admin/ManageUsersModel.php',
        method: 'POST',
        data:{
            'fetchAreaNamesTrig': true
        },
        success: function(jsonResp){
            let response = JSON.parse(jsonResp);
            $("#assignPAreaFld").html(response.areaNames);
            $('.reAssignFld').html(response.areaNames);
        }
    });
}
fetchAreaNames();



// ================================= CREATE ACCOUNT =================================

$(document).on("click", "#createAcctBtn", function(){
    let fnameFld = $('#fnameFld').val();
    let lnameFld = $('#lnameFld').val();
    let unameFld = $('#unameFld').val();
    let passFld = $('#passFld').val();
    let assignPAreaFld = $('#assignPAreaFld').val();
    
    let adminID = $('#adminID').val();
    let adminAuthenticate = $('.adminAuthenticate').val();
    // IF EMPTY
    if(!fnameFld){
        showErrorMsg('#fnameFld');
    }
    if(!lnameFld){
        showErrorMsg('#lnameFld');
    }
    if(!unameFld){
        showErrorMsg('#unameFld');
    }
    if(!passFld){
        showErrorMsg('#passFld');
    }
    if(assignPAreaFld == null){
        showErrorMsg('#assignPAreaFld');
    }
    if(!adminAuthenticate){
        showErrorMsg('.adminAuthenticate');
    }
    
    // IF NOT EMPTY
    if(fnameFld && lnameFld && unameFld && passFld && assignPAreaFld != null && adminID && adminAuthenticate){
      
        $.ajax({
            url: 'app/Models/admin/ManageUsersModel.php',
            method: 'POST',
            data:{
                'fnameFld' : fnameFld,
                'lnameFld' : lnameFld,
                'unameFld' : unameFld,
                'passFld' : passFld,
                'assignPAreaFld' : assignPAreaFld,
                'adminID' : adminID,
                'adminAuthenticate' : adminAuthenticate,
                'regUserTrigger': true
            },
            beforeSend: function(){
                $("#createAcctBtn").html('<i class="fas fa-spinner fa-pulse"></i> Creating...');
            },
            success:function(jsonResp){
               
                let response = JSON.parse(jsonResp);
                if(response.statusCode == 200){

                    setTimeout(function(){

                        $("#createAcctBtn").html('Create');
                        $("#createAcctModal").modal('hide');  
                        
                        $("#fnameFld").val('');
                        $("#lnameFld").val('');
                        $("#passFld").val('');
                        $("#assignPAreaFld").prop('selectedIndex', 0);
                        $(".adminAuthenticate").val('');

                        $("#authFailedMsg").hide();
                        
                        $('#manageUsersTable').DataTable().ajax.reload();
                        
                        showToastMsg('Account created successfully!');    
                        fetchLastAcct();
                        countUsers();
                        fetchAreaNames();
                        
                    }, 1500);

                }
                if(response.statusCode == 201){
                    setTimeout(function(){
                        $("#authFailedMsg").show();
                        $(".adminAuthenticate").addClass('has-error').val('');
                        $("#createAcctBtn").html('Create');     
                    }, 1500)
                }
            }

        });
    }

});


// ================================= MANAGE USERS TABLE =================================

// MODAL - [REASSIGN TO] VALIDATION FIELD
$(document).on("change", ".reAssignFld", function(){
    let defaultVal = $(this).data('default-val');
    let newVal = $(this).val();

    if(newVal == defaultVal){
        $(this).popover('show').addClass('has-error');  
    }else{
        $(this).popover('dispose').removeClass('has-error');
    }

});

// REFRESH DATA IN PARKING AREA FIELD
$(document).on("click", ".modal-opt", function(){
    let id = $(this).data('id');
    $("#needAdminPassFld" + id).removeClass('has-error');
    fetchAreaNames();
});


// MODAL - CONFIRM BUTTON IS CLICKED
$(document).on("click", ".confirmMngUserBtn", function(){

    let tr = $(this).closest('tr');

    let userID = $(this).data('id');
    let adminID = $("#adminID").val();
    let btnName = $(this).data('btn-name');
    let needAdminPassFld = $("#needAdminPassFld" + userID).val();
    
    // REASSIGN FORM BUTTON
    if(btnName == "reAssignBtn" + userID){
        
        let defaultVal = $("#reAssignFld" + userID).data('default-val');
        let newVal = $("#reAssignFld" + userID).val();
        
        if(newVal == null || newVal == defaultVal){
            $("#reAssignFld" + userID).popover('show').addClass('has-error');  
        }else if(needAdminPassFld == ""){
            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $.ajax({
                url: 'app/Models/admin/ManageUsersModel.php',
                method: 'POST',
                data:{
                    'newVal': newVal,
                    'needAdminPassFld': needAdminPassFld,
                    'userID': userID,
                    'adminID': adminID,
                    'reassignUserTrigger': true
                },
                beforeSend: function(){
                    $("#needAdminPassFld" + userID).popover('dispose').removeClass('has-error');
                    $('button[data-btn-name="reAssignBtn'+ userID +'"]').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){

                        setTimeout(function(){
                            $("#manageUserModal" + userID).modal('hide');
                            showToastMsg('User has been reassigned successfully!');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageUsersTable').DataTable().ajax.reload();
                            countUsers();
                        }, 3000);
                        
                       
                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                            $('button[data-btn-name="reAssignBtn'+ userID +'"]').html('Confirm');
                        }, 2000);
                    }
                    
                }
            });
        }
    }

    // DEACTIVATE FORM BUTTON
    if(btnName == "deactBtn" + userID){
        
        if(needAdminPassFld == ""){
            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $("#needAdminPassFld" + userID).popover('dispose').removeClass('has-error');
            $.ajax({
                url: 'app/Models/admin/ManageUsersModel.php',
                method: 'POST',
                data:{
                    'needAdminPassFld': needAdminPassFld,
                    'userID': userID,
                    'adminID': adminID,
                    'deactAcctTrigger': true
                },
                beforeSend: function(){
                    $("#needAdminPassFld" + userID).popover('dispose').removeClass('has-error');
                    $('button[data-btn-name="deactBtn'+ userID +'"]').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){

                        setTimeout(function(){
                            $("#manageUserModal" + userID).modal('hide');
                            showToastMsg('Account has been deactivated');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageUsersTable').DataTable().ajax.reload();
                            countUsers();
                        }, 3000);
                        
                       
                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                            $('button[data-btn-name="deactBtn'+ userID +'"]').html('Confirm');
                        }, 2000);
                    }
                    
                }
            });
        }
       
    }

    // REACTIVATE FORM BUTTON
    if(btnName == "reactivateBtn" + userID){
        
        if(needAdminPassFld == ""){
            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $("#needAdminPassFld" + userID).popover('dispose').removeClass('has-error');
            $.ajax({
                url: 'app/Models/admin/ManageUsersModel.php',
                method: 'POST',
                data:{
                    'needAdminPassFld': needAdminPassFld,
                    'userID': userID,
                    'adminID': adminID,
                    'reactivateAcctTrigger': true
                },
                beforeSend: function(){
                    $("#needAdminPassFld" + userID).popover('dispose').removeClass('has-error');
                    $('button[data-btn-name="reactivateBtn'+ userID +'"]').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){

                        setTimeout(function(){
                            $("#manageUserModal" + userID).modal('hide');
                            showToastMsg('Account has been reactivated');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageUsersTable').DataTable().ajax.reload();
                            countUsers();
                        }, 3000);
                        
                       
                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                            $('button[data-btn-name="reactivateBtn'+ userID +'"]').html('Confirm');
                        }, 2000);
                    }
                    
                }
            });
        }
       
    }

    // DELETE FORM BUTTON
    if(btnName == "delBtn" + userID){
        
        if(needAdminPassFld == ""){
            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'This field is required').popover('show').addClass('has-error');
        }else{
            $("#needAdminPassFld" + userID).popover('dispose').removeClass('has-error');
            $.ajax({
                url: 'app/Models/admin/ManageUsersModel.php',
                method: 'POST',
                data:{
                    'needAdminPassFld': needAdminPassFld,
                    'userID': userID,
                    'adminID': adminID,
                    'deleteAcctTrigger': true
                },
                beforeSend: function(){
                    $("#needAdminPassFld" + userID).popover('dispose').removeClass('has-error');
                    $('button[data-btn-name="delBtn'+ userID +'"]').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success: function(jsonResp){
                    let response = JSON.parse(jsonResp);
                    if(response.statusCode == 200){

                        setTimeout(function(){
                            $("#manageUserModal" + userID).modal('hide');
                            showToastMsg('Account has been deleted');
                            tr.css({'outline': 0, 'box-shadow': '0 0 0 0.55rem rgb(25 135 84 / 25%)'});
                        }, 2000);
                        setTimeout(function(){
                            $('#manageUsersTable').DataTable().ajax.reload();
                            countUsers();
                            fetchLastAcct();
                        }, 3000);
                        
                       
                    }
                    if(response.statusCode == 201){
                        setTimeout(function(){
                            $("#needAdminPassFld" + userID).removeAttr('data-bs-content').attr('data-bs-content', 'Incorrect password').popover('show').addClass('has-error');
                            $('button[data-btn-name="delBtn'+ userID +'"]').html('Confirm');
                        }, 2000);
                    }
                    
                }
            });
        }
       
    }
    
});
   






