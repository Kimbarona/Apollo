<?php
require_once("classProject.php");
$ProjectList = new ProjectList();
?>
<div class="row">
<div class="col-12">
    <div class="card mt-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Project List</h4>
                    <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="text-center">
                                <thead class="text-capitalize">
                                    <tr>
                                        <th width="10%" >Org No.</th>
                                        <th width="10%" >Capex Number</th> 
                                        <th width="20%" >Project Name</th>
                                        <th width="20%" >Business Unit</th>
                                        <th width="10%" >Budget Amount</th>                                                   
                                        <th width="20%" >Project Description</th>
                                        <th width="10%" >Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $stmt = $ProjectList->runQuery("SELECT * FROM apollo_projectlist");
                                        $stmt->execute();
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <tr>
                                        <td><?php echo$row['org_number']; ?></td>
                                        <td><?php echo$row['capex_number']; ?></td>
                                        <td><?php echo$row['project_name']; ?></td>
                                        <td><?php echo$row['business_unit']; ?></td>
                                        <td><b><?php echo$row['budgeted_amount']; ?></b></td>
                                        <td><?php echo$row['project_description']; ?></td>
                                        <td><a href="#editmodal<?php echo $row['org_number'];?>" class="btn btn-success btn-xs mb-3" data-toggle="modal" >Edit</a></td>
                                    </tr>
                                <?php
                                ?>
                                    <!-- Modal -->
                                        <div class="modal fade" id="editmodal<?php echo $row['org_number'];?>">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update your project Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                            $OrgNum = $row['org_number'];
                                                                $stmtss = $ProjectList->runQuery("SELECT * FROM apollo_projectlist WHERE org_number = $OrgNum");
                                                                $stmtss->execute();
                                                                $rows = $stmtss->fetch();
                                                                
                                                                $A =$rows['org_number']; 
                                                                $BA =$rows['budgeted_amount'];   
                                                                
                                                        ?>
                                                        <form method ="post" action="posting.php">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Org Number</label>
                                                                <input type="text" name="OrgNumber" class="OrgNumber form-control" id="OrgNumber" value="<?php echo $A?>" readonly>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Budgeted Amount</label>
                                                                <input type="text" name="BudgetedAmount" class="BudgetedAmount form-control" id="BudgetedAmount<?php echo $A?>" value="<?php echo $BA?>" required placeholder="Enter New Amount" >
                                                                <input type="hidden" name="OrigAmount" class="OrigAmount form-control" id="OrigAmount<?php echo $A?>" value="<?php echo $BA?>" required placeholder="Enter New Amount" >
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" id="BtnSave" onclick="SubmitData(this.value,<?php echo $A?>)" value="<?php echo $A?>" class="BtnSave btn btn-primary">Save changes</Button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                <!-- Modal -->
                                <?php
                                
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

   
                                           
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="../assets/js/scripts.js"></script>
<script>

  
</script>