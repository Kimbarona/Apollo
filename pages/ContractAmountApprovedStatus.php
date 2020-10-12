<?php
    require_once("GlobalClass.php");
    $GlobalConnection = new GlobalConnection();

        $Status = $_POST['Status'];
        $CapexNum = $_POST['CapexNum'];
        if($Status == 'Approved'){
            if($GlobalConnection->SetStatusApprovedProjectList($CapexNum, $Status)){
                if($GlobalConnection->SetStatusApproved($CapexNum, $Status)){
                    echo "Successfully Approved!";
                }
            }
            else{

            }

        }
        else{
            if($GlobalConnection->SetStatusHoldProjectList($CapexNum, $Status)){
                if($GlobalConnection->SetStatusHold($CapexNum, $Status)){
                    echo "Successfully On Hold!";
                }
            }
            else{
                
            }
        }
       
?>