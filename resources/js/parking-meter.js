//  ==================== FETCH DATA FOR PARKING METER TABLE ====================
function pMeterTable(){
    let areaID = $("#areaID").val();
    $("#parkingMeterTable").DataTable({
        responsive: true,
        order: [2, "desc"],
        ajax: {
            url: 'app/Models/ParkingMeterModel.php',
            method: 'POST',
            data:{
                'areaID' : areaID,
                'fetchPMeterDataTrig' : true
            },
            dataSrc: ''
        }
    });
}
pMeterTable();
setInterval(function(){
    $("#parkingMeterTable").DataTable().ajax.reload(null, false);
}, 10000);

// Testing
//  ==================== SIDE DASHLETS ====================
// TOTAL VACANT SLOTS
function countSlots(){
    let areaID = $("#areaID").val();
    let areaName = $("#areaName").val();
    $.ajax({
        url: 'app/Models/ParkingMeterModel.php',
            method: 'POST',
            data:{
                'areaID': areaID,
                'areaName': areaName,
                'countSlotsTrig': true
            },
            success: function(jsonResponse){
                let response = JSON.parse(jsonResponse);
                $('#pMeterTotSlotsCount').html(response.totSlots);
                $('#pMeterTot4WSlotsCount').html(response.vacSlots4W);
                $('#pMeterTot2WSlotsCount').html(response.vacSlots2W);
                

                
            }
    });
    
}
countSlots();



//  ==================== CHECK-IN DRIVER ====================
$(document).on('click', '#checkInBtn', function(){
    let userID = $("#userID").val();
    let areaID = $("#areaID").val();
    let areaName = $("#areaName").val();
    let plateNum = $("#plateNum").val().toUpperCase();
    let vhType = $('input[name="checkIn-vhType"]:checked').val();

    if(plateNum == ""){
        $("#plateNum").popover('show').addClass('has-error');
    }
    if(!$('input[name="checkIn-vhType"]').is(':checked')){
        $(".vhType").popover('show').addClass('has-error');
    }
    if(plateNum != "" && $('input[name="checkIn-vhType"]').is(':checked')){
       
    
        $.ajax({
            url: 'app/Models/ParkingMeterModel.php',
            method: 'POST',
            data:{
                'userID': userID,
                'areaID': areaID,
                'areaName': areaName,
                'plateNum': plateNum,
                'vhType': vhType,
                'checkInTrig': true
            },
            success: function(jsonResponse){
                console.log(jsonResponse);
                let response = JSON.parse(jsonResponse);
                if(response.statusCode == 'checkedIn'){
                    $("#checkInModal").modal('hide');
                    
                    $("#prntPArea").html(areaName);
                    $("#printPlateNum").html(plateNum);
                    $("#timeIn").html(response.timeIn);
                    $("#printTicketModal").modal('show');

                    $("#parkingMeterTable").DataTable().ajax.reload(null, false);
                    countSlots();
                }
                
            }
        });
    }

});

//  ==================== CHECK-IN DRIVER ====================
$(document).on('click', '.checkOutBtn', function(){
    let userID = $("#userID").val();
    let transactID = $(this).data('id');
    
    $.ajax({
        url: 'app/Models/ParkingMeterModel.php',
        method: 'POST',
        data:{
            'userID': userID,
            'transactID': transactID,
            'checkOutTrig': true
        },
        success: function(jsonResponse){
            let response = JSON.parse(jsonResponse);
            if(response.statusCode == 'checkedOut'){

                $("#checkOutModal" + transactID).modal('hide');

                $("#printReceiptVType").html(response.vhType);
                $("#printReceiptDate").html(response.dateIn);
                $("#printReceiptIn").html(response.timeIn);
                $("#printReceiptOut").html(response.timeOut);
                $("#printReceiptDuration").html(response.duration);
                $("#printReceiptAmount").html('₱' + response.amountDue);
                $("#printReceiptModal").modal('show');

                $("#parkingMeterTable").DataTable().ajax.reload(null, false);
                countSlots();
                dailyFreqChart();
                dailyRevChart();
            }
            
        }
    });
   

});


//  ============================ CHARTS ============================

// PARKING FREQUENCY
function dailyFreqChart(){
    let areaID = $("#areaID").val();
    let areaName = $("#areaName").val();

    $.ajax({
        url: 'app/Models/ParkingMeterModel.php',
        method: 'POST',
        data:{
            'areaID': areaID,
            'dailyFreqChartTrig': true
        },
        success: function(jsonResponse){
           
            let freqData = JSON.parse(jsonResponse);
            let freqDataLength = freqData.freq.length;
            let parkFreq = [];

            for (let i = 0; i < freqDataLength; i++) {
                parkFreq.push(freqData.freq[i]);
            }
           
           
            let dailyFreqChartData = {
                labels: ['12am', '1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm', '8pm', '9pm', '10pm', '11pm'],
                datasets: [
                        {
                            label: ['Parking Frequency'],
                            data: parkFreq,
                            fill: false,
                            backgroundColor: '#151A22'
                        }
                ]
            };
            let dailyFreqChartCtx = $("#dailyFreqChart");
            let dailyFreqChart = new Chart(dailyFreqChartCtx, {
                type: 'bar',
                data: dailyFreqChartData,
                options: {
                    scales: {
                        y: {
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
            
        }
    });

    
}
dailyFreqChart();



// PARKING REVENUE
function dailyRevChart(){
    let areaID = $("#areaID").val();
    let areaName = $("#areaName").val();

    $.ajax({
        url: 'app/Models/ParkingMeterModel.php',
        method: 'POST',
        data:{
            'areaID': areaID,
            'dailyRevChartTrig': true
        },
        success: function(jsonResponse){
            let revData = JSON.parse(jsonResponse);
            let revDataLength = revData.rev.length;
            let parkRev = [];

            for (let i = 0; i < revDataLength; i++) {
                parkRev.push(revData.rev[i]);
            }

            let dailyRevChartData = {
                labels: ['12am', '1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am', '9am', '10am', '11am', '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm', '8pm', '9pm', '10pm', '11pm'],
                datasets: [
                        {
                            label: ['Parking Revenue'],
                            data: parkRev,
                            fill: false,
                            backgroundColor: '#18754C'
                        }
                ]
            };
            
            let dailyRevChartCtx = $("#dailyRevChart");
            let dailyRevChart = new Chart(dailyRevChartCtx, {
                type: 'bar',
                data: dailyRevChartData,
                options: {
                    scales: {
                        y: {
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value;
                                },
                                stepSize: 1
                            }
                        }
                    }
                }
            });
            
        }
    });

    
}
dailyRevChart();