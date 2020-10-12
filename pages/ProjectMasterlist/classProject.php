<?php

require_once('../database/db.php');

class ProjectList
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


		public function AddProjectMasterlist($OrganizationNumber, $CapexNumber, $ProjectName, $BusinessUnit,	$Reason, $BudgetedAmount, $ContractAmountStatus, $project_Description, $Proponent, $ProjectStatus, $Approval_status){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO apollo_projectlist(org_number, capex_number, project_name, business_unit, reason, budgeted_amount, contract_amount_status, project_description, proponent, project_status, approval_status)
            VALUES(:OrganizationNumber, :CapexNumber, :ProjectName, :BusinessUnit, :Reason, :budgeted_amount, :Contract_amount_status, :project_Description, :Proponent, :ProjectStatus, :Approval_status)");
    
            $stmt->bindparam(":OrganizationNumber",$OrganizationNumber);
						$stmt->bindparam(":CapexNumber",$CapexNumber);
						$stmt->bindparam(":ProjectName",$ProjectName);
						$stmt->bindparam(":BusinessUnit",$BusinessUnit);
						$stmt->bindparam(":Reason",$Reason);
						$stmt->bindparam(":Contract_amount_status",$ContractAmountStatus);
						$stmt->bindparam(":project_Description",$project_Description);
						$stmt->bindparam(":budgeted_amount",$BudgetedAmount);
						$stmt->bindparam(":Proponent",$Proponent);
						$stmt->bindparam(":ProjectStatus",$ProjectStatus);
						$stmt->bindparam(":Approval_status",$Approval_status);
					
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function UpdateProjectStatus($OrganizationNumber, $P_status){
			 
		$stmt = $this->conn->prepare("UPDATE apollo_projectlist_name SET p_status =:P_status where org_number=:OrganizationNumber");
		
				$stmt->bindparam(":OrganizationNumber",$OrganizationNumber);
				$stmt->bindparam(":P_status",$P_status);
								
				$stmt->execute();
				
				return true;
	
	 }

	 public function UpdateProjectAmount($OrgNum, $BudgetedAmt){
			 
		$stmts = $this->conn->prepare("UPDATE apollo_projectlist SET budgeted_amount =:Budgeted_Amt WHERE org_number=:Org_num");
		
				$stmts->bindparam(":Org_num",$OrgNum);
				$stmts->bindparam(":Budgeted_Amt",$BudgetedAmt);
								
				$stmts->execute();
				return true;
	
	 }

	 public function insertToHistoryLogs($capex, $project, $OrigAmount, $BudgetedAmt){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO apollo_projectlist_logs(capex_number, project_name, amount_from, amount_to)
            VALUES(:capex, :project, :OrigAmount, :BudgetedAmt)");
    
            			$stmt->bindparam(":capex",$capex);
						$stmt->bindparam(":project",$project);
						$stmt->bindparam(":OrigAmount",$OrigAmount);
						$stmt->bindparam(":BudgetedAmt",$BudgetedAmt);
						
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	 
}


?>
