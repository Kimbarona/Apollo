<?php
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();
?>
<div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Enrolled Project</h4>
                        <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                        <thead class="bg-light text-capitalize">
                                        <tr>
                                           
                                            <th>Assign Eo</th>
                                            <th>Project Name</th>
                                            <th>Capex No.</th>
                                            <th>Contractor</th>
                                            <!-- <th>Project Status</th> -->
                                            <th>Contract Amount</th>
                                            <!-- <th>Start Date</th>
                                            <th>End Date</th>                              -->
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $EnrollNewProject->runQuery("SELECT * FROM apollo_enrolledproject");
                                            $stmt->execute();
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                                            ?>
                                            <tr>
                                              
                                                <td><?php echo $row['engineer']; ?></td>
                                                <td><?php echo $row['project_name']; ?></td>
                                                <td><?php echo $row['capex_number']; ?></td>
                                                <td><?php echo $row['contractor']; ?></td>
                                                <!-- <td><?php echo $row['project_status']; ?></td> -->
                                                <td><?php echo $row['ecost']; ?></td>
                                                <!-- <td><?php echo$row['startdate']; ?></td>
                                                <td><?php echo$row['end_date']; ?></td> -->
                                            </tr>
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