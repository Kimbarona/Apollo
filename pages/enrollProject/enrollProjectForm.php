<?php
require_once("class.php");
$EnrollNewProject = new EnrollNewProject();

?>

<div class="row">
    <div class="col-12">
            <div class="card mt-4">
                <div id="AlertEnrollProject"></div>
                <div class="card-body">
                    <h4 class="header-title">Enroll Project</h4>
                    <form class="needs-validation" method="POST" id="EnrollProjectForm" >
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Capex Number</label>
                                <select class="custom-select" name="CapexNumber" id="CapexNumber" onchange="SelectProponent(this.value)" required >
                                <option value=""></option>
                                    <?php   
                                     $view = $EnrollNewProject->runQuery("SELECT * FROM apollo_projectlist where project_status = 'Open'");
                                     $view->execute();
                                        while($row = $view->fetch(PDO::FETCH_ASSOC))
                                        {
                                            ?>
                                            <option><?php echo $row['capex_number']; ?></option>   
                                            <?php
                                         }
                                    ?>                                                                  
                                </select>
                               
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Contractor</label>
                                <select class="custom-select" name="Contractor" id="Contractor" onchange="SelectPayee(this.value)" required readonly>
                                <option value=""></option>
                                <?php   
                                     $con = $EnrollNewProject->runQuery("SELECT * FROM apollo_contractor_list");
                                     $con->execute();
                                        while($row = $con->fetch(PDO::FETCH_ASSOC))
                                        {
                                            ?>
                                            <option><?php echo $row['contractor_name']; ?></option>   
                                            <?php
                                         }
                                    ?>                                                       
                                  </select>
                               
                            </div>                           
                        </div>

                        <div class="form-row">
                             <div class="col-md-6 mb-3">
                                <label for="">Assign Eo</label>
                                <div class="input-group">
                                  <select class="custom-select" name="AssignEo" id="AssignEo"  required readonly>
                                  <option value=""></option>
                                  <?php   
                                     $engr = $EnrollNewProject->runQuery("SELECT * FROM apollo_useraccounts WHERE position='Eo'");
                                     $engr->execute();
                                        while($row = $engr->fetch(PDO::FETCH_ASSOC))
                                        {
                                            ?>
                                            <option><?php echo $row['fullname']; ?></option>   
                                            <?php
                                         }
                                    ?>                             
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Payee</label>
                                <div class="">
                                    <input type="text" name="Payee" class="form-control" id="Payee"  placeholder=""  readonly>
                                </div>
                            </div>
                           
                        </div>
                        
                        <div class="form-row">
                             <div class="col-md-6 mb-3">
                                <label for="">Proponent</label>
                                <div class="">      
                                    <input type="text" name="Proponent" class="form-control" id="Proponent"  placeholder=""  readonly>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">NTP Date</label>
                                <div class="">
                                <input type="date" name="NtpDate" class="form-control" id="NtpDate" placeholder=""  required="">
                                </div>
                            </div>
                           
                        </div>


                        <div class="form-row">
                             <div class="col-md-6 mb-3">
                                <label for="">Start Date</label>
                                <div class="">      
                                    <input type="date" name="StartDate" class="form-control" id="StartDate"  required="">
                                    
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="">End Date</label>
                                <div class="">
                                <input type="date" name="EndDate" class="form-control EndDate" id="EndDate" onchange="ValidateDate(this.value)"  required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                             <div class="col-md-5 mb-3">
                                <label for="">Contract Amount</label>
                                <div class="input-group"> 
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">₱</div>
                                     </div>
                                         <input type="text" name="ContractAmount" onkeyup="this.value=add_commas(this.value);" class="form-control" id="ContractAmount"  required="">
                                   
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="">Percent</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        
                                     </div>
                                <!-- <input type="text" name="Percent" class="form-control" id="Percent" placeholder="" aria-describedby="inputGroupPrepend" required> -->
                                <input type="number" class="form-control" name="Percent" id="Percent" value="" required />                               
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="">Down Payment</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">₱</div>
                                     </div>                                         
                                        <input type="text"  name="DownPayment" class="form-control"  id="DownPayment" placeholder=""  required readonly>
                                    </div>
                            </div>
                        </div>                     
                        <button class="btn btn-primary" type="type" id="btnEnrollProject">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
  $(document).ready(function(){
      $("#BudgetamountApproval").hide();
      $('#BudgetamountOnhold').hide();
    $( "#Percent" ).keyup(function() {
         var a = $(this).val();
         var b = $("#ContractAmount").val();

         var c =  parseFloat(b.replace(/,/g, ''));
         var d =  parseFloat(a.replace(/,/g, ''));
         var e = c*d / 100;
         $('#DownPayment').val(e.toLocaleString('en'));
        //  alert(e);
    }); 

});


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

    function ValidateDate(val){
         
         var end = val;
         var start = $('#StartDate').val();
         
         if(start > end){
             
             $('#EndDate').val('');
             alert('Please Double check your End Date, must be greater than start date!');
         }
         else{
           
         }
    // alert(start);

    }

    function SelectProponent(Capex){
        $.ajax({
            type: "POST",
            url: "enrollProject/SelectProponent.php",
            data: {Capex:Capex},
            success: function (Proponent) {
                $("#Proponent").val(Proponent);
                $("#NameOfApprover").val(Proponent);
            }
        })
    }

    $( "#ContractAmount" ).keyup(function() {
        var EnteredAmount = $(this).val();
        var Capex = $("#CapexNumber").val();
        // alert (b);
        $.ajax({
            type: "POST",
            url: "enrollProject/ValidateContractAmount.php",
            data: {Capex:Capex, EnteredAmount:EnteredAmount},
            success: function (Validation) {
                if(Validation == "over"){
                    $('#BudgetamountApproval').show();
                    $('#btnEnrollProject').hide();  
                    // alert(Validation);              
                }
                else if(Validation == "allowable"){
                    $('#BudgetamountApproval').hide();
                    $('#btnEnrollProject').show();
                    // alert(Validation);   
                }
                else if(Validation == "Hold"){
                    $('#BudgetamountOnhold').show();
                    $('#btnEnrollProject').hide();
                    // alert(Validation);   
                }
                else if(Validation == "For Approval"){
                    $('#BudgetamountOnhold').show();
                    $('#btnEnrollProject').hide();
                    // alert(Validation);   
                }
                else{
                    alert(Validation);
                }
            }
        })
    });

    $( "#ApprovalButton" ).click(function() {
        var Project_Proponent = $("#NameOfApprover").val();
        var CapexNumber = $("#CapexNumber").val();
        var ContractAmt = $("#ContractAmt").val();
            if(ContractAmt == ""){
                alert("Please make sure, you entered the contract amount!!");
            }
            else{
                    $.ajax({
                    type: "POST",
                    url: "enrollProject/ApprovalOfContractAmountPosting.php",
                    data: {Project_Proponent:Project_Proponent, CapexNumber:CapexNumber, ContractAmt:ContractAmt},
                    success: function (message) {
                    alert(message);
                    location.reload();
                    }
                })
            }
         
    });

    $("#Contractor").click(function() {
        // Dito ko ilalagay ung ajax to validate approve or not ca
        
        var CapexNumber = $("#CapexNumber").val();
        $.ajax({
            type: "POST",
            url: "enrollProject/ValidationOfApprovedCa.php",
            data: {CapexNumber:CapexNumber},
            success: function (message) {
                if(!$.trim(message)){
                   
                }
                else{
                    $("#ContractAmount").val(message);
                    $("#ContractAmount").prop("readonly", true);
                }
                
            }
        })
        
    });

    function SelectPayee(Cantractor){
        $.ajax({
            type: "POST",
            url: "enrollProject/SelectPayee.php",
            data: {Cantractor:Cantractor},
            success: function (Payee) {
                $("#Payee").val(Payee);
            }
        })
    }

</script>
