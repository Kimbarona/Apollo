<?php
require_once("class.php");
$AddNewProjectNameList = new AddNewProjectNameList();
?>
<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Project Name List</h4>
                    <div class="data-tables datatable-dark ">
                        <table id="dataTable3" class="text-center">
                            <thead class="text-capitalize">
                                <tr>
                                
                                    <th width="20%">Organization Number</th>
                                    <th width="40%">Project Name</th>
                                    <th width="20%">Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $AddNewProjectNameList->runQuery("SELECT * FROM apollo_projectlist_name");
                                $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>                                       
                                    <td><?php echo $row['org_number']; ?></td>
                                    <td><?php echo $row['project_name']; ?></td>
                                    <td>                                  
                                        <button type="button" class="btn btn-outline-warning mb-3" data-toggle="modal" data-target="#editProject<?php echo $row['org_number']; echo $row['project_name'];?>">Edit
                                    </td>
                                </tr>
                            <?php
                                include('modalEditProjectName.php');
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