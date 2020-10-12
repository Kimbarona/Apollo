<?php
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
                            <h4 class="page-title pull-left" id="ContainerTitle">Project Cost</h4>
                            <ul class="breadcrumbs pull-left">
                                <!-- <li><a href="index.html"></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Kim Aldwin <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Message</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="#">Log Out</a>
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
                            <div class="card-body"> 
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom01">Capex Number</label>
                                                      <select class="capex custom-select" onchange="SearchCapexNum(this.value)" name="CapexNo" id="CapexNo">
                                                <option value=""></option>
                                                    <?php
                                                          $view = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject ");
                                                          $view->execute();
                                                             while($row = $view->fetch(PDO::FETCH_ASSOC))
                                                             {
                                                                
                                                                 ?>
                                                                 <option><?php echo $row['capex_number']; ?></option>   
                                                                 <?php
                                                              }
                                                    ?>
                                                </select>
             
                                            </div>                                
                            <form method="post" id="update_form">
                                <div align="right">
                                    <input type="submit" name="GenerateBilling" id="GenerateBilling" class="btn btn-info" value="Generate Billing" />
                                </div><br>
                                <h4 class="header-title">Project Cost</h4>  
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <th width="10%">Capex Number</th>
                                                <th width="40%">Scopes</th>
                                                <th width="10%">Amount</th>
                                                <th width="10%">Weight</th>
                                                <th width="10%">Percentage</th>
                                                <th width="10%">Equivalent Weight</th>
                                                <th width="10%">Total Amount</th>
                                                <!-- <th width="20%">Status</th>-->
                                                
                                            </thead>
                                            <tbody>
                                        <!-- to get information with other table -->
                                            <?php
                                                    $stmt = $GlobalConnection->runQuery("SELECT apollo_laborandmaterialcost_list.capex_number, apollo_laborandmaterialcost_list.contract_amount, apollo_laborandmaterialcost_list.scope, apollo_laborandmaterialcost_list.scope_amount, AVG(apollo_project_assigned_scopes.subscope_percent)AS percent 
                                                    FROM apollo_laborandmaterialcost_list INNER JOIN apollo_project_assigned_scopes ON apollo_project_assigned_scopes.parent_id = apollo_laborandmaterialcost_list.scope_id 
                                                    GROUP by apollo_laborandmaterialcost_list.scope_id");
                                                    $stmt->execute();
                                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                            $ContractAmount = $row['contract_amount'];
                                                            $RemoveComma = str_replace(',', '', $ContractAmount);
                                                                $FloatCa = (float)$RemoveComma;
                                                        
                                                        // for weight    
                                                            $ScopeAmount = $row['scope_amount'];
                                                            $ScopeRemoveComma = str_replace(',', '', $ScopeAmount);
                                                                 $FloatSa = (float)$ScopeRemoveComma;
                                                                    $Weight = $FloatSa / $FloatCa * 100;
                                                            
                                                        //    for equiv weight         
                                                            $Percentage = $row['percent'];  
                                                                $equiv =  $Percentage * $Weight / 100;  

                                                        //    for equiv weight  
                                                            $TotalAmt = $equiv / $Weight * $FloatSa;      


                                                    ?>
                                                    <tr>                                       
                                                        <td><?php echo $row['capex_number']; ?></td>
                                                        <td><?php echo $row['scope']; ?></td>
                                                        <td>₱<?php echo number_format($row['scope_amount'],2 );?></td>
                                                        <td><?php echo number_format(($Weight),2) ?> %</td>
                                                        <td><?php echo $row['percent'];?>%</td>
                                                        <td><?php echo number_format (($equiv), 2) ?>%</td>
                                                        <td><h5><span class="badge badge-success">₱<?php echo number_format (($TotalAmt), 2) ?></span></h5></td>
                                                    </tr>
                                                <?php
                                            
                                                    }
                                                ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                            </form>
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
                <p>© Copyright 2019. All right reserved. Developed by <a href="#">PIM Developers Unit</a>.</p>
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

<script>
    $(document).ready(function(){



    });

    function SearchCapexNum(capex){

        $.ajax({
            type: "POST",
            url: "AssignedWorks/SearchCapexNumber.php",
            data: {capex:val},
            dataType: "text",
            success: function(response){   
                $('#ContractAmt').val(response); 
            }
            
            });
        console.log(capex);
    }
</script>