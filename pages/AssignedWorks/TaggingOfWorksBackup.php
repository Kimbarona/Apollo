<?php
require_once("class.php");
$AssignedWorks = new AssignedWorks();

$CapexNo = $_POST['CapexNo'];
$ContractAmount = $_POST['ContractAmount'];
$ScopeIDParent = $_POST['ScopeIDParent'];
$Scope = $_POST['Sope'];
$ScopeAmount = $_POST['ScopeAmount'];
$userAccount = $_POST['userAccount'];
$PlannedStart = $_POST['PlannedStart'];
$PlannedEnd = $_POST['PlannedEnd'];


$subScopeID = $_POST['SubScopeId'];
$checkbox = $_POST['SubScopes'];
$Percent = $_POST['Percent'];
$parent_id = $ScopeIDParent;
$GenScope = $Scope;

$ActualStart = $_POST['ActualStart'];
$ActualEnd = $_POST['ActualEnd'];


$idOfSubscope = $_POST['idOfSubscope'];

$Status = "Open"; 

$count = sizeof($idOfSubscope);
for ($i=0; $i < $count; $i++) { 

   if(isset($checkbox[$i])){
     echo $idOfSubscope[$i];
   }
        
   
}
// if(isset($subScopeID) || !empty($subScopeID)){

//     echo implode($idOfSubscope);
// }
// echo implode($Scope); 
// echo implode($ScopeAmount); 
 

    	// dito ung trapping for duplicate data
        // $stmts = $AssignedWorks->runQuery("SELECT *	FROM apollo_laborandmaterialcost_list WHERE capex_number = '$CapexNo'");
        // $stmts->execute();
        // $row = $stmts->fetch();			

// if ($row ==0) {
        // if($result = $AssignedWorks->AssiningWorksToProject($CapexNo,$ContractAmount,$ScopeIDParent,$Scope,$ScopeAmount, $userAccount)){
            
            if($result2 = $AssignedWorks->AssiningSubScopeToProject($parent_id, $CapexNo, $GenScope, $subScopeID, $SubScopes, $Percent, $PlannedStart, $PlannedEnd, $ActualStart, $ActualEnd)){
                // $AssignedWorks->UpdateCapexStatus($CapexNo, $Status)
                        
                ?>
                <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>ok!</strong> Successfully saved!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="fa fa-times"></span>
                    </button>
                </div>  -->
                <?php
            }
        //  }  
    // }

       

// else{
    ?>
    <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>opps!</strong> This Record is Already Exist.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
    </div> -->
    <?php
//    }

 ?>