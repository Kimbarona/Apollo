<?php

require_once('../database/db.php');

class EnrollNewProject
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

    public function EnrollNew($ProjectCode, $ProjectName, $CapexNumber, $OrgNumber, $Contractor, $AssignEo, $project_status, $NtpDate, $ContractAmount, $DownPayment, $ProjectRetention, $Proponent, $Payee, $StartDate, $EndDate, $PlannerName){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  apollo_enrolledproject (project_code, project_name, capex_number, org_number, contractor, engineer, project_status, ntp_date, ecost, dpayment, project_retention, proponent, payee, startdate, end_date, planner_name )
            VALUES(:ProjectCode, :ProjectName, :CapexNumber, :OrgNumber, :Contractor, :AssignEo, :project_status, :NtpDate, :ContractAmount, :DownPayment, :ProjectRetention, :Proponent, :Payee, :StartDate, :EndDate, :PlannerName)");
    
                        $stmt->bindparam(":ProjectCode",$ProjectCode);
						$stmt->bindparam(":ProjectName",$ProjectName);
						$stmt->bindparam(":CapexNumber",$CapexNumber);
						$stmt->bindparam(":OrgNumber",$OrgNumber);
                        $stmt->bindparam(":Contractor",$Contractor);                        
                        $stmt->bindparam(":AssignEo",$AssignEo);
						$stmt->bindparam(":project_status",$project_status);
                        $stmt->bindparam(":NtpDate",$NtpDate);
						$stmt->bindparam(":ContractAmount",$ContractAmount);
                        $stmt->bindparam(":DownPayment",$DownPayment);
                        $stmt->bindparam(":ProjectRetention",$ProjectRetention);
                        $stmt->bindparam(":StartDate",$StartDate);
						$stmt->bindparam(":EndDate",$EndDate);
						$stmt->bindparam(":Proponent",$Proponent);
						$stmt->bindparam(":Payee",$Payee);
						$stmt->bindparam(":PlannerName",$PlannerName);
						
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function AddDownPayment($BillingDate, $CapexNumber, $ProjectName, $Contractor, $ContractAmount, $BillingType, $BillingProgress, $Progress_amount, $DownPayment, $billing_status){
		try
		{
            $stmts = $this->conn->prepare("INSERT INTO  apollo_masterlistofbillings (billing_date, capex_number, project_name, contractor, contract_amount, billing_type, progress, progress_amount, billable_amount, billing_status)
            VALUES(:BillingDate, :CapexNumber, :ProjectName, :Contractor, :ContractAmount, :BillingType, :BillingProgress, :Progress_amount, :DownPayment, :billing_status)");
    
                        $stmts->bindparam(":BillingDate",$BillingDate);
						$stmts->bindparam(":CapexNumber",$CapexNumber);
						$stmts->bindparam(":ProjectName",$ProjectName);
						$stmts->bindparam(":Contractor",$Contractor);
                        $stmts->bindparam(":ContractAmount",$ContractAmount);                        
                        $stmts->bindparam(":BillingType",$BillingType);
						$stmts->bindparam(":BillingProgress",$BillingProgress);
						$stmts->bindparam(":Progress_amount",$Progress_amount);
						$stmts->bindparam(":DownPayment",$DownPayment);
						$stmts->bindparam(":billing_status",$billing_status);
	
            $stmts->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function AddRetentionPayment($BillingDate, $CapexNumber, $ProjectName, $Contractor, $ContractAmount, $Retention, $progress, $Progress_amount, $computeRetention, $billing_status){
		try
		{
            $stmts = $this->conn->prepare("INSERT INTO  apollo_masterlistofbillings (billing_date, capex_number, project_name, contractor, contract_amount, billing_type, progress, progress_amount, billable_amount, billing_status)
            VALUES(:BillingDate, :CapexNumber, :ProjectName, :Contractor, :ContractAmount, :BillingType, :BillingProgress, :Progress_amount, :DownPayment, :billing_status)");
    
                        $stmts->bindparam(":BillingDate",$BillingDate);
						$stmts->bindparam(":CapexNumber",$CapexNumber);
						$stmts->bindparam(":ProjectName",$ProjectName);
						$stmts->bindparam(":Contractor",$Contractor);
                        $stmts->bindparam(":ContractAmount",$ContractAmount);                        
                        $stmts->bindparam(":BillingType",$Retention);
						$stmts->bindparam(":BillingProgress",$progress);
						$stmts->bindparam(":Progress_amount",$Progress_amount);
						$stmts->bindparam(":DownPayment",$computeRetention);
						$stmts->bindparam(":billing_status",$billing_status);
	
            $stmts->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}


	public function AddDpToFirstApproverTable($BillingDate, $CapNum, $Ca, $Contractors, $BillingType, $d_Progress, $BillableAmount,$BillingStatus, $ApprovalDate, $ApproverName, $Remarks){
		try
		{
            $AddingDp = $this->conn->prepare("INSERT INTO  apollo_firstapprover (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, billing_status, approval_date, approver_name, remarks)
            VALUES(:BillingDate, :CapNum, :Ca, :Contractors, :BillingType, :d_Progress, :BillableAmount, :BillingStatus, :ApprovalDate, :ApproverName, :Remarks)");
    
                        $AddingDp->bindparam(":BillingDate",$BillingDate);
						$AddingDp->bindparam(":CapNum",$CapNum);
						$AddingDp->bindparam(":Ca",$Ca);
						$AddingDp->bindparam(":Contractors",$Contractors);
                        $AddingDp->bindparam(":BillingType",$BillingType);                        
                        $AddingDp->bindparam(":d_Progress",$d_Progress);
						$AddingDp->bindparam(":BillableAmount",$BillableAmount);
						$AddingDp->bindparam(":BillingStatus",$BillingStatus);
                        $AddingDp->bindparam(":ApprovalDate",$ApprovalDate);
						$AddingDp->bindparam(":ApproverName",$ApproverName);
						$AddingDp->bindparam(":Remarks",$Remarks);
          
            $AddingDp->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function AddRtToFirstApproverTable($BillingDate, $CapNum, $Ca, $Contractors, $B_Type, $R_Progress, $Billable_Amount,$BillingStatus, $ApprovalDate, $ApproverName, $Remarks){
		try
		{
            $AddingRt = $this->conn->prepare("INSERT INTO  apollo_firstapprover (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, billing_status, approval_date, approver_name, remarks)
            VALUES(:BillingDate, :CapNum, :Ca, :Contractors, :B_Type, :R_Progress, :Billable_Amount, :BillingStatus, :ApprovalDate, :ApproverName, :Remarks)");
    
                        $AddingRt->bindparam(":BillingDate",$BillingDate);
						$AddingRt->bindparam(":CapNum",$CapNum);
						$AddingRt->bindparam(":Ca",$Ca);
						$AddingRt->bindparam(":Contractors",$Contractors);
                        $AddingRt->bindparam(":B_Type",$B_Type);                        
                        $AddingRt->bindparam(":R_Progress",$R_Progress);
						$AddingRt->bindparam(":Billable_Amount",$Billable_Amount);
						$AddingRt->bindparam(":BillingStatus",$BillingStatus);
                        $AddingRt->bindparam(":ApprovalDate",$ApprovalDate);
						$AddingRt->bindparam(":ApproverName",$ApproverName);
						$AddingRt->bindparam(":Remarks",$Remarks);

          
            $AddingRt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function UpdateProjectliststatus($CapNum, $ProjectRemarks){
			 
		$UpdateProjectliststatus = $this->conn->prepare("UPDATE apollo_projectlist SET project_status =:ProjectRemarks where capex_number=:CapNum");

				$UpdateProjectliststatus->bindparam(":CapNum",$CapNum);
				$UpdateProjectliststatus->bindparam(":ProjectRemarks",$ProjectRemarks);
								
		$UpdateProjectliststatus->execute();	
		return true;
	
	 }

	public function SendItForApproval($CapexNumber, $ProjectName, $Project_Proponent, $BudgetAmount, $ContractAmt, $Approval_Status){
		try
		{
            $stmts = $this->conn->prepare("INSERT INTO  apollo_contractamount_approval (capex_number, project_name, budgeted_amount, contract_amount, proponent, approval_status)
            VALUES(:CapexNumber, :ProjectName, :BudgetAmount, :ContractAmt, :Project_Proponent, :Approval_Status)");
    
                        $stmts->bindparam(":CapexNumber",$CapexNumber);
						$stmts->bindparam(":ProjectName",$ProjectName);
						$stmts->bindparam(":Project_Proponent",$Project_Proponent);
						$stmts->bindparam(":BudgetAmount",$BudgetAmount);
                        $stmts->bindparam(":ContractAmt",$ContractAmt);                        
                        $stmts->bindparam(":Approval_Status",$Approval_Status);
	
            $stmts->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function UpdateStatusOfApproval($CapexNumber,$Approval_Status){
			 
		$UpdatePApprovalstatus = $this->conn->prepare("UPDATE apollo_projectlist SET approval_status =:Approval_Status where capex_number=:CapexNumber");

				$UpdatePApprovalstatus->bindparam(":CapexNumber",$CapexNumber);
				$UpdatePApprovalstatus->bindparam(":Approval_Status",$Approval_Status);
								
		$UpdatePApprovalstatus->execute();				
		return true;
	
	 }

	 
}


?>