// 1ST DASHLET
function slotStatFreqRevDashlet(){
  
    $.ajax({
        url: 'app/Models/admin/DashboardModel.php',
        method: 'POST',
        data:{
            'slotStatFreqRevDashletTrig': true
        },
        success: function(jsonResponse){
            
            let data = JSON.parse(jsonResponse);
            $("#vacPerc").html(((data.totVacSlots / data.totSlots) * 100).toFixed(0) + "%");
            $("#occupPerc").html(((data.totOccupSlots / data.totSlots) * 100).toFixed(0) + "%");
            $("#totSlotTxt").html(data.totSlots);
            $("#totRevTxt").html(data.totRev);
            $("#totFreqTxt").html(data.totFreq);
            
                // ############## TOTAL VACANT ##############
                let vacantSlotsChartData = {
                    // labels: ['Vacant Slots'],
                    datasets: [
                            {
                                data: [data.totVacSlots, data.totSlots - data.totVacSlots],
                                backgroundColor: ['#4CB581', '#EEEDEB']
                            }
                    ]
                };
                
                let vacantSlotsChartCtx = $("#vacantSlotsChart");
                let vacantSlotsChart = new Chart(vacantSlotsChartCtx, {
                    type: 'doughnut',
                    data: vacantSlotsChartData,
                    options: {
                        cutout: "70%",
                        maintainAspectRatio : false
                    }
                });


                // ############## TOTAL OCCUPIED ##############
                let occupiedSlotsChartData = {
                    // labels: ['', 'Occupied Slots'],
                    datasets: [
                            {
                                data: [data.totSlots, data.totOccupSlots],
                                backgroundColor: ['#EEEDEB', '#CE0C0C']
                            }
                    ]
                };
                
                let occupiedSlotsChartCtx = $("#occupiedSlotsChart");
                let occupiedSlotsChart = new Chart(occupiedSlotsChartCtx, {
                    type: 'doughnut',
                    data: occupiedSlotsChartData,
                    options: {
                        cutout: "70%",
                        maintainAspectRatio : false
                    }
                });


                // ############## TOTAL SLOTS ##############
                let totalSlotsChartData = {
                    // labels: ['', 'Occupied Slots'],
                    datasets: [
                            {
                                data: [data.totSlots],
                                backgroundColor: ['#151A22']
                            }
                    ]
                };
                
                let totalSlotsChartCtx = $("#totalSlotsChart");
                let totalSlotsChart = new Chart(totalSlotsChartCtx, {
                    type: 'doughnut',
                    data: totalSlotsChartData,
                    options: {
                        cutout: "70%",
                        maintainAspectRatio : false
                    }
                });
            
        }
    });

    
}
slotStatFreqRevDashlet();





// WEEKLY DASHLET
function weeklyDynamicReport(){
  
    $.ajax({
        url: 'app/Models/admin/DashboardModel.php',
        method: 'POST',
        data:{
            'weeklyDynamicReportTrig': true
        },
        success: function(jsonResponse){
         
            let data = JSON.parse(jsonResponse);
            // console.log(data);
                // ############## WEEKLY PARKING REVENUE ##############
                let weeklyDynamicRepREVData = {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [
                            {
                                label: ['Parking Revenue'],
                                data: [data.totRevWeek1, data.totRevWeek2, data.totRevWeek3, data.totRevWeek4],
                                backgroundColor: ['#4CB581']
                            }
                    ]
                };
                
                let weeklyDynamicRepREVCtx = $("#weeklyDynamicRepREV");
                let weeklyDynamicRepREV = new Chart(weeklyDynamicRepREVCtx, {
                    type: 'bar',
                    data: weeklyDynamicRepREVData,
                    options: {
                        scales: {
                            yAxes: {
                                ticks: {
                                    callback: function(value, index, values) {
                                        return '₱' + value;
                                    }
                                }
                            }
                        }
                    }
                    
                  
                });


                // ############## WEEKLY PARKING FREQUENCY ############## 
                let weeklyDynamicRepFREQData = {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [
                            {
                                label: ['Parking Frequency'],
                                data: [data.totFreqWeek1, data.totFreqWeek2, data.totFreqWeek3, data.totFreqWeek4],
                                backgroundColor: ['#151A22']
                            }
                    ]
                };
                
                let weeklyDynamicRepFREQCtx = $("#weeklyDynamicRepFREQ");
                let weeklyDynamicRepFREQ = new Chart(weeklyDynamicRepFREQCtx, {
                    type: 'bar',
                    data: weeklyDynamicRepFREQData
                });

            
        }
    });

    
}
weeklyDynamicReport();




