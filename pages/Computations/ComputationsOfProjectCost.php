<?php
    require_once("class.php");
    $Computations = new Computations();

$CapexNumber = $_POST['capex'];
$output = '';
    $stmt = $Computations->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount, apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent)AS percent 
    FROM apollo_laborandmaterialcost_list INNER JOIN apollo_project_assigned_scopes ON apollo_project_assigned_scopes.parent_id = apollo_laborandmaterialcost_list.scope_id 
    WHERE apollo_laborandmaterialcost_list.capex_number = '.$CapexNumber.' GROUP by apollo_laborandmaterialcost_list.scope_id ");
    $stmt->execute();
    
    if(isset($_POST['capex'])){

        $output .='
        <div class="table-responsive" >
        <table class="table table-bordered table-striped">
            <tr>
                <th width="10%">Capex Number</th>
                <th width="40%">Scopes</th>
                <th width="10%">Amount</th>
                <th width="10%">Weight</th>
                <th width="10%">Percentage</th>
                <th width="10%">Equivalent Weight</th>
                <th width="10%">Total Amount</th>
                <!-- <th width="20%">Status</th>-->
                
            </tr>
        ';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $ContractAmount = $row['contract_amount'];
            $RemoveComma = str_replace(',', '', $ContractAmount);
                $FloatCa = (float)$RemoveComma;
        
        // for weight    
            $ScopeAmount = $row['scope_amount'];
            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                 $FloatSa = (float)$ScopeRemoveComma;
                    $Weight = $FloatSa / $FloatCa * 100;
            
        //    for equiv weight         
            $Percentage = $row['percent'];  
                $equiv =  $Percentage * $Weight / 100;  

        //    for equiv weight  
            $TotalAmt = $equiv / $Weight * $FloatSa;   
            

            $output .='
            <tr>                                       
            <td>'.$row['capex_number'].'</td>
            <td>'. $row['scope'].'</td>
            <td>'.number_format($row['scope_amount'],2 ).'</td>
            <td>'.number_format(($Weight),2).'</td>
            <td>'.$row['percent'].'</td>
            <td>'.number_format (($equiv), 2).'</td>
            <td><h5><span class="badge badge-success">'. number_format (($TotalAmt), 2).'</span></h5></td>
            </tr>
            
            ';

        }
        echo $output;
    }
    else{
        echo 'No Data Found';
    }

   


?>