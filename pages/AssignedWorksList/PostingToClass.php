<?php
require_once("Class.php");
$ListOfWOrks = new ListOfWOrks();
    $RowId = $_POST['Id'];
    $PlannedStart = $_POST['PlannedStart'];
    $PlannedEnd = $_POST['PlannedEnd'];
    $ApprovalStatus = 'Waiting';
    $Remarks = 'For Approval';
    $NumDays = $_POST['NumDays'];

    if($result = $ListOfWOrks->UdateWorksDetails($RowId, $PlannedStart, $PlannedEnd, $ApprovalStatus, $Remarks,  $NumDays)){

        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>ok!</strong> Updated Successfully!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>  
        <?php
    }
?>