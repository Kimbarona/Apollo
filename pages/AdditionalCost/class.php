<?php

require_once('../database/db.php');

class AddNewAdditionalCost
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

    public function InsertAdditionalCost($GeneratedDate,$CapexNumber,$ProjectName,$Contractor,$ContractPrice,$Address,$ContactNum,
    $Payee,$StartOfCon,$ProjectCom,$ScopeOfWorks,$BillingSubDate,$DateRecieved,$PaymentNeeded,$BillingType,$Progress,$Billable,$Particulars,$Status, $Engineer){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  apollo_additional_cost (generated_date, capex_number, project_name, contractor, contract_price, c_address, contact_number, payee, start_of_construction, project_completion, scope_of_works, billing_submission, date_recieve, payment_needed_on, billing_type, progress, billable, particulars, approval_status, engineer)
            VALUES(:GeneratedDate, :CapexNumber, :ProjectName, :Contractor, :ContractPrice, :c_Address, :ContactNum, :Payee, :StartOfCon, :ProjectCom, :ScopeOfWorks, :BillingSubDate, :DateRecieved, :PaymentNeeded, :BillingType, :Progress, :Billable, :Particulars, :c_Status, :Engineer)");
    
                        $stmt->bindparam(":GeneratedDate",$GeneratedDate);
						$stmt->bindparam(":CapexNumber",$CapexNumber);
						$stmt->bindparam(":ProjectName",$ProjectName);
						$stmt->bindparam(":Contractor",$Contractor);
                        $stmt->bindparam(":ContractPrice",$ContractPrice);                        
                        $stmt->bindparam(":c_Address",$Address);
						$stmt->bindparam(":ContactNum",$ContactNum);
                        $stmt->bindparam(":Payee",$Payee);
						$stmt->bindparam(":StartOfCon",$StartOfCon);
                        $stmt->bindparam(":ProjectCom",$ProjectCom);
                        $stmt->bindparam(":ScopeOfWorks",$ScopeOfWorks);
                        $stmt->bindparam(":BillingSubDate",$BillingSubDate);
                        $stmt->bindparam(":DateRecieved",$DateRecieved);
						$stmt->bindparam(":PaymentNeeded",$PaymentNeeded);
						$stmt->bindparam(":BillingType",$BillingType);
                        $stmt->bindparam(":Progress",$Progress);
                        $stmt->bindparam(":Billable",$Billable);
						$stmt->bindparam(":Particulars",$Particulars);
						$stmt->bindparam(":c_Status",$Status);
						$stmt->bindparam(":Engineer",$Engineer);
						
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function InsertAdditionalCostToApprover($BillingDate,$CapexNumber,$ContractPrice,$Contractor,$Billing_type,$Progress,$BillableAmount,
	$BillingStatus, $ApprovalDate, $ApproverName, $Remarks){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  apollo_firstapprover (b_date, capex_number, contract_amount, contractor, billing_type, progress, billable_amount, billing_status, approval_date, approver_name, remarks)
            VALUES(:BillingDate, :CapexNumber, :ContractPrice, :Contractor, :Billing_type, :Progress, :BillableAmount, :BillingStatus, :ApprovalDate, :ApproverName, :Remarks)");
    
                        $stmt->bindparam(":BillingDate",$BillingDate);
						$stmt->bindparam(":CapexNumber",$CapexNumber);
						$stmt->bindparam(":ContractPrice",$ContractPrice);
						$stmt->bindparam(":Contractor",$Contractor);
                        $stmt->bindparam(":Billing_type",$Billing_type);                        
                        $stmt->bindparam(":Progress",$Progress);
						$stmt->bindparam(":BillableAmount",$BillableAmount);
                        $stmt->bindparam(":BillingStatus",$BillingStatus);
						$stmt->bindparam(":ApprovalDate",$ApprovalDate);
						$stmt->bindparam(":ApproverName",$ApproverName);
						$stmt->bindparam(":Remarks",$Remarks);
                       
						
            $stmt->execute();
            
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


}


?>