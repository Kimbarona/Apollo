<?php
session_start();

require_once("GlobalClass.php");
$GlobalConnection = new GlobalConnection();

    if(isset($_SESSION['position'])){
        $fullname=$_SESSION['fullname'];
        $Position = $_SESSION['position'];
        if($Position == 'Eo'){
        $capex = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject Where engineer ='$fullname'");
        $capex->execute();

        $projectList = $GlobalConnection->runQuery("SELECT * FROM `apollo_enrolledproject` Where engineer ='$fullname'");
        $projectList->execute();

        $Ongoing = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS ongoing FROM `apollo_enrolledproject` Where engineer ='$fullname' AND project_status='Open'");
        $Ongoing->execute();

        $Closed = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS closed FROM `apollo_enrolledproject` Where engineer ='$fullname' AND project_status='Completed'");
        $Closed->execute();

        $Pending = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS pending FROM `apollo_enrolledproject` Where engineer ='$fullname' AND project_status='Closed'");
        $Pending->execute();
        }
        else{
            $capex = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject");
            $capex->execute();

            $projectList = $GlobalConnection->runQuery("SELECT * FROM `apollo_enrolledproject`");
            $projectList->execute();

            $Ongoing = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS ongoing FROM `apollo_enrolledproject` Where project_status='Open'");
            $Ongoing->execute();

            $Closed = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS closed FROM `apollo_enrolledproject` Where project_status='Completed'");
            $Closed->execute();

            $Pending = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS pending FROM `apollo_enrolledproject` Where  project_status='Closed'");
            $Pending->execute();

        }
    }

    else{
        header("Location:../login.php");
    }

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
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
    <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    
    
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="script.js"></script>


</head>
<body>
    <!-- [if lt IE 8]>
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
                                <input type="text" name="search" placeholder="Search..." required/>
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
                            <h4 class="page-title pull-left" id="ContainerTitle">Manage Additional Cost</h4>
                            <ul class="breadcrumbs pull-left">
                                <!-- <li><a href="index.html"></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $fullname ?><i class="fa fa-angle-down"></i></h4>
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
            <div class="main-content-inner">
                <div class="row">
                 <!-- data table start -->
                 <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Additional Project Cost List</h4>
                                <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">
                                                <tr>
                                                    <th>Capex number</th>
                                                    <th>Project Name</th>
                                                    <th>Contractor</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                while($rowprojectlist  = $projectList->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $rowprojectlist['capex_number']?></td>
                                                        <td><?php echo $rowprojectlist['project_name']?></td>
                                                        <td><?php echo $rowprojectlist['contractor']?></td>
                                                        <td>
                                                            <a href="#Addcost<?php echo $rowprojectlist['capex_number']?>" class="btn btn-success fa fa-plus" data-toggle="modal"> Additional Cost</a>
                                                            <!-- <button type="#" class="btn btn-info fa fa-eye" data-dismiss="modal"> View</button> -->
                                                        </td>
                                                    </tr>
                                                <?php
                                                 include('AdditionalCost/AdditionalCostModal.php');
                                                }
                                               
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->
                </div>
            </div>
             <!-- modal for new additional cost -->
 
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
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
        <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
        <script src="../assets/js/line-chart.js"></script>
        <script src="../assets/js/bar-chart.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->
        <!-- others plugins -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/scripts.js"></script>
</html>

