<?php
require_once("class.php");
$AssignedWorks = new AssignedWorks();

$WorkId = $_POST['workId'];
$ActualStart = date('Y-m-d');
$Status = "Open";
$Approval_status = "Approved";
$remarks = "Started";

$stmts = $AssignedWorks->runQuery("SELECT * From apollo_project_assigned_scopes WHERE id = '$WorkId' AND work_status!='Open'");
$stmts->execute();
$row = $stmts->fetch();

if ($row !=0) {

if($AssignedWorks->SetUpActualStartDate($WorkId, $ActualStart, $Status, $Approval_status, $remarks)){
echo "Success! work started";

}
}

else{
    echo "This Work is already Started!";
}
?>