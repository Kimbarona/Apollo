<?php
require_once("class.php");
$AddNewEngineerList = new AddNewEngineerList();

    $EngineerName = $_POST['EngineerName'];
    $EngineerPosition = $_POST['EngineerPosition'];
    
     





// eror trapping dito

    if($AddNewEngineerList->InputNewEnginneerName($EngineerName, $EngineerPosition)){
   
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>ok!</strong> Successfully saved!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="fa fa-times"></span>
        </button>
    </div>
    <?php

   }


   else{
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>opps!</strong> Error input.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
    </div>
    <?php
   }
   
