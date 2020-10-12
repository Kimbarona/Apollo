<?php
 require_once("class.php");
 $ClosingOfWholeProject = new ClosingOfWholeProject();
 
 $Id = $_POST['Id'];
 $ProjectStatus = 'Completed';
 
 
    if($result = $ClosingOfWholeProject->ClosingOfProject($Id, $ProjectStatus)){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Work Closed!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span class="fa fa-times"></span>
        </button>
    </div>  
    <?php
 
    }


 ?>