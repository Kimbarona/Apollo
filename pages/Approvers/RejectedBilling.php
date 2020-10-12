<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();
  $CapexNumber = $_POST["Capex"]; 
  $Billing_type =$_POST["B_Type"]; 
  $Remarks =$_POST["Remarks"];
  $Rejected = "Rejected"; 

  if($firstApproverRejected = $ApprovalClass->firstApproverRejected($CapexNumber, $Billing_type, $Remarks, $Rejected)){
    if($SecondApproverRejected = $ApprovalClass->SecondApproverRejected($CapexNumber, $Billing_type, $Remarks)){
      if($ThirdApproverRejected = $ApprovalClass->ThirdApproverRejected($CapexNumber, $Billing_type, $Remarks)){
        if($FourthApprovalRejected = $ApprovalClass->FourthApprovalRejected($CapexNumber, $Billing_type, $Remarks, $Rejected)){
          if($AdditionalCostRejected = $ApprovalClass->AdditionalCostRejected($CapexNumber, $Billing_type, $Rejected)){
            echo 'Succesfully Rejected!!';
          }
        }
      }
    }
}
else{

}

?>