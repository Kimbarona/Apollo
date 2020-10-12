<?php
    require_once("classProject.php");
    $ProjectList = new ProjectList();
?>
    
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">         
                <div class="card-body">
                    <h4 class="header-title">Add Project</h4>                   
                    <form class="needs-validation" method="POST" id="AddProjectListForm" > 
                         <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Budget Amount</label>
                                <input type="text" name="BudgetedAmount" id="BudgetedAmount" onkeyup="NumberFormatting(this.value);" class="form-control" id="BudgetedAmount" placeholder="" required="">
                               
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom02">Capex No.</label>
                                <input type="text"  name="CapexNumber" class="form-control" id="CapexNumber" placeholder=""  required="">
                                
                            </div>                           
                        </div>
                        <!-- onkeyup="this.value=add_commas(this.value);" -->
                        <div class="form-row">
                             <div class="col-md-6 mb-3">
                                <label for="validationCustomUsername">Project Name</label>
                                <div class="form-group">                                    
                                    <!-- <input type="text" name="ProjectName" class="form-control" id="ProjectName"  aria-describedby="inputGroupPrepend" required>                                    -->
                                <select class="custom-select" name="ProjectName" id="ProjectName" readonly>
                                <option value=""></option>
                                <?php   
                                     $view = $ProjectList->runQuery("SELECT * FROM apollo_projectlist_name ");
                                     $view->execute();
                                       
                                        while($row = $view->fetch(PDO::FETCH_ASSOC))
                                        {
                                            ?>
                                            <option><?php echo $row['project_name']; ?></option>   
                                            <?php
                                         }
                                    ?>                 
                                </select>
                                </div>
                                
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustomUsername">Business Unit</label>
                                <div class="form-group">
                                <select class="custom-select" id="BusinessUnit" name="BusinessUnit" readonly>
                                    <option></option>
                                    <option>Fresh Options</option>
                                    <option>F & B</option>
                                    <option>Hot Kitchen</option>
                                    <option>Roberto's Restaurant</option>
                                    <option>Robbie's</option>
                                    <option>Meats & Match</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustomUsername">Proponent</label>
                                <div class="form-group">
                                <select class="custom-select" id="Proponent" name="Proponent" readonly>
                                    <option></option>
                                    <option>Anthony Lozano</option>
                                    <option>Ariel Perigrino</option>
                                    <option>Rodolfo Valdez</option>
                                    <option>Bonifacio Vargas</option>
                                    <option>Mauie Ladores</option>
                                    <option>Mark Anthony Mercado</option>
                                    <option>Fabienne Luz Balucas</option>                                    
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustomUsername">Project Status</label>
                                <div class="form-group">
                                  <!-- <input type="checkbox" name="gender" id="gender" data-toggle="toggle" checked /> -->
                                  <input class="form-control" id="ProjectStatus" name="ProjectStatus" value="Open" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustomUsername">Reason</label>
                                <div class="form-group">
                                <select class="custom-select" id="Reason" name="Reason" readonly>
                                    <option></option>
                                    <option>Freshen up Project</option>
                                    <option>New Project</option>
                                    <option>Repair and Maintenace</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustomUsername">Contract Amount Status</label>
                                <div class="form-group">
                                  <!-- <input type="checkbox" name="gender" id="gender" data-toggle="toggle" checked /> -->
                                  <select class="custom-select" id="ContractAmountStatus" name="ContractAmountStatus" readonly>
                                 
                                    <option>Budgeted</option>
                                    <option>Unbudgeted</option>
                                    
                                </select>
                                </div>
                            </div>

                             <div class="col-md-12 mb-3">
                                    <label for="validationCustomUsername">Description</label>
                                    <div class="form-group">                              
                                    <textarea name="project_Description" id="project_Description" class="form-control" rows="2"  placeholder="ex. Freshen-up of FO-Sindalan" required></textarea>
                                    <div class="invalid-feedback">
                                        Please choose a Description.
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
  
<script>
function add_commas(number){
	//remove any existing commas...
	number=number.replace(/,/g, "");
	//start putting in new commas...
	number = '' + number;
	if (number.length > 3) {
		var mod = number.length % 3;
		var output = (mod > 0 ? (number.substring(0,mod)) : '');
		for (i=0 ; i < Math.floor(number.length / 3); i++) {
			if ((mod == 0) && (i == 0))
				output += number.substring(mod+ 3 * i, mod + 3 * i + 3);
			else
				output+= ',' + number.substring(mod + 3 * i, mod + 3 * i + 3);
		}
		return (output);
	}
	else return number;
}

function NumberFormatting(){
        $('#BudgetedAmount').keyup(function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40){
            event.preventDefault();            
        }

        $(this).val(function(index, value) {
        return value
            .replace(/\D/g, "")
            .replace(/([0-9])([0-9]{2})$/, '$1.$2')  
            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
        });
    }
</script>
