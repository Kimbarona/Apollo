<?php
require_once("classProject.php");
$ProjectList = new ProjectList();

$BudgetedAmount = $_POST['BudgetedAmount'];
$CapexNumber = $_POST['CapexNumber'];
$ProjectName = $_POST['ProjectName'];
$BusinessUnit = $_POST['BusinessUnit'];
$Reason = $_POST['Reason'];
$BudgetedAmount = $_POST['BudgetedAmount'];
$ContractAmountStatus = $_POST['ContractAmountStatus'];
$project_Description = $_POST['project_Description'];
$Proponent = $_POST['Proponent'];
$ProjectStatus = $_POST['ProjectStatus'];
$Approval_status = "Not Available";
$P_status ="0";

$pname = $ProjectName;
$stmt = $ProjectList->runQuery("SELECT * From apollo_projectlist_name where project_name = '$pname'");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $OrganizationNumber =  $row['org_number'];
    

}



// this is condition
$stmt = $ProjectList->runQuery("SELECT * From apollo_projectlist WHERE capex_number = '$CapexNumber'");
$stmt->execute();
$row = $stmt->fetch();

if ($row ==0) {
    if($ProjectList->AddProjectMasterlist($OrganizationNumber, $CapexNumber, $ProjectName, $BusinessUnit, $Reason, $BudgetedAmount, $ContractAmountStatus, $project_Description, $Proponent, $ProjectStatus, $Approval_status))
    {
        if($ProjectList->UpdateProjectStatus($OrganizationNumber, $P_status)){
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

else{
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>opps!</strong> Duplicate Capex Number is not allowed!.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
    </div>
    <?php
   }
   
