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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
    
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
                            <h4 class="page-title pull-left" id="ContainerTitle">Assigned Works</h4>
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
            <div id="AlertEnrollList"></div>
            <div class="main-content-inner">
                <div class="row">
                        <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="validationCustom01">Project Name</label>
                                                <input type="text" onchange="myFunction(this.value)" name="ProjectName" class="form-control" id="ProjectName" autocomplete="on" placeholder="search here..." required/>             
                                            </div>                                           
                                        </div>  
                                <form method="post" id="insert_form">  
                                        <div align="right">
                                            <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-success" value="Insert" />
                                            <button type="button" id ="BtnAddWorks'+$(this).attr('id')+'" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Works</button>
              
                                        </div>                                                                             
                                <h4 class="header-title">Labor & Material Cost</h4>                                        
                                <div class="data-tables">                                                                          
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">                                           
                                            <th width="5%"></th>
                                            <th width="20%">Scope</th>
                                            <th width="20%">Project Name</th>
                                            <th width="10%">Amount</th>
                                            <th width="9%">Progress %</th>
                                            <th width="5%">Scope Status</th>
                                            <th width="8%">Planned Start</th>
                                            <th width="8%">Planned End</th> 
                                                                                       
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>                                                           
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data table end <?php include('AssignedWorks/manageworkdesc.php');?> 
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
    function fetch_data()
    
    {
        $.ajax({
            url:"AssignedWorks/SelectSubScope.php",
            method:"POST",
            dataType:"json",
            success:function(data)
            {
                var html = '';
                for(var count = 0; count < data.length; count++)
                {
                    $("#ProjectName").prop("disabled",true);
                    // $("#multiple_update").attr("disabled", true);
                    html += '<tr>';
                    html += '<td><input type="checkbox" id="'+data[count].id+'" data-projectname="'+data[count].projectname+'" data-genscope="'+data[count].genscope+'" data-amount="'+data[count].amount+'" data-percent="'+data[count].percent+'" data-scope_status="'+data[count].scope_status+'" data-plannedstart="'+data[count].plannedstart+'" data-plannedend="'+data[count].plannedend+'" class="check_box"  /></td>';                
                    html += '<td>'+data[count].genscope+'</td>';
                    html += '<td>'+data[count].projectname+'</td>';
                    html += '<td>'+data[count].amount+'</td>';
                    html += '<td>'+data[count].percent+'</td>';
                    html += '<td>'+data[count].scope_status+'</td>';
                    html += '<td>'+data[count].plannedstart+'</td>';
                    html += '<td>'+data[count].plannedend+'</td></tr>';
                    // html += '<td> <button type="button" id ="BtnAddWorks" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Works</td></tr>';
                   
                                            
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
            $("#ProjectName").prop("disabled",false);
            // $("#BtnAddWorks").attr("disabled", false);
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-projectname="'+$(this).data('projectname')+'" data-genscope="'+$(this).data('genscope')+'" data-amount="'+$(this).data('amount')+'" data-percent="'+$(this).data('percent')+'" data-scope_status="'+$(this).data('scope_status')+'" data-plannedstart="'+$(this).data('plannedstart')+'" data-plannedend="'+$(this).data('plannedend')+'" class="check_box" checked /></td>';
            html += '<td><input type="text" name="genscope[]" class="form-control" value="'+$(this).data("genscope")+'" readonly /></td>';
            html += '<td><input type="text" name="projectname[]" class="form-control" id="projectname" value="'+$(this).data("projectname")+'" /></td>';
            html += '<td><input type="text" onkeyup="this.value=add_commas(this.value);" name="amount[]" class="form-control" value="'+$(this).data("amount")+'" required/></td>';
            html += '<td><input type="text" name="percent[]" class="form-control" value="'+$(this).data("percent")+'" readonly/></td>';
            html += '<td><select name="scope_status[]" id="scope'+$(this).attr('id')+'" class="custom-select"><option value="Open">Open</option></select></td>';
            html += '<td><input type="date" name="plannedstart[]" class="form-control" value="'+$(this).data("plannedstart")+'" required/></td>';
            html += '<td><input type="date" name="plannedend[]" class="form-control" value="'+$(this).data("plannedend")+'" required/><input type="hidden" name="hidden_id[]" value="'+$(this).attr('id')+'" /></td></tr>';
            // html += '<td> <button type="button" id ="BtnAddWorks'+$(this).attr('id')+'" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Works</td></tr>';
                   
        }
        
        else
        {
            $("#ProjectName").prop("disabled",true);
            // $("#BtnAddWorks").attr("disabled", true);
            html = '<td><input type="checkbox" id="'+$(this).attr('id')+'" data-projectname="'+$(this).data('projectname')+'" data-genscope="'+$(this).data('genscope')+'" data-amount="'+$(this).data('amount')+'" data-percent="'+$(this).data('percent')+'" data-scope_status="'+$(this).data('scope_status')+'" data-plannedstart="'+$(this).data('plannedstart')+'" data-plannedend="'+$(this).data('plannedend')+'" class="check_box" /></td>';            
            html += '<td>'+$(this).data('genscope')+'</td>';
            html += '<td>'+$(this).data('projectname')+'</td>';
            html += '<td>'+$(this).data('amount')+'</td>';
            html += '<td>'+$(this).data('percent')+'</td>';
            html += '<td>'+$(this).data('scope_status')+'</td>';
            html += '<td>'+$(this).data('plannedstart')+'</td>';
            html += '<td>'+$(this).data('plannedend')+'</td></tr>';
            // html += '<td> <button type="button" id ="BtnAddWorks'+$(this).attr('id')+'" class="btn btn-secondary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Works</td></tr>';
                               
        }
        $(this).closest('tr').html(html);
        $('#scope'+$(this).attr('id')+'').val($(this).data('scope'));
       
    });

    $('#insert_form').on('submit', function(event){
        event.preventDefault(); 
        if($('.check_box:checked').length > 0)
        {
            $.ajax({
                url:"AssignedWorks/InsertSelectedScope.php",
                method:"POST",
                data:$(this).serialize(),
                success:function(response)
                {
                    if(response != "mali"){
                        alert('Successfuly Saved!');
                        fetch_data();
                        $("#ProjectName").val("");
                        $("#BtnAddWorks").attr("disabled", false);
                    }
                    else{
                        alert('Opps! Duplicate Scope is not Allowed');
                        fetch_data();
                    }
                    
                //      
                }
            })
        }
    });
});

