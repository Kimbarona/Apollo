<?php
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();

    $CapexNumber = $_POST['CapexNumber'];
    $ValidateApproval = $EnrollNewProject->runQuery("SELECT * From apollo_contractamount_approval where capex_number = '$CapexNumber' AND approval_status ='Approved'");
    $ValidateApproval->execute();
    $Validation = $ValidateApproval->fetch(PDO::FETCH_ASSOC);
    $Result = $Validation['contract_amount'];
    if($Result != ''){
        echo $Result;
    }
    else{
       
    }
    // echo $Result;
?>