 <!-- modal for new additional cost -->
 <div class="card">
            <div class="card-body">
                <!-- Large modal -->              
                <div class="modal" id="Addcost<?php echo $rowprojectlist['capex_number']?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Generate Additional Cost</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body" style="background-color:#eeebff">
                            <?php 
                                $CapexNum = $rowprojectlist['capex_number'];
                                $SelectData = $GlobalConnection->runQuery("SELECT * FROM apollo_enrolledproject Where capex_number ='$CapexNum'");
                                $SelectData->execute();
                                $rowData  = $SelectData->fetch(PDO::FETCH_ASSOC);
                                    $ProjectName = $rowData['project_name'];
                                    $Contractor = $rowData['contractor'];
                                    $Payee = $rowData['payee'];
                                    $Engineer = $rowData['engineer'];
                             
                             
                             ?>
                                <form class="" method="POST" action="AdditionalCost/AdditionalCostPostingToClass.php" id="GenerateAdditionalcostForm">
                                    <div class="form-row">
                                        <div class="col-md-2 mb-3">
                                            <label for="validationCustom01">Capex Number</label>
                                            <input type="text" class="form-control" name="CapexNumber" id="CapexNumber" value="<?php echo $CapexNum ?>" readonly>
                                           
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="validationCustom02">Project Name</label>
                                            <input type="text" class="form-control"  name="ProjectName" id="ProjectName" value="<?php echo $ProjectName ?>" readonly>
                                            
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label for="validationCustomUsername">Contractor</label>
                                                <input type="text" class="form-control" name="Contractor" id="Contractor" value="<?php echo $Contractor ?>"  readonly>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Payee</label>
                                            <input type="text" class="form-control" name="Payee" id="Payee" value="<?php echo $Payee ?>" readonly>
                                            
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Address*</label>
                                            <input type="text" class="form-control" name="Address" id="Address" required>
                                          
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05">Contact No.*</label>
                                            <input type="text" class="form-control"  name="ContactNum" id="ContactNum" required>
                                        </div>
                                    </div>          
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                        <label for="validationCustom05">Billing Type*</label>
                                            <Select type="text" class="custom-select" name="BillingType" id="BillingType" required>
                                                <option></option>
                                                <option>Initial Payment (Additional Works)</option>
                                                <option>Full Payment (Additional Works)</option>
                                            </select>
                                          
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05">Start Of Construction*</label>
                                            <input type="date" class="form-control" name="StartOfCon" id="StartOfCon" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom03">Project Completion*</label>
                                            <input type="date" class="form-control" name="ProjectCom" id="ProjectCom" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom04">Scope of Works*</label>
                                            <input type="text" class="form-control" name="ScopeOfWorks" id="ScopeOfWorks" required>
                                          
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom05">Billing Submission Date*</label>
                                            <input type="Date" class="form-control" name="BillingSubDate" id="BillingSubDate" value="" required>
                                            <input type="hidden" class="form-control" name="GeneratedDate" id="GeneratedDate" value="<?php echo date('Y-m-d');?>" readonly>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom03">Date Recieved*</label>
                                            <input type="Date" class="form-control" name="DateRecieved" id="DateRecieved" required>
                                            
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom04">Payment Needen On*</label>
                                            <input type="Date" class="form-control" name="PaymentNeeded" id="PaymentNeeded" required>
                                          
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom03">Contract Price*</label>
                                            <input type="text" class="form-control ContractPrice" onkeyup="this.value=add_commas(this.value);" name="ContractPrice" id="ContractPrice" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="validationCustom03">Progress*</label>
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">%</div>
                                                <input type="number" class="form-control" onkeyup="InputProgress(this.value);"  name="Progress" id="Progress" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">Billable Amount</label>
                                            <input type="text" class="form-control" name="Billable" id="Billable"   required >
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationCustom04">Particulars*</label>
                                            <textarea type="text" class="form-control" name="Particulars" id="Particulars" required></textarea>
                                            <input type="hidden" class="form-control" name="Engineer" id="Engineer" value="<?php echo  $Engineer ?>" required >
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="Generate" class="btn btn-primary Generate">Generate</button>
                            </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>        
<script>
    // $(document).ready(function(){
    // $( "#Progress" ).keyup(function () {
    //      var a = $(this).val();
    //      var b = $("#ContractPrice").val();

    //      var c =  parseFloat(b.replace(/,/g, ''));
    //      var d =  parseFloat(a.replace(/,/g, ''));
    //      var e = c*d / 100;
    //      $('#Billable').val(e.toLocaleString('en'));
    //     //  alert('hello');
    // }); 

    // });
    function InputProgress(Prog){
         var a = Prog;
         var b = $("#ContractPrice").val();
         var c =  parseFloat(b.replace(/,/g, ''));
         var d =  parseFloat(a.replace(/,/g, ''));
         var e = c*d / 100;
         $('#Billable').val(e.toLocaleString('en'));
        //  alert(b);
    }

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
</script>
    