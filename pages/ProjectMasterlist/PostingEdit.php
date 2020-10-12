<?php
require_once("classProject.php");
$ProjectList = new ProjectList();

    $OrgNum =$_POST['OrgNum'];
    $BudgetedAmt = $_POST["BudgetedAmt"];
    $OrigAmount = $_POST['OrigAmount'];
    
    $stmts = $ProjectList->runQuery("SELECT * From apollo_projectlist WHERE org_number = '$OrgNum'");
    $stmts->execute();
    $row = $stmts->fetch();
    $capex = $row['capex_number'];
    $project = $row['project_name'];



    if($ProjectList->UpdateProjectAmount($OrgNum, $BudgetedAmt)){
        if($ProjectList->insertToHistoryLogs($capex, $project, $OrigAmount, $BudgetedAmt)){
            echo "Updated successfully!";
        }
       
    }
    else{
        echo "Incomplete Data!";
    }
?>