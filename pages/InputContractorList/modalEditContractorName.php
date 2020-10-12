<?php
?>
<div class="modal fade bd-example-modal-sm" id="editContractor<?php echo $row['contractor_name']?>">
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
                                <input type="text" class="form-control" name="ContractorName" value="<?php echo $row['contractor_name'];?>" placeholder/>                           
                            </div>
                    </div> 
                    <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Contact Person</label>
                                <input type="text" class="form-control" name="ContactPerson" value="<?php echo $row['contact_person'];?>" placeholder/>                           
                            </div>
                    </div> 
                    <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Address</label>
                                <input type="text" class="form-control" name="ContractorAddress" value="<?php echo $row['contractor_address'];?>" placeholder/>                           
                            </div>
                    </div> 
                    <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Contact Number</label>
                                <input type="text" class="form-control" name="ContactNumber" value="<?php echo $row['contact_number'];?>" placeholder/>                           
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

