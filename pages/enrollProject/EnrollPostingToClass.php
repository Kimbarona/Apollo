<?php
session_start();
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();
    $CapexNumber = $_POST['CapexNumber'];
    $Contractor = $_POST['Contractor'];
    $AssignEo = $_POST['AssignEo'];
    $NtpDate = $_POST['NtpDate'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $ContractAmount = $_POST['ContractAmount'];
    $Down = $_POST['DownPayment'];
    $covertedCa =str_replace(',', '', $ContractAmount);
    $computeRetention = $covertedCa * 10 / 100;
    $ProjectRetention = number_format($computeRetention); 
    $project_status = "Closed";
    $Proponent =$_POST['Proponent'];
    $Payee =$_POST['Payee'];

    // For downpayment here
    $coverteddp =str_replace(',', '', $Down);
    $BillingDate = date('Y-m-d');
    $BillingType = 'Initial Payment';
    $BillingPro = $coverteddp / $covertedCa * 100;
    $Progress_amount = '0';
    // $BillingProgress = (float) $BillingPro;
    $BillingProgress = number_format(($BillingPro),2);

    // this is conversion of dp
    $DownPayment = (float)$coverteddp;

   

    $pname = $CapexNumber;
    $stmt = $EnrollNewProject->runQuery("SELECT * From apollo_projectlist where capex_number = '$pname'");
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $ProjectName =  $row['project_name'];
        $ProjectCode =  $row['project_code'];
        // $CapexNumber =  $row['capex_number'];
        $OrgNumber =  $row['org_number'];    
    }

     // This Part is For Retention Payment
     $BillingDate = date('Y-m-d');
     $pname = $CapexNumber;
     $Retention = 'Retention Payment';
     $progress = '10';
     $Progress_amount = '0';
     $computeRetention = $covertedCa * 10 / 100;
     $billing_status = '0';
     
    //  This Part is for the firstapprover table (dp)
    $BillingDate = date('Y-m-d');
    $CapNum = $CapexNumber;
    $Ca = $ContractAmount;
    $Contractors = $Contractor;
    $BillingType ='Initial Payment';
    $d_Progress = $BillingPro;
    $BillableAmount = $DownPayment;
    $BillingStatus = 'For Approval';
    $ApprovalDate = date('Y-m-d');
    $ApproverName = 'Randy Carillo';
    $Remarks = 'Not Available';

    // This is for the firstapprover table (rt)
    $BillingDate = date('Y-m-d');
    $CapNum = $CapexNumber;
    $Ca = $ContractAmount;
    $Contractors = $Contractor;
    $B_Type = 'Retention Payment';
    $R_Progress = '10';
    $Billable_Amount = $computeRetention;
    $BillingStatus = 'For Approval';
    $ApprovalDate = date('Y-m-d');
    $ApproverName = 'Randy Carillo';
    $Remarks = 'Not Available';

    //this is for the update of enrolled project
    $Estatus = 'Open';
    // this is for the update of projectlist
    $ProjectRemarks ="Closed";

    // planner name
    $PlannerName = $_SESSION['fullname'];

// eror trapping dito
$stmts = $EnrollNewProject->runQuery("SELECT * From apollo_enrolledproject WHERE capex_number = '$CapexNumber'");
$stmts->execute();
$row = $stmts->fetch();

if ($row ==0) {
    if($EnrollNewProject->EnrollNew($ProjectCode, $ProjectName, $CapexNumber, $OrgNumber, $Contractor, $AssignEo, $project_status, $NtpDate, $ContractAmount, $DownPayment, $ProjectRetention,$Proponent, $Payee, $StartDate, $EndDate, $PlannerName)){
        if($EnrollNewProject->AddDownPayment($BillingDate, $CapexNumber, $ProjectName, $Contractor, $ContractAmount, $BillingType, $BillingProgress, $Progress_amount, $DownPayment, $billing_status)){
            if($EnrollNewProject->AddRetentionPayment($BillingDate, $CapexNumber, $ProjectName, $Contractor, $ContractAmount, $Retention, $progress, $Progress_amount, $computeRetention, $billing_status)){
                if($EnrollNewProject->AddDpToFirstApproverTable($BillingDate, $CapNum, $Ca, $Contractors, $BillingType, $d_Progress, $BillableAmount,$BillingStatus, $ApprovalDate, $ApproverName, $Remarks)){
                    if($EnrollNewProject->AddRtToFirstApproverTable($BillingDate, $CapNum, $Ca, $Contractors, $B_Type, $R_Progress, $Billable_Amount,$BillingStatus, $ApprovalDate, $ApproverName, $Remarks)){
                        if($EnrollNewProject->UpdateProjectliststatus($CapNum, $ProjectRemarks)){
                            
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>ok!</strong> Successfully saved!
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
    }
}

else{
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>opps!</strong> This Record is Already Exist.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span class="fa fa-times"></span>
</button>
</div>
<?php
}
   
