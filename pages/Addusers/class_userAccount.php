<?php

require_once('database/db.php');

class user
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

	
    public function UserRegistration($FullName, $UserName, $Pass, $Position){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO apollo_useraccounts (fullname, username, user_password, position)
            VALUES(:fullname, :usernam, :user_password, :position)");
    
            $stmt->bindparam(":fullname",$FullName);
						$stmt->bindparam(":usernam",$UserName);
						$stmt->bindparam(":user_password",$Pass);	
            $stmt->bindparam(":position",$Position);
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function UserUpdate($Pass, $oldusername){
		try
		{
            $stmts = $this->conn->prepare("UPDATE apollo_useraccounts SET user_password =:newpass WHERE username=:oldusername");    
						$stmts->bindparam(":newpass",$Pass);
						$stmts->bindparam(":oldusername",$oldusername);
            $stmts->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}


}


?>