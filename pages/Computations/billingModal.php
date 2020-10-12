 <?php
    require_once("class.php");
    $Computations = new Computations();
    $stmts = $Computations->runQuery("SELECT SUM(billable_amount) AS billableamount From apollo_progressbillinglist WHERE capex_number = '$TriggerCapex'");
    $stmts->execute();
    $row = $stmts->fetch();
    $Pre= $row['billableamount'];

// select maxnum of billing for the billing type
    $selectmaxnumber = $Computations->runQuery("SELECT MAX(billingNumber) as billNumber FROM `apollo_masterlistofbillings` WHERE capex_number='$TriggerCapex'");
    $selectmaxnumber->execute();
    $maxnum = $selectmaxnumber->fetch();
    $billNumber= $maxnum['billNumber'];
    
    $selectbillType = $Computations->runQuery("SELECT COUNT(billing_type) AS tb FROM `apollo_masterlistofbillings` WHERE capex_number='$TriggerCapex'");
    $selectbillType->execute();
    while($maxbilltype = $selectbillType->fetch(PDO::FETCH_ASSOC)){
        $billtype= $maxbilltype['tb'];        
    }
    $tb = $billtype - 1;
 ?>

 <!-- Large modal -->  
        <div class="modal fade bd-example-modal-lg" id="BillingModal<?php echo $TriggerCapex ?>$<?php echo $ProjectName ?>$<?php echo $Contractor?>$<?php echo $TotalAmt?>$<?php echo $DownPayment?>$<?php echo $RetentionPayment?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div id="AlertForSuccess"></div>
                    <div class="modal-header">                   
                        <h5 class="modal-title">Payment Details</php></h5>
                       
                    </div>
                    <div class="modal-body" style="background-color:#d7e1f3">
                    <?php 
                        $stmts = $Computations->runQuery("CALL `Payment_modal`(:_TriggerCapex)");
                        $stmts->bindParam(':_TriggerCapex', $TriggerCapex);
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
                        $Scopes = $rows['scope'];
                        $ScopesAmount = $rows['scope_amount'];
                        $ScopesWeight = $Weight;
                        $ScopesProgress = $rows['percent'];
                        $ScopesEquivWeight = $equiv;
                        $ScopesTotalAmount =  $TotalAmt;   
                        }
                        
                    ?>
                    <?php
                    
                        $a = array_sum($Totalamtsum);
                        $TotalAmount = number_format(($a),2);
                        // echo $TotalAmount;

                        $ew = array_sum($TotalEquiv);
                        $EquivalentWeight = number_format(($ew),2);
                        // echo $ew;
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
                            $TotalDeduction = $PreFloat+$DPRT;
                          
                                 $TAmountRemovecomma = str_replace(',', '', $a);
                                 $FinalDeduction = $TAmountRemovecomma - $TotalDeduction;
                           
                                 echo ''.'RT'. $TotalRT .''.' --- '.'DP'.  $TotalDp; 
                                 echo ''.' --- '.'Progress'.$floatEquivWeight;
                                 

                        // echo $Pre;
                        
                    ?>
                     
                    <form method="POST" action="">
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
                                <input type="text" name="BillingType" class="form-control" id="BillingType" placeholder=""  value="Progress Billing <?php echo $tb?>" readonly>
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
                                    <input type="hidden" name="" id="billing_status" value="0">
                                </div>
                            </div> 
                            <br>
                            <div align="right">                
                            <button class="btn btn-danger" data-dismiss="modal" id="Close"><b>X</b></button>
                            <button class="btn btn-success" type="submit" id="save">Generate Billing</button>   
                            </div>
                             <!-- dito computation ng sum of total amount, equiv weight-->
                        </form> 
                                                    
                    </div>
                </div>
            </div>
        </div>
<!-- Large modal modal end -->

<script>
$(document).ready(function ($) {
    $("#save").click(function (e) {
        e.preventDefault();
        var r = confirm("Are You sure? You want to Generate this billing?");
            if (r == true) {
            var CapexNumber = $('#CapexNumber').val();
            var PreparedDate = $('#PreparedDate').val();
            var ProjectName = $('#ProjectName').val();
            var ContractorName = $('#ContractorName').val();

            var ContractAmt = $('#ContractAmt').val();
            var BillingType = $('#BillingType').val();
            var ProjectProgress = $('#ProjectProgress').val();
            var Amount = $('#Amount').val();
            var BillableAmount = $('#BillbleAmount').val();
            var billing_status = $('#billing_status').val();                    
                $.ajax({
                type: "POST",
                url: "Computations/PostingToClass.php",
                data: {CapexNumber:CapexNumber, PreparedDate:PreparedDate, ProjectName:ProjectName, ProjectName:ProjectName,
                        ContractorName:ContractorName, ContractAmt:ContractAmt, BillingType:BillingType, ProjectProgress:ProjectProgress,
                        Amount:Amount, BillableAmount:BillableAmount, billing_status:billing_status},
                success: function (msg) {
                    $("#AlertSucess").html(msg);
                    $("#Close").click();
                }       
            });
        }
        else{
            location.reload();
        }
    });
});

$( "#Close" ).click(function() {
    setTimeout(function(){
        window.location.reload(1);
    reloadData();
    }, 5000);
    
});

</script>
