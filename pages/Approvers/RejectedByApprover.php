<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();
  $CapexNumber = $_POST["Capex"]; 
  $Billing_type =$_POST["B_Type"]; 
  $Remarks =$_POST["Remarks"];
  $Rejected = "Rejected"; 


  if($firstProcess = $ApprovalClass->RejectedByApprover($CapexNumber, $Billing_type, $Remarks, $Rejected)){
    if($SecondProcess = $ApprovalClass->SetFirstApproverBillRejected($CapexNumber, $Billing_type,$Rejected, $Remarks)){
      if($ThirdProcess = $ApprovalClass->SetsecondApproverBillRejected($CapexNumber, $Billing_type,$Rejected, $Remarks)){
//         if($FourthApprovalRejected = $ApprovalClass->FourthApprovalRejected($CapexNumber, $Billing_type, $Remarks, $Rejected)){
//           if($AdditionalCostRejected = $ApprovalClass->AdditionalCostRejected($CapexNumber, $Billing_type, $Rejected)){
            echo 'Succesfully Rejected!!';
//           }
//         }
      }
    }
}
else{

}

?>