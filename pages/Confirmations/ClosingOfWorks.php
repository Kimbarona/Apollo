<?php
 require_once("class.php");
 $Confirmation = new Confirmation();
 
 $Id = $_POST['Id'];
 $WorkStatus = 'Closed';
 
 
    if($result = $Confirmation->ClosingOfWorks($Id, $WorkStatus)){
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