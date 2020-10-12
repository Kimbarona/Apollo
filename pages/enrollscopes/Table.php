<?php
require_once("class.php");
$EnrollScopes = new EnrollScopes();
?>
<div class="row">
    <div class="col-12">
        <div class="card mt-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Enrolled Scopes List</h4>
                    <div class="data-tables datatable-dark ">
                        <table id="dataTable3" class="text-center">
                            <thead class="text-capitalize">
                                <tr>
                                
                                    <th width="40%">Project Name</th>
                                    <th width="60%">Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $EnrollScopes->runQuery("SELECT * FROM apollo_genscopes");
                                $stmt->execute();
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>                                       
                                    <td><?php echo $row['GenScopes']; ?></td>
                                    <td>      
                                            
                                        <button class="btn btn-outline-info mb-3" data-toggle="modal" data-target="#ViewSubScopeModal<?php echo $row['Scope_id']?>">View</button>
                                        <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#AddSubScopeModal<?php echo $row['Scope_id']?>">Add
                                    </td>
                                </tr>
                            <?php
                                include('modalAddNewSubscope.php');
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