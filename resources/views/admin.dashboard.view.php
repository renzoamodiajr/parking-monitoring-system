
       
<div class="row align-items-center" id="bay-stats-container" style="text-transform: uppercase;">
    
   
    <div class="col d-flex justify-content-evenly text-center" id="bay-stats-dashlet">
        <div class="position-relative" style="width:200px">
            <canvas id="vacantSlotsChart" width="215px"></canvas>
            <div class="doughnut-text position-absolute text-center">
                <p id="vacPerc">XXX</p>
                <p>Vacant Slots</p>
            </div>
        </div>

        <div class="position-relative" style="width:200px">
            <canvas id="occupiedSlotsChart" width="215px"></canvas>
            <div class="doughnut-text position-absolute text-center">
                <p id="occupPerc">XXX</p>
                <p>Occupied Slots</p>
            </div>
        </div>

        <div class="position-relative" style="width:200px">
            <canvas id="totalSlotsChart" width="215px"></canvas>
            <div class="doughnut-text position-absolute text-center">
                <p id="totSlotTxt">XXX</p>
                <p>Total Slots</p>
            </div>
        </div>
    </div>
   

    <div class="col d-flex justify-content-evenly text-left overall-tot-con">
        <div class="item" style="border-right: 1px inset #bfbdb9;padding-right: 46px;">
            <h5 class="mt-3">Overall Total Revenue</h5>
            <span style="font-size:50px; color:#DFDFDF;padding-right: 21px;">&#8369;</span>
            <span style="font-size:50px; color:#4CB581" id="totRevTxt"> XXXX</span>
        </div>
        <div class="item" style="padding-left: 46px;">
            <h5 class="mt-3">Overall Total Frequency</h5>
            <i class="fas fa-chart-bar" style="font-size:50px; color:#DFDFDF;padding-right: 21px;"></i>
            <span style="font-size:50px; color:#4CB581" id="totFreqTxt"> XXX</span>
        </div>
    </div>
    
</div>


<h2 class="mt-5 text-center">Month of <?php echo $currentMonth; ?></h2>
<div class="row justify-content-between mt-3">
    <h3 class="pb-3">Weekly Report <span style="font-size:17px; display:none">(Collecting of datas will start every first monday of the month)</span></h3>
    <div class="card col me-5 park_r">
        <h5 class="mt-3">Parking Revenue</h5>
        <div class="card-body">
            <canvas id="weeklyDynamicRepREV" height="135"></canvas>
        </div>
    </div>
    <div class="card col ms-5 park_f">
        <h5 class="mt-3">Parking Frequency</h5>
        <div class="card-body">
            <canvas id="weeklyDynamicRepFREQ" height="135"></canvas>
        </div>
    </div>
</div>


<div class="row justify-content-between mt-5">
    <h3 class="pb-3">Monthly Report</h3>
    <div class="card col me-5 park_r">
        <h5 class="mt-3">Parking Revenue</h5>
        <div class="card-body">
            <canvas id="monthlyDynamicRepREV" height="135"></canvas>
        </div>
    </div>
    <div class="card col ms-5 park_f">
        <h5 class="mt-3">Parking Frequency</h5>
        <div class="card-body">
            <canvas id="monthlyDynamicRepFREQ" height="135"></canvas>
        </div>
    </div>
</div>

<hr class="my-5">

<h2 class="mt-5 text-center">Data from last 5 years to present</h2>
<div class="row justify-content-between mt-3">
    <h3 class="pb-3">Yearly Report</h3>
    <div class="card col me-5 park_r">
        <h5 class="mt-3">Parking Revenue</h5>
        <div class="card-body">
            <canvas id="yearlyDynamicRepREV" height="135"></canvas>
        </div>
    </div>
    <div class="card col ms-5 park_f">
        <h5 class="mt-3">Parking Frequency</h5>
        <div class="card-body">
            <canvas id="yearlyDynamicRepFREQ" height="135"></canvas>
        </div>
    </div>
</div>
 