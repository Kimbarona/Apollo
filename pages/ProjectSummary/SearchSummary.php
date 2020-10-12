<?php
 require_once("class.php");
 $ProjectSummary = new ProjectSummary();

    $FilterCapex = $_POST['FilterCapex'];
    $Todate = date('Y-m-d');
   
    ?>
        <center><h4 class="header-title">Project Scopes / Work description</h4>                                                            
        <table id="dataTable" class="table table-bordered table-striped">
            <thead class="bg-light text-capitalize">                                                                                      
                
                <th width="30%" style="background-color:#7855ed; color:white;">Scopes</th>
                <th width="30%" style="background-color:#7855ed; color:white;">Work Description</th>
                <th width="20%" style="background-color:#7855ed; color:white;">Planned Start</th>
                <th width="20%" style="background-color:#7855ed; color:white;">Planned End</th>                                             
            </thead>
            <tbody>
            <?php
                 $view = $ProjectSummary->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE capex_number = '$FilterCapex'");
                 $view->execute();
                    while($row = $view->fetch(PDO::FETCH_ASSOC))
                    {
                        
                        ?>
                            <tr>
                                 
                                 <td><?php echo $row['gen_scope']; ?></td>
                                 <td><?php echo $row['subscopes']; ?></td>
                                 <td><?php echo $row['planned_start']; ?></td>
                                 <td><?php echo $row['planned_end']; ?></td>
                                
                            </tr> 
                        <?php
                     }
            
            ?>
            </tbody>
        </table>    
          <HR><HR>                                                                    
        <center><h4 class="header-title">Project Progress</h4>                                                            
        <table class="table table-bordered table-striped" id="TableCostDetails">
            <thead>
                <th class="" width="10%" style="background-color:#7855ed; color:white;">Capex Number</th>
                <th class="table-primary" style="background-color:#7855ed; color:white;" width="40%">Scopes</th>
                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Amount</th>
                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Weight</th>
                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Percentage</th>
                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Equivalent Weight</th>
                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Total Amount</th>
                <!-- <th width="20%">Status</th>-->
                
            </thead>
            <tbody>
        <!-- to get information with other table -->

            <?php
            
                    $stmt = $ProjectSummary->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount, apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent 
                    FROM apollo_laborandmaterialcost_list LEFT JOIN apollo_project_assigned_scopes 
                    ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number) AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
                    WHERE apollo_laborandmaterialcost_list.capex_number = '$FilterCapex' GROUP BY apollo_laborandmaterialcost_list.scope");
                    $stmt->execute();
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            $ContractAmount = $row['contract_amount'];
                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                $FloatCa = (float)$RemoveComma;
                        // echo $ContractAmount;
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
                                
                            
                            $Totalamtsum[]=$TotalAmt;
                            $TotalEquiv[]=$equiv;
                            
                
                            
                    ?>
                    <tr>                                       
                        <td><?php echo $row['capex_number']; ?></td>
                        <td><?php echo $row['scope']; ?></td>
                        <td>₱<?php echo $row['scope_amount'];?></td>
                        <td><?php echo number_format(($Weight),2)?> %</td>
                        <td><?php echo number_format($row['percent'], 2)?>%</td>
                        <td><?php echo number_format(($equiv),2)?>%</td>
                        <td class="amt"><h5><span class="badge badge-success">₱<?php echo number_format (($TotalAmt), 2) ?></span></h5></td>
                    </tr>
                <?php
                
                    }
                    
                    
                ?>

                <!-- dito computation ng sum of total amount, equiv weight-->
                <?php
                    

                    $a = array_sum($Totalamtsum);
                    $TotalAmount = number_format(($a),2);
                    // echo $TotalAmount;

                    $ew = (array_sum($TotalEquiv));
                    $EquivalentWeight = number_format(($ew),2);
                    // print_r($ew);
                    // echo  $EquivalentWeight;
                    
                    
                ?>
            
            </tbody>
        </table>
    <?php
        ?>
        <HR>
        <HR>
        <center><h4 class="header-title">Billing Details</h4> </center> 
        <table class="table table-bordered table-striped" >
                <thead>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Created Date</th>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Capex Number</th>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="20%">Project Name</th>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="15%">Contractor</th>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Contract Amount</th>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="15%">Billing Type</th>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="5%">Progress</th>
                    <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Billing Amount</th>
                    <!-- <th width="20%">Status</th>-->
                    
                </thead>
                <tbody>
                <?php
                
                        $stmts = $ProjectSummary->runQuery("SELECT * FROM apollo_masterlistofbillings WHERE capex_number ='$FilterCapex'");
                        $stmts->execute();
                            while($rows = $stmts->fetch(PDO::FETCH_ASSOC)){
                                $ca = $rows['contract_amount'];
                                $CaRemoveComma = str_replace(',', '', $ca);

                                $ba = $rows['billable_amount'];
                                $baRemoveComma = str_replace(',', '', $ba);
                                
                        ?>
                        <tr>                                       
                            <td><?php echo $rows['billing_date']; ?></td>
                            <td><?php echo $rows['capex_number']; ?></td>
                            <td><?php echo $rows['project_name'];?></td>
                            <td><?php echo $rows['contractor'];?></td>
                            <td>₱<?php echo number_format(($CaRemoveComma), 2);?></td>
                            <td><?php echo $rows['billing_type'];?></td>
                            <td><?php echo $rows['progress'];?>%</td>
                            <td><h5><span class="badge badge-warning">₱<?php echo number_format(($baRemoveComma),2) ?></span></h5></td>
                        </tr>
                    <?php
                
                        }
                        
                    ?>                                           
                </tbody>
            </table>
        <?
?>