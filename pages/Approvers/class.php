<?php

require_once('database/db.php');

class ApprovalClass
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

	public function UpdateApprovalDate($Id, $CurrentDate, $B_Status, $Remarks){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_firstapprover SET approval_date =:CurrentDate, billing_status =:B_Status, remarks = :Remarks where b_id=:Id");
		
				$stmt->bindparam(":Id",$Id);
				$stmt->bindparam(":CurrentDate",$CurrentDate);
				$stmt->bindparam(":B_Status",$B_Status);
				$stmt->bindparam(":Remarks",$Remarks);
				
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function UpdateSecondApprovalDate($Id, $CurrentDate, $B_Status, $Remarks){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_secondapprover SET approval_date =:CurrentDate, billing_status =:B_Status, remarks =:Remarks where b_id=:Id");
		
				$stmt->bindparam(":Id",$Id);
				$stmt->bindparam(":CurrentDate",$CurrentDate);
				$stmt->bindparam(":B_Status",$B_Status);
				$stmt->bindparam(":Remarks",$Remarks);
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function UpdateThirdApprovalDate($Id, $CurrentDate, $B_Status, $Remarks){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_thirdapprover SET approval_date =:CurrentDate, billing_status =:B_Status, remarks =:Remarks where b_id=:Id");
		
				$stmt->bindparam(":Id",$Id);
				$stmt->bindparam(":CurrentDate",$CurrentDate);
				$stmt->bindparam(":B_Status",$B_Status);
				$stmt->bindparam(":Remarks",$Remarks);
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function UpdateFinalApprovalDate($Id, $CurrentDate, $B_Status, $Remarks){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_fourthapprover SET approval_date =:CurrentDate, billing_status =:B_Status, remarks =:Remarks where b_id=:Id");
		
				$stmt->bindparam(":Id",$Id);
				$stmt->bindparam(":CurrentDate",$CurrentDate);
				$stmt->bindparam(":B_Status",$B_Status);
				$stmt->bindparam(":Remarks",$Remarks);
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function UpdateMasterBillings($CapexNumber, $BillingType, $BillingStatus){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_masterlistofbillings SET billing_status =:BillingStatus WHERE capex_number =:CapexNumber AND billing_type =:BillingType");
		
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":BillingType",$BillingType);
				$stmt->bindparam(":BillingStatus",$BillingStatus);
				
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function UpdateBillingOfAddCost($CapexNumber, $BillingType, $B_Status){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_additional_cost SET approval_status =:B_Status WHERE capex_number =:CapexNumber AND billing_type =:BillingType");
		
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":BillingType",$BillingType);
				$stmt->bindparam(":B_Status",$B_Status);
								
				$stmt->execute();
				
				return true;
	
	 }
	
	//  this is for inserting of data for tracking of billings
	public function InsertDataTotrackingOfBilling($Bdate, $capex_number, $billing_type, $billable_amount, $approvedby, $approved_date, $Remarks){
			 
		$TrackingOfBilling = $this->conn->prepare("INSERT INTO apollo_trackingofbilling (billing_date, capex_number, billing_type, billable_amount, first_approver, fdate_approved, billing_status)
		VALUES(:Bdate, :capex_number, :billing_type, :billable_amount, :approvedby, :approved_date, :Remarks)");
		
				$TrackingOfBilling->bindparam(":Bdate",$Bdate);
				$TrackingOfBilling->bindparam(":capex_number",$capex_number);
				$TrackingOfBilling->bindparam(":billing_type",$billing_type);
				$TrackingOfBilling->bindparam(":billable_amount",$billable_amount);
				$TrackingOfBilling->bindparam(":approvedby",$approvedby);
				$TrackingOfBilling->bindparam(":approved_date",$approved_date);	
				$TrackingOfBilling->bindparam(":Remarks",$Remarks);					
				$TrackingOfBilling->execute();
				
				return true;
	
	 }

	public function InsertDataToSecondApprover($Bdate, $capex_number, $contract_amount, $contractor,$billing_type,
	 											$progress,$billable_amount,$approvedby,$approved_date,$billing_status,$second_approval_date, $Proponent,$Remarks){
			 
		$seconapprover = $this->conn->prepare("INSERT INTO apollo_secondapprover (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, approvedby, approved_date, billing_status,approval_date, approver_name, remarks)
		VALUES(:Bdate, :capex_number, :contract_amount, :contractor, :billing_type, :progress, :billable_amount, :approvedby, :approved_date, :billing_status, :second_approval_date, :Proponent, :Remarks)");
		
				$seconapprover->bindparam(":Bdate",$Bdate);
				$seconapprover->bindparam(":capex_number",$capex_number);
				$seconapprover->bindparam(":contract_amount",$contract_amount);
				$seconapprover->bindparam(":contractor",$contractor);
				$seconapprover->bindparam(":billing_type",$billing_type);
				$seconapprover->bindparam(":progress",$progress);
				$seconapprover->bindparam(":billable_amount",$billable_amount);
				$seconapprover->bindparam(":approvedby",$approvedby);
				$seconapprover->bindparam(":approved_date",$approved_date);	
				$seconapprover->bindparam(":billing_status",$billing_status);
				$seconapprover->bindparam(":second_approval_date",$second_approval_date);
				$seconapprover->bindparam(":Proponent",$Proponent);
				$seconapprover->bindparam(":Remarks",$Remarks);					
				$seconapprover->execute();
				
				return true;
	
	 }

	 public function InsertDataToThirdApprover($Bdate, $capex_number, $contract_amount, $contractor,$billing_type,
	 											$progress,$billable_amount,$approvedby,$approved_date,$billing_status,$second_approval_date, $approver_name, $Remarks){
			 
		$seconapprover = $this->conn->prepare("INSERT INTO apollo_thirdapprover (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, approvedby, approved_date, billing_status,approval_date, approver_name, remarks)
		VALUES(:Bdate, :capex_number, :contract_amount, :contractor, :billing_type, :progress, :billable_amount, :approvedby, :approved_date, :billing_status, :second_approval_date, :approver_name, :Remarks)");
		
				$seconapprover->bindparam(":Bdate",$Bdate);
				$seconapprover->bindparam(":capex_number",$capex_number);
				$seconapprover->bindparam(":contract_amount",$contract_amount);
				$seconapprover->bindparam(":contractor",$contractor);
				$seconapprover->bindparam(":billing_type",$billing_type);
				$seconapprover->bindparam(":progress",$progress);
				$seconapprover->bindparam(":billable_amount",$billable_amount);
				$seconapprover->bindparam(":approvedby",$approvedby);
				$seconapprover->bindparam(":approved_date",$approved_date);	
				$seconapprover->bindparam(":billing_status",$billing_status);
				$seconapprover->bindparam(":second_approval_date",$second_approval_date);
				$seconapprover->bindparam(":approver_name",$approver_name);
				$seconapprover->bindparam(":Remarks",$Remarks);						
				$seconapprover->execute();
				
				return true;
	
	 }

		public function InsertDataToFourthApprover($Bdate, $capex_number, $contract_amount, $contractor,$billing_type,
		$progress,$billable_amount,$approvedby,$approved_date,$billing_status,$second_approval_date, $approver_name, $Remarks){

				$seconapprover = $this->conn->prepare("INSERT INTO apollo_fourthapprover (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, approvedby, approved_date, billing_status,approval_date, approver_name, remarks)
				VALUES(:Bdate, :capex_number, :contract_amount, :contractor, :billing_type, :progress, :billable_amount, :approvedby, :approved_date, :billing_status, :second_approval_date, :approver_name, :Remarks)");

				$seconapprover->bindparam(":Bdate",$Bdate);
				$seconapprover->bindparam(":capex_number",$capex_number);
				$seconapprover->bindparam(":contract_amount",$contract_amount);
				$seconapprover->bindparam(":contractor",$contractor);
				$seconapprover->bindparam(":billing_type",$billing_type);
				$seconapprover->bindparam(":progress",$progress);
				$seconapprover->bindparam(":billable_amount",$billable_amount);
				$seconapprover->bindparam(":approvedby",$approvedby);
				$seconapprover->bindparam(":approved_date",$approved_date);	
				$seconapprover->bindparam(":billing_status",$billing_status);
				$seconapprover->bindparam(":second_approval_date",$second_approval_date);
				$seconapprover->bindparam(":approver_name",$approver_name);
				$seconapprover->bindparam(":Remarks",$Remarks);	
				$seconapprover->execute();

				return true;

}

// For rejected billings

public function firstApproverRejected($CapexNumber, $Billing_type, $Remarks, $Rejected){
	$RejectedFirstApprover = $this->conn->prepare("UPDATE apollo_firstapprover SET remarks =:Remarks, billing_status= :Rejected WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$RejectedFirstApprover->bindparam(":CapexNumber",$CapexNumber);
			$RejectedFirstApprover->bindparam(":Billing_type",$Billing_type);
			$RejectedFirstApprover->bindparam(":Remarks",$Remarks);	
			$RejectedFirstApprover->bindparam(":Rejected",$Rejected);							
			$RejectedFirstApprover->execute();
			
			return true;

 }

 
public function SecondApproverRejected($CapexNumber, $Billing_type, $Remarks){
	$SecondApproverRejected = $this->conn->prepare("UPDATE apollo_secondapprover SET remarks =:Remarks WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$SecondApproverRejected->bindparam(":CapexNumber",$CapexNumber);
			$SecondApproverRejected->bindparam(":Billing_type",$Billing_type);
			$SecondApproverRejected->bindparam(":Remarks",$Remarks);							
			$SecondApproverRejected->execute();
			
			return true;

 }

 public function ThirdApproverRejected($CapexNumber, $Billing_type, $Remarks){
	$ThirdApproverRejected = $this->conn->prepare("UPDATE apollo_thirdapprover SET remarks =:Remarks WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$ThirdApproverRejected->bindparam(":CapexNumber",$CapexNumber);
			$ThirdApproverRejected->bindparam(":Billing_type",$Billing_type);
			$ThirdApproverRejected->bindparam(":Remarks",$Remarks);							
			$ThirdApproverRejected->execute();
			
			return true;

 }

 public function FourthApprovalRejected($CapexNumber, $Billing_type, $Remarks, $Rejected){
	$FourthApprovalRejected = $this->conn->prepare("UPDATE apollo_fourthapprover SET remarks =:Remarks, billing_status= :Rejected WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$FourthApprovalRejected->bindparam(":CapexNumber",$CapexNumber);
			$FourthApprovalRejected->bindparam(":Billing_type",$Billing_type);
			$FourthApprovalRejected->bindparam(":Remarks",$Remarks);	
			$FourthApprovalRejected->bindparam(":Rejected",$Rejected);							
			$FourthApprovalRejected->execute();
			
			return true;

 }

 public function AdditionalCostRejected($CapexNumber, $Billing_type, $Rejected){
	$AdditionalCostRejected = $this->conn->prepare("UPDATE apollo_additional_cost SET approval_status =:Rejected WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$AdditionalCostRejected->bindparam(":CapexNumber",$CapexNumber);
			$AdditionalCostRejected->bindparam(":Billing_type",$Billing_type);
			$AdditionalCostRejected->bindparam(":Rejected",$Rejected);							
			$AdditionalCostRejected->execute();
			
			return true;

 }

 //  for reapproval

 // For rejected billings

public function firstApproverReapprove($CapexNumber, $Billing_type, $Remarks, $Approved){
	$firstApproverReapprove = $this->conn->prepare("UPDATE apollo_firstapprover SET remarks =:Remarks, billing_status= :Approved WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$firstApproverReapprove->bindparam(":CapexNumber",$CapexNumber);
			$firstApproverReapprove->bindparam(":Billing_type",$Billing_type);
			$firstApproverReapprove->bindparam(":Remarks",$Remarks);	
			$firstApproverReapprove->bindparam(":Approved",$Approved);							
			$firstApproverReapprove->execute();
			
			return true;

 }

 
public function SecondApproverReapprove($CapexNumber, $Billing_type, $Remarks, $Rejected){
	$SecondApproverReapprove = $this->conn->prepare("UPDATE apollo_secondapprover SET remarks =:Remarks, billing_status=:Rejected WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$SecondApproverReapprove->bindparam(":CapexNumber",$CapexNumber);
			$SecondApproverReapprove->bindparam(":Billing_type",$Billing_type);
			$SecondApproverReapprove->bindparam(":Remarks",$Remarks);	
			$SecondApproverReapprove->bindparam(":Rejected",$Rejected);							
			$SecondApproverReapprove->execute();
			
			return true;

 }

 public function ThirdApproverReapprove($CapexNumber, $Billing_type, $Remarks){
	$ThirdApproverReapprove = $this->conn->prepare("UPDATE apollo_thirdapprover SET remarks =:Remarks WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$ThirdApproverReapprove->bindparam(":CapexNumber",$CapexNumber);
			$ThirdApproverReapprove->bindparam(":Billing_type",$Billing_type);
			$ThirdApproverReapprove->bindparam(":Remarks",$Remarks);							
			$ThirdApproverReapprove->execute();
			
			return true;

 }

 public function FourthApprovalReapprove($CapexNumber, $Billing_type, $Remarks, $Rejected){
	$FourthApprovalReapprove = $this->conn->prepare("UPDATE apollo_fourthapprover SET remarks =:Remarks, billing_status= :Rejected WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$FourthApprovalReapprove->bindparam(":CapexNumber",$CapexNumber);
			$FourthApprovalReapprove->bindparam(":Billing_type",$Billing_type);
			$FourthApprovalReapprove->bindparam(":Remarks",$Remarks);	
			$FourthApprovalReapprove->bindparam(":Rejected",$Rejected);							
			$FourthApprovalReapprove->execute();
			
			return true;

 }

 // this is the process for the rejected billings
 public function UpdateBackToEoFirstApprovalRemark($Id, $Remark){
			 
	$stmt = $this->conn->prepare("UPDATE apollo_firstapprover SET billing_status =:Remark where b_id=:Id");
	
			$stmt->bindparam(":Id",$Id);
			$stmt->bindparam(":Remark",$Remark);
							
			$stmt->execute();
			
			return true;

 }

 public function InsertToRejectedHistory($Bdate,$capex_number,$contract_amount,$contractor,$billing_type,
 $progress,$billable_amount,$BillingStatus,$RejectedDate,$Remarks, $EO){
			 
		$secondprocess = $this->conn->prepare("INSERT INTO apollo_rejectedapproval_history (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, billing_status, rejected_date, remarks, engineer)
		VALUES(:Bdate, :capex_number, :contract_amount, :contractor, :billing_type, :progress, :billable_amount, :BillingStatus, :RejectedDate, :Remarks, :EO)");
		
				$secondprocess->bindparam(":Bdate",$Bdate);
				$secondprocess->bindparam(":capex_number",$capex_number);
				$secondprocess->bindparam(":contract_amount",$contract_amount);
				$secondprocess->bindparam(":contractor",$contractor);
				$secondprocess->bindparam(":billing_type",$billing_type);
				$secondprocess->bindparam(":progress",$progress);
				$secondprocess->bindparam(":billable_amount",$billable_amount);
				$secondprocess->bindparam(":BillingStatus",$BillingStatus);
				$secondprocess->bindparam(":RejectedDate",$RejectedDate);	
				$secondprocess->bindparam(":Remarks",$Remarks);	
				$secondprocess->bindparam(":EO",$EO);					
				$secondprocess->execute();
				
				return true;
	
	 }

	 public function DeleteFromMasterlistOfBillings($CapexNumber, $BillingType){
			 
		$stmt = $this->conn->prepare("DELETE FROM apollo_masterlistofbillings WHERE capex_number=:CapexNumber AND billing_type=:BillingType");
		
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":BillingType",$BillingType);
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function DeleteFromProgressBillings($CapexNumber, $BillingType){
			 
		$stmt = $this->conn->prepare("DELETE FROM apollo_progressbillinglist WHERE capex_number=:CapexNumber AND billing_type=:BillingType");
		
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":BillingType",$BillingType);
								
				$stmt->execute();
				
				return true;
	
	 }

	//  this is for the reject process of proponent
	 
public function RejectedByProponent($CapexNumber, $Billing_type, $Remarks, $Rejected){
$FirsProcess = $this->conn->prepare("UPDATE apollo_secondapprover SET remarks =:Remarks, billing_status= :Rejected WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
	
			$FirsProcess->bindparam(":CapexNumber",$CapexNumber);
			$FirsProcess->bindparam(":Billing_type",$Billing_type);
			$FirsProcess->bindparam(":Remarks",$Remarks);	
			$FirsProcess->bindparam(":Rejected",$Rejected);							
			$FirsProcess->execute();
			
			return true;

 }

 public function SetFirstApproverBillRejected($CapexNumber, $Billing_type,$Rejected, $Remarks){
			 
	$stmt = $this->conn->prepare("UPDATE apollo_firstapprover SET billing_status =:Rejected, remarks = :Remarks WHERE capex_number=:CapexNumber AND billing_type=:Billing_type");
	
			$stmt->bindparam(":CapexNumber",$CapexNumber);
			$stmt->bindparam(":Billing_type",$Billing_type);
			$stmt->bindparam(":Rejected",$Rejected);
			$stmt->bindparam(":Remarks",$Remarks);
			
							
			$stmt->execute();
			
			return true;

 }

//  this is the reject process of Approver
public function RejectedByApprover($CapexNumber, $Billing_type, $Remarks, $Rejected){
	$FirsProcess = $this->conn->prepare("UPDATE apollo_secondapprover SET remarks =:Remarks, billing_status= :Rejected WHERE capex_number =:CapexNumber AND billing_type =:Billing_type");
		
				$FirsProcess->bindparam(":CapexNumber",$CapexNumber);
				$FirsProcess->bindparam(":Billing_type",$Billing_type);
				$FirsProcess->bindparam(":Remarks",$Remarks);	
				$FirsProcess->bindparam(":Rejected",$Rejected);							
				$FirsProcess->execute();
				
				return true;
	
	 }
	
	 public function SetsecondApproverBillRejected($CapexNumber, $Billing_type,$Rejected, $Remarks){
				 
		$stmt = $this->conn->prepare("UPDATE apollo_thirdapprover SET billing_status =:Rejected, remarks = :Remarks WHERE capex_number=:CapexNumber AND billing_type=:Billing_type");
		
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":Billing_type",$Billing_type);
				$stmt->bindparam(":Rejected",$Rejected);
				$stmt->bindparam(":Remarks",$Remarks);
				
								
				$stmt->execute();
				
				return true;
	
	 }
	//  this is for the approval update of trackingbilling

	public function UpdateSecondTrackingOfBilling($approvedby, $CurrentDate, $billing_type, $capex_number){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_trackingofbilling SET second_approver =:approvedby, sdate_approved =:CurrentDate
		WHERE capex_number=:capex_number AND billing_type =:billing_type");
		
				$stmt->bindparam(":approvedby",$approvedby);
				$stmt->bindparam(":CurrentDate",$CurrentDate);
				$stmt->bindparam(":billing_type",$billing_type);
				$stmt->bindparam(":capex_number",$capex_number);
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function UpdateThirdTrackingOfBilling($approvedby, $CurrentDate, $billing_type, $capex_number){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_trackingofbilling SET third_approver =:approvedby, tdate_approved =:CurrentDate
		WHERE capex_number=:capex_number AND billing_type =:billing_type");
		
				$stmt->bindparam(":approvedby",$approvedby);
				$stmt->bindparam(":CurrentDate",$CurrentDate);
				$stmt->bindparam(":billing_type",$billing_type);
				$stmt->bindparam(":capex_number",$capex_number);
								
				$stmt->execute();
				
				return true;
	
	 }
	
	 public function UpdateFourthTrackingOfBilling($approvedby, $CurrentDate, $BillingType, $CapexNumber){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_trackingofbilling SET fourth_approver =:approvedby, frdate_approved =:CurrentDate
		WHERE capex_number=:capex_number AND billing_type =:BillingType");
		
				$stmt->bindparam(":approvedby",$approvedby);
				$stmt->bindparam(":CurrentDate",$CurrentDate);
				$stmt->bindparam(":BillingType",$BillingType);
				$stmt->bindparam(":capex_number",$CapexNumber);
								
				$stmt->execute();
				
				return true;
	
	 }

	//  this is for deleting of tracking data

	public function DeleteFromTrackingOfbilling($CapexNumber, $BillingType){
			 
		$stmt = $this->conn->prepare("DELETE FROM apollo_trackingofbilling WHERE capex_number=:CapexNumber AND billing_type=:BillingType");
		
				$stmt->bindparam(":CapexNumber",$CapexNumber);
				$stmt->bindparam(":BillingType",$BillingType);
								
				$stmt->execute();
				
				return true;
	
	 }


}




?>