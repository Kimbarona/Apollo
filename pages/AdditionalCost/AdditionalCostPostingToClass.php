<?php
require_once("class.php");
$AddNewAdditionalCost = new AddNewAdditionalCost();

$GeneratedDate = $_POST['GeneratedDate'];
$CapexNumber = $_POST['CapexNumber'];
$ProjectName = $_POST['ProjectName'];
$Contractor = $_POST['Contractor'];
$ContractPrice = $_POST['ContractPrice'];
$Address = $_POST['Address'];
$ContactNum = $_POST['ContactNum'];
$Payee = $_POST['Payee'];
$StartOfCon = $_POST['StartOfCon'];
$ProjectCom = $_POST['ProjectCom'];
$ScopeOfWorks = $_POST['ScopeOfWorks'];
$BillingSubDate = $_POST['BillingSubDate'];
$DateRecieved = $_POST['DateRecieved'];
$PaymentNeeded = $_POST['PaymentNeeded'];
$BillingType = $_POST['BillingType'];
$Progress = $_POST['Progress'];
$Billable = $_POST['Billable'];
$Particulars = $_POST['Particulars'];
$Status = 'For Approval';
$Engineer = $_POST['Engineer'];

// this is for the First approver 
$BillingDate = $_POST['GeneratedDate'];
$CapexNumber = $_POST['CapexNumber'];
$ContractPrice = $_POST['ContractPrice'];
$Contractor = $_POST['Contractor'];
$Billing_type = $_POST['BillingType'];
$Progress = $_POST['Progress'];
$BillableAmount = $_POST['Billable'];
$BillingStatus = 'For Approval';
$ApprovalDate = date('y-m-d');
$ApproverName = 'Randy Carillo';
$Remarks = 'Not Available';

// eror trapping dito
$stmts = $AddNewAdditionalCost->runQuery("SELECT * From apollo_additional_cost WHERE capex_number = '$CapexNumber' AND billing_type = '$BillingType'");
$stmts->execute();
$row = $stmts->fetch();

if ($row ==0) {
  if($AddNewAdditionalCost->InsertAdditionalCost($GeneratedDate,$CapexNumber,$ProjectName,$Contractor,$ContractPrice,$Address,$ContactNum,
  $Payee,$StartOfCon,$ProjectCom,$ScopeOfWorks,$BillingSubDate,$DateRecieved,$PaymentNeeded,$BillingType,$Progress,$Billable,$Particulars, $Status, $Engineer)){
    if($AddNewAdditionalCost->InsertAdditionalCostToApprover($BillingDate,$CapexNumber,$ContractPrice,$Contractor,$Billing_type,$Progress,$BillableAmount,
    $BillingStatus, $ApprovalDate, $ApproverName, $Remarks)){
        echo "<script>
                    alert('Successfully saved!');
                    window.location.href='../AdditionalCost.php';
              </script>";
    }       
  }
}
else{
  echo "<script>
          alert('Already Exist, Please Check your billing type!');
          window.location.href='../AdditionalCost.php';
        </script>";
} 
  
?>