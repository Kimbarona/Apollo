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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
    
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="AssignedWorkscript.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 
    <style>
    .textbox {
        border:0;
        background-color: white;
        width: 400px;
    }
    </style>
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
                            <h4 class="page-title pull-left" id="ContainerTitle">Assigned Works</h4>
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
            
            <div class="main-content-inner">
                <div class="row" >
                    <div class="col-12 mt-2">
                        <div class="card">
                        <form method="post" id="insert_form"> 
                            <div class="card-body">
                                <div class="form-row">                                 
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom01">Capex Number</label>
                                                <select class="capex custom-select" onchange="SearchCapexNum(this.value)" name="CapexNo" id="CapexNo">
                                        <option value=""></option>
                                            <?php
                                                    $view = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject WHERE project_status = 'Closed'");
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
                                    <div class="col-md-8 mb-2 " style="position:absolute;margin-left:18%;z-index:100;background-color:#8914fe;border-radius:10px;width:20%;box-shadow:1px 1px #666;">
                                        <label for="validationCustom01" style="color:#fff">Contract Amount</label>
                                        <input type="text"  name="ContractAmount" class="ContractAmt form-control col-md-12 mb-3" id="ContractAmt" value="" placeholder="" readonly/> 
                                        <div style="color:#ffb3b3" id="Balance"></div> 
                                        <input type="hidden" name="userAccount" id='userAccount'value="">  
                                        <input type="hidden" style="background-color:#96dd92" name="TotalAmt" class="form-control col-md-4 mb-3" id="TotalAmt" value="" />          
                                    </div>                                          
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                        <!-- data table start -->
                    <div class="col-12 mt-4" id="AssignedWorksList" style="overflow-y:scroll; overflow-x:hidden; height:500px;">
                    <div id="AlertErrorCapex"></div>
                        <div class="card">
                            <div class="card-body">
                              
                                        <div align="right">
                                            <input type="submit" name="insert" id="BtnSave" class="btn btn-info" value="+  Save" />
                                        </div>                                                                             
                                <h4 class="header-title">Assigned Works</h4>                                        
                                <div class="data-tables">                                                                          
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">                                           
                                            
                                                                          
                                            <th width="0%" >General Scopes</th>
                                            <th width="0%" ></th>
                                            <th width="80%" >Works Description</th>
                                            <th width="0%" ></th> 
                                            <th width="10%" >Planned Start</th> 
                                            <th width="10%" >No. Of Days</th> 
                                            <th width="10%" >Planned End</th>               
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        $a = 1;
                                            $stmt = $GlobalConnection->runQuery("SELECT * FROM apollo_genscopes");
                                            $stmt->execute();
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <tr>
                                                
                                                <td><input type="hidden" name="ScopeIDParent[]" value="<?php echo $row['Scope_id']?>"><input type="text"  class="form-control textbox" name="Sope[]" value="<?php echo $row['GenScopes']?>" style="background-color: white;"></td>
                                                <td colspan="3">
                                                <input id="ScopeAmt<?php echo $i;?>" style="background-color:#fbf7ff;" class="ScopeAmt  col-md-7 mb-3 form-control" type="text" name="ScopeAmount[]"  placeholder=" ₱" ></td>
                                                <?php
                                                // for sub scope
                                                $subscope = $GlobalConnection->runQuery("SELECT * FROM apollo_added_subscopes WHERE parent_id=:IDscope");
                                                $subscope->execute(array(':IDscope' =>$row['Scope_id']));
                                                while ($rowSub = $subscope->fetch(PDO::FETCH_ASSOC)) {
                                                    ?>
                                                    <tr>
                                                        
                                                        <td ><input type="hidden"class="textbox"  name="parent_id[]" value="<?php echo $rowSub['parent_id']?>"><input type="checkbox" id="Chkbx" class="Chkbx checkbox form-control" value="<?php echo $rowSub['id']?>" name="SubScopeId[]" ></td>
                                                        <td ><input type="text" class="Gscope form-control" style="background-color:#fbf7ff" name="GenScope[]" value="<?php echo $row['GenScopes']?>" data-toggle="tooltip" data-placement="right" title="<?php echo $row['GenScopes']?>" readonly></td>                                                        
                                                        <td ><input type="text" style="background-color:#e9e3f3" class="col-md-12 mb-1 form-control"  name="SubScopes[]" value="<?php echo $rowSub['SubScopes']?>" data-toggle="tooltip" data-placement="right" title="<?php echo $rowSub['SubScopes']?>" readonly></td>
                                                        <td ><input style="background-color:#e9e3f3" class="" name="Percent[]" id="percent" VALUE="0" type="hidden" placeholder="%" READONLY></td>
                                                        <td ><input style="background-color:#e9e3f3" class="ps form-control" name="PlannedStart[]" onchange="triggerDate(this.value,<?php echo $rowSub['id']?>)" id="PlannedStart<?php echo $rowSub['id']?>" type="date"></td>
                                                        <td ><input class="col-md-12 mb-1 form-control numdays" onkeyup="InputDays(this.value,<?php echo $rowSub['id']?>)" name="NumDays[]" id="NumDays<?php echo $rowSub['id']?>" type="number" ></td>
                                                        <td ><input style="background-color:#e9e3f3" class="pe form-control"  name="PlannedEnd[]" onchange="triggerDateEnd(this.value)" id="PlannedEnd<?php echo $rowSub['id']?>" type="date" readonly ></td>
                                                        <td><input style="background-color:#e9e3f3" class="ActualStart form-control" name="ActualStart[]" id="ActualStart" value="" type="date"></td>
                                                        <td><input style="background-color:#e9e3f3" class="ActualEnd form-control" name="ActualEnd[]" id="ActualEnd" value="<?php echo date('Y-m-d');?>"  type="date"><input type="hidden" name="Status" value="Pending To Start"><input type="hidden" name="Remarks[]" value="For Approval"><input type="hidden" name="Approval_status[]" value="Waiting"></td>
                                                       
                                                    </tr>
                                                    <?php
                                                   $a++;
                                               
                                                }
                                                ?>
                                                </tr> 
                                                <?php
                                                 $i++;
                                                 
                                            }
                                            ?>      
                                            <input type="hidden" value="<?php echo $a; ?>" id="CountOfI">      
                                        </tbody>
                                    </table>                                                           
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
        <footer>
            <div class="footer-area">
                <p>© Copyright 2019. All right reserved. Developed by <a href="#">MIS Developers Unit</a>.</p>
            </div>
        </footer>
        
    </div>
    <audio id="audiotag" src="erroralert.mp3" preload="auto"></audio>
</body>
     <!-- <!- jquery latest version -->
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


  
