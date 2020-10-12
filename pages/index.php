<?php
session_start();

require_once("GlobalClass.php");
$GlobalConnection = new GlobalConnection();

if (isset($_SESSION['position'])) {
    $fullname = $_SESSION['fullname'];
    $Position = $_SESSION['position'];
    if ($Position == 'Eo') {
        $capex = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject Where engineer ='$fullname'");
        $capex->execute();

        $projectList = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS projectList FROM `apollo_enrolledproject` Where engineer ='$fullname'");
        $projectList->execute();

        $Ongoing = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS ongoing FROM `apollo_enrolledproject` Where engineer ='$fullname' AND project_status='Open'");
        $Ongoing->execute();

        $Closed = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS closed FROM `apollo_enrolledproject` Where engineer ='$fullname' AND project_status='Completed'");
        $Closed->execute();

        $Pending = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS pending FROM `apollo_enrolledproject` Where engineer ='$fullname' AND project_status='Closed'");
        $Pending->execute();
    } else {
        $capex = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject");
        $capex->execute();

        $projectList = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS projectList FROM `apollo_enrolledproject`");
        $projectList->execute();

        $Ongoing = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS ongoing FROM `apollo_enrolledproject` Where project_status='Open'");
        $Ongoing->execute();

        $Closed = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS closed FROM `apollo_enrolledproject` Where project_status='Completed'");
        $Closed->execute();

        $Pending = $GlobalConnection->runQuery("SELECT COUNT(capex_number)AS pending FROM `apollo_enrolledproject` Where  project_status='Closed'");
        $Pending->execute();
    }
} else {
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
        <?php include_once("sideNavigation.php"); ?>
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
                                <input type="text" name="search" placeholder="Search..." required />
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- notification here -->
                    <?php include_once("notification/notification.php"); ?>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left" id="ContainerTitle">Dashboard</h4>
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
                <!-- sales report area start -->
                <div class="sales-report-area sales-style-two">
                    <div class="row">
                        <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
                            <div class="single-report">
                                <div class="s-sale-inner pt--30 mb-3">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Project List</h4>
                                        <?php

                                        while ($rowProjectList  = $projectList->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <button type="button" class="btn btn-info mb-3 border-0 pr-3">
                                                <span class="badge badge-light"><?php echo $rowProjectList['projectList'] ?></span>
                                            </button>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                                <!-- <canvas id="coin_sales4" height="1"></canvas> -->
                            </div>
                        </div>
                        <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
                            <div class="single-report">
                                <div class="s-sale-inner pt--30 mb-3">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">On Going Projects</h4>
                                        <?php

                                        while ($rowongoing  = $Ongoing->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <button type="button" class="btn btn-success mb-3 border-0 pr-3">
                                                <span class="badge badge-light"><?php echo $rowongoing['ongoing'] ?></span>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                        <!-- <select class="custome-select border-0 pr-3">
                                            <option selected="">Last 7 Days</option>
                                            <option value="0">Last 7 Days</option>
                                        </select> -->
                                    </div>
                                </div>
                                <!-- <canvas id="coin_sales5" height="1"></canvas> -->
                            </div>
                        </div>
                        <div class="col-xl-3 col-ml-3 col-md-6  mt-5">
                            <div class="single-report">
                                <div class="s-sale-inner pt--30 mb-3">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Closed Projects</h4>
                                        <?php

                                        while ($rowClosed  = $Closed->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <button type="button" class="btn btn-danger mb-3 border-0 pr-3">
                                                <span class="badge badge-light"><?php echo $rowClosed['closed'] ?></span>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- <canvas id="coin_sales6" height="1"></canvas> -->
                            </div>
                        </div>
                        <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
                            <div class="single-report">
                                <div class="s-sale-inner pt--30 mb-3">
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Pending Projects</h4>
                                        <?php

                                        while ($rowpending  = $Pending->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <button type="button" class="btn btn-warning mb-3 border-0 pr-3">
                                                <span class="badge badge-light"><?php echo $rowpending['pending'] ?></span>
                                            </button>
                                        <?php
                                        }
                                        ?>
                                        <!-- <select class="custome-select border-0 pr-3">
                                            <option selected="">Last 7 Days</option>
                                            <option value="0">Last 7 Days</option>
                                        </select> -->
                                    </div>
                                </div>
                                <!-- <canvas id="" height="1"></canvas> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- sales report area end -->
                <div class="row" id="Container">
                    <div class="col-12 mt-3" id="AssignedProjectList">
                        <div class="card">
                            <div class="card-body">
                                <div align="right">
                                </div>
                                <LEFT>
                                    <h4 class="header-title">Project Gantt Chart</h4>
                                </LEFT>
                                <div class="form-row">
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom01">Capex Number</label>
                                        <select class=" custom-select" name="CapexNum" id="CapexNum" onchange="SelectFunction(this.value)">
                                            <option value=""></option>
                                            <?php
                                            while ($row = $capex->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value="<?php echo $row['capex_number']; ?>"><?php echo $row['capex_number']; ?> - <?php echo $row['project_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div align="right">  -->
                                <input type="button" value="Print" onclick="PrintDiv('chart-container')" />
                                <!-- </div> -->

                                <div id="chart-container">Select Capex Number to Show Chart</div>

                            </div>
                        </div>
                    </div>
                </div>
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

<!-- <script src="navigation_script.js"></script>
        <script src="userAccount.js"></script>
        <script src="ProjectMasterlist.js"></script>
        <script src="EnrollProject.js"></script>
        <script src="EnrollScopes.js"></script>
        <script src="modal_AddSubScopes.js"></script> -->

</html>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("#CapexNum").change(function() {
            var capex = $('#CapexNum').val();
            $.ajax({
                type: "POST",
                url: "GanttChart/selectingTotalSlacks.php",
                data: {
                    capex: capex
                },
                dataType: "text",
                success: function(name) {
                    // alert(TotalSlacks);
                    $('#pname').val(name);
                }
            });
        });



    });

    function PrintDiv(id) {
        var data = document.getElementById(id).innerHTML;
        var myWindow = window.open('', 'my div', 'height=600,width=1300');
        myWindow.document.write('<html><head><title></title>');
        /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        myWindow.document.write('</head><body >');
        myWindow.document.write(data);
        myWindow.document.write('</body></html>');
        myWindow.document.close(); // necessary for IE >= 10

        myWindow.onload = function() { // necessary if the div contain images

            myWindow.focus(); // necessary for IE >= 10
            myWindow.print();
            myWindow.close();
        };
    }
</script>