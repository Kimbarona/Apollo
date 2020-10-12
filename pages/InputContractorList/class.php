<?php

require_once('../database/db.php');

class AddNewContractorList
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

    public function InputNewContractorName($ContractorName, $ContactPerson, $ContractorAddress, $ContactNumber){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  apollo_contractor_list (contractor_name, contact_person, contractor_address, contact_number)
            VALUES(:contractor_name, :contact_person, :contractor_address, :contact_number)");
    
                        $stmt->bindparam(":contractor_name",$ContractorName);
                        $stmt->bindparam(":contact_person",$ContactPerson);
                        $stmt->bindparam(":contractor_address",$ContractorAddress);
						$stmt->bindparam(":contact_number",$ContactNumber);
						
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