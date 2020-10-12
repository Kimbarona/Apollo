<?php
require_once('database/db.php');
class EnrollScopes
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

    public function NewScopes($genScope){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO apollo_genscopes (GenScopes)
            VALUES(:GenScopes)");
    
                        $stmt->bindparam(":GenScopes",$genScope);
					
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function SubScopes($scopeID, $subscope){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO apollo_added_subscopes (parent_id, SubScopes)
            VALUES(:scopeID, :subscope)");

                        $stmt->bindparam(":scopeID",$scopeID);
                        $stmt->bindparam(":subscope",$subscope);
					
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