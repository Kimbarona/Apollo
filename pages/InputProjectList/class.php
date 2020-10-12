<?php

require_once('../database/db.php');

class AddNewProjectNameList
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

    public function InputNewProjectName($OrganizationNumber,$ProjectName, $p_Status){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  apollo_projectlist_name (org_number, project_name, p_status)
            VALUES(:OrganizationNumber, :ProjectName, :p_Status)");
    
                        $stmt->bindparam(":OrganizationNumber",$OrganizationNumber);
						$stmt->bindparam(":ProjectName",$ProjectName);
						$stmt->bindparam(":p_Status",$p_Status);
						
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