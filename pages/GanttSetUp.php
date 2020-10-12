<?php
//  require_once("class.php");
//  $ForGanttChart = new ForGanttChart();

//  $view = $ForGanttChart->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE capex_number='19-121'");
//  $result = $view->execute();
//      while($row = $view->fetch(PDO::FETCH_ASSOC))
//      {

//      }

$CapexNum = $_POST['val'];

$connect = mysqli_connect("localhost", "root", "", "db_engineering");
$query = "SELECT id, subscopes,actual_start, actual_end, planned_end, planned_start, subscope_percent 
 FROM apollo_project_assigned_scopes 
 Where capex_number = '$CapexNum' 
 AND work_status!='Pending To Start'";


$result = mysqli_query($connect, $query);
$SomeScope = [];
$somePlanStartActualEnd = [];
$somePlanEndActualEnd = [];
$taskPlan = [];
$months = []; //pending ko muna to
$workDelay = [];



if(mysqli_num_rows($result) > 0)
{
 
 while($row = mysqli_fetch_assoc($result))
 {  
    $a = (strtotime($row['actual_end'])-strtotime($row['planned_end']))/(86400);
 
 
    if($row['actual_end'] > $row['planned_end']){
        $actual = $row['actual_end'];
        $planned = $row['planned_end'];

        $a = (strtotime($row['actual_end'])-strtotime($row['planned_end']))/(86400);
        
        
    }
    else{
        $actual = 0;
        $planned = 0;
      
    }

    array_push($SomeScope, [
        'label'   => $row['subscopes'].'<br><br>Progress (blue):'. $row['subscope_percent'].''.'%',
        'scope' => $row['subscope_percent'],
        'id' => $row['id'],
        'hoverBandColor' => '#e44a00',
        'hoverBandAlpha' => '20'
        
    ]);
    
    array_push($somePlanStartActualEnd, [
            'label' => $row['planned_start'],
            'label' => $row['actual_start']
    ]);

    array_push($somePlanEndActualEnd, [
            'label' => $row['planned_end'],
            'label' => $row['actual_end']
    ]);

    array_push($taskPlan, 
        ['label'   => 'Planned',
        'processid'   => $row['id'],
        'start'   => $row['planned_start'],
        'end'   => $row['planned_end'],
        'id'   => $row['id'],
        'color'   => '#6baa01',
        'height'   => '20%',
        'toppadding'   => '20%'],

        ['label'   => 'Actual',
        'processid' => $row['id'],
        'start'   => $row['actual_start'],
        'end'   => $row['actual_end'],
        'id'   => $row['id'],
        'color'   => '#008ee4', 
        'height'   => '20%',
        'toppadding'   => '50%'],
        
        ['label' => 'Delay',
        'processid'  => $row['id'],
        'start' => $planned,
        'end' => $actual,
        'id'  => $row['id'],
        'color'  => '#e44a00',
        'toppadding'  => '50%',
        'height'  => '20%',
        'tooltext'  =>$a.' '."Day/s Delayed",
        ]
    
    );

    
    
 }


            $getStart = "SELECT MIN(actual_start)as startDate FROM apollo_project_assigned_scopes Where capex_number = '$CapexNum'";
            $resultDate = mysqli_query($connect, $getStart);
            if(mysqli_num_rows($resultDate) > 0)
            {
               $row = mysqli_fetch_assoc($resultDate);
               $startDate = date('Y-m-01', strtotime($row['startDate']));
             }

             $getEnd = "SELECT MAX(actual_end)as EndDate FROM apollo_project_assigned_scopes Where capex_number = '$CapexNum'";
             $resultEnd = mysqli_query($connect, $getEnd);
             if(mysqli_num_rows($resultEnd) > 0)
             {
                $rowEnd = mysqli_fetch_assoc($resultEnd);
                $EndDate = date('Y-m-t', strtotime($rowEnd['EndDate']));
              }

                // This code is for whole year range 
                $arrayYearRange = [];
                $start = $month = strtotime($startDate);
                $end = strtotime($EndDate);
                while($month < $end)
                {   
                        $query_date = date('F Y', $month);
                        $thisStart = date('Y-m-01', strtotime($query_date));
                        $thisEnd = date('Y-m-t', strtotime($query_date));

                        $thisMonth =  date('F', $month);
                        $month = strtotime("+1 month", $month);

                        array_push($arrayYearRange, [
                            'start' => $thisStart,
                            'end' => $thisEnd,
                            'label' => $thisMonth
                        ]);
                }

                // this is for weekly range
                $begin = new DateTime(date('Y-m-01', strtotime($startDate)));
                $end = new DateTime(date('Y-m-t', strtotime($EndDate)));
                $end = $end->modify( '+7 day' ); 
                
                $interval = new DateInterval('P7D');
                $daterange = new DatePeriod($begin, $interval ,$end);
                
                $week = 0;
                $arrayWeekly = [];
                foreach($daterange as $date){
                    $conDate =  $date->format("Y-m-d");
                    $days =  $date->format("d");
                    
                    if($week > 4){
                        $week = 1;
                    }
                    array_push($arrayWeekly, [
                        'start' => $conDate,
                        'end' => $conDate,
                        'label' => "week ".$week
                        
                    ]);
                   
                $week++;
                }

                // this is for total slacks
                $getSlack = "SELECT planned_end,actual_end, sum(TIMESTAMPDIFF(day,planned_end,actual_end)) as 'Slack'
                FROM apollo_project_assigned_scopes where TIMESTAMPDIFF(day,planned_end,actual_end) > 0 AND capex_number = '$CapexNum'";
                $resultSlack = mysqli_query($connect, $getSlack);
                $rowSlack = mysqli_fetch_assoc($resultSlack);
                
                $TotalSlacks = $rowSlack['Slack'];
                if($TotalSlacks ==''){
                    $TotalSlacks=0; 
                }
                $TotalSlackDelay = [];

                array_push($TotalSlackDelay,
                      
                        ["label"=> "Planned",
                        "color"=>  "#6baa01",
                        ],     
                
                                    
                        ["label"=> "Actual",
                        "color"=>  "#008ee4",
                        ],
                                  
                        ["label"=> "Slack:" .' '. $TotalSlacks .' '."Day/s",
                        "color"=>  "#e44a00"                     
                        ]
                
            );


            // this is for the Project name

            $getprojectName = "SELECT project_name FROM apollo_enrolledproject WHERE capex_number = '$CapexNum'";
            $projectname= mysqli_query($connect, $getprojectName);
            $rowprojectname = mysqli_fetch_assoc($projectname);
            $ProjectName = $rowprojectname['project_name'];



 $result = array("scope"=>$SomeScope,"PlanStartActualEnd"=>$somePlanStartActualEnd,"somePlanEndActualEnd"=>$somePlanEndActualEnd,"taskPlan"=>$taskPlan,"StartDate"=>$startDate,"EndDate"=>$EndDate,"arrayRangeYear"=>$arrayYearRange,"arrayWeekly"=>$arrayWeekly,"arraySlacks"=>$TotalSlackDelay, "ProjectName"=>$ProjectName );
 $forProjectScope = json_encode($result);
 echo $forProjectScope;
}
 
 ?>
 



