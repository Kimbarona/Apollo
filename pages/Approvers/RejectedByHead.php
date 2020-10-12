<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();

// $Remarks =$_POST["Remarks"];
$Id =$_POST["Id"];

$Finding = $ApprovalClass->runQuery("SELECT * From apollo_firstapprover WHERE b_id='$Id'");
$Finding->execute();
$row = $Finding->fetch();
$CapexNumber =  $row['capex_number'];
$BillingType =  $row['billing_type'];
$Remark = 'Back to EO';

$Bdate = $row['b_date'];
$capex_number = $row['capex_number'];
$contract_amount = $row['contract_amount'];
$contractor = $row['contractor'];
$billing_type = $row['billing_type'];
$progress = $row['progress'];
$billable_amount = $row['billable_amount'];
$BillingStatus = $row['billing_status'];
$RejectedDate = date('y-m-d');
$Remarks = $_POST['Remarks'];

// select name of assigned EO
$SelectEo = $ApprovalClass->runQuery("SELECT * From apollo_enrolledproject WHERE capex_number='$CapexNumber'");
$SelectEo->execute();
$rowSelect = $SelectEo->fetch();
$EO = $rowSelect['engineer'];


if($firstprocess = $ApprovalClass->UpdateBackToEoFirstApprovalRemark($Id, $Remark)){
    if($Secondprocess = $ApprovalClass->InsertToRejectedHistory($Bdate,$capex_number,$contract_amount,$contractor,$billing_type,
        $progress,$billable_amount,$BillingStatus,$RejectedDate,$Remarks, $EO)){
        if($Thirdprocess = $ApprovalClass->DeleteFromMasterlistOfBillings($CapexNumber, $BillingType)){
            if($Fourthprocess = $ApprovalClass->DeleteFromProgressBillings($CapexNumber, $BillingType)){
                if($Fifthprocess = $ApprovalClass->DeleteFromTrackingOfbilling($CapexNumber, $BillingType)){
                    echo 'Successfully rejected!';
                }
            }
        }
    }
}
else{

}
?>