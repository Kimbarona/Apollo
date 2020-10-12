<?php
    require_once("class.php");
    $AddNewProjectNameList = new AddNewProjectNameList();
?>
    
    <div class="row">
        <div class="col-12">
            <div class="card mt-4"> 
                <div id="AlertProjectName"></div>        
                <div class="card-body">
                    <h4 class="header-title">Add Project</h4>                   
                    <form class="needs-validation" method="POST" id="InputNewProjectNameForm" > 
                         <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Organization No.</label>
                                <input type="number" name="OrganizationNumber" class="form-control" id="OrganizationNumber" placeholder="ex. 12345" required="">
                               
                            </div>
                        </div> 
                        <div class="form-row">             
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom02">Store/Project Name</label>
                                <input type="text"  name="ProjectName" class="form-control" id="ProjectName" placeholder="ex. FO-Apalit"  required="">
                                <input type="hidden"  name="Status" class="form-control" id="Status" value="1"  required="">
                                
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
  
