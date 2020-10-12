<?php
    require_once("class.php");

    $EnrollScopes = new EnrollScopes();

    $genScope = $_POST['genScope'];



        if($EnrollScopes->NewScopes($genScope)){
    
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
   