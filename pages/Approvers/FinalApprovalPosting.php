<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();

$Id = $_POST['Id'];
$CurrentDate = date('y-m-d');
$B_Status = 'Approved';

$Finding = $ApprovalClass->runQuery("SELECT * From apollo_fourthapprover WHERE b_id='$Id'");
$Finding->execute();
$row = $Finding->fetch();
$CapexNumber =  $row['capex_number'];
$BillingType =  $row['billing_type'];
$approvedby = $row['approver_name']; 
$BillingStatus = 1;
$Remarks = 'Not Available';

    if($firstprocess = $ApprovalClass->UpdateFinalApprovalDate($Id, $CurrentDate, $B_Status, $Remarks )){
        if($Secondprocess = $ApprovalClass->UpdateMasterBillings($CapexNumber, $BillingType, $BillingStatus)){
            if($Thirdprocess = $ApprovalClass->UpdateBillingOfAddCost($CapexNumber, $BillingType, $B_Status)){
                if($ThirdProcess = $ApprovalClass->UpdateFourthTrackingOfBilling($approvedby, $CurrentDate, $BillingType, $CapexNumber)){
                    echo 'Successfully Approved!';
                }
            }
        }
    }
    else{

    }

?>