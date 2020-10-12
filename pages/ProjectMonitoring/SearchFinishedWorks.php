<?php
 require_once("class.php");
 $ProjectMonitoring = new ProjectMonitoring();

    $FilterCapex = $_POST['FilterCapex'];

    if(isset($FilterCapex)){
        $stmts = $ProjectMonitoring->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE capex_number = '$FilterCapex' AND subscope_percent = 100 AND work_status !='Closed'");
        $stmts->execute();
        $row = $stmts->fetch();

        if ($row ==0) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Opps!</strong> No Finished Project Available!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
            </div>
            <?php
        }
        else{
            ?>
            <div id="ClosingWorksAlert"></div>                                                            
            <table id="dataTable" class="table table-bordered table-striped">
                <thead class="bg-light text-capitalize">                                                                                      
                    <th width="10%" style="background-color:#7855ed; color:white;">Capex</th>
                    <th width="20%" style="background-color:#7855ed; color:white;">Scopes</th>
                    <th width="20%" style="background-color:#7855ed; color:white;">Work Description</th>
                    <th width="25%" style="background-color:#7855ed; color:white;">Progress</th>
                    <th width="10%" style="background-color:#7855ed; color:white;">End Date</th>
                    <th width="10%" style="background-color:#7855ed; color:white;">Status</th>
                    <th width="5%" style="background-color:#7855ed; color:white;">Action</th>                                                                
                </thead>
            <tbody>
            <?php
                 $view = $ProjectMonitoring->runQuery("SELECT * FROM  apollo_project_assigned_scopes WHERE capex_number = '$FilterCapex' AND subscope_percent = 100 AND work_status!='Closed'");
                 $view->execute();
                    while($row = $view->fetch(PDO::FETCH_ASSOC))
                    {
                        
                        ?>
                            <tr>
                                 <td><?php echo $row['capex_number']; ?></td>
                                 <td><?php echo $row['gen_scope']; ?></td>
                                 <td><?php echo $row['subscopes']; ?></td>
                                 <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width:<?php echo $row['subscope_percent']; ?>%" aria-valuenow="<?php echo $row['subscope_percent']; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $row['subscope_percent']; ?>%</div>                                    
                                    </div></td>
                                 <td><?php echo $row['actual_end']; ?></td>
                                 <td> <span class="badge badge-warning"><?php echo $row['work_status'];?></span></td>
                                 <td><button class="btn btn-secondary btn-xs mb-3" type="type" id="btnEditStatus"  onclick="ChangeStatus(this.value)" value="<?php echo $row['id']; ?>">Close</button></td>  
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
<script type="text/javascript" language="javascript">
  

</script>