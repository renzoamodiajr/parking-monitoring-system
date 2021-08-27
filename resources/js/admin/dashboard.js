$(document).ready(function(){
        // ================================ 1ST DASHLET ================================

        // ############## TOTAL VACANT CHART ##############
        let vacantSlotsChartCtx = $("#vacantSlotsChart");
        let vacantSlotsChart = new Chart(vacantSlotsChartCtx, {
            type: 'doughnut',
            data: {
                datasets: [
                    {
                        data: [],
                        backgroundColor: ['#4CB581', '#EEEDEB']
                    }
                ]
            },
            options: {
                cutout: "70%",
                maintainAspectRatio : false
            }
        });

        // ############## TOTAL OCCUPIED CHART ##############
        let occupiedSlotsChartCtx = $("#occupiedSlotsChart");
        let occupiedSlotsChart = new Chart(occupiedSlotsChartCtx, {
            type: 'doughnut',
            data: {
                datasets: [
                    {
                        data: [],
                        backgroundColor: ['#EEEDEB', '#CE0C0C']
                    }
                ]
            },
            options: {
                cutout: "70%",
                maintainAspectRatio : false
            }
        });

        // ############## TOTAL SLOTS ##############
        let totalSlotsChartCtx = $("#totalSlotsChart");
        let totalSlotsChart = new Chart(totalSlotsChartCtx, {
            type: 'doughnut',
            data: {
                datasets: [
                    {
                        data: [],
                        backgroundColor: ['#151A22', '#EEEDEB']
                    }
                ]
            },
            options: {
                cutout: "70%",
                maintainAspectRatio : false
            }
        });

        function slotStatFreqRevDashlet(){
        
            $.ajax({
                url: 'app/Models/admin/DashboardModel.php',
                method: 'POST',
                data:{
                    'slotStatFreqRevDashletTrig': true
                },
                success: function(jsonResponse){
                    
                    let data = JSON.parse(jsonResponse);

                    
                    // ############## TOTAL VACANT ##############
                    let vacSlotsData = [];
                    
                    if(data.totVacSlots == 0){
                        vacSlotsData.push(data.totVacSlots, 100);
                        vacantSlotsChart.data.datasets[0].data = vacSlotsData;
                        $("#vacPerc").html(0 + "%");
                        
                    }else{
                        vacSlotsData.push(data.totVacSlots, data.totSlots - data.totVacSlots);
                        vacantSlotsChart.data.datasets[0].data = vacSlotsData;

                        $("#vacPerc").html(Math.round((data.totVacSlots / data.totSlots) * 100) + "%");
                    }
                    vacantSlotsChart.update();


                    // ############## TOTAL OCCUPIED ##############
                    let occSlotsData = [];
                   
                    if(data.totOccupSlots == 0){
                        $("#occupPerc").html(0 + "%");
                        occSlotsData.push(100, data.totOccupSlots);
                        occupiedSlotsChart.data.datasets[0].data = occSlotsData;
                    }else{
                        occSlotsData.push(data.totSlots, data.totOccupSlots);
                        occupiedSlotsChart.data.datasets[0].data = occSlotsData;
                        $("#occupPerc").html(Math.round((data.totOccupSlots / data.totSlots) * 100) + "%");
                    }
                    occupiedSlotsChart.update();


                    // ############## TOTAL SLOTS ##############
                    let totSlotsData = [];
                    
                    if(data.totSlots == 0){
                        totSlotsData.push(data.totSlots, 100);
                        totalSlotsChart.data.datasets[0].data = totSlotsData;
                        $("#totSlotTxt").html(0);
                    }else{
                        totSlotsData.push(data.totSlots);
                        totalSlotsChart.data.datasets[0].data = totSlotsData;
                        $("#totSlotTxt").html(data.totSlots);
                    }
                    totalSlotsChart.update();

                    // TOTAL FREQUENCY AND REVENUE TEXTS
                    $("#totRevTxt").html(data.totRev);
                    $("#totFreqTxt").html(data.totFreq);
                    

                    
                }
            });

            
        }
        slotStatFreqRevDashlet();





        // ======================================= WEEKLY DASHLET =======================================

        // ############## REVENUE CHART ##############
        let weeklyDynamicRepREVCtx = $("#weeklyDynamicRepREV");
        let weeklyDynamicRepREV = new Chart(weeklyDynamicRepREVCtx, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [
                        {
                            label: ['Parking Revenue'],
                            data: [],
                            backgroundColor: ['#4CB581']
                        }
                ]
            },
            options: {
                scales: {
                    yAxes: {
                        ticks: {
                            callback: function(value, index, values) {
                                return '₱' + value;
                            },
                            precision: 0
                        }
                    }
                }
            }
            
        });


        // ############## FREQUENCY CHART ############## 
        let weeklyDynamicRepFREQCtx = $("#weeklyDynamicRepFREQ");
        let weeklyDynamicRepFREQ = new Chart(weeklyDynamicRepFREQCtx, {
            type: 'bar',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [
                        {
                            label: ['Parking Frequency'],
                            data: [],
                            backgroundColor: ['#151A22']
                        }
                ]
            },
            options: {
                scales: {
                    yAxes: {
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

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

                    let weeklyRevData = []
                    weeklyRevData.push(data.totFreqWeek1, data.totFreqWeek2, data.totFreqWeek3, data.totFreqWeek4);
                    weeklyDynamicRepREV.data.datasets[0].data = weeklyRevData;
                    weeklyDynamicRepREV.update();

                    let weeklyFreqData = []
                    weeklyFreqData.push(data.totRevWeek1, data.totRevWeek2, data.totRevWeek3, data.totRevWeek4);
                    weeklyDynamicRepFREQ.data.datasets[0].data = weeklyFreqData;
                    weeklyDynamicRepFREQ.update();
                    
                }
            });

            
        }
        weeklyDynamicReport();




        // ======================================= MONTHLY DASHLET =======================================

        // ############## REVENUE CHART ##############
        let monthlyDynamicRepREVCtx = $("#monthlyDynamicRepREV");
        let monthlyDynamicRepREV = new Chart(monthlyDynamicRepREVCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                        {
                            label: ['Parking Revenue'],
                            data: [],
                            backgroundColor: ['#4CB581']
                        }
                ]
            },
            options: {
                scales: {
                    yAxes: {
                        ticks: {
                            callback: function(value, index, values) {
                                return '₱' + value;
                            },
                            precision:0
                        }
                    }
                }
            }
        });

        // ############## FREQUENCY CHART ############## 
        let monthlyDynamicRepFREQCtx = $("#monthlyDynamicRepFREQ");
        let monthlyDynamicRepFREQ = new Chart(monthlyDynamicRepFREQCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                        {
                            label: ['Parking Frequency'],
                            data: [],
                            backgroundColor: ['#151A22']
                        }
                ]
            },
            options: {
                scales: {
                    yAxes: {
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
            
        });

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
                        monthlyDynamicRepREV.data.datasets[0].data = revData;
                        monthlyDynamicRepREV.update();

                    // ############## MONTHLY PARKING FREQUENCY ##############
                        let freqDataLen = data.totMonthlyFreq.length;
                        let freqData = [];
                        for(let j=0; j<freqDataLen; j++){
                            freqData.push(data.totMonthlyFreq[j]);
                        }
                        monthlyDynamicRepFREQ.data.datasets[0].data = freqData;
                        monthlyDynamicRepFREQ.update();
                    
                }
            });

            
        }
        monthlyDynamicReport();





        // ================================ YEARLY DASHLET ================================
        // ############## REVENUE CHART ##############
        let yearlyDynamicRepREVCtx = $("#yearlyDynamicRepREV");
        let yearlyDynamicRepREV = new Chart(yearlyDynamicRepREVCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                        {
                            label: ['Parking Revenue'],
                            data: [],
                            backgroundColor: ['#4CB581']
                        }
                ]
            },
            options: {
                scales: {
                    yAxes: {
                        ticks: {
                            callback: function(value, index, values) {
                                return '₱' + value;
                            },
                            precision:0
                        }
                    }
                }
            }
            
            
        });

        // ############## FREQUENCY CHART ##############
        let yearlyDynamicRepFREQCtx = $("#yearlyDynamicRepFREQ");
        let yearlyDynamicRepFREQ = new Chart(yearlyDynamicRepFREQCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [
                        {
                            label: ['Parking Frequency'],
                            data: [],
                            backgroundColor: ['#151A22']
                        }
                ]
            },
            options: {
                scales: {
                    yAxes: {
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

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
                    
                    // ############## GET YEARS ##############
                    let yearsLen = data.years.length;
                    let years = [];
                    for(let y=0; y<yearsLen; y++){
                        years.push(data.years[y]);
                    }
                    yearlyDynamicRepREV.data.labels = years;
                    yearlyDynamicRepFREQ.data.labels = years;
                    
                    // ############## YEARLY PARKING REVENUE ##############

                    let revDataLen = data.totYearlyRev.length;
                    let revData = [];
                    for(let i=0; i<revDataLen; i++){
                        revData.push(data.totYearlyRev[i]);
                    }
                    yearlyDynamicRepREV.data.datasets[0].data = revData;
                    yearlyDynamicRepREV.update();

                    
                    // ############## YEARLY PARKING FREQUENCY ##############

                    let freqDataLen = data.totYearlyFreq.length;
                    let freqData = [];
                    for(let j=0; j<freqDataLen; j++){
                        freqData.push(data.totYearlyFreq[j]);
                    }
                    
                    yearlyDynamicRepFREQ.data.datasets[0].data = freqData;
                    yearlyDynamicRepFREQ.update();
                    
                }
            });

            
        }
        yearlyDynamicReport();



})