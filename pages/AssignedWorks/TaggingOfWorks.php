<?php
session_start();

require_once("class.php");
$AssignedWorks = new AssignedWorks();

// THIS IS FOR TABLE apollo_laborandmaterialcost_list

$CapexNo = $_POST['CapexNo'];
$ContractAmount = $_POST['ContractAmount'];
$ScopeIDParent = $_POST['ScopeIDParent'];
$Scope = $_POST['Sope'];
$ScopeAmount = $_POST['ScopeAmount'];
$userAccount = $_POST['userAccount'];
$Start = $_POST['PlannedStart'];
$End = $_POST['PlannedEnd'];   
$Days = $_POST['NumDays'];

$PlannedStart= [];
    foreach($Start as $Pstarts){
        if(!empty($Pstarts)){
        array_push($PlannedStart, $Pstarts);
        }
    }
$PlannedEnd= [];  
foreach($End as $PEnds){
    if(!empty($PEnds)){
    array_push($PlannedEnd, $PEnds);
    }
}

$NumDays= [];  
foreach($Days as $NDays){
    if(!empty($NDays)){
    array_push($NumDays, $NDays);
    }
}
   
// THIS IS FOR TABLE apollo_project_assigned_scopes

$SubScopeId = $_POST['SubScopeId'];
// $SubScopes = $_POST['SubScopes'];
$Percent = $_POST['Percent'];
// $parent_id = $ScopeIDParent;
// $GenScope = $Scope;

$ActualStart = $_POST['ActualStart'];
$ActualEnd = $_POST['ActualEnd'];
$ScopeIDParent = $_POST['ScopeIDParent'];
$Status = 'Open';
$Remarks = $_POST['Remarks'];
$Approval_status = $_POST['Approval_status'];

$count = sizeof($SubScopeId);
for ($i=0; $i < $count; $i++) { 
   if(isset($SubScopeId[$i])){
       if(!empty($SubScopeId[$i])){           
            $sample = $SubScopeId[$i];
            $stmts = $AssignedWorks->runQuery("SELECT apollo_added_subscopes.id, apollo_added_subscopes.parent_id, apollo_added_subscopes.SubScopes, apollo_genscopes.GenScopes FROM apollo_added_subscopes INNER JOIN apollo_genscopes ON apollo_genscopes.Scope_id = apollo_added_subscopes.parent_id WHERE apollo_added_subscopes.id  IN (".($sample).")");
                $stmts->execute();
                while ($row = $stmts->fetch(PDO::FETCH_ASSOC)) {

                    $ScopesubId[] = $row['id']; 
                    $ParentId[] = $row['parent_id'];
                    $SubScopes[] = $row['SubScopes'];                   
                    $GenScopes[] = $row['GenScopes'];
                    $WorkStat[] = $_POST['Status'];
                          
                }
                $ArrayScopeId = $ScopesubId;
       }    
   }

}




// INSERT TO TABLE apollo_laborandmaterialcost_list

    	// dito ung trapping for duplicate data
        $stmts = $AssignedWorks->runQuery("SELECT *	FROM apollo_laborandmaterialcost_list WHERE capex_number = '$CapexNo'");
        $stmts->execute();
        $row = $stmts->fetch();			

            if ($row ==0) {

                 if($FirstProcess = $AssignedWorks->AssiningWorksToProject($CapexNo,$ContractAmount,$ScopeIDParent,$Scope,$ScopeAmount, $userAccount)){
                    if($SeconProcess = $AssignedWorks->AssiningSubScopeToProject($ParentId, $CapexNo, $GenScopes, $ArrayScopeId, $SubScopes, $Percent, $WorkStat, 
                       $PlannedStart, $PlannedEnd, $ActualStart, $ActualEnd, $Remarks, $Approval_status, $NumDays)){
                        if($ThirdProcess = $AssignedWorks->UpdateCapexStatus($CapexNo, $Status)){
                        ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>ok!</strong> Successfully saved!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>  
                        <?php
                        }
                    }
                }
             }

           else{
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>opps!</strong> This Record is Already Exist.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                        </div>
                    <?php
                   }





 ?>