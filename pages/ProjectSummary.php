<?php
    session_start();
    require_once("ProjectSummary/class.php");
    $ProjectSummary = new ProjectSummary();

    if(isset($_SESSION['position'])){
       
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
    <script src=""></script>
 
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
                            <h4 class="page-title pull-left" id="ContainerTitle">Project Overview</h4>
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
                        <!-- data table start -->
                    <div class="col-12 mt-5" id="AssignedProjectList">
                        <div class="card">
                            <div class="card-body">                              
                                <div align="right">                                    
                                </div>                                                                             
                                <h4 class="header-title">Overview</h4>
                                <HR>
                                <div>
                                    <select name="FilterCapex" id="FilterCapex" class="custom-select col-md-3 mb-3" onchange="SearchCapexNum(this.value)">
                                        <option value="">Select Capex</option>
                                    <?php   
                                         if(isset($_SESSION['position'])){
                                            $fullname=$_SESSION['fullname'];
                                            $Position = $_SESSION['position'];
                                            if($Position == 'Eo'){
                                                $view = $ProjectSummary->runQuery("SELECT capex_number, project_name FROM apollo_enrolledproject WHERE engineer='$fullname' AND project_status='Completed'");
                                                $view->execute();
                                            }
                                            else{
                                                $view = $ProjectSummary->runQuery("SELECT capex_number, project_name FROM apollo_enrolledproject WHERE project_status='Completed'");
                                                $view->execute();
                                            }
                                        }
                                  
                                        while($row = $view->fetch(PDO::FETCH_ASSOC))
                                        {
                                            ?>
                                                <option value="<?php echo $row['capex_number']; ?>"><?php echo $row['capex_number']; ?> - <?php echo $row['project_name']; ?></option>  
                                            <?php
                                         }
                                    ?>                      
                                    </select>
                                    <input type="text" class="form-control col-md-3 mb-3" id="Contractor" value="" placeholder="Contractor" readonly>
                                </div><br>                                                                                
                                <div class="data-tables">                                                                          
                                    <div id="ContainerTable"></div>                                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
        
</html>
<script type="text/javascript" language="javascript">
$(document).ready(function(){  
   
    $( "#FilterCapex" ).change(function() {
        var FilterCapex = $('#FilterCapex').val();
        
        $.ajax({
            type: "POST",
            url: "ProjectSummary/SearchSummary.php",
            data: {FilterCapex:FilterCapex},
            success: function(response){
                $("#ContainerTable").html(response);
                // // alert(response);
                // console.log(response);
            }
          });
     
    });
});    

function SearchCapexNum(val){
        
        $.ajax({
        type: "POST",
        url: "ProjectSummary/SearchContractor.php",
        data: {capex:val},
        dataType: "text",
        success: function(response){   
            $('#Contractor').val(response); 
            // console.log(response);
        }
        
        });

    }


function reloadData(){
        var FilterCapex = $('#FilterCapex').val();
        
        $.ajax({
            type: "POST",
            url: "ProjectMonitoring/SearchPendingToStart.php",
            data: {FilterCapex:FilterCapex},
            success: function(response){
                $("#ContainerTable").html(response);
                // // alert(response);
                // console.log(response);
            }
          });

}

</script>