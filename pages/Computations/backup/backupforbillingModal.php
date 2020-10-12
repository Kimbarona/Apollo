
 <?php
    require_once("class.php");
    $Computations = new Computations();
    $stmts = $Computations->runQuery("SELECT SUM(billable_amount) AS billableamount From apollo_progressbillinglist WHERE capex_number = '$TriggerCapex'");
    $stmts->execute();
    $row = $stmts->fetch();
    
    $Pre= $row['billableamount'];

    
 
 ?>
 <!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Form - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico"> -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

    <!-- datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
    
 
</head>
<body>
 <!-- Large modal -->  
        <div class="modal fade bd-example-modal-lg" id="BillingModal<?php echo $TriggerCapex ?>$<?php echo $ProjectName ?>$<?php echo $Contractor?>$<?php echo $TotalAmt?>$<?php echo $DownPayment?>$<?php echo $RetentionPayment?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div id="AlertForSuccess"></div>
                    <div class="modal-header">                   
                        <h5 class="modal-title">Payment Details</h5>
                       
                    </div>
                    <div class="modal-body" style="background-color:#d7e1f3">
                    <?php 
                        $stmts = $Computations->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount, apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent)AS percent 
                        FROM apollo_laborandmaterialcost_list INNER JOIN apollo_project_assigned_scopes ON apollo_project_assigned_scopes.parent_id = apollo_laborandmaterialcost_list.scope_id  Where apollo_laborandmaterialcost_list.capex_number = '$TriggerCapex' GROUP by apollo_laborandmaterialcost_list.scope_id");
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
                          
                     
                        }
                        
                    ?>
                    <?php
                    
                        $a = array_sum($Totalamtsum);
                        $TotalAmount = number_format(($a),2);
                        // echo $TotalAmount;

                        $ew = array_sum($TotalEquiv);
                        $EquivalentWeight = number_format(($ew),2);
                        echo $ew;
                        // this is for computation of billable amount
                        $floatEquivWeight = (float) $ew;
                        
                        $Dp = $DownPayment;
                        // $DpRemovecomma = str_replace(',', '', $Dp);
                        $Dpdp = (float) $Dp;
                            $TotalDp = $Dpdp * $floatEquivWeight / 100;

                        $Rt = $RetentionPayment;
                        $RtRemovecomma = str_replace(',', '', $Rt);
                        $RTRT = (float) $RtRemovecomma;

                        $presum =$Pre;
                        $PreRemovecomma = str_replace(',', '', $presum);
                        $PreFloat = (float) $PreRemovecomma;
                            $TotalRT = $RTRT * $floatEquivWeight / 100;

                            // This is for total of rt, dp and previous
                            $DPRT = $TotalDp + $TotalRT; 
                            $TotalDeduction = $Pre+$DPRT;
                          
                                 $TAmountRemovecomma = str_replace(',', '', $a);
                                 $FinalDeduction = $TAmountRemovecomma - $TotalDeduction;
                           
                                //  echo $TotalDeduction;
                        // echo $Pre;
                        
                    ?>
                     
                    <form method="POST" action="postingToClass.php">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <div align="left"><label for="validationCustomUsername"><b>Capex Number</b></label></div>
                                <div class="input-group">  
                                <span class="input-group-text">#</span>   
                                    <input type="text" name="CapexNumber" class="form-control" id="CapexNumber" value="<?php echo $TriggerCapex?>"  readonly>
                                    
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                            <div align="left"><label for="validationCustomUsername"><b>Prepared Date</b></label></div>
                                <div class="input-group">
                                <span class="input-group-text fa fa-calendar"></span> 
                                <input type="date" name="PreparedDate" class="form-control" id="PreparedDate" value="<?php echo date('Y-m-d')?>" placeholder="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <div align="left"><label for="validationCustomUsername"><b>Project Name</b></label></div>
                                <div class="input-group">
                                <span class="input-group-text fa fa-home"></span>         
                                    <input type="text" name="ProjectName" class="form-control" id="ProjectName" placeholder=""  value="<?php echo $ProjectName?>" readonly>
                                    
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                            <div align="left"><label for="validationCustomUsername"><b>Name Of Contractor</b></label></div>
                                <div class="input-group">
                                <span class="input-group-text fa fa-bars"></span>  
                                <input type="text" name="ContractorName" class="form-control" id="ContractorName" placeholder="" value="<?php echo $Contractor?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                            <div align="left"><label for="validationCustomUsername"><b>Contract Amount</b></label></div>
                                <div class="input-group">      
                                <span class="input-group-text">₱</span>  
                                    <input type="text" name="ContractAmt" class="form-control" id="ContractAmt" placeholder=""  value="<?php echo number_format(($FloatCa),2)?>" readonly>
                                    
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                            <div align="left"><label for="validationCustomUsername"><b>Billing Type</b></label></div>
                                <div class="input-group">
                                <span class="input-group-text fa fa-list"></span>
                                <select class="custom-select" name="BillingType" id="BillingType" required>
                                    <option ></option>
                                    <option >Progress Billing 1</option>
                                    <option >Progress Billing 2</option>
                                    <option >Progress Billing 3</option>
                                    <option >Progress Billing 4</option>
                                    <option >Progress Billing 5</option>
                                    <option >Progress Billing 6</option>
                                    <option >Progress Billing 7</option>
                                    <option >Progress Billing 8</option>
                                    <option >Progress Billing 9</option>
                                    <option >Progress Billing 10</option>
                                    <option >Progress Billing 11</option>
                                    <option >Progress Billing 12</option>
                                    <option >Full Payment</option>
                                    <option >Final Payment</option>
                                </select>
                                </div>
                            </div>
                        </div> 
                                <div class="" align="">
                                <div class="col-md-5 mb-3">
                                <div align="left"><label for="validationCustomUsername"><b>Progress:</b></label></div>
                                    <div class="input-group">
                                    <span class="input-group-text">%</span> 
                                    <input type="text" name="ProjectProgress" class="form-control" id="ProjectProgress" placeholder="" value="<?php echo   $EquivalentWeight?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="" align="right">
                                <div class="col-md-5 mb-3">
                                <div align="left"><label for="validationCustomUsername"><b>Amount:</b></label></div>
                                    <div class="input-group">
                                    <span class="input-group-text fa fa-money"></span> 
                                    <input type="text" name="Amount" class="form-control" id="Amount" placeholder="" value="<?php echo $TotalAmount ?>" readonly>
                                    </div>
                                </div>
                            </div> 
                            <div class="" align="right">
                                <div class="col-md-5 mb-3">
                                <div align="left"><label for="validationCustomUsername"><b>Billable Amount:</b></label></div>
                                    <div class="input-group">
                                    <span class="input-group-text fa fa-money"></span> 
                                    <input type="text" name="BillbleAmount" class="form-control" id="BillbleAmount" placeholder="" value="<?php echo number_format(($FinalDeduction), 2)?>" readonly></div>
                                </div>
                            </div> 
                      
                            <br>
                            <div align="right">                
                            <button class="btn btn-danger" data-dismiss="modal"  id="Close"><b>X</b></button>  
                            <button class="btn btn-secondary" type="submit" id="save">Generate Billing</button>                  
                            </div>

                             <!-- dito computation ng sum of total amount, equiv weight-->
                        </form> 
                                                    
                    </div>
                </div>
            </div>
        </div>
