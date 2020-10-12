<?php
require_once("class.php");
$ApprovalClass = new ApprovalClass();
  $CapexNumber = $_POST["Capex"]; 
  $Billing_type =$_POST["B_Type"]; 
  $Remarks =$_POST["Remarks"];
  $Rejected = "For Approval"; 
  $Approved = 'Approved';

if($firstApproverReapprove = $ApprovalClass->firstApproverReapprove($CapexNumber, $Billing_type, $Remarks, $Approved)){
    if($SecondApproverReapprove = $ApprovalClass->SecondApproverReapprove($CapexNumber, $Billing_type, $Remarks, $Rejected)){
      if($ThirdApproverReapprove = $ApprovalClass->ThirdApproverReapprove($CapexNumber, $Billing_type, $Remarks)){
        if($FourthApprovalReapprove = $ApprovalClass->FourthApprovalReapprove($CapexNumber, $Billing_type, $Remarks, $Rejected)){
          echo 'Succesfully Reapprove!!';
        }
      }
    }
}
else{

}

?>