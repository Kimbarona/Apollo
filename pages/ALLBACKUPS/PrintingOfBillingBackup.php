<?php
session_start();
require_once("GlobalClass.php");
$GlobalConnection = new GlobalConnection();
$TriggerCapex = ($_GET['equiv']);



?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="../assets/css/bootstrap.min.css">

<style>
            @page { 
              size:80%;  margin: 0mm; margin-left: 0px; margin-right: 0px; margin-top:20px;
            }
            @media all{
            printed-div{
                display:none;
            }
            }

            @media print{
            printed-div{
                display:block;
            }
            .logo-print{
                width:160px;
                height:100px;
                display: list-item;
                /* list-style-image: url(../assets/images/logoprint.png); */
                list-style-image: url(printinglogo.png);
                list-style-position: inside;
            }
            }
            .txtFormat {
                font-family: century gothic;
                line-height: 28px;
            }
            .txtInside {
                font-family: century gothic;
                line-height: 28px;
                font-size: 14px;
            }
            .txtoutside {
                font-family: century gothic;
                line-height: 5px;
                font-size: 14px;
            }
            .SmallText {
                font-family: century gothic;
                line-height: 5px;
                font-size: 10px;
            }
            .ProgressbillText {
                font-family: century gothic;
                line-height: 18px;
                font-size: 12px;
            }
            
</style>
</head>
    <body>
    <p class="txtFormat"> 
