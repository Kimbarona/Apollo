<?php

require_once('../database/db.php');

class AssignedWorks
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

   public function AssiningWorksToProject($CapexNo, $ContractAmount, $ScopeID, $Scope, $ScopeAmount, $userAccount){

		 $count = sizeof($ScopeID);
    	for($i=0;$i<$count;$i++){
				$in_ScopeID = $ScopeID[$i];
				$in_Scope = $Scope[$i];
				$in_ScopeAmount = $ScopeAmount[$i];
				

				if(!empty($in_ScopeAmount)){
				$stmt = $this->conn->prepare("INSERT INTO  apollo_laborandmaterialcost_list (capex_number, contract_amount, scope_id, scope, scope_amount, assigned_user)
				VALUES(:CapexNo, :ContractAmount, :ScopeID, :Scope, :ScopeAmount, :userAccount)");
				
						$stmt->bindparam(":CapexNo",$CapexNo);
						$stmt->bindparam(":ContractAmount",$ContractAmount);
						$stmt->bindparam(":ScopeID",$in_ScopeID);
						$stmt->bindparam(":Scope",$in_Scope);
						$stmt->bindparam(":ScopeAmount",$in_ScopeAmount);
						$stmt->bindparam(":userAccount",$userAccount);
             
            $stmt->execute();
						
					
			}
		}
		return true;

	 }


	 public function AssiningSubScopeToProject($ParentId, $CapexNo, $GenScopes, $ArrayScopeId, $SubScopes, $Percent, $WorkStat, $PlannedStart, $PlannedEnd, $ActualStart, $ActualEnd, $Remarks, $Approval_status, $NumDays){

		$counts = sizeof($ArrayScopeId);
		for($x=0;$x < $counts;$x++){
			$in_parent_id= $ParentId[$x];
			$in_GenScope= $GenScopes[$x];
			$in_subScopeID= $ArrayScopeId[$x];
			$in_SubCode= $SubScopes[$x];
			$in_percent= $Percent[$x];
			$in_status= $WorkStat[$x];
			$in_Start= $PlannedStart[$x];
			$in_End= $PlannedEnd[$x];
			$in_ActualStart= $ActualStart[$x];
			$in_ActualEnd= $ActualEnd[$x];
			$in_remarks= $Remarks[$x];
			$in_approval_status= $Approval_status[$x];
			$in_Numdays= $NumDays[$x];
	
		
			if(!empty($in_parent_id)){
			$stmts = $this->conn->prepare("INSERT INTO  apollo_project_assigned_scopes (capex_number, parent_id,  gen_scope, subscope_id, subscopes, subscope_percent, work_status, planned_start, planned_end, actual_start, actual_end, remarks, approval_status, numdays)
			VALUES(:Capex_number,  :Parent_id, :Gen_scope, :Subscope_id, :Subscopes, :Subscope_percent, :Work_status, :Planned_start, :Planned_end, :Actual_start, :Actual_end, :Remarks, :Approval_status, :NumDays)");
				
				
				  $stmts->bindparam(":Capex_number",$CapexNo);
					$stmts->bindparam(":Parent_id",$in_parent_id);				
					$stmts->bindparam(":Gen_scope",$in_GenScope);
					$stmts->bindparam(":Subscope_id",$in_subScopeID);
					$stmts->bindparam(":Subscopes",$in_SubCode);
					$stmts->bindparam(":Subscope_percent",$in_percent);
					$stmts->bindparam(":Work_status",$in_status);
					$stmts->bindparam(":Planned_start",$in_Start);
					$stmts->bindparam(":Planned_end",$in_End);
					$stmts->bindparam(":Actual_start",$in_ActualStart);
					$stmts->bindparam(":Actual_end",$in_ActualEnd);
					$stmts->bindparam(":Remarks",$in_remarks);
					$stmts->bindparam(":Approval_status",$in_approval_status);
					$stmts->bindparam(":NumDays",$in_Numdays);
				
					$stmts->execute();
					
	
			}
		}
		return true;

		}


		public function UpdateProjectWorkdescription($id, $scope, $work, $percent, $ActualStart, $ActualEnd){

			$count = sizeof($id);
			 for($i=0;$i<$count;$i++){
				$in_id = $id[$i];
				 $in_scope = $scope[$i];
				 $in_work = $work[$i];
				 $in_percent = $percent[$i];
				 $in_ActualStart= $ActualStart[$i];
				 $in_ActualEnd= $ActualEnd[$i];
				 
 
				 
				 $stmt = $this->conn->prepare("UPDATE apollo_project_assigned_scopes SET gen_scope = :Scope, subscopes = :Work, subscope_percenT = :Percent, actual_start = :ActualStart, actual_end = :ActualEnd WHERE id = :Id");
						 
						 $stmt->bindparam(":Id",$in_id);
						 $stmt->bindparam(":Scope",$in_scope);
						 $stmt->bindparam(":Work",$in_work);
						 $stmt->bindparam(":Percent",$in_percent);
						 $stmt->bindparam(":ActualStart",$in_ActualStart);
						 $stmt->bindparam(":ActualEnd",$in_ActualEnd);
						 
							
						 $stmt->execute();
						 
					 
			 
		 }
		 return true;
 
		}

		public function UpdateCapexStatus($CapexNo, $Status){		 
 
				 
					$stmt = $this->conn->prepare("UPDATE apollo_enrolledproject SET project_status = :Stat WHERE capex_number = :CapexNo");
							
							$stmt->bindparam(":Stat",$Status);
							$stmt->bindparam(":CapexNo",$CapexNo);
							
								
							$stmt->execute();
							
						
				
			
			return true;
			}


			public function SetUpActualStartDate($WorkId, $ActualStart, $Status, $Approval_status, $remarks){		 
 
				 
				$stmt = $this->conn->prepare("UPDATE apollo_project_assigned_scopes SET actual_start = :ActualStart, work_Status= :StatusOfwork, approval_status =:Approval_status, remarks =:remarks WHERE id = :WorkId");
						
						$stmt->bindparam(":ActualStart",$ActualStart);
						$stmt->bindparam(":WorkId",$WorkId);
						$stmt->bindparam(":StatusOfwork",$Status);
						$stmt->bindparam(":Approval_status",$Approval_status);
						$stmt->bindparam(":remarks",$remarks);
							
						$stmt->execute();
						
					
			
		
		return true;
		}
 
		}






?>