<?php

//insertDito.php

require_once("class.php");
$AssignedWorks = new AssignedWorks();


if(isset($_POST['hidden_id']))
{
 $ProjectName = $_POST['projectname'];  
 $genscope = $_POST['genscope'];
 $amount = $_POST['amount'];
 $percent = $_POST['percent'];
 $scope_status = $_POST['scope_status'];
 $plannedstart = $_POST['plannedstart'];
 $plannedend = $_POST['plannedend'];
 $id = $_POST['hidden_id'];
 $error = implode($id);
 $errorpro = implode($ProjectName);
// eror trapping dito

        for($count = 0; $count < count($id); $count++)
        {
        $data = array(
        ':id'   => $id[$count],
        ':projectname'   => $ProjectName[$count],
        ':genscope'   => $genscope[$count],
        ':amount'  => $amount[$count],
        ':percent'  => $percent[$count],
        ':scope_status' => $scope_status[$count],
        ':plannedstart'   => $plannedstart[$count],
        ':plannedend'   => $plannedend[$count]
        
        );
       
        $stmts = $AssignedWorks->runQuery("SELECT * From apollo_laborcost_and_schedule WHERE id = '$error' AND project_name ='$errorpro'");
        $stmts->execute();
        $row = $stmts->fetch();
        
            if ($row ==0) {
            $query =
                "INSERT INTO apollo_laborcost_and_schedule (id, project_name, genscope, amount, progress, scopestatus, planned_start, planned_end)
                 VALUES(:id, :projectname, :genscope, :amount, :percent, :scope_status, :plannedstart, :plannedend)";

                    $statement = $AssignedWorks->runQuery($query);
                    $statement->execute($data);
                
                }
                else{
                
                    echo "mali";
                    
                }
                // echo json_encode($data);
        }


          
}  


?>
