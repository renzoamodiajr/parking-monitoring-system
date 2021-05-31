<?php require_once '../../../config/dbcon.php';

date_default_timezone_set('Asia/Manila');

class DashboardController extends DatabaseConnection{


    public function slotStatFreqRevDashlet(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // TOTAL SLOTS
            $totSlotsSTMT = $this->connectDb()->prepare("SELECT (SUM(tot_4Wheel_slot) + SUM(tot_2Wheel_slot)) as totSlots FROM parking_area_info");
            $totSlotsSTMT->execute();
            $totSlots = $totSlotsSTMT->fetch();
            
            // TOTAL OCCUPIED SLOTS
            $totOccupSlotSTMT = $this->connectDb()->prepare("SELECT COUNT(*) as totOccupSlots FROM parking_transaction WHERE time_checked_out = '' AND parking_status = 'Unpaid'");
            $totOccupSlotSTMT->execute();
            $totOccupSlots = $totOccupSlotSTMT->fetch();

            // TOTAL VACANT SLOTS
            $totVacSlots = 0;


            // TOTAL REVENUE
            $totRevSTMT = $this->connectDb()->prepare("SELECT SUM(parking_rate) as totRev FROM parking_transaction WHERE parking_status = 'Paid'");
            $totRevSTMT->execute();
            $totRev = $totRevSTMT->fetch();


            // TOTAL PARKING FREQUENCY
            $totFreqSTMT = $this->connectDb()->prepare("SELECT COUNT(*) as totFreq FROM parking_transaction WHERE time_checked_out != '' AND parking_status = 'Paid'");
            $totFreqSTMT->execute();
            $totFreq = $totFreqSTMT->fetch();

            echo json_encode(
                    array(
                        'totSlots' => $totSlots['totSlots'],
                        'totOccupSlots' => $totOccupSlots['totOccupSlots'],
                        'totVacSlots' => $totSlots['totSlots'] - $totOccupSlots['totOccupSlots'],
                        'totRev' => ($totRev['totRev'] + 0),
                        'totFreq' => $totFreq['totFreq']
                    )
                );
        }
    }


    public function weeklyDynamicReport(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $firstMonday = new DateTime('first Monday of this month');

            $getDaysOFWeeks = array();
            
            for($i = 0; $i < 4; $i++){
                $getDaysOFWeeks[] = $firstMonday->format('Y-m-d');
                $firstMonday->modify('next Monday');
            }
            
           
            $week1Freq = array();
            $week1Rev = array();
            $getDays1stWeek = array();

            $week2Freq = array();
            $week2Rev = array();
            $getDays2ndWeek = array();

            $week3Freq = array();
            $week3Rev = array();
            $getDays3rdWeek = array();

            $week4Freq = array();
            $week4Rev = array();
            $getDays4thWeek = array();
            
            for($j = 0; $j < 7; $j++){
               
                $getDays1stWeek[] = date('Y-m-d',strtotime($getDaysOFWeeks[0] . "+$j day"));
                $day1stmt = $this->connectDb()->prepare("SELECT COUNT(*) as totFreqWeek1, SUM(parking_rate) as totRevWeek1 FROM parking_transaction WHERE date_parked_in = :_day AND parking_status = 'Paid'");
                $day1stmt->bindParam(':_day', $getDays1stWeek[$j]);
                $day1stmt->execute();
                foreach($day1stmt as $row){
                    $week1Freq[] = $row['totFreqWeek1'];
                    $week1Rev[] = $row['totRevWeek1'];
                }
                
                $getDays2ndWeek[] = date('Y-m-d',strtotime($getDaysOFWeeks[1] . "+$j day"));
                $day2stmt = $this->connectDb()->prepare("SELECT COUNT(*) as totFreqWeek2, SUM(parking_rate) as totRevWeek2 FROM parking_transaction WHERE date_parked_in = :_day AND parking_status = 'Paid'");
                $day2stmt->bindParam(':_day', $getDays2ndWeek[$j]);
                $day2stmt->execute();
                foreach($day2stmt as $row2){
                    $week2Freq[] = $row2['totFreqWeek2'];
                    $week2Rev[] = $row2['totRevWeek2'];
                }
                
                $getDays3rdWeek[] = date('Y-m-d',strtotime($getDaysOFWeeks[2] . "+$j day"));
                $day3stmt = $this->connectDb()->prepare("SELECT COUNT(*) as totFreqWeek3, SUM(parking_rate) as totRevWeek3 FROM parking_transaction WHERE date_parked_in = :_day AND parking_status = 'Paid'");
                $day3stmt->bindParam(':_day', $getDays3rdWeek[$j]);
                $day3stmt->execute();
                foreach($day3stmt as $row3){
                    $week3Freq[] = $row3['totFreqWeek3'];
                    $week3Rev[] = $row3['totRevWeek3'];
                }
                
                $getDays4thWeek[] = date('Y-m-d',strtotime($getDaysOFWeeks[3] . "+$j day"));
                $day4stmt = $this->connectDb()->prepare("SELECT COUNT(*) as totFreqWeek4, SUM(parking_rate) as totRevWeek4 FROM parking_transaction WHERE date_parked_in = :_day AND parking_status = 'Paid'");
                $day4stmt->bindParam(':_day', $getDays4thWeek[$j]);
                $day4stmt->execute();
                foreach($day4stmt as $row4){
                    $week4Freq[] = $row4['totFreqWeek4'];
                    $week4Rev[] = $row4['totRevWeek4'];
                }
                
                
            }
            

            echo json_encode(array(
                                'totFreqWeek1' => array_sum($week1Freq),
                                'totRevWeek1'=> array_sum($week1Rev),
                                'totFreqWeek2' => array_sum($week2Freq),
                                'totRevWeek2'=> array_sum($week2Rev),
                                'totFreqWeek3' => array_sum($week3Freq),
                                'totRevWeek3'=> array_sum($week3Rev),
                                'totFreqWeek4' => array_sum($week4Freq),
                                'totRevWeek4'=> array_sum($week4Rev)
                            )
                );
        }
    }


    public function monthlyDynamicReport(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $totMonthlyFreq = array();
            $totMonthlyRev = array();
            
            for($i = 1; $i <= 12; $i++){
                $totDayInMonths = cal_days_in_month(CAL_GREGORIAN,$i,2021);
                $month = sprintf("%02d", $i);
                $firstDay = '2021-'.$month.'-01';
                $lastDay = '2021-'.$month.'-'.$totDayInMonths.'';
             
                $stmt = $this->connectDb()->prepare("SELECT COUNT(*) as totMonthlyFreq, SUM(parking_rate) as totMonthlyRev FROM parking_transaction WHERE date_parked_in >= :firstDay AND date_parked_in <= :lastDay AND parking_status = 'Paid'");
                $stmt->bindParam(':firstDay', $firstDay);
                $stmt->bindParam(':lastDay', $lastDay);
                $stmt->execute();
                foreach($stmt as $row){
                    $totMonthlyFreq[] = $row['totMonthlyFreq'];
                    $totMonthlyRev[] = $row['totMonthlyRev'];
                }
               
            }

            echo json_encode(array(
                            'totMonthlyFreq' => $totMonthlyFreq,
                            'totMonthlyRev' => $totMonthlyRev
            ));
        }
    }



    public function yearlyDynamicReport(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $totYearlyFreq = array();
            $totYearlyRev = array();

            $years = array();
           
            for($i = 5; $i >= 0; $i--){
                $years[] = date('Y', strtotime("-$i year"));
            }


          
            for($k=0; $k<=5; $k++){
                $stmt = $this->connectDb()->prepare("SELECT COUNT(*) as totYearlyFreq, SUM(parking_rate) as totYearlyRev FROM parking_transaction WHERE date_parked_in LIKE 
                '$years[$k]%' AND parking_status = 'Paid'");
                // $stmt->bindParam(':firstDay', '%'.);
                $stmt->execute();
                foreach($stmt as $row){
                    $totYearlyFreq[] = $row['totYearlyFreq'];
                    $totYearlyRev[] = $row['totYearlyRev'];
                }
            }

            echo json_encode(array(
                'years' => $years,
                'totYearlyFreq' => $totYearlyFreq,
                'totYearlyRev' => $totYearlyRev
            ));
        }
    }




}