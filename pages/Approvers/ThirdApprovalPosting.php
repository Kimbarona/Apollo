<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();

$Id = $_POST['Id'];
$CurrentDate = date('y-m-d');
$B_Status = 'Approved';


$stmts = $ApprovalClass->runQuery("SELECT * From apollo_thirdapprover WHERE b_id='$Id'");
$stmts->execute();
$row = $stmts->fetch();
    $BId = $row['b_id'];
    $Bdate = $row['b_date'];
    $capex_number = $row['capex_number'];
    $contract_amount = $row['contract_amount'];
    $contractor = $row['contractor'];
    $billing_type = $row['billing_type'];
    $progress = $row['progress'];
    $billable_amount = $row['billable_amount'];
    $approvedby = $row['approver_name'];
    $approved_date = $row['approval_date'];
    $billing_status = 'For Approval';
    $second_approval_date = date('y-m-d');
    $Remarks = 'Not Available';
    $approver_name = 'Dionisio Literato';

  

    if($firstprocess = $ApprovalClass->UpdateThirdApprovalDate($Id, $CurrentDate, $B_Status, $Remarks)){
        if($secondprocess = $ApprovalClass->InsertDataToFourthApprover($Bdate, $capex_number, $contract_amount, $contractor,$billing_type,$progress,$billable_amount,
        $approvedby,$approved_date,$billing_status,$second_approval_date, $approver_name, $Remarks)){
            if($ThirdProcess = $ApprovalClass->UpdateThirdTrackingOfBilling($approvedby, $CurrentDate, $billing_type, $capex_number)){
                echo 'Approved Successfully!';
            }
        }
    }
    else{

    }

?>