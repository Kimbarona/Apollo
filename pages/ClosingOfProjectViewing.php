<?php
    session_start();
    if(isset($_SESSION['position'])){
        
    }
    else{
        header("Location:../login.php");
    }
    require_once("GlobalClass.php");
    $GlobalConnection = new GlobalConnection();
   
    $TriggerCapex = $_GET['id'];
    $stmts = $GlobalConnection->runQuery("SELECT * From apollo_enrolledproject WHERE capex_number = '$TriggerCapex'");
    $stmts->execute();
    $row = $stmts->fetch();
    $ProjectName = $row['project_name'];
    $Contractor = $row['contractor'];
    $DownPayment = $row['dpayment'];
    $RetentionPayment = $row['project_retention'];    


     $stmt = $GlobalConnection->runQuery("CALL `Pro_select_works`(:_TriggerCapex)");
     $stmt->bindParam(':_TriggerCapex', $TriggerCapex);
     $stmt->execute();

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Apollo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico"> -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <!-- <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" /> -->
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
    <script src="ManageProjectCost.js"></script>
    
 
</head>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <?php include_once("sideNavigation.php");?>
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- notification here -->
                    <?php include_once("notification/notification.php");?>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left" id="ContainerTitle">Project Cost and Previous Billings</h4>
                            <ul class="breadcrumbs pull-left">
                                <!-- <li><a href="index.html"></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['fullname']; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="LogoutAllsessions.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- page title area end -->
            <div id="AlertSucess"></div>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12 mt-5" id="MonitoringList">
                        <div class="card">
                            <div class="card-body" >                            
                            <form method="post" id="update_form">
                                <div align="center">
                                <a href="ClosingOfProject.php" class="btn btn-info mb-3" ><<<< Back</a>
                                </div>
                                <h4 class="header-title"><h4>Scopes Progress Cost</h4>                                
                                Project Name: <h4 class="header-title"> <?php echo $ProjectName ?></h4>  
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="datatable">
                                            <thead>
                                                <th class="" width="10%" style="background-color:#7855ed; color:white;">Capex Number</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="40%">Scopes</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Amount</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Weight</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Percentage</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Equivalent Weight</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Total Amount</th>
                                                
                                                
                                            </thead>
                                            <tbody>
                                        <!-- to get information with other table -->
                                            <?php
                                            
                                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $row['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                            $FloatCa = (float)$RemoveComma;
                                       
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
                                                            $sendforprint =implode($TotalEquiv);
                                                                                                                 
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
                                            
                                                                $ew = (array_sum($TotalEquiv));
                                                                $EquivalentWeight = number_format(($ew),2);                                                                                                                              
                                                            ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" id="TotalAmount" value="<?php echo $TotalAmount; ?>"/>
                                    <input type="hidden" id="EquivalentWeight" value="<?php echo $EquivalentWeight; ?>"/>
                            </form>
                            </div>
                        </div>
                    </div>
                <!-- Billing table -->
              
                <div class="col-12 mt-5" id="BillingList">
                        <div class="card">
                            <div class="card-body" >                                              
                                <h4 class="header-title">Billing Details</h4>  
                                    <div class="table-responsive" id="TableCostDetails">
                                        <table class="table table-bordered table-striped" >
                                            <thead>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="5%">Created Date</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Capex Number</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="25%">Project Name</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="20%">Contractor</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Contract Amount</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="15%">Billing Type</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="5%">Progress</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="10%">Billing Amount</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="5%">Status</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="5%">Tag Number</th>
                                                <th class="table-primary" style="background-color:#7855ed; color:white;" width="5%">Voucher Number</th>
                                                
                                                
                                            </thead>
                                            <tbody>
                                            <?php
                                                $Position = $_SESSION['position'];
                                                $stmts = $GlobalConnection->runQuery("SELECT * FROM apollo_masterlistofbillings WHERE capex_number ='$TriggerCapex'");
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
                                                        <td><?php echo number_format ($rows['progress'], 2)?>%</td>
                                                        <td><h5><span class="badge badge-info">₱<?php echo number_format(($baRemoveComma),2) ?></span></h5></td>
                                                        <td>
                                                            <?php
                                                                if($rows['billing_status']==3){
                                                                    ?>
                                                                        <h6><span class="badge badge-success"><?php echo 'Printed';?></span></h6>
                                                                    <?php
                                                                } 
                                                                else{
                                                                    ?>
                                                                        <h6><span class="badge badge"><?php echo 'To Print';?></span></h6>
                                                                    <?php
                                                                }   
                                                            ?>
                                                        </td>
                                                        <td><?php echo $rows['tag_number']; ?></td>
                                                        <td><?php echo $rows['voucher_number']; ?></td>
                                                            
                                                       
                                                    </tr>
                                                <?php  
                                               
                                                }
                                               
                                                ?> 
                                               
                                                                                        
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
            
                </div>
                </div>
            </div>
        </div><br>
              
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2019. All right reserved. Developed by <a href="#">MIS Developers Unit</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
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
 