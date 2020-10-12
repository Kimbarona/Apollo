<?php

require_once('database/db.php');

class Confirmation
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

	public function ClosingOfWorks($Id, $WorkStatus){
			
		$stmt = $this->conn->prepare("UPDATE apollo_project_assigned_scopes SET work_status = :WorkStatus WHERE id = :Id");							
							
							$stmt->bindparam(":Id",$Id);
							$stmt->bindparam(":WorkStatus",$WorkStatus);
							
								
							$stmt->execute();
							
						
				
			
			return true;
	}


}


?>