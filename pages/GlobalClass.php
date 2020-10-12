<?php

require_once('./database/db.php');

class GlobalConnection
{

	private $conn;

		
	function getDate(){
		$tz_oject = new DateTimeZone('Asia/manila');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_oject);
		return $datetime->format('Y-m-d');
	}


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

    public function EnrollNew($ProjectCode, $ProjectName, $CapexNumber, $OrgNumber, $Contractor, $AssignEo, $project_status, $NtpDate, $ContractAmount, $DownPayment, $ProjectRetention, $StartDate, $EndDate){
		try
		{
            $stmt = $this->conn->prepare("INSERT INTO  apollo_enrolledproject (project_code, project_name, capex_number, org_number, contractor, engineer, project_status, ntp_date, ecost, dpayment, project_retention, startdate, end_date )
            VALUES(:ProjectCode, :ProjectName, :CapexNumber, :OrgNumber, :Contractor, :AssignEo, :project_status, :NtpDate, :ContractAmount, :DownPayment, :ProjectRetention, :StartDate, :EndDate)");
    
                        $stmt->bindparam(":ProjectCode",$ProjectCode);
						$stmt->bindparam(":ProjectName",$ProjectName);
						$stmt->bindparam(":CapexNumber",$CapexNumber);
						$stmt->bindparam(":OrgNumber",$OrgNumber);
                        $stmt->bindparam(":Contractor",$Contractor);                        
                        $stmt->bindparam(":AssignEo",$AssignEo);
						$stmt->bindparam(":project_status",$project_status);
                        $stmt->bindparam(":NtpDate",$NtpDate);
						$stmt->bindparam(":ContractAmount",$ContractAmount);
                        $stmt->bindparam(":DownPayment",$DownPayment);
                        $stmt->bindparam(":ProjectRetention",$ProjectRetention);
                        $stmt->bindparam(":StartDate",$StartDate);
						$stmt->bindparam(":EndDate",$EndDate);
            $stmt->execute();
            
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function SetStatusApprovedProjectList($CapexNum, $Status){
			 
		$SetStatusApprovedProjectList = $this->conn->prepare("UPDATE apollo_projectlist SET approval_status =:AStatus where capex_number=:CapexNum");

				$SetStatusApprovedProjectList->bindparam(":CapexNum",$CapexNum);
				$SetStatusApprovedProjectList->bindparam(":AStatus",$Status);
								
		$SetStatusApprovedProjectList->execute();	
		return true;
	
	 }

	 public function SetStatusApproved($CapexNum, $Status){
			 
		$SetStatusApproved = $this->conn->prepare("UPDATE apollo_contractamount_approval SET approval_status =:AStatus where capex_number=:CapexNum");

				$SetStatusApproved->bindparam(":CapexNum",$CapexNum);
				$SetStatusApproved->bindparam(":AStatus",$Status);
								
		$SetStatusApproved->execute();	
		return true;
	
	 }

	 public function SetStatusHoldProjectList($CapexNum, $Status){
			 
		$SetStatusHoldProjectList = $this->conn->prepare("UPDATE apollo_projectlist SET approval_status =:AStatus where capex_number=:CapexNum");

				$SetStatusHoldProjectList->bindparam(":CapexNum",$CapexNum);
				$SetStatusHoldProjectList->bindparam(":AStatus",$Status);
								
		$SetStatusHoldProjectList->execute();	
		return true;
	
	 }

	 public function SetStatusHold($CapexNum, $Status){
			 
		$SetStatusHold = $this->conn->prepare("UPDATE apollo_contractamount_approval SET approval_status =:AStatus where capex_number=:CapexNum");

				$SetStatusHold->bindparam(":CapexNum",$CapexNum);
				$SetStatusHold->bindparam(":AStatus",$Status);
								
		$SetStatusHold->execute();	
		return true;
	
	 }

	 public function UpdateBillingDetails($Id, $TagNumber, $VoucherNumber){
			 
		$updatebilling = $this->conn->prepare("UPDATE apollo_masterlistofbillings SET tag_number =:TagNumber, voucher_number =:VoucherNumber WHERE billingNumber=:Id");

				$updatebilling->bindparam(":Id",$Id);
				$updatebilling->bindparam(":TagNumber",$TagNumber);
				$updatebilling->bindparam(":VoucherNumber",$VoucherNumber);
								
		$updatebilling->execute();	
		return true;
	
	 }

}


?>