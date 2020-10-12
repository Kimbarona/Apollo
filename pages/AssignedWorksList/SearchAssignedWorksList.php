<?php
require_once("class.php");
$ListOfWOrks = new ListOfWOrks();
date_default_timezone_set('Asia/Manila');
$FilterCapex = $_POST['FilterCapex'];

?>
                                                                        
        <table id="dataTable" class="table table-bordered table-striped">
            <thead class="bg-light text-capitalize">                                                                                      
                <th width="10%" style="background-color:#7855ed; color:white;">Capex</th>
                <th width="15%" style="background-color:#7855ed; color:white;">Scopes</th>
                <th width="25%" style="background-color:#7855ed; color:white;">Work Description</th>
                <th width="15%" style="background-color:#7855ed; color:white;">Planned Start</th>
                <th width="15%" style="background-color:#7855ed; color:white;">Planned End</th>
                <th width="20%" style="background-color:#7855ed; color:white;">Remarks</th> 
                <th width="10%" style="background-color:#7855ed; color:white;">Status</th>    
            </thead>
            <tbody>
            <?php
                 $view = $ListOfWOrks->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE capex_number = '$FilterCapex' AND subscope_percent != 100");
                 $view->execute();
                    while($row = $view->fetch(PDO::FETCH_ASSOC))
                    {
                        
                        ?>
                            <tr>
                                 <td><?php echo $row['capex_number']; ?></td>
                                 <td><?php echo $row['gen_scope']; ?></td>
                                 <td><?php echo $row['subscopes']; ?></td>
                                 <td><?php echo $row['planned_start']; ?></td>
                                 <td><?php echo $row['planned_end']; ?></td>
                                 <td><?php echo $row['remarks']; ?></td>
                                 <?php
                                 if($row['approval_status']=='Waiting'){
                                     ?>
                                    <td><h6><span class="badge badge-info"><?php echo $row['approval_status']; ?></span></h6></td>
                                    <?php
                                 }
                                 elseif($row['approval_status']=='Approved'){
                                    ?>
                                   <td><h6><span class="badge badge-success"><?php echo $row['approval_status']; ?></span></h6></td>
                                   <?php
                                }
                                else{
                                    $id=$row['id'];
                                    $work=$row['subscopes'];
                                    ?>
                                   
                                   <td><h6><span class="badge badge-danger"><?php echo $row['approval_status']; ?></span></h6></td>
                                   <td><a href="#UpdateModal<?php echo $id?>" class="btn btn-warning submit-btn" data-toggle="modal" data-target="" >Update</a><td>
                                   <?php
                                }

                                ?>
                                
                            </tr> 
                        <?php
                     }
            
            ?>
            </tbody>
        </table>                                                                          
    
    <?php

?>
<!-- Vertically centered modal start -->
<div class="col-lg-6 mt-5">
    <div class="card">
        <div class="card-body">
            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="UpdateModal<?php echo $id?>">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div id="alertMessage"></div>
                        <div class="modal-header">
                            <h5 class="modal-title">Update Work Details</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                                <?php
                                $Id = $id;
                                $a=date('yy-m-d');
                                $GetScope = $ListOfWOrks->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE id = '$Id'");
                                $GetScope->execute();
                                while($rowScope = $GetScope->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                        <form>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Work Description</label>
                                                <input type="text" class="form-control" name="WorkDesc" id="WorkDesc" aria-describedby="emailHelp" value="<?php echo $rowScope['subscopes']?>" readonly>
                                                <input type="hidden" class="form-control" id="RowId" name="RowId" value="<?php echo $id?>">
                                                <input type="hidden" class="form-control" id="capex" name="capex" value="<?php echo $rowScope['capex_number']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Planned Start</label>
                                                <div class="input-group">
                                                    <input type="date" class="form-control col-sm-9 " id="PlannedStart" name="PlannedStart" value="<?php echo $rowScope['planned_start']?>" required >
                                                    <input type="number" class="form-control col-sm-3 " id="NumDays" name="NumDays" placeholder="* No. of Days">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Planned End</label>
                                                <input type="date" class="form-control" id="PlannedEnd" name="PlannedEnd" value="" readonly>
                                            </div>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="BtnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="BtnProceed" onclick="SaveUpdatedData(this.value)" value="<?php echo $id?>" class="btn btn-primary">Proceed</button>
                                        </div>
                                        </form> 
                                    <?php
                                }
                        ?>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Vertically centered modal end -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function(){  
        DateRange();
        ValidateDate();
        ButtonActivate();
        $('#BtnProceed').hide();
        $('#NumDays').css("background-color", "#e8f0c7");
        $('#PlannedStart').css("background-color", "#e8f0c7");

        $('#BtnProceed').click(function(){
            // alert('hello');
        });
    
    });    

    function DateRange(){
        $( "#NumDays" ).keyup(function() {
          var PlannedStart = new Date($('#PlannedStart').val());
          var newdate = new Date();
          var NumDays = (parseInt($(this).val()));
          newdate.setDate(PlannedStart.getDate()+NumDays);
          let convertDate = JSON.stringify(newdate)
          var finalDate = convertDate.slice(1, 11);
          $("#PlannedEnd").val(finalDate);          
            
        });
    }

    function ButtonActivate(){
        $( "#NumDays" ).keyup(function() {
        var days = $('#NumDays').val(); 
        if(days==''){
            $('#BtnProceed').hide();
          }
          else{
            $('#BtnProceed').show();
          }
        });
    }

    function ValidateDate(){
        var Id = $('#RowId').val();        
        var capex = $('#capex').val();
        $( "#PlannedEnd" ).change(function() {
            var CurrDate = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "AssignedWorksList/CurrentDateValidator.php",
                    data: {capex:capex},
                    dataType: "text",
                    success: function(response){   
                        // if(response > CurrDate){
                        //     alert('Date is must be greater than or equal to the Planned Start of the whole Project');
                        //     }
                            // console.log(response);
                            alert(response);
                        }        
                    });
                // alert('hello');

                });
    }
    function reloadData(){
            var FilterCapex = $('#FilterCapex').val();
            
            $.ajax({
                type: "POST",
                url: "AssignedWorksList/SearchAssignedWorksList.php",
                data: {FilterCapex:FilterCapex},
                success: function(response){
                    $("#ContainerTable").html(response);
                    // // alert(response);
                    // console.log(response);
                }
            });

    }    

    function SaveUpdatedData(Id){
            var PlannedStart = $('#PlannedStart').val();
            var PlannedEnd = $('#PlannedEnd').val();
            var NumDays = $('#NumDays').val();
            $.ajax({
                    type: "POST",
                    url: "AssignedWorksList/PostingToCLass.php",
                    data: {Id:Id, PlannedStart:PlannedStart, PlannedEnd:PlannedEnd, NumDays:NumDays },
                    dataType: "text",
                    success: function(response){   
                        $('#alertMessage').html(response);
                            $('#PlannedEnd').val('');
                            $('#NumDays').val('');
                                // setTimeout(function(){
                                // $( "#data-tables" ).load( "./AssignedWorksList.php #data-tables");
                                // reloadData();
                                // }, 250);
                                location.reload();
                        }        
                    });



        }
 
     
    
</script>