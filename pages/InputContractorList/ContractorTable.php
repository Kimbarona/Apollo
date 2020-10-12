<?php
require_once("class.php");
$AddNewContractorList = new AddNewContractorList();
?>
<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Contractor Name List</h4>
                    <div class="data-tables datatable-dark ">
                        <table id="dataTable3" class="text-center">
                            <thead class="text-capitalize">
                                <tr>
                                
                                    <th width="40%">Contractor Name</th>                                    
                                    <th width="20%">Contact Person</th>
                                    <th width="20%">Address</th>
                                    <th width="10%">Contact Number</th>
                                    <th width="10%">Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $AddNewContractorList->runQuery("SELECT * FROM apollo_contractor_list");
                                $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>                                       
                                    <td><?php echo $row['contractor_name']; ?></td>
                                    <td><?php echo $row['contact_person']; ?></td>
                                    <td><?php echo $row['contractor_address']; ?></td>
                                    <td><?php echo $row['contact_number']; ?></td>
                                    <td>                                  
                                        <button type="button" class="btn btn-outline-warning mb-3" data-toggle="modal" data-target="#editContractor<?php echo $row['contractor_name'];?>">Edit
                                    </td>
                                </tr>
                            <?php
                                include('modalEditContractorName.php');
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