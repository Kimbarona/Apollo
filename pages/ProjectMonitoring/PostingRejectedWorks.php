<?php
  require_once("class.php");
  $ProjectMonitoring = new ProjectMonitoring();

    $WorkId = $_POST['WorkId'];
    $ApprovalStatus = "Rejected";
    $Remarks = "Please Double check your Date!";
    
    if($result = $ProjectMonitoring->RejectWorksDetails($WorkId,$ApprovalStatus,$Remarks)){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>ok!</strong> Rejected Successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>  
        <?php
     
        
    }

?>