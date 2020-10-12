<?php
    require_once("class.php");
    $AddNewEngineerList = new AddNewEngineerList();
?>
    
    <div class="row">
        <div class="col-12">
            <div class="card mt-4"> 
                <div id="AlertEngineerName"></div>        
                <div class="card-body">
                    <h4 class="header-title">Add Engineer</h4>                   
                    <form class="needs-validation" method="POST" id="InputNewEngineerListForm" > 
                         <div class="form-row">
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom01">Name</label>
                                <input type="text" name="EngineerName" class="form-control" id="EngineerName" placeholder="" required="">
                               
                            </div>
                        </div> 
                        <div class="form-row">             
                            <div class="col-md-10 mb-3">
                                <label for="validationCustom02">Position</label>
                                <select class="custom-select" name="EngineerPosition" id="EngineerPosition">
                                    <option>Head</option>
                                    <option>Planner</option>
                                    <option>Eo</option>
                                </select>
                                
                            </div>   
                        </div>                                                                                                   
                        <button class="btn btn-primary" type="type" id="btnsave">Save</button>
                    </form>
                </div>
            </div>
        </div>
     </div>
    </div>
</div>  
  
