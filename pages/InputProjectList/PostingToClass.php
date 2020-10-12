<?php
require_once("class.php");
$AddNewProjectNameList = new AddNewProjectNameList();

    $OrganizationNumber = $_POST['OrganizationNumber'];
    $ProjectName = $_POST['ProjectName'];
    $p_Status = $_POST['Status'];
     





// eror trapping dito
$stmts = $AddNewProjectNameList->runQuery("SELECT * From apollo_projectlist_name WHERE project_name = '$ProjectName' OR org_number = '$OrganizationNumber'");
$stmts->execute();
$row = $stmts->fetch();

if ($row ==0) {
    if($AddNewProjectNameList->InputNewProjectName($OrganizationNumber, $ProjectName, $p_Status)){
   
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
    <strong>opps!</strong> Project Name or Organization Number is already Exist.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
    </div>
    <?php
   }
   
