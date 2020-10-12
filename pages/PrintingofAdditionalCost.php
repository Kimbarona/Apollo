<?php
session_start();
require_once("GlobalClass.php");
$GlobalConnection = new GlobalConnection();
// $TriggerCapex = ($_GET['equiv']);



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
                line-height: 23px;
                font-size: 14px;
            }
            .txtoutside {
                font-family: century gothic;
                line-height: 5px;
                font-size: 14px;
            }
            .txtHeader {
                font-family: century gothic;
                line-height: 12px;
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
            tr.noBorder td {
            border: 0;
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
    $bill = $GlobalConnection->runQuery("SELECT * FROM  apollo_additional_cost WHERE id ='$IdOfBilling'");
    $bill->execute();
    while($rows = $bill->fetch(PDO::FETCH_ASSOC)){
        $Capex = $rows['capex_number'];
       ?>
        <!-- Render the user details -->
            <div class="container">
           <br>
                <!-- <h2>User Details</h2> -->
                <?php if(!empty($IdOfBilling)){ 
                    if($rows['billing_type']=='Initial Payment (Additional Works)'){                  
                    ?>
                    <BR>    
                     <div class="logo-print">
                     </div>
                    <BR><BR>  
                    <div>
                    <p colspan="2" class="txtFormat" align="center" style="font-size:18px "><B>INITIAL PAYMENT (Additional Works) - <?php echo number_format($rows["progress"])?>% of Total Contract Cost</b></p>
                    </div>
                                    <div class="table-responsive" id="TableCostDetails"  style="overflow:hidden;">
                                        <table class="table table-striped" border="2">
                                            <tr border="2">
                                                <td>
                                                    <table class="table table-striped" border="0" >               
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Project Name &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows["project_name"]?></b></td>
                                                                <td colspan="6" class="txtHeader">Capex No. &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows["capex_number"]?></b> </td>                                                                                                          
                                                            </tr>
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Contract Price &nbsp;&nbsp;:&nbsp;&nbsp;<b>Php<?php echo $rows["contract_price"]?>.00</b> </td>
                                                                <td colspan="6" class="txtHeader">Scope of Works&nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows["scope_of_works"]?></b></td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6"class="txtHeader">Start of Construction &nbsp;&nbsp;:&nbsp;&nbsp;
                                                                <?php 
                                                                    $newDate = $rows['start_of_construction'];
                                                                    $tstamp =  strtotime($newDate);
                                                                    $old_date = date('l, F d Y', $tstamp); 
                                                                    echo  $old_date;
                                                                ?>
                                                            </td>
                                                                <td colspan="6" class="txtHeader">Projected Completion &nbsp;:&nbsp;&nbsp;   
                                                                    <?php 
                                                                        $newEndDate = $rows['project_completion'];
                                                                        $tstampEnd =  strtotime($newEndDate);
                                                                        $end_date = date('l, F d Y', $tstampEnd); 
                                                                        echo  $end_date;
                                                                    ?>
                                                                </td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Name of Contractor &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows['contractor']?></b></td>
                                                                <td colspan="6" class="txtHeader"> Address &nbsp;:&nbsp;&nbsp;<?php echo $rows["c_address"]?></td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader"><b>Payee</b> &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo strtoupper($rows['payee']) ?></b></td>
                                                                <td colspan="6" class="txtHeader"> Contact No &nbsp;:&nbsp;&nbsp;
                                                                    <?php 
                                                                       echo $rows["contact_number"];
                                                                    ?>
                                                                </td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Date Prepared &nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                         $GDate = $rows['generated_date'];
                                                                         $NewGdate =  strtotime($GDate);
                                                                         $FgDate = date('l, F d Y', $NewGdate); 
                                                                         echo  $FgDate;
                                                                    ?>
                                                                </b></td>
                                                                <td colspan="6" class="txtHeader"><b>Billing Submission Date</b>&nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                         $BsDate = $rows['billing_submission'];
                                                                         $NewBsGdate =  strtotime($BsDate);
                                                                         $FBsDate = date('l, F d Y', $NewBsGdate); 
                                                                         echo  $FBsDate;
                                                                    ?>
                                                                </b></td>                                                                                                          
                                                            </tr>
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Date Recieved &nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                        $DrDate = $rows['date_recieve'];
                                                                        $NewDrdate =  strtotime($DrDate);
                                                                        $FdrDate = date('l, F d Y', $NewDrdate); 
                                                                        echo  $FdrDate;
                                                                    ?>
                                                                </b></td>
                                                                <td colspan="6" class="txtHeader"><b>Payment Needed On</b>&nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                        $PnoDate = $rows['payment_needed_on'];
                                                                        $NewPnodate =  strtotime($PnoDate);
                                                                        $FpnoDate = date('l, F d Y', $NewPnodate); 
                                                                        echo  $FpnoDate;
                                                                    ?>
                                                                </b></td>                                                                                                          
                                                            </tr>    
                                                    </table >
                                                </td>
                                            </tr>
                                        </table>
                                        
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
                                                     
                                                        <td class="txtInside" colspan="2" rowspan="3"><center><b>Php <?php echo $rows['contract_price']?>.00</b></center></td>
                                                       
                                                        <td class="txtInside" rowspan="3"><center><b>0%</b></center></td>
                                                        <td class="txtInside" rowspan="3"><center><b><?php echo $rows['progress']?>.00%</b></center></td>
                                                        <td class="txtInside" rowspan="3"><center><b><?php echo $rows['progress']?>.00%</b></center></td>
                                                        <td></td>
                                                        <td class="txtInside" rowspan="3" colspan="2"><center><b>Php 
                                                            <?php
                                                             $oldBill = $rows['billable'];
                                                             $output = str_replace(',', '', $oldBill);
                                                             echo number_format($output, 2);
                                                            ?>
                                                        </b></center></td>
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
                                                       
                                                    
                                                        <td class="txtInside"><center><b><?php echo $rows['progress']?>.00%</b></center></td>
                                                        <td></td>
                                                        <td class="txtInside" colspan="2"><center><b>Php
                                                            <?php
                                                             $oldBill = $rows['billable'];
                                                             $output = str_replace(',', '', $oldBill);
                                                             echo number_format($output, 2);
                                                            ?>
                                                        </b></center></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="txtInside" colspan="5">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; <b>Amount in Words</b></td>
                                                       
                                                        <td class="txtInside" colspan="7"><center>
                                                        <b>
                                                            <?php
                                                                 $billings = $rows['billable'];
                                                                $output = str_replace(',', '', $billings);
                                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                                $res =  $f->format($output);
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
                                            <?php
                                                 $CapexNum = $rows["capex_number"];
                                                 $DateOfApproval = $GlobalConnection->runQuery("SELECT * FROM apollo_trackingofbilling 
                                                 WHERE capex_number = '$CapexNum' 
                                                 AND billing_type = 'Initial Payment (Additional Works)'");
                                                 $DateOfApproval->execute();
                                                 $FinalDate = $DateOfApproval->fetch();                                             
                                                    $BD = $FinalDate['billing_date'];
                                                    $FA = $FinalDate['fdate_approved'];
                                                    $SA = $FinalDate['sdate_approved'];
                                                    $TA = $FinalDate['tdate_approved'];
                                                    $FRA = $FinalDate['frdate_approved'];
                                            ?>
                                                    <tr>
                                                        <td class="txtInside" colspan="4">PREPARED BY:
                                                            <BR><br>
                                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<?php echo $BD ?><br>
                                                            ENGINEERING OFFICER
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">NOTED BY:
                                                           <BR><br>
                                                            <b>
                                                                <?php 
                                                                $stmts = $GlobalConnection->runQuery("SELECT * From apollo_enrolledproject WHERE capex_number='$Capex'");
                                                                $stmts->execute();
                                                                $row = $stmts->fetch();
                                                                echo strtoupper($row['proponent']); 
                                                                $pname = $row['project_name'];
                                                                $contractor = $row['contractor'];
                                                                $contractAmt = $row['ecost'];
                                                                ?>
                                                            </b>&nbsp; Date:<?php echo $FA ?><br>
                                                            HEAD, SALES & MARKETING
                                                            </td>

                                                        <td class="txtInside" colspan="4">PROCESSED BY:
                                                            <BR><br>
                                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<?php echo date('Y-m-d') ?><br>
                                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                                        </td>
                                                       
                                                    </tr>
                                                    <tr>
                                                        <td class="txtInside" colspan="4">CERTIFY BY:
                                                            <BR><br>
                                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<?php echo $SA ?><br>
                                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">CHECKED BY:
                                                            <BR><br>
                                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<?php echo $TA ?><br>
                                                            MANAGER, PURCHASING
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">APPROVED BY:
                                                            <BR><br>
                                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<?php echo $FRA ?><br>
                                                            CHIEF OPERATING OFFICER
                                                        </td>                              
                                                    </tr>                                               
                                        </table>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        
                                        <div align="right">
                                            <div class="logo-print">
                                            </div>
                                            <hr>
                                        </div>
                                            <table class="table table-striped" border="2">
                                                <tr>
                                                    <td class="txtInside" colspan="2"><b>TO   :</b></td>
                                                    <td class="txtInside" colspan="4">FINANCE DEPARTMENT</td>
                                                    <td class="txtInside" colspan="3"><b>Control Number:</b><br>BC-ACM-MMO-19-054</td>
                                                    <td class="txtInside" colspan="3"><b>Date   :</b><br><?php echo date('F-d-Y') ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="txtInside" colspan="2"><b>FROM   :</b></td>
                                                    <td class="txtInside" colspan="4">ETS-BUILDING & CONSTRUCTION</td>
                                                    <td class="txtInside" colspan="3"><b>Effectivity :</b><br><?php echo date('F-d-Y') ?></td>
                                                    <td class="txtInside" colspan="3"><b>Supersedes :</b><br>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td class="txtInside" colspan="2"><b>CC   :</b></td>
                                                    <td class="txtInside" colspan="4"><b><?php echo strtoupper($row['proponent'])?></b></td>
                                                    <td class="txtInside" colspan="6"><b>SUBJECT:</b><br><b>ADDITIONAL COST MEMO (<?php echo $pname?>-ADDITIONAL WORKS)</b></td>
                                                </tr>
                                                <tr>
                                                    <td class="txtInside" colspan="12">
                                                    <?php 
                                                        $stmts = $GlobalConnection->runQuery("SELECT * From apollo_additional_cost WHERE capex_number='$Capex' and billing_type='Initial Payment (Additional Works)'");
                                                        $stmts->execute();
                                                        $row_c = $stmts->fetch();
                                                        $contractor_amount = $row_c['contract_price'];
                                                        $G = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                        $resContract =  $G->format($contractor_amount);
                                                        
                                                    ?>
                                                        <p>Sir / Ma'am,<br>
                                                        This is to request an additional budget allocation for the awarded contract amount & additional works at <br>
                                                        <?php echo $pname?> Project which was done by <b><?php echo $contractor?></b> amounting to <b><?php echo $contractor_amount?>Php</b> <?php echo ucwords($resContract);?> Thousand Pesos <br>
                                                        under CIP# <?php echo $Capex?>. Below are the breakdowns of cost. <br><br>
                                                        
                                                        Awarded Contract Amount:<?php echo $contractAmt ?><br>
                                                        Applied Amount For Construction: <?php echo $contractAmt ?><br>
                                                        Additional Cost: <?php echo $contractor_amount?><br><br>

                                                        (Awarded Contract Amount -Applied Amount For Construction +Additional Cost)<br>
                                                        ₱<?php echo $contractAmt ?>-₱<?php echo $contractAmt ?>+₱<?php echo $contractor_amount?> = <b>₱<?php echo $contractor_amount?></b><br><br><br>
                                                        Thank You!<br><br><br>

                                                        Prepared by:<br>
                                                        Date:<?php echo date('Y-m-d') ?><br>
                                                        <b><?php echo strtoupper($rows['engineer']) ?></b><br>
                                                        EO-Construction<br><br>

                                                        Certified by:<br>
                                                        Date:<?php echo $SA ?><br>
                                                        <b>Engr.Randy Carillo</b><br>
                                                        Head, Engineering Technical Services<br><br>

                                                        Noted by:<br>
                                                        Date:<?php echo $FA ?><br>
                                                        <b><?php echo strtoupper($row['proponent']);?></b><br>
                                                        Manager, Sales and Marketing<br><br>

                                                        Approved by:<br>
                                                        Date:<?php echo $FRA ?><br>
                                                        <b>Dionisio Literato.,DVM</b><br>
                                                        COO, RDF Feed, Livestocks & Food, Inc.<br><br>
                                                        
                                                    </p>

                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <p class="SmallText">Purok 6, Barangay Lara, City of San Fernando, Pampanga</p>
                                    </div>
                    
                <?php 
                }

                else if($rows['billing_type']=='Full Payment (Additional Works)'){                  
                    ?>
                    <BR>    
                     <div class="logo-print">
                     </div>
                    <BR><BR>  
                    <div>
                    <p colspan="2" class="txtFormat" align="center" style="font-size:18px "><B>Full PAYMENT (Additional Works) - <?php echo number_format($rows["progress"])?>% of Total Contract Cost</b></p>
                    </div>
                                    <div class="table-responsive" id="TableCostDetails">
                                        <table class="table table-striped" border="2">
                                            <tr border="2">
                                                <td>
                                                    <table class="table table-striped" border="0" >               
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Project Name &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows["project_name"]?></b></td>
                                                                <td colspan="6" class="txtHeader">Capex No. &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows["capex_number"]?></b> </td>                                                                                                          
                                                            </tr>
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Contract Price &nbsp;&nbsp;:&nbsp;&nbsp;<b>Php<?php echo $rows["contract_price"]?>.00</b> </td>
                                                                <td colspan="6" class="txtHeader">Scope of Works&nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows["scope_of_works"]?></b></td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6"class="txtHeader">Start of Construction &nbsp;&nbsp;:&nbsp;&nbsp;
                                                                <?php 
                                                                    $newDate = $rows['start_of_construction'];
                                                                    $tstamp =  strtotime($newDate);
                                                                    $old_date = date('l, F d Y', $tstamp); 
                                                                    echo  $old_date;
                                                                ?>
                                                            </td>
                                                                <td colspan="6" class="txtHeader">Projected Completion &nbsp;:&nbsp;&nbsp;   
                                                                    <?php 
                                                                        $newEndDate = $rows['project_completion'];
                                                                        $tstampEnd =  strtotime($newEndDate);
                                                                        $end_date = date('l, F d Y', $tstampEnd); 
                                                                        echo  $end_date;
                                                                    ?>
                                                                </td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Name of Contractor &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo $rows['contractor']?></b></td>
                                                                <td colspan="6" class="txtHeader"> Address &nbsp;:&nbsp;&nbsp;<?php echo $rows["c_address"]?></td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader"><b>Payee</b> &nbsp;&nbsp;:&nbsp;&nbsp;<b><?php echo strtoupper($rows['payee']) ?></b></td>
                                                                <td colspan="6" class="txtHeader"> Contact No &nbsp;:&nbsp;&nbsp;
                                                                    <?php 
                                                                       echo $rows["contact_number"];
                                                                    ?>
                                                                </td>                                                                                                          
                                                            </tr> 
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Date Prepared &nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                         $GDate = $rows['generated_date'];
                                                                         $NewGdate =  strtotime($GDate);
                                                                         $FgDate = date('l, F d Y', $NewGdate); 
                                                                         echo  $FgDate;
                                                                    ?>
                                                                </b></td>
                                                                <td colspan="6" class="txtHeader"><b>Billing Submission Date</b>&nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                         $BsDate = $rows['billing_submission'];
                                                                         $NewBsGdate =  strtotime($BsDate);
                                                                         $FBsDate = date('l, F d Y', $NewBsGdate); 
                                                                         echo  $FBsDate;
                                                                    ?>
                                                                </b></td>                                                                                                          
                                                            </tr>
                                                            <tr class="noBorder">                                       
                                                                <td colspan="6" class="txtHeader">Date Recieved &nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                        $DrDate = $rows['date_recieve'];
                                                                        $NewDrdate =  strtotime($DrDate);
                                                                        $FdrDate = date('l, F d Y', $NewDrdate); 
                                                                        echo  $FdrDate;
                                                                    ?>
                                                                </b></td>
                                                                <td colspan="6" class="txtHeader"><b>Payment Needed On</b>&nbsp;:&nbsp;&nbsp;<b>
                                                                    <?php 
                                                                        $PnoDate = $rows['payment_needed_on'];
                                                                        $NewPnodate =  strtotime($PnoDate);
                                                                        $FpnoDate = date('l, F d Y', $NewPnodate); 
                                                                        echo  $FpnoDate;
                                                                    ?>
                                                                </b></td>                                                                                                          
                                                            </tr>    
                                                    </table >
                                                </td>
                                            </tr>
                                        </table>
                                        
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
                                                     
                                                        <td class="txtInside" colspan="2" rowspan="3"><center><b>Php <?php echo $rows['contract_price']?>.00</b></center></td>
                                                       
                                                        <td class="txtInside" rowspan="3"><center><b>
                                                            <?php
                                                                $todate = $rows['progress'];
                                                                $tdate = 100-$todate;
                                                                echo number_format(($tdate),2);
                                                            ?>%
                                                        </b></center></td>
                                                        <td class="txtInside" rowspan="3"><center><b><?php echo $rows['progress']?>.00%</b></center></td>
                                                        <td class="txtInside" rowspan="3"><center><b>
                                                            <?php
                                                                 $tperiod = $rows['progress'];
                                                                 $tdate = 100-$todate;
                                                                 $finalthisperiod = $tperiod + $tdate;
                                                                 echo number_format(($finalthisperiod),2);
                                                            ?>%
                                                        </b></center></td>
                                                        <td></td>
                                                        <td class="txtInside" rowspan="3" colspan="2"><center><b>
                                                            <?php
                                                             $oldBill = $rows['billable'];
                                                             $output = str_replace(',', '', $oldBill);
                                                             echo number_format($output, 2);
                                                            ?>
                                                        </b></center></td>
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
                                                       
                                                    
                                                        <td class="txtInside"><center><?php echo $rows['progress']?>.00%</center></td>
                                                        <td></td>
                                                        <td class="txtInside" colspan="2"><center><b>Php 
                                                            <?php
                                                             $oldBill = $rows['billable'];
                                                             $output = str_replace(',', '', $oldBill);
                                                             echo number_format($output, 2);
                                                            ?>
                                                        </b></center></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td class="txtInside" colspan="5">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; 
                                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; <b>Amount in Words</b></td>
                                                       
                                                        <td class="txtInside" colspan="7"><center>
                                                        <b>
                                                            <?php
                                                                $billings = $rows['billable'];
                                                                $output = str_replace(',', '', $billings);
                                                                $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                                $res =  $f->format($output);
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
                                            <?php
                                                 $CapexNum = $rows["capex_number"];
                                                 $DateOfApproval = $GlobalConnection->runQuery("SELECT * FROM apollo_trackingofbilling 
                                                 WHERE capex_number = '$CapexNum' 
                                                 AND billing_type = 'Full Payment (Additional Works)'");
                                                 $DateOfApproval->execute();
                                                 $FinalDate = $DateOfApproval->fetch();                                             
                                                    $BD = $FinalDate['billing_date'];
                                                    $FA = $FinalDate['fdate_approved'];
                                                    $SA = $FinalDate['sdate_approved'];
                                                    $TA = $FinalDate['tdate_approved'];
                                                    $FRA = $FinalDate['frdate_approved'];
                                            ?>
                                                    <tr>
                                                        <td class="txtInside" colspan="4">PREPARED BY:
                                                            <BR><br>
                                                            <b><?php echo strtoupper($rows['engineer']) ?></b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<?php echo $BD ?><br>
                                                            ENGINEERING OFFICER
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">NOTED BY:
                                                           <BR><br>
                                                            <b>
                                                                <?php 
                                                                $stmts = $GlobalConnection->runQuery("SELECT * From apollo_enrolledproject WHERE capex_number='$Capex'");
                                                                $stmts->execute();
                                                                $row = $stmts->fetch();
                                                                echo strtoupper($row['proponent']) 
                                                                ?>
                                                            </b>&nbsp; Date:<?php echo $FA ?><br>
                                                            HEAD, SALES & MARKETING
                                                            </td>

                                                        <td class="txtInside" colspan="4">PROCESSED BY:
                                                            <BR><br>
                                                            <b>TEODERICK AQUINO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;   Date:<?php echo date('Y-m-d') ?><br>
                                                            SUPERVISOR, ASSET MANAGEMENT GROUP
                                                        </td>
                                                       
                                                    </tr>
                                                    <tr>
                                                        <td class="txtInside" colspan="4">CERTIFY BY:
                                                            <BR><br>
                                                            <b>RANDY CARILLO</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:<?php echo $SA ?><br>
                                                            HEAD, ENGINEERING TECHNICAL SERVICES
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">CHECKED BY:
                                                            <BR><br>
                                                            <b>JEFREY LINDAIN</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;Date:<?php echo $TA ?><br>
                                                            MANAGER, PURCHASING
                                                        </td>
                                                       
                                                        <td class="txtInside" colspan="4">APPROVED BY:
                                                            <BR><br>
                                                            <b>DIONISIO LITERATO, DVM</b>&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; Date:<?php echo $FRA ?><br>
                                                            CHIEF OPERATING OFFICER
                                                        </td>                              
                                                    </tr>                                               
                                        </table>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        
                                        <div align="right">
                                            <div class="logo-print">
                                            </div>
                                            <hr>
                                        </div>
                                            <table class="table table-striped" border="2">
                                                <tr>
                                                    <td class="txtInside" colspan="2"><b>TO   :</b></td>
                                                    <td class="txtInside" colspan="4">FINANCE DEPARTMENT</td>
                                                    <td class="txtInside" colspan="3"><b>Control Number:</b><br>BC-ACM-MMO-19-054</td>
                                                    <td class="txtInside" colspan="3"><b>Date   :</b><br><?php echo date('F-d-Y') ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="txtInside" colspan="2"><b>FROM   :</b></td>
                                                    <td class="txtInside" colspan="4">ETS-BUILDING & CONSTRUCTION</td>
                                                    <td class="txtInside" colspan="3"><b>Effectivity :</b><br><?php echo date('F-d-Y') ?></td>
                                                    <td class="txtInside" colspan="3"><b>Supersedes :</b><br>N/A</td>
                                                </tr>
                                                <tr>
                                                    <td class="txtInside" colspan="2"><b>CC   :</b></td>
                                                    <td class="txtInside" colspan="4"><b><?php echo strtoupper($row['proponent'])?></b></td>
                                                    <td class="txtInside" colspan="6"><b>SUBJECT:</b><br><b>ADDITIONAL COST MEMO (<?php echo $pname?>-ADDITIONAL WORKS)</b></td>
                                                </tr>
                                                <tr>
                                                    <td class="txtInside" colspan="12">
                                                    <?php 
                                                        $stmts = $GlobalConnection->runQuery("SELECT * From apollo_additional_cost WHERE capex_number='$Capex' and billing_type='Initial Payment (Additional Works)'");
                                                        $stmts->execute();
                                                        $row_c = $stmts->fetch();
                                                        $contractor_amount = $row_c['contract_price'];
                                                        $G = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                        $resContract =  $G->format($contractor_amount);
                                                        
                                                    ?>
                                                        <p>Sir / Ma'am,<br>
                                                        This is to request an additional budget allocation for the awarded contract amount & additional works at <br>
                                                        <?php echo $pname?> Project which was done by <b><?php echo $contractor?></b> amounting to <b><?php echo $contractor_amount?>Php</b> <?php echo ucwords($resContract);?> Thousand Pesos <br>
                                                        under CIP# <?php echo $Capex?>. Below are the breakdowns of cost. <br><br>
                                                        
                                                        Awarded Contract Amount:<?php echo $contractAmt ?><br>
                                                        Applied Amount For Construction: <?php echo $contractAmt ?><br>
                                                        Additional Cost: <?php echo $contractor_amount?><br><br>

                                                        (Awarded Contract Amount -Applied Amount For Construction +Additional Cost)<br>
                                                        ₱<?php echo $contractAmt ?>-₱<?php echo $contractAmt ?>+₱<?php echo $contractor_amount?> = <b>₱<?php echo $contractor_amount?></b><br><br><br>
                                                        Thank You!<br><br><br>

                                                        Prepared by:<br>
                                                        Date:<?php echo date('Y-m-d') ?><br>
                                                        <b><?php echo strtoupper($rows['engineer']) ?></b><br>
                                                        EO-Construction<br><br>

                                                        Certified by:<br>
                                                        Date:<?php echo $SA ?><br>
                                                        <b>Engr.Randy Carillo</b><br>
                                                        Head, Engineering Technical Services<br><br>

                                                        Noted by:<br>
                                                        Date:<?php echo $FA ?><br>
                                                        <b><?php echo strtoupper($row['proponent']);?></b><br>
                                                        Manager, Sales and Marketing<br><br>

                                                        Approved by:<br>
                                                        Date:<?php echo $FRA ?><br>
                                                        <b>Dionisio Literato.,DVM</b><br>
                                                        COO, RDF Feed, Livestocks & Food, Inc.<br><br>
                                                        
                                                    </p>

                                                    </td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <p class="SmallText">Purok 6, Barangay Lara, City of San Fernando, Pampanga</p>
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
