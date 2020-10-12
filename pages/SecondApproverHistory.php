<?php
    session_start();
    if(isset($_SESSION['position'])){
        
    }
    else{
        header("Location:../login.php");
    }
    require_once("GlobalClass.php");
    $GlobalConnection = new GlobalConnection();
     
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
                            <h4 class="page-title pull-left" id="ContainerTitle">History</h4>
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
                     <!-- Primary table start -->
                    <div class="col-12 mt-5">
                    <div id="AlertMessage"></div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Billing History List</h4>
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-bordered table-striped">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <!-- <th width="5%" style="background-color:#7855ed; color:white;">Generated Date</th> -->
                                                <th width="5%" style="background-color:#7855ed; color:white;">Capex</th>
                                                <!-- <th width="10%" style="background-color:#7855ed; color:white;">Contract Amount</th> -->
                                                <th width="15%" style="background-color:#7855ed; color:white;">Contractor</th>
                                                <th width="20%" style="background-color:#7855ed; color:white;">Billing Type</th>
                                                <th width="5%" style="background-color:#7855ed; color:white;">Progress</th>  
                                                <!-- <th width="5%" style="background-color:#7855ed; color:white;">ApprovedBy</th>                                            -->
                                                <th width="10%" style="background-color:#7855ed; color:white;">Billable Amount</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Approved Date</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Status</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Note</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $fullname = $_SESSION['fullname'];
                                            $stmts = $GlobalConnection->runQuery("SELECT * FROM apollo_secondapprover WHERE billing_status IN('Approved','Rejected') AND approver_name ='$fullname'");
                                            $stmts->execute();
                                                while($rows = $stmts->fetch(PDO::FETCH_ASSOC))
                                                {   
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $rows['capex_number']?></td>
                                                        <td><?php echo $rows['contractor']?></td>
                                                        <td><?php echo $rows['billing_type']?></td>
                                                        <td><?php echo $rows['progress']?>%</td>
                                                        <!-- <td><?php echo $rows['approvedby']?></td>                            -->
                                                        <td>₱<?php echo $rows['billable_amount']?></td>
                                                        <td><?php echo $rows['approval_date']?></td>
                                                        <td><?php echo $rows['billing_status']?></td>
                                                        <?php
                                                        if($rows['billing_status']=='Approved'){
                                                            ?>
                                                             <td style="background-color:green; color:white;" data-toggle="tooltip" data-placement="Left" title="<?php echo $rows['remarks']?>"><?php echo $rows['remarks']?></td>

                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                             <td style="background-color:red; color:white;" data-toggle="tooltip" data-placement="Left" title="<?php echo $rows['remarks']?>"><?php echo $rows['remarks']?></td>

                                                            <?php
                                                        }
                                                       ?>
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
                    <!-- Primary table end -->
            </div>
        </div>
                   
        <!-- main content area end -->
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

 
