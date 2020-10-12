<?php

require_once('database/db.php');

class UserLogin
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


	public function UpdateActualStartDate($today){		 
 
				 
		$stmt = $this->conn->prepare("UPDATE apollo_project_assigned_scopes SET actual_end = :today WHERE work_status ='Open'");
				
				$stmt->bindparam(":today",$today);
			
				
					
				$stmt->execute();
				
			
	

return true;
}


}


?>