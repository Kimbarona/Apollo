<?php
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();

$CapexNumber = $_POST['CapexNumber'];
$FindData = $EnrollNewProject->runQuery("SELECT * From apollo_projectlist where capex_number = '$CapexNumber'");
$FindData->execute();
$RowData = $FindData->fetch(PDO::FETCH_ASSOC);

    $ProjectName = $RowData['project_name'];
    $Project_Proponent = $_POST['Project_Proponent'];
    $BudgetAmount = $RowData['budgeted_amount'];
    $ContractAmt = $_POST['ContractAmt'];
    $Approval_Status = "For Approval";

    if($EnrollNewProject->SendItForApproval($CapexNumber, $ProjectName, $Project_Proponent, $BudgetAmount, $ContractAmt, $Approval_Status)){
        if($EnrollNewProject->UpdateStatusOfApproval($CapexNumber,$Approval_Status)){
            echo "For Approval Sent!";
        }
    }
?>