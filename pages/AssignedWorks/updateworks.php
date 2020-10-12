<?php

//multiple_update.php
require_once("Class.php");
$AssignedWorks = new AssignedWorks();

$id = $_POST['hidden_id'];
$scope = $_POST['scope'];
$work = $_POST['work'];
$percent = $_POST['percent'];
$ActualStart = $_POST['actualStart'];
$ActualEnd = $_POST['ActualEnd'];

$workId = implode($id);


$stmts = $AssignedWorks->runQuery("SELECT * From apollo_project_assigned_scopes WHERE id IN('" . implode("','", $id) . "') AND actual_start = '0000-00-00'");
$stmts->execute();
$row = $stmts->fetch();

if ($row ==0) {

if($result = $AssignedWorks->UpdateProjectWorkdescription($id, $scope, $work, $percent, $ActualStart, $ActualEnd)){
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
else{
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Opps!</strong> You need to start this work to make this action!.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
    </div>
    <?php
   }

?>
