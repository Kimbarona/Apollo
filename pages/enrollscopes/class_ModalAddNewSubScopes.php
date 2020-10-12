<?php

require_once('../database/db.php');

class ModalSubScope
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	
    public function SubScopes($scopeid, $SubScope){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO apollo_added_subscopes (parent_id, SubScopes)
            VALUES(:scopeID, :subscope)");

                        $stmt->bindparam(":scopeID",$scopeid);
                        $stmt->bindparam(":subscope",$SubScope);
					
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