<?php

    session_start();
    require_once("GlobalClass.php");
    $GlobalConnection = new GlobalConnection();

    if(isset($_SESSION['position'])){
        
    }
    else{
        header("Location:../login.php");
    }

require_once("Addusers/class_userAccount.php");
$user = new user();
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

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
     -->
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="Addusers/userAccount.js"></script> -->
    
    <!-- this is for toogle button -->
    <!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> -->

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
                            <h4 class="page-title pull-left" id="ContainerTitle">Add User</h4>
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
            <div id="AddnewUserAlert"></div>
                <div class="main-content-inner">
                    <div class="row" >
                        <div class="col-lg-5 col-ml-12" id="" >
                            <div class="col-12">
                                <div class="card mt-5">
                                    <div id="AlertUserAccount"></div>
                                    <div class="card-body">
                                        <h4 class="header-title">Add user </h4>
                                        <form class="needs-validation" method="POST" id="RegisterAccountForm" >
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustom01">Full Name</label>
                                                    <input type="text" name="FullName" class="form-control" id="FullName" placeholder="" required="">
                                                  
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustomUsername">Username</label>
                                                    <div class="input-group">
                                                        
                                                        <input type="text" name="UserName" class="form-control" id="UserName" required>
                                                       
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="form-row">
                                               

                                                <div class="col-md-6 mb-3">
                                                    <label for="validationCustomUsername">Password</label>
                                                    <div class="input-group">
                                                    
                                                        <input type="password" name="user_password" class="form-control" id="user_password" placeholder="" aria-describedby="inputGroupPrepend" required="">
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                        <label for="validationCustomUsername">Position</label>
                                                    <select class="custom-select" id="Position" name="Position">
                                                        <option>Select Position</option>
                                                        <option>Admin</option>
                                                        <option>Head</option>
                                                        <option>Planner</option>
                                                        <option>Eo</option>
                                                        <option>Proponent</option>
                                                        <option>Approver-2</option>
                                                        <option>Final-Approver</option>
                                                        <option>Amg</option>
                                                        <option>Internal-Audit</option>
                                                        <option>Finance-FA</option>
                                                        <option>Finance-Tagging</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div align="right">
                                            <button class="btn btn-primary" type="type" id="btnUserRegistration">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>                            
                        </div>
                    </div>

                      <div class="col-7 mt-5" id="MonitoringList">
                        <div class="card">
                            <div class="card-body">                                                          
                                <h4 class="header-title">Users list</h4>  
                                <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">
                                        <tr>
                                           
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <!-- <th>Password</th> -->
                                            <th>Position</th>
                                            <th>Change Password</th>
                                                                 
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $user->runQuery("SELECT * FROM apollo_useraccounts");
                                            $stmt->execute();
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                                            ?>
                                            <tr>
                                              
                                                <td><?php echo $row['fullname']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <!-- <td><?php echo $row['user_password']; ?></td> -->
                                                <td><?php echo $row['position']; ?></td>

                                                 <td>                                  
                                                 <button type="button" class="btn btn-success btn-rounded btn-xs mt-1" data-toggle="modal" data-target="#changepass<?php $row['username'];?>">Change Password</button>                                                </td>                                               
                                            </tr>
                                            
                                        <?php
                                           include('Addusers/changepassword_modal.php');
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
  $(document).ready(function(){
    $("#RegisterAccountForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({ 
            type: "POST",
            url: "Addusers/RequestToRegister.php",
            data: form.serialize(), // serializes the form's elements.
            success: function(response)
            {
           
            $("#AddnewUserAlert").html(response);
            location.reload();
            // $('#btnClose').click();
            // $("#Subscope").val(""); 
            // console.log(response);
        
            }
            });

        });
});
</script>
