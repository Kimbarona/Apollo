<?php

require_once('database/db.php');

class ListOfWOrks
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

	public function UdateWorksDetails($RowId, $PlannedStart, $PlannedEnd, $ApprovalStatus, $Remarks, $NumDays){		 
 
				 
		$stmts = $this->conn->prepare("UPDATE apollo_project_assigned_scopes SET planned_start = :PlannedStart, planned_end = :PlannedEnd, approval_status = :ApprovalStatus, remarks= :Remarks, numdays = :NumDays WHERE id = :Id");
				
				$stmts->bindparam(":Id",$RowId);
				$stmts->bindparam(":PlannedStart",$PlannedStart);
				$stmts->bindparam(":PlannedEnd",$PlannedEnd);	
				$stmts->bindparam(":ApprovalStatus",$ApprovalStatus);
				$stmts->bindparam(":Remarks",$Remarks);
				$stmts->bindparam(":NumDays",$NumDays);
				$stmts->execute();
				
			
	

		return true;
	}

}
  




?>