<?php
// $rows = array();
if(!empty($_GET['id'])){
    // Include the database configuration file
 
    
    // Get the user's ID from the URL
    $IdOfBilling = $_GET['id'];
   
   
    // Fetch the user data based on the ID
    $bill = $GlobalConnection->runQuery("SELECT apollo_enrolledproject.project_name, apollo_enrolledproject.ecost, apollo_enrolledproject.contractor,
       apollo_enrolledproject.capex_number, apollo_enrolledproject.startdate, apollo_enrolledproject.end_date, apollo_masterlistofbillings.billing_type,
       apollo_masterlistofbillings.billing_status, apollo_masterlistofbillings.billable_amount, apollo_masterlistofbillings.progress, apollo_masterlistofbillings.contract_amount,
       apollo_enrolledproject.dpayment,apollo_enrolledproject.project_retention, apollo_enrolledproject.proponent, apollo_enrolledproject.engineer, apollo_enrolledproject.payee, apollo_masterlistofbillings.billing_date, SUM(apollo_project_assigned_scopes.numdays) AS numdays
       FROM `apollo_enrolledproject` INNER JOIN apollo_masterlistofbillings ON apollo_enrolledproject.capex_number=apollo_masterlistofbillings.capex_number 
       INNER JOIN apollo_project_assigned_scopes ON apollo_project_assigned_scopes.capex_number=apollo_masterlistofbillings.capex_number
       WHERE apollo_masterlistofbillings.billingNumber =' $IdOfBilling'");
    $bill->execute();
 
  
    while($rows = $bill->fetch(PDO::FETCH_ASSOC)){
       ?>
        <!-- Render the user details -->
            <div class="container">
           <br>
                <!-- <h2>User Details</h2> -->
                <?php if(!empty($IdOfBilling)){ 
                    if($rows['billing_type']=='Initial Payment'){                  
                    ?>
                    <BR>    
                     <div class="logo-print">
                     </div>
                    <BR><BR>  
                    <div>
                    <p colspan="2" class="txtFormat" align="center" style="font-size:18px "><B>INITIAL PAYMENT - <?php echo number_format($rows["progress"])?>% of Total Contract Cost</b></p>
                    </div>
                                    <div class="table-responsive" id="TableCostDetails">
                                        <table class="table  table-striped" border="1" >               
                                                    <tr>                                       
                                                        <td colspan="6" class="txtInside">
                                                            Project &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   
                                                            &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            :&nbsp; <b><?php echo $rows["project_name"]?></b>&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;CAPEX No&nbsp;:&nbsp; <b><?php echo $rows["capex_number"]?></b> <br>
                                                            Contract Price &nbsp; &nbsp; &nbsp;&nbsp; 
                                                            &nbsp; &nbsp;&nbsp; &nbsp;
                                                            :&nbsp; <b>Php<?php echo $rows["contract_amount"]?>.00</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Scope of Works&nbsp;:&nbsp;<b>Labor & Materials</b><br>
                                                            Start of Construction &nbsp; &nbsp;&nbsp;:&nbsp;
                                                            <?php 
                                                             $newDate = $rows['startdate'];
                                                             $tstamp =  strtotime($newDate);
                                                             $old_date = date('l, F d Y', $tstamp); 
                                                             echo  $old_date;
                                                            ?>
                                                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
                                                            &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Projected Completion&nbsp;:&nbsp;
                                                            <?php 
                                                             $newEndDate = $rows['end_date'];
                                                             $tstampEnd =  strtotime($newEndDate);
                                                             $end_date = date('l, F d Y', $tstampEnd); 
                                                             echo  $end_date;
                                                            ?>
                                                            <br>
                                                            &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Duration&nbsp;: <b><?php echo $rows['numdays']?> Days</b>&nbsp;<br>                
                                                            Name of Contractor &nbsp; &nbsp; 
                                                            :&nbsp;<?php echo $rows["contractor"]?> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Address&nbsp;:&nbsp; Not Available<br>
                                                            <b>Payee</b> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
                                                             &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;:
                                                             &nbsp;<b><?php echo strtoupper($rows['payee']) ?></b> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact No.&nbsp;:&nbsp; Not Available<br>
                                                            Date Prepared &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                                            &nbsp;:&nbsp;
                                                            <?php 
                                                                $date_prep = $rows['billing_date'];
                                                                $now = new DateTime($date_prep);
                                                                $timestring = $now->format('l, F d Y');
                                                                echo $timestring;
                                                            ?>
                                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;Billing Submission Date.&nbsp;:&nbsp; <b><?php echo date('l, F d Y');?></b><br>
                                                            &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Payment Needed On</b>&nbsp;:&nbsp; <b><?php echo date('l, F d Y');?></b>                                                      
                                                        </td>                                                    
                                                    </tr>  
                                        </table >
                                        <table class="table  table-striped" border="2" >  
                                                    <tr>
                                                        <td class="txtInside" colspan="4" rowspan="2"><b><center>Particulars</center></b></td>
                                                        
                                                        <td class="txtInside" colspan="2" rowspan="2"><center><b>Contract Amount</center></b></td>
                                                        
                                                        <td class="txtInside" colspan="3"><b><center>Billing Update (in %)</center></b></td>
                                                       
                                                        <td></td>
                                                        <td class="txtInside"  colspan="2" rowspan="2"><b><center>Amount</center></b></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                                                                               
                                                        
                                                        <td class="txtInside"><b><center>Prev</center></b></td>
                                                        <td class="txtInside"><b><center>This Period</center></b></td>
                                                        <td class="txtInside"><b><center>To Date</center></b></td>
                                                        <td></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="txtInside" colspan="4" rowspan="3"><center><?php echo $rows['project_name']?></center></td>
                                                     
                                                        <td class="txtInside" colspan="2" rowspan="3"><center><b>Php <?php echo $rows['contract_amount']?>.00</b></center></td>
                                                       
                                                        <td class="txtInside" rowspan="3"><center><b>0%</b></center></td>
                                                        <td class="txtInside" rowspan="3"><center><b>30%</b></center></td>
                                                        <td class="txtInside" rowspan="3"><center><b>30%</b></center></td>
                                                        <td></td>
                                                        <td class="txtInside" rowspan="3" colspan="2"><center><b>Php <?php echo (number_format($rows['billable_amount'],2))?></b></center></td>
                                                    </tr>
                                                    <tr>                                                       
                                                        
                                                        <td></td>
                                                       
                                            
                                                    </tr>
                                                    <tr>
                                                                                                               
                                                        <td></td>
                                                                                                               
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" class="txtInside"> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;  <b>TOTAL BILLABLE AMOUNT</b></td>
                                                       
                                                    
                                                        <td class="txtInside"><center><b>30.00%</b></center></td>
                                                        <td></td>
                                                        <td class="txtInside" colspan="2"><center><b>Php <?php echo (number_format($rows['billable_amount'],2))?></b></center></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="txtInside" colspan="5">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; <b>Amount in Words</b></td>
                                                       
                                                        <td class="txtInside" colspan="7"><center>
                                                        <b>
                                                            <?php
                                                                $billings = $rows['billable_amount'];
                                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                                $res =  $f->format($billings);
                                                                echo ucwords($res);
                                                            ?> Pesos Only
                                                        </b>
                                                        </center></td>
                                                        
                                                    </tr>
                                        </table>
                                        <table class="table  table-striped" border="2">
                                                    <tr>
                                                        <td class="txtInside" colspan="12"><b>Remarks :</b></td>
                                                    
                                                    </tr>
                                                   
                                        </table>
                                        <table class="table  table-striped" border="2">
                                                    <tr>
                                                        <td class="txtInside" colspan="4">PREPARED BY:
                                                            <BR><br>
                                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                                            ENGINEERING OFFICER
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">NOTED BY:
                                                           <BR><br>
                                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                                            HEAD, SALES & MARKETING
                                                            </td>

                                                        <td class="txtInside" colspan="4">PROCESSED BY:
                                                            <BR><br>
                                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                                        </td>
                                                       
                                                    </tr>
                                                    <tr>
                                                        <td class="txtInside" colspan="4">CERTIFY BY:
                                                            <BR><br>
                                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">CHECKED BY:
                                                            <BR><br>
                                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                                            MANAGER, PURCHASING
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">APPROVED BY:
                                                            <BR><br>
                                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                                            CHIEF OPERATING OFFICER
                                                        </td>                              
                                                    </tr>                                               
                                        </table>
                                    </div>
                    
                <?php 
                }
                elseif($rows['billing_type']=='Retention Payment'){ 
                    ?>
                       
                        <div class="logo-print"></div><br><BR> 
                        <div>
                        <p colspan="2" class="txtFormat" align="center" style="font-size:18px "><B>RETENTION PAYMENT - 10% of Total Contract Cost</b></p>
                        </div>
                            <div class="table-responsive" id="TableCostDetails">
                                <table class="table  table-striped" border="2" >
                                    <tr>
                                        <td colspan="12" class="txtInside">
                                           Project Name &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                           :   &nbsp; &nbsp;<?php echo $rows["project_name"]?>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;PR: <input type="text">
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; RR: <input type="text"><br>
                                           CAPEX No. &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;
                                            &nbsp;<?php echo $rows["capex_number"]?>&nbsp;&nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp;PO: <input type="text"><br>
                                           Contract Price &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; 
                                           Php<?php echo $rows["contract_amount"]?>.00 &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           Billing Submission Date :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?><br>
                                           Name of Contractor &nbsp; :&nbsp;<?php echo $rows["contractor"]?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           Date Prepared :&nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php
                                            $date_prep = $rows['billing_date'];
                                            $now = new DateTime($date_prep);
                                            $timestring = $now->format('l, F d Y');
                                            echo $timestring;
                                            ?><br>
                                           <b>Payee &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($rows['payee']) ?>
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;
                                           Payment Needed on :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?></b> 
                                        </td>
                                    </tr>
                                </table><br>
                                <p class="txtoutside"><b>Progress Billing Computations</b></p>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td rowspan="2" class="txtInside"><center><b>Item</b></center></td>
                                        <td colspan="3" rowspan="2" class="txtInside"><center><b>Description</b></center></td>
                                        
                                        <td colspan="2" rowspan="2" class="txtInside"><center><b>Amount</b></center></td>
                                        <td rowspan="2" class="txtInside"><center><b>Weight</b></center></td>
                                        <td colspan="3" class="txtInside"><center><b>Accomp</b></center></td>
                                        
                                        <td rowspan="2" class="txtInside"><center><b>Equiv. Wt</b></center></td>
                                        <td rowspan="2" class="txtInside"><center><b>Amount</b></center></td>
                                    </tr>
                                    <tr>
                                        
                                        
                                        
                                        
                                        
                                        <td class="txtInside"><center><b>Prev</b></center></td>
                                        <td class="txtInside"><center><b>This Period</b></center></td>
                                        <td class="txtInside"><center><b>To Date</b></center></td>
                                    </tr>
                                    <tr>
                                        <td class="txtInside"><center>I</center></td>
                                        <td colspan="3" class="txtInside">Progress of Project</td>
                                        <td colspan="2" class="txtInside"><?php echo $rows['contract_amount']?>.00</td>
                                        <td class="txtInside">100.00%</td>
                                        <td class="txtInside">100.00%</td>
                                        <td></td>
                                        <td class="txtInside">100.00%</td>
                                        <td></td>
                                        <td class="txtInside">100.00%</td>
                                    </tr>
                                    <tr>
                                        <td colspan="10" class="txtInside">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                       
                                            <b>COMPLETED AMOUNT</b></td>
                                        
                                        <td class="txtInside"><b>100.00%</b></td>
                                        <td class="txtInside"><center><b><?php echo $rows['contract_amount']?>.00</b></center></td>
                                    </tr>
                                    <tr>
                                        <td class="txtInside"><center>II</center></td>
                                        <td colspan="3" class="txtInside">Less Standard Deductions</td>
                                        <td colspan="2"></td>                                       
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="txtInside"><center>Downpayment</center></td>
                                       
                                        <td colspan="2" class="txtInside"><center><?php echo number_format(($rows['dpayment']),2)?></center></td>
                                        
                                        <td class="txtInside"><center>30.00%</center></td>
                                        <td class="txtInside"><center>100.00%</center></td>
                                        <td class="txtInside"><center>0.00%</center></td>
                                        <td class="txtInside"><center>100.00%</center></td>
                                        <td class="txtInside"><center>30.00%</center></td>
                                        <td class="txtInside"><center><?php echo number_format(($rows['dpayment']),2)?></center></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="txtInside"><center>Less Previous Billings</center></td>
                                       
                                        <td colspan="2"></td>
                                        
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    $capex = $rows['capex_number'];
                                        $Previousbill = $GlobalConnection->runQuery("SELECT * FROM apollo_progressbillinglist where capex_number ='$capex'");
                                        $Previousbill->execute();                                             
                                        while($RowPrev = $Previousbill->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        
                                            <tr>
                                                <td colspan="10" class="txtInside"><div align="right">
                                                <?php 
                                                
                                                    $locale = 'en_US';
                                                    $nf = new NumberFormatter($locale, NumberFormatter::ORDINAL);
                                                    echo $nf->format($i);
                                                    $i++;
                                                ?> Billing
                                                </div></td>
                                                <td class="txtInside">
                                                    <?php 
                                                     $ca = $RowPrev['contract_amount'];
                                                     $ba = $RowPrev['billable_amount'];
                                                     $var = floatval(preg_replace('/[^\d.]/', '', $ca));
                                                     $Total = $ba/$var *100;
                                                     echo number_format(($Total),2);
                                                     
                                                    ?>%
                                                </td class="txtInside">
                                                <td>
                                                    <?php 
                                                    echo (number_format($RowPrev['billable_amount'],2));
                                                   
                                                    ?>
                                                </td>                                           
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    <tr>
                                        <td colspan="10" class="txtInside"><div align="right"><b>TOTAL DEDUCTIONS</b></div></td>
                                        <td class="txtInside"><center><b>90.00%</b></center></td>
                                        <td class="txtInside"><center><b><?php echo $rows['project_retention'] ?>.00</b></center></td>
                                    </tr>
                                   
                                </table>
                                <table  class="table  table-striped" border="2">
                                    <tr>
                                        <td colspan="10" class="txtInside"><b><div align="right">TOTAL BILLABLE AMOUNT</div></b></td>
                                      
                                        <td class="txtInside"><center><b>10.00%</b></center></td>
                                        <td class="txtInside"><center><b><?php echo $rows['project_retention']?>.00</b></center></td>
                                    </tr>
                                    <tr>
                                        <td colspan="10" class="txtInside"><b><div align="right">Amount in Words</div></b></td>
                                        
                                        <td colspan="2" class="txtInside"><center>
                                        <b>
                                            <?php
                                                $billings = $rows['billable_amount'];
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $res =  $f->format($billings);
                                                echo ucwords($res);
                                            ?> Pesos Only
                                        </b>
                                        </center></td>
                                        
                                    </tr>
                                </table>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td class="txtInside" colspan="4">PREPARED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                            ENGINEERING OFFICER
                                        </td>
                                        
                                        <td class="txtInside" colspan="4">NOTED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                            HEAD, SALES & MARKETING
                                            </td>

                                        <td class="txtInside" colspan="4">PROCESSED BY:
                                            <BR>
                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="txtInside" colspan="4">CERTIFY BY:
                                            <BR>
                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                        </td>
                                        
                                        <td class="txtInside" colspan="4">CHECKED BY:
                                            <BR>
                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                            MANAGER, PURCHASING
                                        </td>
                                        
                                        <td class="txtInside" colspan="4">APPROVED BY:
                                            <BR>
                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                            CHIEF OPERATING OFFICER
                                        </td>                              
                                    </tr>                                               
                                </table>
                            </div>

                   <?php 
                }
                elseif($rows['billing_type']=='Progress Billing 1'){ 
                    ?>                       
                        <div class="logo-print"></div><BR>   
                        <div>
                        <p colspan="2" class="txtFormat" align="right" style="font-size:18px "><B>PROGRESS BILLING NO. 1</b></p>
                        </div>
                            <div class="table-responsive" id="TableCostDetails">
                                <table class="table  table-striped" border="2" >
                                    <tr>
                                        <td colspan="12" class="ProgressbillText">
                                           Project Name &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                           :   &nbsp; &nbsp;<?php echo $rows["project_name"]?>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;PR: <input type="text">
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; RR: <input type="text"><br>
                                           CAPEX No. &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;
                                            &nbsp;<?php echo $rows["capex_number"]?>&nbsp;&nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp;PO: <input type="text"><br>
                                           Contract Price &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; 
                                           <b>Php<?php echo $rows["contract_amount"]?></b>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           Billing Submission Date :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?><br>
                                           Name of Contractor &nbsp; :&nbsp;<?php echo $rows["contractor"]?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           Date Prepared :&nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php
                                            $date_prep = $rows['billing_date'];
                                            $now = new DateTime($date_prep);
                                            $timestring = $now->format('l, F d Y');
                                            echo $timestring;
                                            ?><br>
                                           <b>Payee &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($rows['payee']) ?>
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;
                                           Payment Needed on :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?></b> 
                                        </td>
                                    </tr>
                                </table>
                             
                                <table class="table  table-striped" border="2">
                               
                                                <tr>
                                                    <td rowspan="2" class="SmallText"><center><b>Item</b></center></td>
                                                    <td colspan="3" rowspan="2" class="SmallText"><center><b>Description</b></center></td>                                                    
                                                    <td colspan="2" rowspan="2" class="SmallText"><center><b>Amount</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Weight</b></center></td>
                                                    <td colspan="3" class="SmallText"><center><b>Accomp</b></center></td>                                                   
                                                    <td rowspan="2" class="SmallText"><center><b>Equiv. Wt</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Total Amount</b></center></td>
                                                </tr>                                        
                                                    <td class="SmallText"><center><b>Prev</b></center></td>
                                                    <td class="SmallText"><center><b>This Period</b></center></td>
                                                    <td class="SmallText"><center><b>To Date</b></center></td>
                                                </tr>
                                                <tr>
                                                <?php
                                                    $capex = $rows['capex_number'];
                                                    $i = 1;
                                                            function ConverToRoman($num){ 
                                                                $n = intval($num); 
                                                                $res = ''; 
                                                            
                                                                //array of roman numbers
                                                                $romanNumber_Array = array( 
                                                                    'M'  => 1000, 
                                                                    'CM' => 900, 
                                                                    'D'  => 500, 
                                                                    'CD' => 400, 
                                                                    'C'  => 100, 
                                                                    'XC' => 90, 
                                                                    'L'  => 50, 
                                                                    'XL' => 40, 
                                                                    'X'  => 10, 
                                                                    'IX' => 9, 
                                                                    'V'  => 5, 
                                                                    'IV' => 4, 
                                                                    'I'  => 1); 
                                                            
                                                                foreach ($romanNumber_Array as $roman => $number){ 
                                                                    //divide to get  matches
                                                                    $matches = intval($n / $number); 
                                                            
                                                                    //assign the roman char * $matches
                                                                    $res .= str_repeat($roman, $matches); 
                                                            
                                                                    //substract from the number
                                                                    $n = $n % $number; 
                                                                } 
                                                            
                                                                // return the result
                                                                return $res;                             
                                                            
                                                            } 
                                                 
                                                               
                                                        $ProgressBilling = $GlobalConnection->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount,apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent,
                                                        apollo_billing_history.scopes_progress,apollo_billing_history.equivalent_weight,apollo_billing_history.total_amount  
                                                        FROM apollo_laborandmaterialcost_list 
                                                        LEFT JOIN apollo_project_assigned_scopes 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number)
                                                        AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
                                                        INNER JOIN apollo_billing_history 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_billing_history.capex_number) 
                                                        AND (apollo_laborandmaterialcost_list.scope=apollo_billing_history.scopes)
                                                        WHERE apollo_laborandmaterialcost_list.capex_number = '$capex' 
                                                        AND apollo_billing_history.billing_type = 'Progress Billing 1' 
                                                        GROUP BY apollo_laborandmaterialcost_list.scope");
                                                        $ProgressBilling->execute();                                             
                                                        while($RowProgressBill = $ProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $RowProgressBill['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                            $FloatCa = (float)$RemoveComma;
                                                        
                                                            $ScopeAmount = $RowProgressBill['scope_amount'];
                                                            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                                                            $FloatSa = (float)$ScopeRemoveComma;
                                                            $Weight = $FloatSa / $FloatCa * 100;
                                                            
                                                            // for equiv weight         
                                                            $Percentage = $RowProgressBill['percent'];  
                                                            $equiv =  $Percentage * $Weight / 100;  
                                                            
                                                            //    for equiv weight  
                                                            $TotalAmt = $equiv / $Weight * $FloatSa;  
                                                            $Totalamtsum[]=$TotalAmt;
                                                            $TotalEquiv[]=$equiv;
                                                            ?>
                                                            <td class="SmallText">
                                                                <center>
                                                                <?php                                                                   
                                                                    echo ConverToRoman($i);
                                                                    $i++;                                                                    
                                                                ?>
                                                                </center>
                                                            </td>   
                                                                <td colspan="3" class="SmallText"><?php echo $RowProgressBill['scope']?></td>
                                                                <td colspan="2" class="SmallText"><?php echo $RowProgressBill['scope_amount']?></td>
                                                                <td class="SmallText">
                                                                    <?php 
                                                                        // $sa = $RowProgressBill['scope_amount'];
                                                                        // $saconvert = (float)$sa;
                                                                        // $ca = $RowProgressBill['contract_amount'];
                                                                        // $caconvert = (float)$ca;
                                                                        // $Weight = $saconvert / $caconvert*100;
                                                                        $ew = (array_sum($TotalEquiv));
                                                                        $EquivalentWeight = number_format(($ew),2); 
                                                                        echo $EquivalentWeight ;
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">0.00%</td>
                                                                <td class="SmallText">
                                                                <!-- for this period -->
                                                                    <?php
                                                                        $thisperiod = 100 - 0;
                                                                        echo number_format(($RowProgressBill['scopes_progress']),2);
                                                                    ?>%     
                                                                </td>
                                                                <td class="SmallText">
                                                                     <?php
                                                                        $todate = 100 + 0;
                                                                        echo number_format(($RowProgressBill['scopes_progress']),2);
                                                                    ?>%                                                       
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php                                        
                                                                        echo number_format(($RowProgressBill['equivalent_weight']),2);                                                                
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText"><?php echo number_format(($RowProgressBill['total_amount']),2);  ?></td>
                                                            </tr>
                                                        <?php
                                                      
                                                        }
                                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="SmallText"></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td  colspan="4" class="SmallText"><div align="right"><b>CONTRACT AMOUNT</b></div></td>
                                        <td colspan="2" class="SmallText"><B><?php echo $rows['contract_amount']?></B></td>
                                        <td class="SmallText"><b>100.00%</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="SmallText"><b><?php echo $rows['progress']; ?>%</b></td>
                                        <td class="SmallText"><b>  
                                        <?php                                                            
                                            $a = array_sum($Totalamtsum);
                                            $TotalAmount = number_format(($a),2);
                                            echo $TotalAmount;                                                                                                                             
                                        ?>
                                        </b>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                      
                                        <td colspan="12" class="SmallText"><DIV align="left"><b>PROGRESS BILLING COMPUTATIONS</b></DIV></td>
                                       
                                        
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center>I</center></td>
                                        <td colspan="3" class="SmallText">Less Standard Deductions</td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Downpayment</center></td>
                                        <td colspan="2" class="SmallText"><?php echo (number_format($rows['dpayment'], 2)) ?></td>
                                        <td class="SmallText">30.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php 
                                                $downpro = 30;
                                                $billprogress = $rows['progress'];
                                                $eqpr = $downpro * $billprogress /100;
                                                echo (number_format(($eqpr),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php 
                                                $dp = $rows['dpayment'];
                                                $convertdp = str_replace(',', '', $dp);
                                                $tamount = $eqpr/30*$dp;
                                                echo (number_format(($tamount),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Retention (10%)</center></td>
                                        <td colspan="2" class="SmallText">
                                            <?php 
                                                $a = $rows['project_retention'];
                                                $removecom = str_replace(',', '', $a);
                                                echo (number_format(($removecom),2));
                                            ?></td>
                                        <td class="SmallText">10.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php
                                                $rtpro = 10;
                                                $billprogress = $rows['progress'];
                                                $eqrt = $rtpro * $billprogress /100;
                                                echo (number_format(($eqrt),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php
                                                 $rtp = $rows['project_retention'];
                                                 $convertrtp = str_replace(',', '', $rtp);
                                                 $tamountrtp = $eqrt/10*$convertrtp;
                                                 echo (number_format(($tamountrtp),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><b>Note:Applied on 100% project comp</b></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText"><center>II</center></td>
                                        <td colspan="3" class="SmallText"><center>Less Previous Billings</center></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText" colspan="11" ><div align="right"></div></td>                                       
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText" colspan="11" ><div align="right"><b>TOTAL BILLABLE AMOUNT</b></div></td>                                       
                                        <td class="SmallText"><b><?php echo (number_format(($rows['billable_amount']),2)) ?></b></td>
                                    </tr>
                                    <tr> 
                                       <td colspan="4" class="SmallText"><div align="right"><b>Amount In Words</b></div></td>
                                       <td colspan="8" class="SmallText">
                                           <center><b> <?php
                                                $billings = $rows['billable_amount'];
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $res =  $f->format($billings);
                                                echo ucwords($res);
                                            ?> Pesos Only</center></b>
                                       </td>
                                       
                                    </tr>
                                    <tr> 
                                       <td colspan="12" class="SmallText"><div align="left"><b>Remarks:</b></div></td>
                                      
                                    </tr>
                                </table>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">PREPARED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                            ENGINEERING OFFICER
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">NOTED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                            HEAD, SALES & MARKETING
                                            </td>

                                        <td class="ProgressbillText" colspan="4">PROCESSED BY:
                                            <BR>
                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">CERTIFY BY:
                                            <BR>
                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">CHECKED BY:
                                            <BR>
                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                            MANAGER, PURCHASING
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">APPROVED BY:
                                            <BR>
                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                            CHIEF OPERATING OFFICER
                                        </td>                              
                                    </tr>                                               
                                </table>
                            </div>

                   <?php 
                }

                elseif($rows['billing_type']=='Progress Billing 2'){ 
                    ?>                       
                        <div class="logo-print"></div><BR>   
                        <div>
                        <p colspan="2" class="txtFormat" align="right" style="font-size:18px "><B>PROGRESS BILLING NO. 2</b></p>
                        </div>
                            <div class="table-responsive" id="TableCostDetails">
                                <table class="table  table-striped" border="2" >
                                    <tr>
                                        <td colspan="12" class="ProgressbillText">
                                           Project Name &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                           :   &nbsp; &nbsp;<?php echo $rows["project_name"]?>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;PR: <input type="text">
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; RR: <input type="text"><br>
                                           CAPEX No. &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;
                                            &nbsp;<?php echo $rows["capex_number"]?>&nbsp;&nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp;PO: <input type="text"><br>
                                           Contract Price &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; 
                                           <b>Php<?php echo $rows["contract_amount"]?></b>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           Billing Submission Date :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?><br>
                                           Name of Contractor &nbsp; :&nbsp;<?php echo $rows["contractor"]?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           Date Prepared :&nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php
                                            $date_prep = $rows['billing_date'];
                                            $now = new DateTime($date_prep);
                                            $timestring = $now->format('l, F d Y');
                                            echo $timestring;
                                            ?><br>
                                           <b>Payee &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($rows['payee']) ?>
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;
                                           Payment Needed on :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?></b> 
                                        </td>
                                    </tr>
                                </table>
                             
                                <table class="table  table-striped" border="2">
                               
                                                <tr>
                                                    <td rowspan="2" class="SmallText"><center><b>Item</b></center></td>
                                                    <td colspan="3" rowspan="2" class="SmallText"><center><b>Description</b></center></td>                                                    
                                                    <td colspan="2" rowspan="2" class="SmallText"><center><b>Amount</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Weight</b></center></td>
                                                    <td colspan="3" class="SmallText"><center><b>Accomp</b></center></td>                                                   
                                                    <td rowspan="2" class="SmallText"><center><b>Equiv. Wt</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Total Amount</b></center></td>
                                                </tr>                                        
                                                    <td class="SmallText"><center><b>Prev</b></center></td>
                                                    <td class="SmallText"><center><b>This Period</b></center></td>
                                                    <td class="SmallText"><center><b>To Date</b></center></td>
                                                </tr>
                                                <tr>
                                                <?php
                                                    $capex = $rows['capex_number'];
                                                    $i = 1;
                                                            function ConverToRoman($num){ 
                                                                $n = intval($num); 
                                                                $res = ''; 
                                                            
                                                                //array of roman numbers
                                                                $romanNumber_Array = array( 
                                                                    'M'  => 1000, 
                                                                    'CM' => 900, 
                                                                    'D'  => 500, 
                                                                    'CD' => 400, 
                                                                    'C'  => 100, 
                                                                    'XC' => 90, 
                                                                    'L'  => 50, 
                                                                    'XL' => 40, 
                                                                    'X'  => 10, 
                                                                    'IX' => 9, 
                                                                    'V'  => 5, 
                                                                    'IV' => 4, 
                                                                    'I'  => 1); 
                                                            
                                                                foreach ($romanNumber_Array as $roman => $number){ 
                                                                    //divide to get  matches
                                                                    $matches = intval($n / $number); 
                                                            
                                                                    //assign the roman char * $matches
                                                                    $res .= str_repeat($roman, $matches); 
                                                            
                                                                    //substract from the number
                                                                    $n = $n % $number; 
                                                                } 
                                                            
                                                                // return the result
                                                                return $res;                             
                                                            
                                                            } 
                                                 
                                                               
                                                        $ProgressBilling = $GlobalConnection->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount,apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent,
                                                        apollo_billing_history.scopes_progress,apollo_billing_history.equivalent_weight,apollo_billing_history.total_amount
                                                        FROM apollo_laborandmaterialcost_list 
                                                        LEFT JOIN apollo_project_assigned_scopes 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number)
                                                        AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
                                                        INNER JOIN apollo_billing_history 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_billing_history.capex_number) 
                                                        AND (apollo_laborandmaterialcost_list.scope=apollo_billing_history.scopes)
                                                        WHERE apollo_laborandmaterialcost_list.capex_number = '$capex' 
                                                        AND apollo_billing_history.billing_type = 'Progress Billing 2' 
                                                        GROUP BY apollo_laborandmaterialcost_list.scope");
                                                        $ProgressBilling->execute();                                             
                                                        while($RowProgressBill = $ProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $RowProgressBill['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                            $FloatCa = (float)$RemoveComma;
                                                        
                                                            $ScopeAmount = $RowProgressBill['scope_amount'];
                                                            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                                                            $FloatSa = (float)$ScopeRemoveComma;
                                                            $Weight = $FloatSa / $FloatCa * 100;
                                                            
                                                            // for equiv weight         
                                                            $Percentage = $RowProgressBill['percent'];  
                                                            $equiv =  $Percentage * $Weight / 100;  
                                                            
                                                            //    for equiv weight  
                                                            $TotalAmt = $equiv / $Weight * $FloatSa;  
                                                            $Totalamtsum[]=$TotalAmt;
                                                            $TotalEquiv[]=$equiv;
                                                            ?>
                                                            <td class="SmallText">
                                                                <center>
                                                                <?php                                                                   
                                                                    echo ConverToRoman($i);
                                                                    $i++;                                                                    
                                                                ?>
                                                                </center>
                                                            </td>   
                                                                <td colspan="3" class="SmallText"><?php echo $RowProgressBill['scope']?></td>
                                                                <td colspan="2" class="SmallText"><?php echo $RowProgressBill['scope_amount']?></td>
                                                                <td class="SmallText">
                                                                    <?php 
                                                                        // $sa = $RowProgressBill['scope_amount'];
                                                                        // $saconvert = (float)$sa;
                                                                        // $ca = $RowProgressBill['contract_amount'];
                                                                        // $caconvert = (float)$ca;
                                                                        // $Weight = $saconvert / $caconvert*100;
                                                                        $ew = (array_sum($TotalEquiv));
                                                                        $EquivalentWeight = number_format(($ew),2); 
                                                                        echo $EquivalentWeight ;
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php
                                                                        $todate = $RowProgressBill['scopes_progress'];
                                                                        $tdate = 100-$todate;
                                                                        echo number_format(($tdate),2);
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                <!-- for this period -->
                                                                    <?php
                                                                        echo number_format(($RowProgressBill['scopes_progress']),2);
                                                                    ?>%     
                                                                </td>
                                                                <td class="SmallText">
                                                                     <?php
                                                                       $tperiod = $RowProgressBill['scopes_progress'];
                                                                       $tdate = 100-$todate;
                                                                       $finalthisperiod = $tperiod + $tdate;
                                                                       echo number_format(($finalthisperiod),2);
                                                                    ?>%                                                     
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php                                        
                                                                        echo number_format(($RowProgressBill['equivalent_weight']),2);                                                         
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText"><?php echo number_format(($RowProgressBill['total_amount']),2) ?></td>
                                                            </tr>
                                                        <?php
                                                      
                                                        }
                                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="SmallText"></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td  colspan="4" class="SmallText"><div align="right"><b>CONTRACT AMOUNT</b></div></td>
                                        <td colspan="2" class="SmallText"><B><?php echo $rows['contract_amount']?></B></td>
                                        <td class="SmallText"><b>100.00%</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="SmallText"><b><?php echo $rows['progress']; ?>%</b></td>
                                        <td class="SmallText"><b>  
                                        <?php                                                            
                                            $a = array_sum($Totalamtsum);
                                            $TotalAmount = number_format(($a),2);
                                            echo $TotalAmount;                                                                                                                             
                                        ?>
                                        </b>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                      
                                        <td colspan="12" class="SmallText"><DIV align="left"><b>PROGRESS BILLING COMPUTATIONS</b></DIV></td>
                                       
                                        
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center>I</center></td>
                                        <td colspan="3" class="SmallText">Less Standard Deductions</td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Downpayment</center></td>
                                        <td colspan="2" class="SmallText"><?php echo (number_format($rows['dpayment'], 2)) ?></td>
                                        <td class="SmallText">30.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php 
                                                $downpro = 30;
                                                $billprogress = $rows['progress'];
                                                $eqpr = $downpro * $billprogress /100;
                                                echo (number_format(($eqpr),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php 
                                                $dp = $rows['dpayment'];
                                                $convertdp = str_replace(',', '', $dp);
                                                $tamount = $eqpr/30*$dp;
                                                echo (number_format(($tamount),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Retention (10%)</center></td>
                                        <td colspan="2" class="SmallText">
                                            <?php 
                                                $a = $rows['project_retention'];
                                                $removecom = str_replace(',', '', $a);
                                                echo (number_format(($removecom),2));
                                            ?></td>
                                        <td class="SmallText">10.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php
                                                $rtpro = 10;
                                                $billprogress = $rows['progress'];
                                                $eqrt = $rtpro * $billprogress /100;
                                                echo (number_format(($eqrt),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php
                                                 $rtp = $rows['project_retention'];
                                                 $convertrtp = str_replace(',', '', $rtp);
                                                 $tamountrtp = $eqrt/10*$convertrtp;
                                                 echo (number_format(($tamountrtp),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><b>Note:Applied on 100% project comp</b></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText"><center>II</center></td>
                                        <td colspan="3" class="SmallText"><center>Less Previous Billings</center></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    
                                    <?php
                                        $lessProgressBilling = $GlobalConnection->runQuery("SELECT * from apollo_progressbillinglist WHERE capex_number='$capex' and billing_type!='Progress Billing 2'");
                                        $lessProgressBilling->execute();                                             
                                        while($RowlessProgressBill = $lessProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        
                                        <tr> 
                                            <td class="SmallText" colspan="11" ><div align="right"><?php echo $RowlessProgressBill['billing_type']?></div></td>                                       
                                            <td class="SmallText"><?php echo (number_format(($RowlessProgressBill['billable_amount']),2))?></td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    
                                    <tr> 
                                        <td class="SmallText" colspan="11" ><div align="right"><b>TOTAL BILLABLE AMOUNT</b></div></td>                                       
                                        <td class="SmallText"><b><?php echo (number_format(($rows['billable_amount']),2)) ?></b></td>
                                    </tr>
                                    <tr> 
                                       <td colspan="4" class="SmallText"><div align="right"><b>Amount In Words</b></div></td>
                                       <td colspan="8" class="SmallText">
                                           <center><b> <?php
                                                $billings = $rows['billable_amount'];
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $res =  $f->format($billings);
                                                echo ucwords($res);
                                            ?> Pesos Only</center></b>
                                       </td>
                                       
                                    </tr>
                                    <tr> 
                                       <td colspan="12" class="SmallText"><div align="left"><b>Remarks:</b></div></td>
                                      
                                    </tr>
                                </table>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">PREPARED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                            ENGINEERING OFFICER
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">NOTED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                            HEAD, SALES & MARKETING
                                            </td>

                                        <td class="ProgressbillText" colspan="4">PROCESSED BY:
                                            <BR>
                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">CERTIFY BY:
                                            <BR>
                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">CHECKED BY:
                                            <BR>
                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                            MANAGER, PURCHASING
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">APPROVED BY:
                                            <BR>
                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                            CHIEF OPERATING OFFICER
                                        </td>                              
                                    </tr>                                               
                                </table>
                            </div>

                   <?php 
                }

                elseif($rows['billing_type']=='Progress Billing 3'){ 
                    ?>                       
                        <div class="logo-print"></div><BR>   
                        <div>
                        <p colspan="2" class="txtFormat" align="right" style="font-size:18px "><B>PROGRESS BILLING NO. 3</b></p>
                        </div>
                            <div class="table-responsive" id="TableCostDetails">
                                <table class="table  table-striped" border="2" >
                                    <tr>
                                        <td colspan="12" class="ProgressbillText">
                                           Project Name &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                           :   &nbsp; &nbsp;<?php echo $rows["project_name"]?>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;PR: <input type="text">
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; RR: <input type="text"><br>
                                           CAPEX No. &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;
                                            &nbsp;<?php echo $rows["capex_number"]?>&nbsp;&nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp;PO: <input type="text"><br>
                                           Contract Price &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; 
                                           <b>Php<?php echo $rows["contract_amount"]?></b>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           Billing Submission Date :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?><br>
                                           Name of Contractor &nbsp; :&nbsp;<?php echo $rows["contractor"]?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           Date Prepared :&nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php
                                            $date_prep = $rows['billing_date'];
                                            $now = new DateTime($date_prep);
                                            $timestring = $now->format('l, F d Y');
                                            echo $timestring;
                                            ?><br>
                                           <b>Payee &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($rows['payee']) ?>
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;
                                           Payment Needed on :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?></b> 
                                        </td>
                                    </tr>
                                </table>
                             
                                <table class="table  table-striped" border="2">
                               
                                                <tr>
                                                    <td rowspan="2" class="SmallText"><center><b>Item</b></center></td>
                                                    <td colspan="3" rowspan="2" class="SmallText"><center><b>Description</b></center></td>                                                    
                                                    <td colspan="2" rowspan="2" class="SmallText"><center><b>Amount</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Weight</b></center></td>
                                                    <td colspan="3" class="SmallText"><center><b>Accomp</b></center></td>                                                   
                                                    <td rowspan="2" class="SmallText"><center><b>Equiv. Wt</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Total Amount</b></center></td>
                                                </tr>                                        
                                                    <td class="SmallText"><center><b>Prev</b></center></td>
                                                    <td class="SmallText"><center><b>This Period</b></center></td>
                                                    <td class="SmallText"><center><b>To Date</b></center></td>
                                                </tr>
                                                <tr>
                                                <?php
                                                    $capex = $rows['capex_number'];
                                                    $i = 1;
                                                            function ConverToRoman($num){ 
                                                                $n = intval($num); 
                                                                $res = ''; 
                                                            
                                                                //array of roman numbers
                                                                $romanNumber_Array = array( 
                                                                    'M'  => 1000, 
                                                                    'CM' => 900, 
                                                                    'D'  => 500, 
                                                                    'CD' => 400, 
                                                                    'C'  => 100, 
                                                                    'XC' => 90, 
                                                                    'L'  => 50, 
                                                                    'XL' => 40, 
                                                                    'X'  => 10, 
                                                                    'IX' => 9, 
                                                                    'V'  => 5, 
                                                                    'IV' => 4, 
                                                                    'I'  => 1); 
                                                            
                                                                foreach ($romanNumber_Array as $roman => $number){ 
                                                                    //divide to get  matches
                                                                    $matches = intval($n / $number); 
                                                            
                                                                    //assign the roman char * $matches
                                                                    $res .= str_repeat($roman, $matches); 
                                                            
                                                                    //substract from the number
                                                                    $n = $n % $number; 
                                                                } 
                                                            
                                                                // return the result
                                                                return $res;                             
                                                            
                                                            } 
                                                 
                                                               
                                                        $ProgressBilling = $GlobalConnection->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount,apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent,apollo_billing_history.scopes_progress,
                                                        apollo_billing_history.equivalent_weight,apollo_billing_history.total_amount 
                                                        FROM apollo_laborandmaterialcost_list 
                                                        LEFT JOIN apollo_project_assigned_scopes 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number)
                                                        AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
                                                        INNER JOIN apollo_billing_history 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_billing_history.capex_number) 
                                                        AND (apollo_laborandmaterialcost_list.scope=apollo_billing_history.scopes)
                                                        WHERE apollo_laborandmaterialcost_list.capex_number = '$capex' 
                                                        AND apollo_billing_history.billing_type = 'Progress Billing 3' 
                                                        GROUP BY apollo_laborandmaterialcost_list.scope");
                                                        $ProgressBilling->execute();                                             
                                                        while($RowProgressBill = $ProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $RowProgressBill['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                            $FloatCa = (float)$RemoveComma;
                                                        
                                                            $ScopeAmount = $RowProgressBill['scope_amount'];
                                                            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                                                            $FloatSa = (float)$ScopeRemoveComma;
                                                            $Weight = $FloatSa / $FloatCa * 100;
                                                            
                                                            // for equiv weight         
                                                            $Percentage = $RowProgressBill['percent'];  
                                                            $equiv =  $Percentage * $Weight / 100;  
                                                            
                                                            //    for equiv weight  
                                                            $TotalAmt = $equiv / $Weight * $FloatSa;  
                                                            $Totalamtsum[]=$TotalAmt;
                                                            $TotalEquiv[]=$equiv;
                                                            ?>
                                                            <td class="SmallText">
                                                                <center>
                                                                <?php                                                                   
                                                                    echo ConverToRoman($i);
                                                                    $i++;                                                                    
                                                                ?>
                                                                </center>
                                                            </td>   
                                                                <td colspan="3" class="SmallText"><?php echo $RowProgressBill['scope']?></td>
                                                                <td colspan="2" class="SmallText"><?php echo $RowProgressBill['scope_amount']?></td>
                                                                <td class="SmallText">
                                                                    <?php 
                                                                        // $sa = $RowProgressBill['scope_amount'];
                                                                        // $saconvert = (float)$sa;
                                                                        // $ca = $RowProgressBill['contract_amount'];
                                                                        // $caconvert = (float)$ca;
                                                                        // $Weight = $saconvert / $caconvert*100;
                                                                        $ew = (array_sum($TotalEquiv));
                                                                        $EquivalentWeight = number_format(($ew),2); 
                                                                        echo $EquivalentWeight ;
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php
                                                                        $todate = $RowProgressBill['scopes_progress'];
                                                                        $tdate = 100-$todate;
                                                                        echo number_format(($tdate),2);
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                <!-- for this period -->
                                                                    <?php
                                                                        echo number_format(($RowProgressBill['scopes_progress']),2);
                                                                    ?>%     
                                                                </td>
                                                                <td class="SmallText">
                                                                     <?php
                                                                       $tperiod = $RowProgressBill['scopes_progress'];
                                                                       $tdate = 100-$todate;
                                                                       $finalthisperiod = $tperiod + $tdate;
                                                                       echo number_format(($finalthisperiod),2);
                                                                    ?>%                                                     
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php                                        
                                                                        echo number_format(($RowProgressBill['eqivalent_weight']),2)                                                              
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText"><?phpecho number_format(($RowProgressBill['total_amount']),2) ?></td>
                                                            </tr>
                                                        <?php
                                                      
                                                        }
                                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="SmallText"></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td  colspan="4" class="SmallText"><div align="right"><b>CONTRACT AMOUNT</b></div></td>
                                        <td colspan="2" class="SmallText"><B><?php echo $rows['contract_amount']?></B></td>
                                        <td class="SmallText"><b>100.00%</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="SmallText"><b><?php echo $rows['progress']; ?>%</b></td>
                                        <td class="SmallText"><b>  
                                        <?php                                                            
                                            $a = array_sum($Totalamtsum);
                                            $TotalAmount = number_format(($a),2);
                                            echo $TotalAmount;                                                                                                                             
                                        ?>
                                        </b>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                      
                                        <td colspan="12" class="SmallText"><DIV align="left"><b>PROGRESS BILLING COMPUTATIONS</b></DIV></td>
                                       
                                        
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center>I</center></td>
                                        <td colspan="3" class="SmallText">Less Standard Deductions</td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Downpayment</center></td>
                                        <td colspan="2" class="SmallText"><?php echo (number_format($rows['dpayment'], 2)) ?></td>
                                        <td class="SmallText">30.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php 
                                                $downpro = 30;
                                                $billprogress = $rows['progress'];
                                                $eqpr = $downpro * $billprogress /100;
                                                echo (number_format(($eqpr),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php 
                                                $dp = $rows['dpayment'];
                                                $convertdp = str_replace(',', '', $dp);
                                                $tamount = $eqpr/30*$dp;
                                                echo (number_format(($tamount),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Retention (10%)</center></td>
                                        <td colspan="2" class="SmallText">
                                            <?php 
                                                $a = $rows['project_retention'];
                                                $removecom = str_replace(',', '', $a);
                                                echo (number_format(($removecom),2));
                                            ?></td>
                                        <td class="SmallText">10.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php
                                                $rtpro = 10;
                                                $billprogress = $rows['progress'];
                                                $eqrt = $rtpro * $billprogress /100;
                                                echo (number_format(($eqrt),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php
                                                 $rtp = $rows['project_retention'];
                                                 $convertrtp = str_replace(',', '', $rtp);
                                                 $tamountrtp = $eqrt/10*$convertrtp;
                                                 echo (number_format(($tamountrtp),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><b>Note:Applied on 100% project comp</b></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText"><center>II</center></td>
                                        <td colspan="3" class="SmallText"><center>Less Previous Billings</center></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    
                                    <?php
                                        $lessProgressBilling = $GlobalConnection->runQuery("SELECT * from apollo_progressbillinglist WHERE capex_number='$capex' and billing_type!='Progress Billing 2'");
                                        $lessProgressBilling->execute();                                             
                                        while($RowlessProgressBill = $lessProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        
                                        <tr> 
                                            <td class="SmallText" colspan="11" ><div align="right"><?php echo $RowlessProgressBill['billing_type']?></div></td>                                       
                                            <td class="SmallText"><?php echo (number_format(($RowlessProgressBill['billable_amount']),2))?></td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    
                                    <tr> 
                                        <td class="SmallText" colspan="11" ><div align="right"><b>TOTAL BILLABLE AMOUNT</b></div></td>                                       
                                        <td class="SmallText"><b><?php echo (number_format(($rows['billable_amount']),2)) ?></b></td>
                                    </tr>
                                    <tr> 
                                       <td colspan="4" class="SmallText"><div align="right"><b>Amount In Words</b></div></td>
                                       <td colspan="8" class="SmallText">
                                           <center><b> <?php
                                                $billings = $rows['billable_amount'];
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $res =  $f->format($billings);
                                                echo ucwords($res);
                                            ?> Pesos Only</center></b>
                                       </td>
                                       
                                    </tr>
                                    <tr> 
                                       <td colspan="12" class="SmallText"><div align="left"><b>Remarks:</b></div></td>
                                      
                                    </tr>
                                </table>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">PREPARED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                            ENGINEERING OFFICER
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">NOTED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                            HEAD, SALES & MARKETING
                                            </td>

                                        <td class="ProgressbillText" colspan="4">PROCESSED BY:
                                            <BR>
                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">CERTIFY BY:
                                            <BR>
                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">CHECKED BY:
                                            <BR>
                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                            MANAGER, PURCHASING
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">APPROVED BY:
                                            <BR>
                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                            CHIEF OPERATING OFFICER
                                        </td>                              
                                    </tr>                                               
                                </table>
                            </div>

                   <?php 
                }

                elseif($rows['billing_type']=='Progress Billing 4'){ 
                    ?>                       
                        <div class="logo-print"></div><BR>   
                        <div>
                        <p colspan="2" class="txtFormat" align="right" style="font-size:18px "><B>PROGRESS BILLING NO. 4</b></p>
                        </div>
                            <div class="table-responsive" id="TableCostDetails">
                                <table class="table  table-striped" border="2" >
                                    <tr>
                                        <td colspan="12" class="ProgressbillText">
                                           Project Name &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                           :   &nbsp; &nbsp;<?php echo $rows["project_name"]?>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;PR: <input type="text">
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; RR: <input type="text"><br>
                                           CAPEX No. &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;
                                            &nbsp;<?php echo $rows["capex_number"]?>&nbsp;&nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp;PO: <input type="text"><br>
                                           Contract Price &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; 
                                           <b>Php<?php echo $rows["contract_amount"]?></b>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           Billing Submission Date :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?><br>
                                           Name of Contractor &nbsp; :&nbsp;<?php echo $rows["contractor"]?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           Date Prepared :&nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php
                                            $date_prep = $rows['billing_date'];
                                            $now = new DateTime($date_prep);
                                            $timestring = $now->format('l, F d Y');
                                            echo $timestring;
                                            ?><br>
                                           <b>Payee &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($rows['payee']) ?>
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;
                                           Payment Needed on :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?></b> 
                                        </td>
                                    </tr>
                                </table>
                             
                                <table class="table  table-striped" border="2">
                               
                                                <tr>
                                                    <td rowspan="2" class="SmallText"><center><b>Item</b></center></td>
                                                    <td colspan="3" rowspan="2" class="SmallText"><center><b>Description</b></center></td>                                                    
                                                    <td colspan="2" rowspan="2" class="SmallText"><center><b>Amount</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Weight</b></center></td>
                                                    <td colspan="3" class="SmallText"><center><b>Accomp</b></center></td>                                                   
                                                    <td rowspan="2" class="SmallText"><center><b>Equiv. Wt</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Total Amount</b></center></td>
                                                </tr>                                        
                                                    <td class="SmallText"><center><b>Prev</b></center></td>
                                                    <td class="SmallText"><center><b>This Period</b></center></td>
                                                    <td class="SmallText"><center><b>To Date</b></center></td>
                                                </tr>
                                                <tr>
                                                <?php
                                                    $capex = $rows['capex_number'];
                                                    $i = 1;
                                                            function ConverToRoman($num){ 
                                                                $n = intval($num); 
                                                                $res = ''; 
                                                            
                                                                //array of roman numbers
                                                                $romanNumber_Array = array( 
                                                                    'M'  => 1000, 
                                                                    'CM' => 900, 
                                                                    'D'  => 500, 
                                                                    'CD' => 400, 
                                                                    'C'  => 100, 
                                                                    'XC' => 90, 
                                                                    'L'  => 50, 
                                                                    'XL' => 40, 
                                                                    'X'  => 10, 
                                                                    'IX' => 9, 
                                                                    'V'  => 5, 
                                                                    'IV' => 4, 
                                                                    'I'  => 1); 
                                                            
                                                                foreach ($romanNumber_Array as $roman => $number){ 
                                                                    //divide to get  matches
                                                                    $matches = intval($n / $number); 
                                                            
                                                                    //assign the roman char * $matches
                                                                    $res .= str_repeat($roman, $matches); 
                                                            
                                                                    //substract from the number
                                                                    $n = $n % $number; 
                                                                } 
                                                            
                                                                // return the result
                                                                return $res;                             
                                                            
                                                            } 
                                                 
                                                               
                                                        $ProgressBilling = $GlobalConnection->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount,apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent,
                                                        apollo_billing_history.scopes_progress,apollo_billing_history.equivalent_weight,apollo_billing_history.total_amount 
                                                        FROM apollo_laborandmaterialcost_list 
                                                        LEFT JOIN apollo_project_assigned_scopes 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number)
                                                        AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
                                                        INNER JOIN apollo_billing_history 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_billing_history.capex_number) 
                                                        AND (apollo_laborandmaterialcost_list.scope=apollo_billing_history.scopes)
                                                        WHERE apollo_laborandmaterialcost_list.capex_number = '$capex' 
                                                        AND apollo_billing_history.billing_type = 'Progress Billing 4' 
                                                        GROUP BY apollo_laborandmaterialcost_list.scope");
                                                        $ProgressBilling->execute();                                             
                                                        while($RowProgressBill = $ProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $RowProgressBill['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                            $FloatCa = (float)$RemoveComma;
                                                        
                                                            $ScopeAmount = $RowProgressBill['scope_amount'];
                                                            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                                                            $FloatSa = (float)$ScopeRemoveComma;
                                                            $Weight = $FloatSa / $FloatCa * 100;
                                                            
                                                            // for equiv weight         
                                                            $Percentage = $RowProgressBill['percent'];  
                                                            $equiv =  $Percentage * $Weight / 100;  
                                                            
                                                            //    for equiv weight  
                                                            $TotalAmt = $equiv / $Weight * $FloatSa;  
                                                            $Totalamtsum[]=$TotalAmt;
                                                            $TotalEquiv[]=$equiv;
                                                            ?>
                                                            <td class="SmallText">
                                                                <center>
                                                                <?php                                                                   
                                                                    echo ConverToRoman($i);
                                                                    $i++;                                                                    
                                                                ?>
                                                                </center>
                                                            </td>   
                                                                <td colspan="3" class="SmallText"><?php echo $RowProgressBill['scope']?></td>
                                                                <td colspan="2" class="SmallText"><?php echo $RowProgressBill['scope_amount']?></td>
                                                                <td class="SmallText">
                                                                    <?php 
                                                                        // $sa = $RowProgressBill['scope_amount'];
                                                                        // $saconvert = (float)$sa;
                                                                        // $ca = $RowProgressBill['contract_amount'];
                                                                        // $caconvert = (float)$ca;
                                                                        // $Weight = $saconvert / $caconvert*100;
                                                                        $ew = (array_sum($TotalEquiv));
                                                                        $EquivalentWeight = number_format(($ew),2); 
                                                                        echo $EquivalentWeight ;
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php
                                                                        $todate = $RowProgressBill['scopes_progress'];
                                                                        $tdate = 100-$todate;
                                                                        echo number_format(($tdate),2);
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                <!-- for this period -->
                                                                    <?php
                                                                        echo number_format(($RowProgressBill['scopes_progress']),2);
                                                                    ?>%     
                                                                </td>
                                                                <td class="SmallText">
                                                                     <?php
                                                                       $tperiod = $RowProgressBill['scopes_progress'];
                                                                       $tdate = 100-$todate;
                                                                       $finalthisperiod = $tperiod + $tdate;
                                                                       echo number_format(($finalthisperiod),2);
                                                                    ?>%                                                     
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php                                        
                                                                        echo number_format(($RowProgressBill['equivalent_weight']),2);                                                                 
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText"><?php echo number_format(($RowProgressBill['total_amount']),2)?></td>
                                                            </tr>
                                                        <?php
                                                      
                                                        }
                                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="SmallText"></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td  colspan="4" class="SmallText"><div align="right"><b>CONTRACT AMOUNT</b></div></td>
                                        <td colspan="2" class="SmallText"><B><?php echo $rows['contract_amount']?></B></td>
                                        <td class="SmallText"><b>100.00%</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="SmallText"><b><?php echo $rows['progress']; ?>%</b></td>
                                        <td class="SmallText"><b>  
                                        <?php                                                            
                                            $a = array_sum($Totalamtsum);
                                            $TotalAmount = number_format(($a),2);
                                            echo $TotalAmount;                                                                                                                             
                                        ?>
                                        </b>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                      
                                        <td colspan="12" class="SmallText"><DIV align="left"><b>PROGRESS BILLING COMPUTATIONS</b></DIV></td>
                                       
                                        
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center>I</center></td>
                                        <td colspan="3" class="SmallText">Less Standard Deductions</td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Downpayment</center></td>
                                        <td colspan="2" class="SmallText"><?php echo (number_format($rows['dpayment'], 2)) ?></td>
                                        <td class="SmallText">30.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php 
                                                $downpro = 30;
                                                $billprogress = $rows['progress'];
                                                $eqpr = $downpro * $billprogress /100;
                                                echo (number_format(($eqpr),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php 
                                                $dp = $rows['dpayment'];
                                                $convertdp = str_replace(',', '', $dp);
                                                $tamount = $eqpr/30*$dp;
                                                echo (number_format(($tamount),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Retention (10%)</center></td>
                                        <td colspan="2" class="SmallText">
                                            <?php 
                                                $a = $rows['project_retention'];
                                                $removecom = str_replace(',', '', $a);
                                                echo (number_format(($removecom),2));
                                            ?></td>
                                        <td class="SmallText">10.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php
                                                $rtpro = 10;
                                                $billprogress = $rows['progress'];
                                                $eqrt = $rtpro * $billprogress /100;
                                                echo (number_format(($eqrt),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php
                                                 $rtp = $rows['project_retention'];
                                                 $convertrtp = str_replace(',', '', $rtp);
                                                 $tamountrtp = $eqrt/10*$convertrtp;
                                                 echo (number_format(($tamountrtp),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><b>Note:Applied on 100% project comp</b></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText"><center>II</center></td>
                                        <td colspan="3" class="SmallText"><center>Less Previous Billings</center></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    
                                    <?php
                                        $lessProgressBilling = $GlobalConnection->runQuery("SELECT * from apollo_progressbillinglist WHERE capex_number='$capex' and billing_type!='Progress Billing 2'");
                                        $lessProgressBilling->execute();                                             
                                        while($RowlessProgressBill = $lessProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        
                                        <tr> 
                                            <td class="SmallText" colspan="11" ><div align="right"><?php echo $RowlessProgressBill['billing_type']?></div></td>                                       
                                            <td class="SmallText"><?php echo (number_format(($RowlessProgressBill['billable_amount']),2))?></td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    
                                    <tr> 
                                        <td class="SmallText" colspan="11" ><div align="right"><b>TOTAL BILLABLE AMOUNT</b></div></td>                                       
                                        <td class="SmallText"><b><?php echo (number_format(($rows['billable_amount']),2)) ?></b></td>
                                    </tr>
                                    <tr> 
                                       <td colspan="4" class="SmallText"><div align="right"><b>Amount In Words</b></div></td>
                                       <td colspan="8" class="SmallText">
                                           <center><b> <?php
                                                $billings = $rows['billable_amount'];
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $res =  $f->format($billings);
                                                echo ucwords($res);
                                            ?> Pesos Only</center></b>
                                       </td>
                                       
                                    </tr>
                                    <tr> 
                                       <td colspan="12" class="SmallText"><div align="left"><b>Remarks:</b></div></td>
                                      
                                    </tr>
                                </table>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">PREPARED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                            ENGINEERING OFFICER
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">NOTED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                            HEAD, SALES & MARKETING
                                            </td>

                                        <td class="ProgressbillText" colspan="4">PROCESSED BY:
                                            <BR>
                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">CERTIFY BY:
                                            <BR>
                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">CHECKED BY:
                                            <BR>
                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                            MANAGER, PURCHASING
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">APPROVED BY:
                                            <BR>
                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                            CHIEF OPERATING OFFICER
                                        </td>                              
                                    </tr>                                               
                                </table>
                            </div>

                   <?php 
                }

                elseif($rows['billing_type']=='Progress Billing 5'){ 
                    ?>                       
                        <div class="logo-print"></div><BR>   
                        <div>
                        <p colspan="2" class="txtFormat" align="right" style="font-size:18px "><B>PROGRESS BILLING NO. 5</b></p>
                        </div>
                            <div class="table-responsive" id="TableCostDetails">
                                <table class="table  table-striped" border="2" >
                                    <tr>
                                        <td colspan="12" class="ProgressbillText">
                                           Project Name &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                           :   &nbsp; &nbsp;<?php echo $rows["project_name"]?>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;PR: <input type="text">
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; RR: <input type="text"><br>
                                           CAPEX No. &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;
                                            &nbsp;<?php echo $rows["capex_number"]?>&nbsp;&nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp;PO: <input type="text"><br>
                                           Contract Price &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; 
                                           <b>Php<?php echo $rows["contract_amount"]?></b>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           Billing Submission Date :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?><br>
                                           Name of Contractor &nbsp; :&nbsp;<?php echo $rows["contractor"]?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           Date Prepared :&nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php
                                            $date_prep = $rows['billing_date'];
                                            $now = new DateTime($date_prep);
                                            $timestring = $now->format('l, F d Y');
                                            echo $timestring;
                                            ?><br>
                                           <b>Payee &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($rows['payee']) ?>
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;
                                           Payment Needed on :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?></b> 
                                        </td>
                                    </tr>
                                </table>
                             
                                <table class="table  table-striped" border="2">
                               
                                                <tr>
                                                    <td rowspan="2" class="SmallText"><center><b>Item</b></center></td>
                                                    <td colspan="3" rowspan="2" class="SmallText"><center><b>Description</b></center></td>                                                    
                                                    <td colspan="2" rowspan="2" class="SmallText"><center><b>Amount</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Weight</b></center></td>
                                                    <td colspan="3" class="SmallText"><center><b>Accomp</b></center></td>                                                   
                                                    <td rowspan="2" class="SmallText"><center><b>Equiv. Wt</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Total Amount</b></center></td>
                                                </tr>                                        
                                                    <td class="SmallText"><center><b>Prev</b></center></td>
                                                    <td class="SmallText"><center><b>This Period</b></center></td>
                                                    <td class="SmallText"><center><b>To Date</b></center></td>
                                                </tr>
                                                <tr>
                                                <?php
                                                    $capex = $rows['capex_number'];
                                                    $i = 1;
                                                            function ConverToRoman($num){ 
                                                                $n = intval($num); 
                                                                $res = ''; 
                                                            
                                                                //array of roman numbers
                                                                $romanNumber_Array = array( 
                                                                    'M'  => 1000, 
                                                                    'CM' => 900, 
                                                                    'D'  => 500, 
                                                                    'CD' => 400, 
                                                                    'C'  => 100, 
                                                                    'XC' => 90, 
                                                                    'L'  => 50, 
                                                                    'XL' => 40, 
                                                                    'X'  => 10, 
                                                                    'IX' => 9, 
                                                                    'V'  => 5, 
                                                                    'IV' => 4, 
                                                                    'I'  => 1); 
                                                            
                                                                foreach ($romanNumber_Array as $roman => $number){ 
                                                                    //divide to get  matches
                                                                    $matches = intval($n / $number); 
                                                            
                                                                    //assign the roman char * $matches
                                                                    $res .= str_repeat($roman, $matches); 
                                                            
                                                                    //substract from the number
                                                                    $n = $n % $number; 
                                                                } 
                                                            
                                                                // return the result
                                                                return $res;                             
                                                            
                                                            } 
                                                 
                                                               
                                                        $ProgressBilling = $GlobalConnection->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount,apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent,
                                                        apollo_billing_history.scopes_progress,apollo_billing_history.equivalent_weight,apollo_billing_history.total_amount 
                                                        FROM apollo_laborandmaterialcost_list 
                                                        LEFT JOIN apollo_project_assigned_scopes 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number)
                                                        AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
                                                        INNER JOIN apollo_billing_history 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_billing_history.capex_number) 
                                                        AND (apollo_laborandmaterialcost_list.scope=apollo_billing_history.scopes)
                                                        WHERE apollo_laborandmaterialcost_list.capex_number = '$capex' 
                                                        AND apollo_billing_history.billing_type = 'Progress Billing 5' 
                                                        GROUP BY apollo_laborandmaterialcost_list.scope");
                                                        $ProgressBilling->execute();                                             
                                                        while($RowProgressBill = $ProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $RowProgressBill['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                            $FloatCa = (float)$RemoveComma;
                                                        
                                                            $ScopeAmount = $RowProgressBill['scope_amount'];
                                                            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                                                            $FloatSa = (float)$ScopeRemoveComma;
                                                            $Weight = $FloatSa / $FloatCa * 100;
                                                            
                                                            // for equiv weight         
                                                            $Percentage = $RowProgressBill['percent'];  
                                                            $equiv =  $Percentage * $Weight / 100;  
                                                            
                                                            //    for equiv weight  
                                                            $TotalAmt = $equiv / $Weight * $FloatSa;  
                                                            $Totalamtsum[]=$TotalAmt;
                                                            $TotalEquiv[]=$equiv;
                                                            ?>
                                                            <td class="SmallText">
                                                                <center>
                                                                <?php                                                                   
                                                                    echo ConverToRoman($i);
                                                                    $i++;                                                                    
                                                                ?>
                                                                </center>
                                                            </td>   
                                                                <td colspan="3" class="SmallText"><?php echo $RowProgressBill['scope']?></td>
                                                                <td colspan="2" class="SmallText"><?php echo $RowProgressBill['scope_amount']?></td>
                                                                <td class="SmallText">
                                                                    <?php 
                                                                        // $sa = $RowProgressBill['scope_amount'];
                                                                        // $saconvert = (float)$sa;
                                                                        // $ca = $RowProgressBill['contract_amount'];
                                                                        // $caconvert = (float)$ca;
                                                                        // $Weight = $saconvert / $caconvert*100;
                                                                        $ew = (array_sum($TotalEquiv));
                                                                        $EquivalentWeight = number_format(($ew),2); 
                                                                        echo $EquivalentWeight ;
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php
                                                                        $todate = $RowProgressBill['scopes_progress'];
                                                                        $tdate = 100-$todate;
                                                                        echo number_format(($tdate),2);
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                <!-- for this period -->
                                                                    <?php
                                                                        echo number_format(($RowProgressBill['scopes_progress']),2);
                                                                    ?>%     
                                                                </td>
                                                                <td class="SmallText">
                                                                     <?php
                                                                       $tperiod = $RowProgressBill['scopes_progress'];
                                                                       $tdate = 100-$todate;
                                                                       $finalthisperiod = $tperiod + $tdate;
                                                                       echo number_format(($finalthisperiod),2);
                                                                    ?>%                                                     
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php                                        
                                                                         echo number_format(($RowProgressBill['equivalent_weight']),2);                                                                 
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText"><?php echo number_format(($RowProgressBill['total_amount']),2) ?></td>
                                                            </tr>
                                                        <?php
                                                      
                                                        }
                                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="SmallText"></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td  colspan="4" class="SmallText"><div align="right"><b>CONTRACT AMOUNT</b></div></td>
                                        <td colspan="2" class="SmallText"><B><?php echo $rows['contract_amount']?></B></td>
                                        <td class="SmallText"><b>100.00%</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="SmallText"><b><?php echo $rows['progress']; ?>%</b></td>
                                        <td class="SmallText"><b>  
                                        <?php                                                            
                                            $a = array_sum($Totalamtsum);
                                            $TotalAmount = number_format(($a),2);
                                            echo $TotalAmount;                                                                                                                             
                                        ?>
                                        </b>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                      
                                        <td colspan="12" class="SmallText"><DIV align="left"><b>PROGRESS BILLING COMPUTATIONS</b></DIV></td>
                                       
                                        
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center>I</center></td>
                                        <td colspan="3" class="SmallText">Less Standard Deductions</td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Downpayment</center></td>
                                        <td colspan="2" class="SmallText"><?php echo (number_format($rows['dpayment'], 2)) ?></td>
                                        <td class="SmallText">30.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php 
                                                $downpro = 30;
                                                $billprogress = $rows['progress'];
                                                $eqpr = $downpro * $billprogress /100;
                                                echo (number_format(($eqpr),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php 
                                                $dp = $rows['dpayment'];
                                                $convertdp = str_replace(',', '', $dp);
                                                $tamount = $eqpr/30*$dp;
                                                echo (number_format(($tamount),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Retention (10%)</center></td>
                                        <td colspan="2" class="SmallText">
                                            <?php 
                                                $a = $rows['project_retention'];
                                                $removecom = str_replace(',', '', $a);
                                                echo (number_format(($removecom),2));
                                            ?></td>
                                        <td class="SmallText">10.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php
                                                $rtpro = 10;
                                                $billprogress = $rows['progress'];
                                                $eqrt = $rtpro * $billprogress /100;
                                                echo (number_format(($eqrt),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php
                                                 $rtp = $rows['project_retention'];
                                                 $convertrtp = str_replace(',', '', $rtp);
                                                 $tamountrtp = $eqrt/10*$convertrtp;
                                                 echo (number_format(($tamountrtp),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><b>Note:Applied on 100% project comp</b></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText"><center>II</center></td>
                                        <td colspan="3" class="SmallText"><center>Less Previous Billings</center></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    
                                    <?php
                                        $lessProgressBilling = $GlobalConnection->runQuery("SELECT * from apollo_progressbillinglist WHERE capex_number='$capex' and billing_type!='Progress Billing 2'");
                                        $lessProgressBilling->execute();                                             
                                        while($RowlessProgressBill = $lessProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        
                                        <tr> 
                                            <td class="SmallText" colspan="11" ><div align="right"><?php echo $RowlessProgressBill['billing_type']?></div></td>                                       
                                            <td class="SmallText"><?php echo (number_format(($RowlessProgressBill['billable_amount']),2))?></td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    
                                    <tr> 
                                        <td class="SmallText" colspan="11" ><div align="right"><b>TOTAL BILLABLE AMOUNT</b></div></td>                                       
                                        <td class="SmallText"><b><?php echo (number_format(($rows['billable_amount']),2)) ?></b></td>
                                    </tr>
                                    <tr> 
                                       <td colspan="4" class="SmallText"><div align="right"><b>Amount In Words</b></div></td>
                                       <td colspan="8" class="SmallText">
                                           <center><b> <?php
                                                $billings = $rows['billable_amount'];
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $res =  $f->format($billings);
                                                echo ucwords($res);
                                            ?> Pesos Only</center></b>
                                       </td>
                                       
                                    </tr>
                                    <tr> 
                                       <td colspan="12" class="SmallText"><div align="left"><b>Remarks:</b></div></td>
                                      
                                    </tr>
                                </table>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">PREPARED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                            ENGINEERING OFFICER
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">NOTED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                            HEAD, SALES & MARKETING
                                            </td>

                                        <td class="ProgressbillText" colspan="4">PROCESSED BY:
                                            <BR>
                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">CERTIFY BY:
                                            <BR>
                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">CHECKED BY:
                                            <BR>
                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                            MANAGER, PURCHASING
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">APPROVED BY:
                                            <BR>
                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                            CHIEF OPERATING OFFICER
                                        </td>                              
                                    </tr>                                               
                                </table>
                            </div>

                   <?php 
                }


                elseif($rows['billing_type']=='Full Payment'){ 
                    ?>                       
                        <div class="logo-print"></div><BR>   
                        <div>
                        <p colspan="2" class="txtFormat" align="right" style="font-size:18px "><B>Full Payment</b></p>
                        </div>
                            <div class="table-responsive" id="TableCostDetails">
                                <table class="table  table-striped" border="2" >
                                    <tr>
                                        <td colspan="12" class="ProgressbillText">
                                           Project Name &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                           :   &nbsp; &nbsp;<?php echo $rows["project_name"]?>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;PR: <input type="text">
                                            &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; RR: <input type="text"><br>
                                           CAPEX No. &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;:&nbsp;
                                            &nbsp;<?php echo $rows["capex_number"]?>&nbsp;&nbsp;&nbsp;
                                            &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; 
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                            &nbsp;&nbsp; &nbsp;&nbsp;PO: <input type="text"><br>
                                           Contract Price &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;:&nbsp;&nbsp; 
                                           <b>Php<?php echo $rows["contract_amount"]?></b>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; 
                                           Billing Submission Date :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?><br>
                                           Name of Contractor &nbsp; :&nbsp;<?php echo $rows["contractor"]?>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           Date Prepared :&nbsp;&nbsp;&nbsp;&nbsp;
                                           <?php
                                            $date_prep = $rows['billing_date'];
                                            $now = new DateTime($date_prep);
                                            $timestring = $now->format('l, F d Y');
                                            echo $timestring;
                                            ?><br>
                                           <b>Payee &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo strtoupper($rows['payee']) ?>
                                           &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
                                           &nbsp;&nbsp;
                                           Payment Needed on :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date('l, F d Y');?></b> 
                                        </td>
                                    </tr>
                                </table>
                             
                                <table class="table  table-striped" border="2">
                               
                                                <tr>
                                                    <td rowspan="2" class="SmallText"><center><b>Item</b></center></td>
                                                    <td colspan="3" rowspan="2" class="SmallText"><center><b>Description</b></center></td>                                                    
                                                    <td colspan="2" rowspan="2" class="SmallText"><center><b>Amount</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Weight</b></center></td>
                                                    <td colspan="3" class="SmallText"><center><b>Accomp</b></center></td>                                                   
                                                    <td rowspan="2" class="SmallText"><center><b>Equiv. Wt</b></center></td>
                                                    <td rowspan="2" class="SmallText"><center><b>Total Amount</b></center></td>
                                                </tr>                                        
                                                    <td class="SmallText"><center><b>Prev</b></center></td>
                                                    <td class="SmallText"><center><b>This Period</b></center></td>
                                                    <td class="SmallText"><center><b>To Date</b></center></td>
                                                </tr>
                                                <tr>
                                                <?php
                                                    $capex = $rows['capex_number'];
                                                    $i = 1;
                                                            function ConverToRoman($num){ 
                                                                $n = intval($num); 
                                                                $res = ''; 
                                                            
                                                                //array of roman numbers
                                                                $romanNumber_Array = array( 
                                                                    'M'  => 1000, 
                                                                    'CM' => 900, 
                                                                    'D'  => 500, 
                                                                    'CD' => 400, 
                                                                    'C'  => 100, 
                                                                    'XC' => 90, 
                                                                    'L'  => 50, 
                                                                    'XL' => 40, 
                                                                    'X'  => 10, 
                                                                    'IX' => 9, 
                                                                    'V'  => 5, 
                                                                    'IV' => 4, 
                                                                    'I'  => 1); 
                                                            
                                                                foreach ($romanNumber_Array as $roman => $number){ 
                                                                    //divide to get  matches
                                                                    $matches = intval($n / $number); 
                                                            
                                                                    //assign the roman char * $matches
                                                                    $res .= str_repeat($roman, $matches); 
                                                            
                                                                    //substract from the number
                                                                    $n = $n % $number; 
                                                                } 
                                                            
                                                                // return the result
                                                                return $res;                             
                                                            
                                                            } 
                                                 
                                                               
                                                        $ProgressBilling = $GlobalConnection->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount,apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent) as percent,
                                                        apollo_billing_history.scopes_progress,apollo_billing_history.equivalent_weight,apollo_billing_history.total_amount 
                                                        FROM apollo_laborandmaterialcost_list 
                                                        LEFT JOIN apollo_project_assigned_scopes 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_project_assigned_scopes.capex_number)
                                                        AND (apollo_laborandmaterialcost_list.scope_id=apollo_project_assigned_scopes.parent_id) 
                                                        INNER JOIN apollo_billing_history 
                                                        ON (apollo_laborandmaterialcost_list.capex_number=apollo_billing_history.capex_number) 
                                                        AND (apollo_laborandmaterialcost_list.scope=apollo_billing_history.scopes)
                                                        WHERE apollo_laborandmaterialcost_list.capex_number = '$capex' 
                                                        AND apollo_billing_history.billing_type = 'Full Payment' 
                                                        GROUP BY apollo_laborandmaterialcost_list.scope");
                                                        $ProgressBilling->execute();                                             
                                                        while($RowProgressBill = $ProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $RowProgressBill['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                            $FloatCa = (float)$RemoveComma;
                                                        
                                                            $ScopeAmount = $RowProgressBill['scope_amount'];
                                                            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                                                            $FloatSa = (float)$ScopeRemoveComma;
                                                            $Weight = $FloatSa / $FloatCa * 100;
                                                            
                                                            // for equiv weight         
                                                            $Percentage = $RowProgressBill['percent'];  
                                                            $equiv =  $Percentage * $Weight / 100;  
                                                            
                                                            //    for equiv weight  
                                                            $TotalAmt = $equiv / $Weight * $FloatSa;  
                                                            $Totalamtsum[]=$TotalAmt;
                                                            $TotalEquiv[]=$equiv;
                                                            ?>
                                                            <td class="SmallText">
                                                                <center>
                                                                <?php                                                                   
                                                                    echo ConverToRoman($i);
                                                                    $i++;                                                                    
                                                                ?>
                                                                </center>
                                                            </td>   
                                                                <td colspan="3" class="SmallText"><?php echo $RowProgressBill['scope']?></td>
                                                                <td colspan="2" class="SmallText"><?php echo $RowProgressBill['scope_amount']?></td>
                                                                <td class="SmallText">
                                                                    <?php 
                                                                        // $sa = $RowProgressBill['scope_amount'];
                                                                        // $saconvert = (float)$sa;
                                                                        // $ca = $RowProgressBill['contract_amount'];
                                                                        // $caconvert = (float)$ca;
                                                                        // $Weight = $saconvert / $caconvert*100;
                                                                        $ew = (array_sum($TotalEquiv));
                                                                        $EquivalentWeight = number_format(($ew),2); 
                                                                        echo $EquivalentWeight ;
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php
                                                                        $todate = $RowProgressBill['scopes_progress'];
                                                                        $tdate = 100-$todate;
                                                                        echo number_format(($tdate),2);
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText">
                                                                <!-- for this period -->
                                                                    <?php
                                                                        echo number_format(($RowProgressBill['scopes_progress']),2);
                                                                    ?>%     
                                                                </td>
                                                                <td class="SmallText">
                                                                     <?php
                                                                       $tperiod = $RowProgressBill['scopes_progress'];
                                                                       $tdate = 100-$todate;
                                                                       $finalthisperiod = $tperiod + $tdate;
                                                                       echo number_format(($finalthisperiod),2);
                                                                    ?>%                                                     
                                                                </td>
                                                                <td class="SmallText">
                                                                    <?php                                        
                                                                        echo number_format(($RowProgressBill['equivalent_weight']),2);                                                                 
                                                                    ?>%
                                                                </td>
                                                                <td class="SmallText"><?php  echo number_format(($RowProgressBill['total_amount']),2)?></td>
                                                            </tr>
                                                        <?php
                                                      
                                                        }
                                                    ?>
                                    <tr>
                                        <td></td>
                                        <td colspan="3" class="SmallText"></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td  colspan="4" class="SmallText"><div align="right"><b>CONTRACT AMOUNT</b></div></td>
                                        <td colspan="2" class="SmallText"><B><?php echo $rows['contract_amount']?></B></td>
                                        <td class="SmallText"><b>100.00%</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="SmallText"><b><?php echo $rows['progress']; ?>%</b></td>
                                        <td class="SmallText"><b>  
                                        <?php                                                            
                                            $a = array_sum($Totalamtsum);
                                            $TotalAmount = number_format(($a),2);
                                            echo $TotalAmount;                                                                                                                             
                                        ?>
                                        </b>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                      
                                        <td colspan="12" class="SmallText"><DIV align="left"><b>PROGRESS BILLING COMPUTATIONS</b></DIV></td>
                                       
                                        
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center>I</center></td>
                                        <td colspan="3" class="SmallText">Less Standard Deductions</td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Downpayment</center></td>
                                        <td colspan="2" class="SmallText"><?php echo (number_format($rows['dpayment'], 2)) ?></td>
                                        <td class="SmallText">30.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php 
                                                $downpro = 30;
                                                $billprogress = $rows['progress'];
                                                $eqpr = $downpro * $billprogress /100;
                                                echo (number_format(($eqpr),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php 
                                                $dp = $rows['dpayment'];
                                                $convertdp = str_replace(',', '', $dp);
                                                $tamount = $eqpr/30*$dp;
                                                echo (number_format(($tamount),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><center>Retention (10%)</center></td>
                                        <td colspan="2" class="SmallText">
                                            <?php 
                                                $a = $rows['project_retention'];
                                                $removecom = str_replace(',', '', $a);
                                                echo (number_format(($removecom),2));
                                            ?></td>
                                        <td class="SmallText">10.00%</td>
                                        <td class="SmallText">0.00%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText"><?php echo $rows['progress']; ?>%</td>
                                        <td class="SmallText">
                                            <?php
                                                $rtpro = 10;
                                                $billprogress = $rows['progress'];
                                                $eqrt = $rtpro * $billprogress /100;
                                                echo (number_format(($eqrt),2));
                                            ?>%
                                        </td>
                                        <td class="SmallText">
                                            <?php
                                                 $rtp = $rows['project_retention'];
                                                 $convertrtp = str_replace(',', '', $rtp);
                                                 $tamountrtp = $eqrt/10*$convertrtp;
                                                 echo (number_format(($tamountrtp),2));
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="SmallText"><center></center></td>
                                        <td colspan="3" class="SmallText"><b>Note:Applied on 100% project comp</b></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    <tr> 
                                        <td class="SmallText"><center>II</center></td>
                                        <td colspan="3" class="SmallText"><center>Less Previous Billings</center></td>
                                        <td colspan="2" class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                        <td></td>
                                        <td class="SmallText"></td>
                                    </tr>
                                    
                                    <?php
                                        $lessProgressBilling = $GlobalConnection->runQuery("SELECT * from apollo_progressbillinglist WHERE capex_number='$capex' and billing_type!='Progress Billing 2'");
                                        $lessProgressBilling->execute();                                             
                                        while($RowlessProgressBill = $lessProgressBilling->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        
                                        <tr> 
                                            <td class="SmallText" colspan="11" ><div align="right"><?php echo $RowlessProgressBill['billing_type']?></div></td>                                       
                                            <td class="SmallText"><?php echo (number_format(($RowlessProgressBill['billable_amount']),2))?></td>
                                        </tr>
                                        <?php
                                        }
                                    ?>
                                    
                                    <tr> 
                                        <td class="SmallText" colspan="11" ><div align="right"><b>TOTAL BILLABLE AMOUNT</b></div></td>                                       
                                        <td class="SmallText"><b><?php echo (number_format(($rows['billable_amount']),2)) ?></b></td>
                                    </tr>
                                    <tr> 
                                       <td colspan="4" class="SmallText"><div align="right"><b>Amount In Words</b></div></td>
                                       <td colspan="8" class="SmallText">
                                           <center><b> <?php
                                                $billings = $rows['billable_amount'];
                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                $res =  $f->format($billings);
                                                echo ucwords($res);
                                            ?> Pesos Only</center></b>
                                       </td>
                                       
                                    </tr>
                                    <tr> 
                                       <td colspan="12" class="SmallText"><div align="left"><b>Remarks:</b></div></td>
                                      
                                    </tr>
                                </table>
                                <table class="table  table-striped" border="2">
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">PREPARED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date: <br>
                                            ENGINEERING OFFICER
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">NOTED BY:
                                            <BR>
                                            <b><?php echo strtoupper($rows['proponent']) ?></b>&nbsp; &nbsp;&nbsp;  Date:<br>
                                            HEAD, SALES & MARKETING
                                            </td>

                                        <td class="ProgressbillText" colspan="4">PROCESSED BY:
                                            <BR>
                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<br>
                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="ProgressbillText" colspan="4">CERTIFY BY:
                                            <BR>
                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<br>
                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">CHECKED BY:
                                            <BR>
                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<br>
                                            MANAGER, PURCHASING
                                        </td>
                                        
                                        <td class="ProgressbillText" colspan="4">APPROVED BY:
                                            <BR>
                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<br>
                                            CHIEF OPERATING OFFICER
                                        </td>                              
                                    </tr>                                               
                                </table>
                            </div>

                   <?php 
                }

                else{ 
                    ?>
                    <p>Billing not found...</p>
                   <?php 
                 } 
            ?>

            </div>
            <?php
         }
    }
}
?>
</p>
</body>
</html>
