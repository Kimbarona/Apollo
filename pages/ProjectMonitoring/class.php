<?php

require_once('database/db.php');

class ProjectMonitoring
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

    public function InputNewEnginneerName($EngineerName, $EngineerPosition){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  apollo_engineer_list (engineer_name, designation)
            VALUES(:EngineerName, :EngineerPosition)");
    
                        $stmt->bindparam(":EngineerName",$EngineerName);
                        $stmt->bindparam(":EngineerPosition",$EngineerPosition);
                       
						
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function ClosingOfWorks($Id, $WorkStatus){
			
		$stmt = $this->conn->prepare("UPDATE apollo_project_assigned_scopes SET work_status = :WorkStatus WHERE id = :Id");							
							
							$stmt->bindparam(":Id",$Id);
							$stmt->bindparam(":WorkStatus",$WorkStatus);
							
								
							$stmt->execute();
							
						
				
			
			return true;
	}

	public function RejectWorksDetails($WorkId, $ApprovalStatus, $Remarks){		 
 	 
		$stmts = $this->conn->prepare("UPDATE apollo_project_assigned_scopes SET approval_status = :ApprovalStatus, remarks = :Remarks WHERE id = :Id");
				
				$stmts->bindparam(":Id",$WorkId);
				$stmts->bindparam(":ApprovalStatus",$ApprovalStatus);
				$stmts->bindparam(":Remarks",$Remarks);	
				$stmts->execute();
				
			
	

		return true;
	}


	public function UpdateBillingStatus($BillingNumber,$BillStat){		 
 	 
		$stmts = $this->conn->prepare("UPDATE  apollo_masterlistofbillings SET billing_status = :BillStat WHERE billingNumber = :BillingNumber");
				
				$stmts->bindparam(":BillingNumber",$BillingNumber);
				$stmts->bindparam(":BillStat",$BillStat);
				$stmts->execute();
				
			
	

		return true;
	}


}


?>