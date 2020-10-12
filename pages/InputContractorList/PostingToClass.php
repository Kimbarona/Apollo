<?php
require_once("class.php");
$AddNewContractorList = new AddNewContractorList();

    $ContractorName = $_POST['ContractorName'];
    $ContactPerson = $_POST['ContactPerson'];
    $ContractorAddress = $_POST['ContractorAddress'];
    $ContactNumber = $_POST['ContactNumber'];
     





// eror trapping dito
$stmts = $AddNewContractorList->runQuery("SELECT * From apollo_contractor_list WHERE contractor_name = '$ContractorName'");
$stmts->execute();
$row = $stmts->fetch();

if ($row ==0) {
    if($AddNewContractorList->InputNewContractorName($ContractorName, $ContactPerson, $ContractorAddress, $ContactNumber)){
   
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
   