function add_commas(number){
	//remove any existing commas...
	number=number.replace(/,/g, "");
	//start putting in new commas...
	number = '' + number;
	if (number.length > 3) {
		var mod = number.length % 3;
		var output = (mod > 0 ? (number.substring(0,mod)) : '');
		for (i=0 ; i < Math.floor(number.length / 3); i++) {
			if ((mod == 0) && (i == 0))
				output += number.substring(mod+ 3 * i, mod + 3 * i + 3);
			else
				output+= ',' + number.substring(mod + 3 * i, mod + 3 * i + 3);
		}
		return (output);
	}
	else return number;
}


</script>

<script>
$(document).ready(function(){
   
    $('#ProjectName').typeahead({
     source: function(query, result)
     
     {
      $.ajax({
       url:"AssignedWorks/ProjectNameSearch.php",
       method:"POST",
       data:{query:query},
       dataType:"json",
       success:function(data)
       {
        result($.map(data, function(item){
         return item;
        }));
      
       }
      })
     }
    });
    
   });
</script>

<script>
   function myFunction(x){
            // $('#ProjectName').val() 
            //  $('#projectname').val($(this).val(x));

            $('#ProjectName').change(function () {
                var textone;
                var texttwo;
                textone = $('#ProjectName').val();
                var result = textone;
                $('#projectname').val(result.toString());
            });
            // console.log(x);
          
            // $.ajax({
            //     url:"AssignedWorks/SelectSubScope.php",
            //     method:"POST",
            //     data:{pname:pname},
            //     dataType:"json",
            //     success:function(data){}
            // });
        }     
</script>
