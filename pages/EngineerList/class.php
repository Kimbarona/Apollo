<?php

require_once('../database/db.php');

class AddNewEngineerList
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


}


?>