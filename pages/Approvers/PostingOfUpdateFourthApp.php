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
$BillingStatus = 1;
$Remarks = 'Printed';

    if($firstprocess = $ApprovalClass->UpdateFinalApprovalDate($Id, $CurrentDate, $B_Status, $Remarks )){
        if($Secondprocess = $ApprovalClass->UpdateMasterBillings($CapexNumber, $BillingType, $BillingStatus)){
        echo 'Successfully Approved!';
        }
    }
    else{

    }

?>