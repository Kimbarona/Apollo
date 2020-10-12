<?php
require_once("class.php");
$AddNewEngineerList = new AddNewEngineerList();
?>
<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Name List</h4>
                    <div class="data-tables datatable-dark ">
                        <table id="dataTable3" class="text-center">
                            <thead class="text-capitalize">
                                <tr>
                                
                                    <th width="40%">Name</th>                                    
                                    <th width="40%">Position</th>
                                    <th width="20%">Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $AddNewEngineerList->runQuery("SELECT * FROM apollo_engineer_list");
                                $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>                                       
                                    <td><?php echo $row['engineer_name']; ?></td>
                                    <td><?php echo $row['designation']; ?></td>
                                    <td>                                  
                                        <button type="button" class="btn btn-outline-warning mb-3" data-toggle="modal" data-target="#editEngineer<?php echo $row['engineer_name'];?>">Edit
                                    </td>
                                </tr>
                            <?php
                                include('modalEditEngineerName.php');
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