// MONTHLY DASHLET
function monthlyDynamicReport(){
  
    $.ajax({
        url: 'app/Models/admin/DashboardModel.php',
        method: 'POST',
        data:{
            'monthlyDynamicReportTrig': true
        },
        success: function(jsonResponse){
            // console.log(jsonResponse);
            let data = JSON.parse(jsonResponse);
            // console.log(data);
            

            // ############## MONTHLY  PARKING REVENUE ##############
            let revDataLen = data.totMonthlyRev.length;
            let revData = [];
            for(let i = 0; i<revDataLen; i++){
                revData.push(data.totMonthlyRev[i]);
            }
            
            let monthlyDynamicRepREVData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                        {
                            label: ['Parking Revenue'],
                            data: revData,
                            backgroundColor: ['#4CB581']
                        }
                ]
            };
            
            let monthlyDynamicRepREVCtx = $("#monthlyDynamicRepREV");
            let monthlyDynamicRepREV = new Chart(monthlyDynamicRepREVCtx, {
                type: 'bar',
                data: monthlyDynamicRepREVData,
                options: {
                    scales: {
                        yAxes: {
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value;
                                }
                            }
                        }
                    }
                }
                
                
            });



            // ############## MONTHLY PARKING FREQUENCY ##############

            let freqDataLen = data.totMonthlyFreq.length;
            let freqData = [];
            for(let j=0; j<freqDataLen; j++){
                freqData.push(data.totMonthlyFreq[j]);
            }
            
            let monthlyDynamicRepFREQData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                        {
                            label: ['Parking Frequency'],
                            data: freqData,
                            backgroundColor: ['#151A22']
                        }
                ]
            };
            
            let monthlyDynamicRepFREQCtx = $("#monthlyDynamicRepFREQ");
            let monthlyDynamicRepFREQ = new Chart(monthlyDynamicRepFREQCtx, {
                type: 'bar',
                data: monthlyDynamicRepFREQData
                
            });

            
        }
    });

    
}
monthlyDynamicReport();





// YEARLY DASHLET
function yearlyDynamicReport(){
  
    $.ajax({
        url: 'app/Models/admin/DashboardModel.php',
        method: 'POST',
        data:{
            'yearlyDynamicReportTrig': true
        },
        success: function(jsonResponse){
            // console.log(jsonResponse);
            let data = JSON.parse(jsonResponse);
            // console.log(data);
            
            let yearsLen = data.years.length;
            let years = [];
            for(let y=0; y<yearsLen; y++){
                years.push(data.years[y]);
            }

            // ############## YEARLY PARKING REVENUE ##############

            let revDataLen = data.totYearlyRev.length;
            let revData = [];
            for(let i=0; i<revDataLen; i++){
                revData.push(data.totYearlyRev[i]);
            }

            let yearlyDynamicRepREVData = {
                labels: years,
                datasets: [
                        {
                            label: ['Parking Revenue'],
                            data: revData,
                            backgroundColor: ['#4CB581']
                        }
                ]
            };
            
            let yearlyDynamicRepREVCtx = $("#yearlyDynamicRepREV");
            let yearlyDynamicRepREV = new Chart(yearlyDynamicRepREVCtx, {
                type: 'bar',
                data: yearlyDynamicRepREVData,
                options: {
                    scales: {
                        yAxes: {
                            ticks: {
                                callback: function(value, index, values) {
                                    return '₱' + value;
                                }
                            }
                        }
                    }
                }
                
                
            });

            
            // ############## YEARLY PARKING FREQUENCY ##############

            let freqDataLen = data.totYearlyFreq.length;
            let freqData = [];
            for(let j=0; j<freqDataLen; j++){
                freqData.push(data.totYearlyFreq[j]);
            }

            let yearlyDynamicRepFREQData = {
                labels: years,
                datasets: [
                        {
                            label: ['Parking Frequency'],
                            data: freqData,
                            backgroundColor: ['#151A22']
                        }
                ]
            };
            
            let yearlyDynamicRepFREQCtx = $("#yearlyDynamicRepFREQ");
            let yearlyDynamicRepFREQ = new Chart(yearlyDynamicRepFREQCtx, {
                type: 'bar',
                data: yearlyDynamicRepFREQData
            });

            
        }
    });

    
}
yearlyDynamicReport();