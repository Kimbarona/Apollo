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
                            <h4 class="page-title pull-left" id="ContainerTitle">Updating Works</h4>
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
                        <!-- data table start -->
                    <div class="col-12 mt-5" id="AssignedProjectList">
                        <div class="card">
                            <div class="card-body">                              
                                <div align="right">
                                    
                                    
                                </div>                                                                             
                                <h4 class="header-title">Project Handled Details</h4>
                                <hr>                                                                                
                                <div class="data-tables">                                                                          
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">                                                                                      
                                            <th width="20%" style="background-color:#7855ed; color:white;">Project Code</th>
                                            <th width="20%" style="background-color:#7855ed; color:white;">Project Name</th>
                                            <th width="10%" style="background-color:#7855ed; color:white;">Capex Number</th>
                                            <th width="10%" style="background-color:#7855ed; color:white;">Amount</th>
                                            <th width="5%" style="background-color:#7855ed; color:white;">Action</th>
                                                                                         
                                        </thead>
                                        <tbody>
                                        <?php
                                                $stmt = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject WHERE project_status = 'Open'");
                                                $stmt->execute();
                                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                <tr> 
                                                    <td><?php echo $row['project_code']; ?></td>                                      
                                                    <td><?php echo $row['project_name']; ?></td>
                                                    <td><?php echo $row['capex_number']; ?></td>
                                                    <td><?php echo $row['ecost']; ?></td>

                                                    <td>                                                                  
                                                    <button type="button" value="<?php echo $row['capex_number'];?>" class="BtnShowModal btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">Update Works</button>
                                                    </td>
                                                </tr>
                                            <?php 
                                                //   include('AssignedWorks/manageworks.php');                                  
                                                }
                                            ?>
                                              
                                        </tbody>
                                    </table>                                                                          
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->
                    <div class="col-12 mt-5" id="MonitoringList">
                        <div class="card">
                            <div class="card-body">                              
                            <form method="post" id="update_form">
                                <div align="right">
                                    <button class="btn btn-warning" id="Btnback"><< Back</button>
                                    <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info" value="Update Works" />
                                </div><br>
                                
                                <h4 class="header-title">Updating Work Progress</h4>
                                <hr>
                                <div>
                               Capex Number <b><input type="text"  name="project" class ="form-control col-md-1 mb-3" id=project  readonly></b>
                                </div>  
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <th width="5%" style="background-color:#7855ed; color:white;"></th>
                                                <th width="15%" style="background-color:#7855ed; color:white;">Scope</th>
                                                <th width="30%" style="background-color:#7855ed; color:white;">Work Description</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Progress</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Planned Start</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Planned End</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Actual Start Date</th>
                                                <th width="10%" style="background-color:#7855ed; color:white;">Action</th>
                                                <!-- <th width="20%">Status</th>                                 -->
                                                
                                            </thead>
                                            <tbody></tbody>
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
    // CheckboxUpdateStartDate();
    $('#MonitoringList').hide();

    $(document).on('click', '.BtnShowModal', function () {
        // alert('Freshmorning!! Reminder: Dont Forget To set the Actual Start Date!');        
        $('#AssignedProjectList').hide();
        $('#MonitoringList').show(); 
        var CapexNum = $(this).val();
        
            function fetch_data()   
            {
                $.ajax({
                    url:"AssignedWorks/Selectworks.php",
                    method:"POST",
                    data:{CapexNumber:CapexNum},
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        for(var count = 0; count < data.length; count++)
                        {
                            html += '<tr>';
                            html += '<td><input type="checkbox" id="'+data[count].id+'" data-gen_scope="'+data[count].gen_scope+'" data-subscopes="'+data[count].subscopes+'" data-subscope_percent="'+data[count].subscope_percent+'" data-planned_start="'+data[count].planned_start+'" data-planned_end="'+data[count].planned_end+'" data-actual_start="'+data[count].actual_start+'"  class="check_box" /></td>';
                            html += '<td>'+data[count].gen_scope+'</td>';
                            html += '<td>'+data[count].subscopes+'</td>';
                            html += '<td>'+data[count].subscope_percent+'</td>';
                            html += '<td>'+data[count].planned_start+'</td>';
                            html += '<td>'+data[count].planned_end+'</td>';
                            html += '<td>'+data[count].actual_start+'</td>';
                            html += '<td><button type="button" class="btn btn-success" id="btnStart" value="'+data[count].id+'">Start</button></td>';
                            
                    
                        }
                        $('tbody').html(html);
                        
                    }
                });
            }

            fetch_data();

            $(document).on('click', '.check_box', function(){
                var html = '';
                if(this.checked)
                {
                    html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-gen_scope="'+$(this).data('gen_scope')+'" data-subscopes="'+$(this).data('subscopes')+'" data-subscope_percent="'+$(this).data('subscope_percent')+'" data-planned_start="'+$(this).data('planned_start')+'" data-planned_end="'+$(this).data('planned_end')+'" data-actual_start="'+$(this).data('actual_start')+'" class="check_box" checked /></td>';
                    html += '<td><input type="text" name="scope[]" class="form-control" value="'+$(this).data("gen_scope")+'" readonly/></td>';
                    html += '<td><input type="text" name="work[]" class="form-control" value="'+$(this).data("subscopes")+'" readonly/></td>';
                    html += '<td><input type="text" name="percent[]" onkeyup="ChangeValue(this.value)" class="per form-control" value="'+$(this).data("subscope_percent")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'"/></td>';
                    html += '<td><input type="text" name="plannedstart[]" class="form-control" value="'+$(this).data("planned_start")+'" readonly/></td>';
                    html += '<td><input type="text" name="plannedend[]" class="form-control" value="'+$(this).data("planned_end")+'" readonly/></td>';
                    html += '<td><input type="date" name="actualStart[]" id="Start" class="form-control" value="'+$(this).data("actual_start")+'" /><input type="hidden" name="ActualEnd[]" value="<?php echo date('Y-m-d');?>"/></td></td>';
                   
                }
                else
                {
                    html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-gen_scope="'+$(this).data('gen_scope')+'" data-subscopes="'+$(this).data('subscopes')+'" data-subscope_percent="'+$(this).data('subscope_percent')+'" data-planned_start="'+$(this).data('planned_start')+'" data-planned_end="'+$(this).data('planned_end')+'" data-actual_start="'+$(this).data('actual_start')+'" class="check_box" /></td>';
                    html += '<td>'+$(this).data('gen_scope')+'</td>';
                    html += '<td>'+$(this).data('subscopes')+'</td>';
                    html += '<td>'+$(this).data('subscope_percent')+'</td>';
                    html += '<td>'+$(this).data('planned_start')+'</td>';
                    html += '<td>'+$(this).data('planned_end')+'</td>';
                    html += '<td>'+$(this).data('actual_start')+'</td>';
                
                            
                }
                $(this).closest('tr').html(html);
                $('#work_'+$(this).attr('id')+'').val($(this).data('work'));
            });

            $('#update_form').on('submit', function(event){
                event.preventDefault();
                if($('.check_box:checked').length > 0)
                {
                    $.ajax({
                        url:"AssignedWorks/updateworks.php",
                        method:"POST",
                        data:$(this).serialize(),
                        success:function(response)
                        {
                            $('#AlertSucess').html(response);
                        
                            fetch_data();
                         
                            // console.log(response);
                        }
                    })
                }
            });
    });

    $(".BtnShowModal").click(function(){
    var projectcapex = $(this).val();
    document.getElementById('project').value = projectcapex ;
    // alert(projectcapex);
    });

    $( "#Btnback" ).click(function() {
      location.reload();
    });
});    

function ChangeValue(val){
    var a = val;
        // $.ajax({
        //     url:"AssignedWorks/updateworks.php",
        //     method:"POST",
        //     data:$(this).serialize(),
        //     success:function(response)
        //     {
        //         $('#AlertSucess').html(response);
            
        //         fetch_data();
                
        //         // console.log(response);
        //     }
        // })
//    var percent = $('.per').val();
//    if(a < percent){
//     alert('Progress is not less than current value!!');
//    }
    if(a !=0){
        // alert('bawal na maedit');
        // $('#Start').prop('disabled', true);
        document.getElementById('Start').readOnly = false;
    }

    if(a ==0){
        document.getElementById('Start').readOnly = true;
    }

    if(a ==''){
        document.getElementById('Start').readOnly = true;
        alert('Progress is Required!!');
    }

    if(a > 100){
        document.getElementById('Start').readOnly = true;
        alert('Progress is not greater than 100!!');
    }

    else{
        document.getElementById('Start').readOnly = true;
        // alert('Percent is Required!!');
    }

    // console.log(val);  
}

// function CheckboxUpdateStartDate(){
//     $( "#btnStart" ).click(function() {
//         alert('connected');
//     });
    
// }

</script>