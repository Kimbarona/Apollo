<?php
require_once("class_ModalAddNewSubScopes.php");
$ModalSubScope = new ModalSubScope();

    $SubScope = $_POST['SubScope'];
    $scopeid = $_POST['scopeid'];


    
     if($ModalSubScope->SubScopes($scopeid, $SubScope)){
   
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
    
   }
   ?>