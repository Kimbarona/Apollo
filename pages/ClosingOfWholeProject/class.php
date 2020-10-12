<?php

require_once('database/db.php');

class ClosingOfWholeProject
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

	public function ClosingOfProject($Id, $ProjectStatus){
			
		$stmt = $this->conn->prepare("UPDATE apollo_enrolledproject SET project_status = :ProjectStatus WHERE project_num = :Id");							
							
							$stmt->bindparam(":Id",$Id);
							$stmt->bindparam(":ProjectStatus",$ProjectStatus);
							
								
							$stmt->execute();
							
						
				
			
			return true;
	}


}


?>