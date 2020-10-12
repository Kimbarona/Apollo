<?php

require_once('database/db.php');

class Computations
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	 public function InsertDataFromBillingForm($PreparedDate, $CapexNumber,  $ProjectName, $ContractorName, $ContractAmt, $BillingType, $ProjectProgress, $Amount, $BillableAmount, $billing_status){
			 
		$stmt = $this->conn->prepare("INSERT INTO  apollo_masterlistofbillings (billing_date, capex_number, project_name, contractor, contract_amount, billing_type, progress, progress_amount, billable_amount, billing_status)
		VALUES(:PreparedDate, :CapexNumber, :ProjectName, :ContractorName, :ContractAmt, :BillingType, :ProjectProgress, :Amount, :BillableAmount, :billing_status)");
		
				$stmt->bindparam(":PreparedDate",$PreparedDate);
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":ProjectName",$ProjectName);
				$stmt->bindparam(":ContractorName",$ContractorName);
				$stmt->bindparam(":ContractAmt",$ContractAmt);
				$stmt->bindparam(":BillingType",$BillingType);
				$stmt->bindparam(":ProjectProgress",$ProjectProgress);
				$stmt->bindparam(":Amount",$Amount);
				$stmt->bindparam(":BillableAmount",$BillableAmount);
				$stmt->bindparam(":billing_status",$billing_status);					
				$stmt->execute();
				
				return true;
	
	 }


	 public function InsertDataFromBillingFormSecond($PreparedDate, $CapexNumber,  $ProjectName, $ContractorName, $ContractAmt, $BillingType, $ProjectProgress, $Amount, $BillableAmount, $billing_status){
			 
		$stmt = $this->conn->prepare("INSERT INTO  apollo_progressbillinglist (billing_date, capex_number, project_name, contractor, contract_amount, billing_type, progress, progress_amount, billable_amount, billing_status)
		VALUES(:PreparedDate, :CapexNumber, :ProjectName, :ContractorName, :ContractAmt, :BillingType, :ProjectProgress, :Amount, :BillableAmount, :billing_status)");
		
				$stmt->bindparam(":PreparedDate",$PreparedDate);
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":ProjectName",$ProjectName);
				$stmt->bindparam(":ContractorName",$ContractorName);
				$stmt->bindparam(":ContractAmt",$ContractAmt);
				$stmt->bindparam(":BillingType",$BillingType);
				$stmt->bindparam(":ProjectProgress",$ProjectProgress);
				$stmt->bindparam(":Amount",$Amount);
				$stmt->bindparam(":BillableAmount",$BillableAmount);
				$stmt->bindparam(":billing_status",	$billing_status);			
				$stmt->execute();
				
				return true;

}

     public function FirstApprover($Billing_date, $Capex_num, $CAmount, $ConTractor, $BType, $BillingProgress, $BillablAmt, $BillingStatus, $ApprovalDate, $approver_name, $Remarks){
		 
		$Approval = $this->conn->prepare("INSERT INTO  apollo_firstapprover (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, billing_status, approval_date, approver_name, remarks)
		VALUES(:Billing_date, :Capex_num, :CAmount, :ConTractor, :BType, :BillingProgress, :BillablAmt, :BillingStatus, :ApprovalDate, :approver_name, :Remarks)");
		
			$Approval->bindparam(":Billing_date",$Billing_date);
			$Approval->bindparam(":Capex_num",$Capex_num);
			$Approval->bindparam(":CAmount",$CAmount);
			$Approval->bindparam(":ConTractor",$ConTractor);
			$Approval->bindparam(":BType",$BType);
			$Approval->bindparam(":BillingProgress",$BillingProgress);
			$Approval->bindparam(":BillablAmt",$BillablAmt);
			$Approval->bindparam(":BillingStatus",$BillingStatus);
			$Approval->bindparam(":ApprovalDate",$ApprovalDate);
			$Approval->bindparam(":approver_name",$approver_name);
			$Approval->bindparam(":Remarks",$Remarks);	
			$Approval->execute();
			
			return true;

}

public function BillingHistory($Capex_num, $Scopes, $BType, $ScopesAmount, $ScopesWeight, $ScopesProgress, $ScopesEquivWeight, $ScopesTotalAmount){

   $count = sizeof($Scopes);
   for($i=0;$i<$count;$i++){
		   $in_Scopes = $Scopes[$i];
		   $in_ScopesAmount = $ScopesAmount[$i];
		   $in_ScopesWeight = $ScopesWeight[$i];
		   $in_ScopesProgress = $ScopesProgress[$i];
		   $in_ScopesEquivWeight = $ScopesEquivWeight[$i];
		   $in_ScopesTotalAmount = $ScopesTotalAmount[$i];
		   
		   
		   $billhistory = $this->conn->prepare("INSERT INTO  apollo_billing_history (capex_number, scopes, scopes_amount, billing_type, scopes_weight, scopes_progress, equivalent_weight, total_amount)
		   VALUES(:in_capex, :in_Scopes, :in_ScopesAmount, :in_BType, :in_ScopesWeight, :in_ScopesProgress, :in_ScopesEquivWeight, :in_ScopesTotalAmount)");
		   
				   $billhistory->bindparam(":in_capex",$Capex_num);
				   $billhistory->bindparam(":in_Scopes",$in_Scopes);
				   $billhistory->bindparam(":in_BType",$BType);
				   $billhistory->bindparam(":in_ScopesAmount",$in_ScopesAmount);
				   $billhistory->bindparam(":in_ScopesWeight",$in_ScopesWeight);
				   $billhistory->bindparam(":in_ScopesProgress",$in_ScopesProgress);
				   $billhistory->bindparam(":in_ScopesEquivWeight",$in_ScopesEquivWeight);
				   $billhistory->bindparam(":in_ScopesTotalAmount",$in_ScopesTotalAmount);
		
	   $billhistory->execute();
				   
			   
	   }
   
   return true;

}
	

}




?>