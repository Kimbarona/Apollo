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
    <title>Form - srtdash</title>
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
                            <h4 class="page-title pull-left" id="ContainerTitle">Closing OF Project</h4>
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
                                <h4 class="header-title">Project Details</h4>
                                <hr>                                                                                
                                <div class="data-tables">                                                                          
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">                                                                                      
                                        <th width="5%" style="background-color:#7855ed; color:white;">Capex</th>
                                        <th width="15%" style="background-color:#7855ed; color:white;">Project Name</th>
                                        <th width="15%" style="background-color:#7855ed; color:white;">Contractor</th>
                                        <th width="15%" style="background-color:#7855ed; color:white;">Engineer</th>
                                        <th width="5%" style="background-color:#7855ed; color:white;">Budgeted Amount</th>
                                        <th width="10%" style="background-color:#7855ed; color:white;">Contract Amount</th>
                                        <th width="5%" style="background-color:#7855ed; color:white;">Additional Cost</th>
                                        <th width="5%" style="background-color:#7855ed; color:white;">Progress</th>
                                        <th width="10%" style="background-color:#7855ed; color:white;">Total Cost</th>
                                        <th width="5%" style="background-color:#7855ed; color:white;">Status</th>  
                                        <th width="10%" style="background-color:#7855ed; color:white;">Action</th>  
                                                                                         
                                        </thead>
                                        <tbody>
                                        <?php
                                            $Position = $_SESSION['position'];
                                            $view = $GlobalConnection->runQuery("SELECT apollo_enrolledproject.project_num, apollo_enrolledproject.capex_number,apollo_enrolledproject.project_name,apollo_enrolledproject.contractor,apollo_enrolledproject.engineer,apollo_enrolledproject.project_status, apollo_projectlist.budgeted_amount,
                                            apollo_enrolledproject.ecost AS CA,apollo_additional_cost.contract_price AS AC, MAX(apollo_masterlistofbillings.progress) as Progress 
                                            FROM `apollo_enrolledproject` 
                                            LEFT JOIN apollo_masterlistofbillings 
                                            ON apollo_enrolledproject.capex_number = apollo_masterlistofbillings.capex_number 
                                            LEFT JOIN apollo_additional_cost
                                            ON apollo_enrolledproject.capex_number = apollo_additional_cost.capex_number 
                                            LEFT JOIN apollo_projectlist 
                                            ON apollo_enrolledproject.capex_number = apollo_projectlist.capex_number WHERE apollo_enrolledproject.project_status in('Open','Completed')
                                            GROUP BY apollo_enrolledproject.capex_number 
                                            ORDER BY apollo_enrolledproject.capex_number ASC");
                                            $view->execute();
                                                while($row = $view->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row['capex_number']; ?></td>
                                                            <td><?php echo $row['project_name']; ?></td>
                                                            <td><?php echo $row['contractor']; ?></td>
                                                            <td><?php echo $row['engineer']; ?></td>
                                                            <td><b>₱<?php echo $row['budgeted_amount']; ?></b></td>
                                                            <td>
                                                                <b>₱
                                                                    <?php 
                                                                        echo $row['CA'];
                                                                    ?>.00
                                                                </b>
                                                            </td>
                                                            <?php
                                                            if($row['AC']==''){
                                                                ?>
                                                                    <td><b>--</b></td>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                    <!-- <td><b>₱<?php echo $row['AC']; ?></b></td> -->
                                                                    <td><a href="AdditionalCostViewing.php?id=<?php echo $row['capex_number']?>" class="" value=""> Yes</a></td>
                                                                <?php 
                                                            }
                                                            ?>  
                                                            <td><b><?php echo $row['Progress']; ?>%</b></td>
                                                            <td>
                                                                <b>₱
                                                                    <?php 
                                                                        $Progress = $row['Progress'];
                                                                        $a = $row['CA'];
                                                                        $b = str_replace( ',', '', $a );
                                                                        $c = (float)$b;
                                                                        // echo $c;
                                                                        $d = $c *$Progress/100;
                                                                        echo (number_format($d,2));
                                                                    ?>
                                                                </b>
                                                            </td>
                                                            <?php
                                                                if($row['project_status']=='Open'){
                                                                    ?>
                                                                        <td> <span class="badge badge"><?php echo $row['project_status'];?></span></td>
                                                                    <?php
                                                                      if($Position == 'Admin'){
                                                                        ?>
                                                                            
                                                                            <td><a href="ClosingOfProjectViewing.php?id=<?php echo $row['capex_number']?>" class="btn btn-info btn-xs mb-2 fa fa" value=""> View</a></td>  
                                                                        <?php
                                                                    }
                                                                   
                                                                     else{
                                                                        ?>
                                                                            <td><button class="btn btn-secondary btn-xs mb-2 btnConfirm" type="type" id="<?php echo $row['project_num']?>"  onclick="ChangeStatus(this.value)" value="<?php echo $row['project_num']; ?>">To Close</button>
                                                                            <a href="ClosingOfProjectViewing.php?id=<?php echo $row['capex_number']?>" class="btn btn-info btn-xs mb-2 fa fa" value=""> View</a></td>  
                                                                        <?php
                                                                    }
                                        
                                                                }else{
                                                                    ?>
                                                                        <td> <span class="badge badge-success"><?php echo $row['project_status'];?></span></td>
                                                                        
                                                                    <?php
                                                                    if($Position == 'Admin'){
                                                                        ?>
                                                                            
                                                                            <td><a href="ClosingOfProjectViewing.php?id=<?php echo $row['capex_number']?>" class="btn btn-info btn-xs mb-2 fa fa" value=""> View</a></td>  
                                                                        <?php
                                                                    }
                                                                   
                                                                     else{
                                                                        ?>
                                                                            <!-- <td><button class="btn btn-secondary btn-xs mb-2 btnConfirm" type="type" id="<?php echo $row['project_num']?>"  onclick="ChangeStatus(this.value)" value="<?php echo $row['project_num']; ?>">To Close</button> -->
                                                                            <td><a href="ClosingOfProjectViewing.php?id=<?php echo $row['capex_number']?>" class="btn btn-secondary btn-xs mb-2 fa fa" value=""> View</a></td>  
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

$(document).on("click", ".btnConfirm", function(){
     var Id = ($(this).attr('id'));

     $.ajax({
            type: "POST",
            url: "ClosingOfWholeProject/ClosingOfWholeProject.php",
            data: {Id:Id},
            success: function(resulta){
                $("#AlertSucess").html(resulta);
                // alert(resulta);
                // console.log(response);                
                location.reload();             
            }
          });

    // alert(Id);
     
});
</script>