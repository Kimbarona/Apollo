<?php
 require_once("class.php");
 $ProjectMonitoring = new ProjectMonitoring();

    $FilterCapex = $_POST['FilterCapex'];
    $Todate = date('Y-m-d');

    if(isset($FilterCapex)){
        $stmts = $ProjectMonitoring->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE capex_number = '$FilterCapex' AND work_status = 'Pending To Start' AND approval_status IN('Waiting', 'Reject')");
        $stmts->execute();
        $row = $stmts->fetch();
        
        if ($row ==0) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Opps!</strong> No Pending Works Available!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="fa fa-times"></span>
                    </button>
                </div>
            <?php
        }else{
            ?>                                                               
                <table id="dataTable" class="table table-bordered table-striped">
                    <thead class="bg-light text-capitalize">                                                                                      
                        
                        <th width="10%" style="background-color:#7855ed; color:white;">Capex</th>
                        <th width="15%" style="background-color:#7855ed; color:white;">Scopes</th>
                        <th width="25%" style="background-color:#7855ed; color:white;">Work Description</th>
                        <th width="15%" style="background-color:#7855ed; color:white;">Planned Start</th>
                        <th width="15%" style="background-color:#7855ed; color:white;">Planned End</th>
                        <th width="20%" style="background-color:#7855ed; color:white;">Remarks</th> 
                        
                        <!-- <th width="10%" style="background-color:#7855ed; color:white;">Status</th>-->
                    </thead>
                    <tbody>
                        <?php
                            $todate = date('Y-m-d');
                            $view = $ProjectMonitoring->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE capex_number = '$FilterCapex' AND work_status = 'Pending To Start' AND approval_status IN('Waiting', 'Reject')");
                            $view->execute();
                            while($row = $view->fetch(PDO::FETCH_ASSOC))
                            {
                                
                                ?>
                                    <tr>
                                        
                                        <td><?php echo $row['capex_number']; ?></td>
                                        <td><?php echo $row['gen_scope']; ?></td>
                                        <td><?php echo $row['subscopes']; ?></td>
                                        <?php
                                            if($row['planned_start']==$todate){
                                                ?>
                                                    <td><span class="badge badge-pill badge-danger"><?php echo $row['planned_start']; ?></span></td>                                       
                                                <?php
                                                }
                                            else{
                                                ?>
                                                    <td><?php echo $row['planned_start']; ?></td>
                                                <?php
                                            } 
                                        ?>
                                        <td><?php echo $row['planned_end']; ?></td>
                                        <td><?php echo $row['remarks']; ?></td>
                                        <!-- <td><?php echo $row['approval_status']; ?></td> -->
                                        <?php
                                        if($row['approval_status']!='Rejected'){
                                            ?>
                                            <td><button type="submit" id="BtnStart" class="btn btn-success submit-btn" onclick="SetStartDate(this.value)" value="<?php echo $row['id'];?>">Approve</button></td>
                                            <td><button type="submit" id="BtnReject" class="btn btn-warning submit-btn" onclick="RejectWorks(this.value)" value="<?php echo $row['id'];?>">Reject</button></td>
                                            <?php
                                        }
                                        else{
                                            
                                        }
                                        ?>
                                    </tr> 
                                <?php
                            }
                        ?>
                    </tbody>
                </table>    
            <?php
        }
    }
   
?>