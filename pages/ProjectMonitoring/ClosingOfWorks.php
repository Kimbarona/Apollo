<?php
 require_once("class.php");
 $ProjectMonitoring = new ProjectMonitoring();
 
 $Id = $_POST['Id'];
 $WorkStatus = 'Pending To Close';
 
 
    if($result = $ProjectMonitoring->ClosingOfWorks($Id, $WorkStatus)){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Wait for the confirmation of admin! tnx.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="fa fa-times"></span>
        </button>
    </div>  
    <?php
 
    }


 ?>