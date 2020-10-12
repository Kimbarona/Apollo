<?php
?>
<div class="modal fade bd-example-modal-sm" id="editEngineer<?php echo $row['engineer_name'];?>">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        <div id="SubScopeAlert"></div>
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
               
            </div>
                <div class="modal-body">
                <form action="" method="POST" id="FormEditProjectName">
                    <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Contractor Name</label>
                                <input type="text" class="form-control" name="ContractorName" value="<?php echo $row['engineer_name'];?>" placeholder/>                           
                            </div>
                    </div> 
                    <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Position</label>
                                <input type="text" class="form-control" name="Designantion" value="<?php echo $row['designation'];?>" placeholder/>                           
                            </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" name="BtnSubmit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" id="btnClose" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

