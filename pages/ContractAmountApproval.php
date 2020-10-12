<?php
    session_start();
    require_once("GlobalClass.php");
    $GlobalConnection = new GlobalConnection();
    if(isset($_SESSION['position'])){
        
        $Position = $_SESSION['position'];
        if($Position == 'Proponent'){
            $FullName = $_SESSION['fullname'];
            $stmt = $GlobalConnection->runQuery("SELECT * FROM apollo_contractamount_approval WHERE proponent = :proponent ");
            $stmt->bindparam(":proponent",$FullName);
            $stmt->execute();
        }
        else if($Position == 'Planner'){
            $stmt = $GlobalConnection->runQuery("SELECT * FROM apollo_contractamount_approval WHERE approval_status in('Approved','Hold')");
            $stmt->execute();
        }
        else{
            $stmt = $GlobalConnection->runQuery("SELECT * FROM apollo_contractamount_approval WHERE approval_status ='For Approval'");
            $stmt->execute();
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
                            <h4 class="page-title pull-left" id="ContainerTitle">Contract Amount Approval List</h4>
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
            <div id="AlertApprovalList"></div>
            <div class="main-content-inner">
                <div class="col-lg-12 col-ml-12">
                    <div class="row">
                            <div class="col-12">
                                <div class="card mt-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">CA List</h4>
                                            <div class="data-tables">
                                                    <table id="dataTable" class="text-center">
                                                        <thead class="bg-light text-capitalize">
                                                        <tr>
                                                        
                                                            <th>Capex Number</th>
                                                            <th>Project Name</th>
                                                            <th>Budget Amount</th>
                                                            <th>Applied Contract Amount</th>
                                                            <th>Approval Status</th>
                                                            <?php
                                                             if($Position == 'Planner'){
                                                                 ?>
                                                                   
                                                                <?php
                                                             }
                                                             else{
                                                                 ?>
                                                                <th>Action</th>
                                                                <?php
                                                             }
                                                            ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                            ?>
                                                            <tr>                                                            
                                                                <td><?php echo $row['capex_number']; ?></td>
                                                                <td><?php echo $row['project_name']; ?></td>
                                                                <td><?php echo $row['budgeted_amount']; ?></td>
                                                                <td>
                                                                    <?php 
                                                                        $a = $row['contract_amount']; 
                                                                        $b = str_replace( ',', '', $a );
                                                                        echo number_format($b, 2);
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $row['approval_status']; ?></td>
                                                                <?php
                                                                    $Position = $_SESSION['position'];
                                                                    if($Position == 'Planner'){
                                                                        ?>
                                                                            <td>
                    
                                                                            </td>
                                                                        <?php
                                                                    }
                                                                    else{
                                                                        if($row['approval_status'] == 'Not Available'){
                                                                            ?>
                                                                            <td>
                                                                                <button class="btn btn-success btn-xs mb-3" type="type" id="ApprovalBtn" value="<?php echo $row['capex_number']; ?>">Approve</button>
                                                                                <button class="btn btn-warning btn-xs mb-3" type="type" id="HoldBtn" value="<?php echo $row['capex_number']; ?>">Hold</button>
                                                                            </td>
                                                                        <?php
                                                                        }
                                                                        else if($row['approval_status'] == 'Hold'){
                                                                            ?>
                                                                            <td>
                                                                                <button class="btn btn-success btn-xs mb-3" type="type" id="ApprovalBtn" value="<?php echo $row['capex_number']; ?>">Approve</button>
                                                                                <!-- <button class="btn btn-warning btn-xs mb-3" type="type" id="HoldBtn" value="<?php echo $row['capex_number']; ?>">Hold</button> -->
                                                                            </td>
                                                                        <?php
                                                                        }
                                                                        else if($row['approval_status'] == 'Approved'){
                                                                            ?>
                                                                            <td>
                                                                                <!-- <button class="btn btn-success btn-xs mb-3" type="type" id="ApprovalBtn" value="<?php echo $row['capex_number']; ?>">Approve</button> -->
                                                                                <!-- <button class="btn btn-warning btn-xs mb-3" type="type" id="HoldBtn" value="<?php echo $row['capex_number']; ?>">Hold</button> -->
                                                                            </td>
                                                                        <?php
                                                                        }
                                                                        else{
                                                                            ?>
                                                                            <td>
                                                                                <button class="btn btn-success btn-xs mb-3" type="type" id="ApprovalBtn" value="<?php echo $row['capex_number']; ?>">Approve</button>
                                                                                <button class="btn btn-warning btn-xs mb-3" type="type" id="HoldBtn" value="<?php echo $row['capex_number']; ?>">Hold</button>
                                                                            </td>
                                                                        <?php
                                                                        }
                                                                        
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
        <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->
        <!-- others plugins -->
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/scripts.js"></script>       
</html>
<script>
    $( "#ApprovalBtn" ).click(function() {
        var CapexNum = $(this).val();
        var r = confirm("Are You sure? You want to Approve this?");
        var Status = "Approved";
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: "ContractAmountApprovedStatus.php",
                    data: {CapexNum:CapexNum, Status:Status},
                    success: function (mensahe) {
                        alert(mensahe);
                        location.reload();
                    }
                })
            }
            else{

            }
    });

    $( "#HoldBtn" ).click(function() {
        var CapexNum = $(this).val();
        var r = confirm("Are You sure? You want to put on Hold this?");
        var Status = "Hold";
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: "ContractAmountApprovedStatus.php",
                    data: {CapexNum:CapexNum, Status:Status},
                    success: function (mensahe) {
                        alert(mensahe);
                        location.reload();
                    }
                })
            }
            else{
                
            }
    });
</script>