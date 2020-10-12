<?php
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();

    $ContractAmount = $_POST['EnteredAmount'];
    $Capex = $_POST['Capex'];
     if($Capex !=''){
        $stmt = $EnrollNewProject->runQuery("SELECT budgeted_amount From apollo_projectlist where capex_number = '$Capex'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $BudgetedAmount =  $row['budgeted_amount'];
            $BA_RemoveComma = str_replace( ',', '', $BudgetedAmount );
            $BA_ConvertToFloat = number_format((float)$BA_RemoveComma, 2, '.', '');
                // additional greater than equal 10% additional to budgeted amount.
                $TenPercentAdd = $BA_ConvertToFloat * 10 / 100;
                $TP_ConvertToFloat = number_format((float)$TenPercentAdd, 2, '.', '');
                $TP_BA_Total = $BA_ConvertToFloat + $TP_ConvertToFloat;
                 

            $CA_RemoveComma = str_replace( ',', '', $ContractAmount );
            $CA_ConvertToFloat = number_format((float)$CA_RemoveComma, 2, '.', '');
            
            // condition for the additional 10% on the budgeted amount
            if($CA_ConvertToFloat >= $TP_BA_Total){
                
                // condition ulet dito to validate approval.
                $ValidateApproval = $EnrollNewProject->runQuery("SELECT * From apollo_projectlist where capex_number = '$Capex'");
                $ValidateApproval->execute();
                $Validation = $ValidateApproval->fetch(PDO::FETCH_ASSOC);
                    $Approval_stat = $Validation['approval_status'];
                    if($Approval_stat == "Approved"){
                        echo "allowable";
                    }
                    else if($Approval_stat == "Not Available"){
                        // condition for not available but over
                        if($CA_ConvertToFloat >= $TP_BA_Total){
                            echo "over";
                        }
                        else{
                            echo "allowable";
                        }
                    }
                    else if($Approval_stat == "Hold"){
                        echo "Hold";
                    }
                    else if($Approval_stat == "For Approval"){
                        echo "For Approval";
                    }
                    else{
                        echo "over";
                    }
            }
            else if($CA_ConvertToFloat < $TP_BA_Total){

                // condition ulet dito to validate approval.
                $ValidateApproval = $EnrollNewProject->runQuery("SELECT * From apollo_projectlist where capex_number = '$Capex'");
                $ValidateApproval->execute();
                $Validation = $ValidateApproval->fetch(PDO::FETCH_ASSOC);
                    $Approval_stat = $Validation['approval_status'];
                    if($Approval_stat == "Hold"){
                        echo "Hold";
                    }
                    else if($Approval_stat == "For Approval"){
                        echo "For Approval";
                    }
                    else{
                        echo "allowable";
                    }
            }
            else{
                echo "allowable";
            }
            
     }
     else{
         echo "Please Enter Capex Number To Validate!!";
     }
?>