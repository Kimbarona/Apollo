<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();

$Id = $_POST['Id'];
$CurrentDate = date('y-m-d');
$B_Status = 'Approved';

$Finding = $ApprovalClass->runQuery("SELECT * From apollo_firstapprover WHERE b_id='$Id'");
$Finding->execute();
$row = $Finding->fetch();
$CapexNumber =  $row['capex_number'];
$BillingType =  $row['billing_type'];
$BillingStatus = 1;
$Remark = 'Back to EO';

// select name of assigned EO
$SelectEo = $ApprovalClass->runQuery("SELECT * From apollo_enrolledproject WHERE capex_number='$CapexNumber'");
$SelectEo->execute();
$rowSelect = $SelectEo->fetch();
$EO = $rowSelect['engineer'];

// this is for the history of rejected billings

$Bdate = $row['b_date'];
$capex_number = $row['capex_number'];
$contract_amount = $row['contract_amount'];
$contractor = $row['contractor'];
$billing_type = $row['billing_type'];
$progress = $row['progress'];
$billable_amount = $row['billable_amount'];
$BillingStatus = 'Rejected';
$RejectedDate = date('y-m-d');
$Remarks = $row['remarks'];


    if($firstprocess = $ApprovalClass->UpdateBackToEoFirstApprovalRemark($Id, $Remark)){
        if($Secondprocess = $ApprovalClass->InsertToRejectedHistory($Bdate,$capex_number,$contract_amount,$contractor,$billing_type,
            $progress,$billable_amount,$BillingStatus,$RejectedDate,$Remarks, $EO)){
            if($Thirdprocess = $ApprovalClass->DeleteFromMasterlistOfBillings($CapexNumber, $BillingType)){
                if($Fourthprocess = $ApprovalClass->DeleteFromProgressBillings($CapexNumber, $BillingType)){
                    if($Fifthprocess = $ApprovalClass->DeleteFromTrackingOfbilling($CapexNumber, $BillingType)){
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>ok!</strong> Successfully Back To Eo to generate new Billing!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        <?php
                    }
                }
            }
        }
    }
    else{

    }

?>