<?php
require_once("GlobalClass.php");
$GlobalConnection = new GlobalConnection();
?>
<!-- basic modal start -->
<!-- Modal -->
<div class="modal fade" id="exampleModalLong<?php echo $rows['b_id']?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enter Your Remarks For Final Approval</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <?php
                $Id = $rows['b_id'];
                    $stmts = $GlobalConnection->runQuery("SELECT * From apollo_firstapprover WHERE b_id = '$Id'");
                    $stmts->execute();
                    while($row = $stmts->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Note:</label>
                    <textarea class="form-control rounded-0" id="Remarks" onkeyup="RemarksKeyUp(this.value)" rows="5" placeholder="Please Enter you reason here.."></textarea>
                    <input class="form-control" type="text" value="<?php echo $row['capex_number']?>" id="capex" readonly>
                    <input class="form-control" type="text" value="<?php echo $row['billing_type']?>" id="b_type" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="BtnReject" value="<?php echo $rows['b_id']?>" onclick="ReapproveButton(this.value)">For Approval</button>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- basic modal end -->
    