<?php
    require_once("class.php");
    $Computations = new Computations();

    $CapexNumber = ($_POST['CapexNumber']);
    $PreparedDate = $_POST['PreparedDate'];
    $ProjectName = $_POST['ProjectName'];
    $ContractorName = $_POST['ContractorName'];
    $ContractAmt = $_POST['ContractAmt'];
    $BillingType = $_POST['BillingType'];
    $ProjectProgress = $_POST['ProjectProgress'];
    $Amount = $_POST['Amount'];
    $Bill = $_POST['BillableAmount'];
    $billing_status = $_POST['billing_status'];
    
    //THIS IS FOR CONVERSION OF BILLABLE AMOUNT
        $BillRemoveComma = str_replace(',', '', $Bill);
        $BillableAmount =$BillRemoveComma;

    // THIS IS FOR THE 1ST APPROVER
        $Billing_date = $PreparedDate;
        $Capex_num = $CapexNumber;
        $CAmount = $ContractAmt;
        $ConTractor = $ContractorName;
        $BType = $BillingType;
        $BillingProgress = $ProjectProgress;
        $BillablAmt = $Bill;
        $BillingStatus = 'For Approval';
        $ApprovalDate = date('Y-m-d');
        $approver_name = 'Randy Carillo'; 
        $Remarks = 'Not Available'; 
    // this is for billing history
   
        $stmts = $Computations->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount, apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent 
        FROM apollo_laborandmaterialcost_list LEFT JOIN apollo_project_assigned_scopes 
        ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number) AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
        WHERE apollo_laborandmaterialcost_list.capex_number = '$CapexNumber' GROUP BY apollo_laborandmaterialcost_list.scope");
        $stmts->execute();
        while($rows = $stmts->fetch(PDO::FETCH_ASSOC)){
            $ContractAmount = $rows['contract_amount'];
            $RemoveComma = str_replace(',', '', $ContractAmount);
                $FloatCa = (float)$RemoveComma;
        // for weight    
            $ScopeAmount = $rows['scope_amount'];
            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                $FloatSa = (float)$ScopeRemoveComma;
                    $Weight = $FloatSa / $FloatCa * 100;
        //    for equiv weight         
            $Percentage = $rows['percent'];  
                $equiv =  $Percentage * $Weight / 100;  
        //    for equiv weight  
            $TotalAmt = $equiv / $Weight * $FloatSa;      
                $Totalamtsum[]=$TotalAmt;
                $TotalEquiv[]=$equiv;
        // this is for the Billing History
            $Cap =$CapexNumber;
            $Sco[] = $rows['scope'];
            $SAmount[] = $rows['scope_amount'];
            $ScoWeight[] = $Weight;
            $ScoProg[] = $rows['percent'];
            $ScoEquWeight[]= $equiv;
            $ScoTtalAmount[] =  $TotalAmt;
            $B_Type = $BillingType;  
    }
            $CapNumber =$Cap;
            $Scopes = $Sco;
            $ScopesAmount = $SAmount;
            $ScopesWeight = $ScoWeight;
            $ScopesProgress = $ScoProg;
            $ScopesEquivWeight= $ScoEquWeight;
            $ScopesTotalAmount =  $ScoTtalAmount;
            $BType = $B_Type;
                                    
// AND billing_date = '$PreparedDate' 
    $stmts = $Computations->runQuery("SELECT * From apollo_progressbillinglist WHERE capex_number='$CapexNumber' AND billing_type = '$BillingType' AND progress = '$ProjectProgress'");
    $stmts->execute();
    $row = $stmts->fetch();
    if($row==0){
        if($Computations->InsertDataFromBillingForm($PreparedDate, $CapexNumber,  $ProjectName, $ContractorName, $ContractAmt, $BillingType, $ProjectProgress, $Amount, $BillableAmount, $billing_status)){
            if($result = $Computations->InsertDataFromBillingFormSecond($PreparedDate, $CapexNumber, $ProjectName, $ContractorName, $ContractAmt, $BillingType, $ProjectProgress, $Amount, $BillableAmount, $billing_status)){
                if($approver = $Computations->FirstApprover($Billing_date, $Capex_num, $CAmount, $ConTractor, $BType, $BillingProgress, $BillablAmt, $BillingStatus, $ApprovalDate, $approver_name, $Remarks)){
                    if($BillingHistory = $Computations->BillingHistory($CapNumber, $Scopes, $BType, $ScopesAmount, $ScopesWeight, $ScopesProgress, $ScopesEquivWeight, $ScopesTotalAmount)){
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>ok!</strong> Successfully Generated!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span class="fa fa-times"></span>
                                </button>
                            </div>
                        <?php    
                    }
                }
            }
        }
    }
    else{
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>opps!</strong> Your Trying To Generate Existed Billing!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
            </div>
        <?php
    }
    
 
 ?>