<!-- Large modal modal end -->
</body>
     <!-- jquery latest version -->
     <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/jquery.slicknav.min.js"></script>
        <!-- Start datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->
        <!-- others plugins -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
        
</html>
<script>
    $(document).ready(function ($) {
        $("#save").click(function (e) {
            e.preventDefault();

            var CapexNumber = $('#CapexNumber').val();
            var PreparedDate = $('#PreparedDate').val();
            var ProjectName = $('#ProjectName').val();
            var ContractorName = $('#ContractorName').val();

            var ContractAmt = $('#ContractAmt').val();
            var BillingType = $('#BillingType').val();
            var ProjectProgress = $('#ProjectProgress').val();
            var Amount = $('#Amount').val();
            var BillableAmount = $('#BillbleAmount').val();

            $.ajax({
                type: "POST",
                url: "Computations/PostingToClass.php",
                data: {CapexNumber:CapexNumber, PreparedDate:PreparedDate, ProjectName:ProjectName, ProjectName:ProjectName, ContractorName:ContractorName, ContractAmt:ContractAmt, BillingType:BillingType, ProjectProgress:ProjectProgress, Amount:Amount, BillableAmount:BillableAmount},
                success: function (msg) {
                    $("#AlertForSuccess").html(msg);
                    $("#Close").cick();
                    $("#TableCostDetails").load();
                    
                    
                    // console.log(msg);
                }
            
            });
        
        });
});
</script>
