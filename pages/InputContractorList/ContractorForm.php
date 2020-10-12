<?php
    require_once("class.php");
    $AddNewContractorList = new AddNewContractorList();
?>
    
    <div class="row">
        <div class="col-12">
            <div class="card mt-4"> 
                <div id="AlertContractorName"></div>        
                <div class="card-body">
                    <h4 class="header-title">Add Contractor</h4>                   
                    <form class="needs-validation" method="POST" id="InputNewContractorListForm" > 
                         <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Contractor Name</label>
                                <input type="text" name="ContractorName" class="form-control" id="ContractorName" placeholder="" required="">
                               
                            </div>
                        </div> 
                        <div class="form-row">             
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom02">Contact Person</label>
                                <input type="text"  name="ContactPerson" class="form-control" id="ContactPerson" placeholder=""  required="">
                                
                            </div>   
                        </div>    
                        <div class="form-row">             
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom02">Contractor Address</label>
                                <input type="text"  name="ContractorAddress" class="form-control" id="ContractorAddress" placeholder=""  required="">
                                
                            </div>   
                        </div>          
                        <div class="form-row">             
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom02">Contact Number</label>
                                <input type="text"  name="ContactNumber" class="form-control" id="ContactNumber" placeholder=""  required="">
                                
                            </div>   
                        </div>                     
                                                                       
                        <button class="btn btn-primary" type="type" id="btnProjectMasterlist">Save</button>
                    </form>
                </div>
            </div>
        </div>
     </div>
    </div>
</div>  
  
