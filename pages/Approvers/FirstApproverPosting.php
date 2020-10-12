<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();

$Id = $_POST['Id'];
$CurrentDate = date('y-m-d');
$B_Status = 'Approved';


$stmts = $ApprovalClass->runQuery("SELECT * From apollo_firstapprover WHERE b_id='$Id'");
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
    $approvedby = 'Randy Carillo';
    $approved_date = $row['approval_date'];
    $billing_status = 'For Approval';
    $second_approval_date = date('y-m-d');
    $Remarks = 'Not Available';

    $FindingProponent = $ApprovalClass->runQuery("SELECT * From apollo_enrolledproject WHERE capex_number='$capex_number'");
    $FindingProponent->execute();
    $rowproponent = $FindingProponent->fetch();
    $Proponent =  $rowproponent['proponent'];

  

    if($firstprocess = $ApprovalClass->UpdateApprovalDate($Id, $CurrentDate, $B_Status, $Remarks)){
        if($secondprocess = $ApprovalClass->InsertDataToSecondApprover($Bdate, $capex_number, $contract_amount, $contractor,$billing_type,$progress,$billable_amount,
        $approvedby,$approved_date,$billing_status,$second_approval_date, $Proponent, $Remarks)){
            if($Thirdprocess = $ApprovalClass->InsertDataTotrackingOfBilling($Bdate, $capex_number, $billing_type, $billable_amount, $approvedby, $approved_date, $Remarks)){
                ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>ok!</strong> Successfully Generated!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                    </div>
                <?php
            }
        }
    }
    else{

    }

?>