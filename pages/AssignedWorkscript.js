$(document).ready(function(){  
    ContractAmountValidation();
    NumberFormatting();
    GetRowId();
    triggerDateEnd();
    $('#CapexNo').css("background-color", "#e8f0c7");
    $('.ScopeAmt').css("background-color", "#e8f0c7");
    $('.ps').css("background-color", "#e8f0c7");
    $('.pe').readOnly = true;
    $('.numdays').css("background-color", "#e8f0c7");
    $('#BtnSave').hide();
        $(".ActualStart").hide();
        $(".ActualEnd").hide();
        $(".Gscope").hide();
        $("#AssignedWorksList").hide();
        $(".textbox").attr('readonly','readonly');

        $('#insert_form').on('submit', function(event){
            event.preventDefault();
            // var r = confirm("Are You sure? You want to save it? You Only Have 1 attemp to do this Action!");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
              })
              
              swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You want to save it? You Only Have 1 attemp to do this Action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, save it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                  $.ajax({
                    url:"AssignedWorks/TaggingOfWorks.php",
                    method:"POST",
                    data:$(this).serialize(),
                    success:function(response)
                    {
                        // $('#AlertErrorCapex').html(response);
                        swalWithBootstrapButtons.fire(
                            'Done!',
                            'Successfully saved!',
                            'success'
                          );
                        location.reload();                        
                    }
                })
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                  )
                }
              })

            });                   

        });  
             
        
function NumberFormatting(){
    $('.ScopeAmt').keyup(function(event) {
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
function ContractAmountValidation(){
        $('.ScopeAmt').keyup(function() {
// this is for scope amount 
            var sum = 0;            
            $('.ScopeAmt').each(function() {
                sum += Number(($(this).val().replace(/[^0-9]/g, '')/100));                    
            });            
            var tot = parseFloat(sum).toFixed(2);
            $('#TotalAmt').val(tot); 
            // console.log(sum);                                     
// this is for contract amount
            var Amt = $('#ContractAmt').val();
            var sam = Number(($('#ContractAmt').val().replace(/[^0-9]/g, '')/1));
            // var result = Amt.replace(",","");
            var f = parseFloat(sam).toFixed(2);
                // $( "#BtnSave" ).click(function() { 
                    // console.log(f);                            
                    if(tot != f){                            
                        $('#BtnSave').hide();
                        $('#Balance').html('Total Scope Amount Greater than or Less Than Contract Amount!!'); 
                        $("#ContractAmt").css("background-color", "#ffb3b3");
                        // document.getElementById('audiotag').play();   
                                                                 
                    }
                    else{
                        $('#BtnSave').show();
                        $('#Balance').html(''); 
                        $("#ContractAmt").css("background-color", "#42f598");
                        // $('#insert_form').click();                                                      
                    }
                });
        // }); 
    }

function SearchCapexNum(val){
    $("#AssignedWorksList").show ();        
        $.ajax({
        type: "POST",
        url: "AssignedWorks/SearchCapexNumber.php",
        dataType: 'JSON',
        data: {capex:val},
        success: function(response){   
            // alert('Reminder: Highligted textbox are Fillable!');
            Swal.fire(
                'Reminder',
                'Highligted textbox are Fillable!',
                'info'
              )
            
            $('#ContractAmt').val(response.Ecost); 
            $('#userAccount').val(response.User); 
         }            
        });    
    }   

function triggerDate(id, Id){
    var Capex = $('#CapexNo').val();
    var planend = $('#PlannedEnd').val();
    var Start = $('#PlannedStart'+Id).val();
    var ndays = $('#NumDays'+Id).val();
    $.ajax({
    type: "POST",
    url: "AssignedWorks/DateValidator.php",
    data: {capex:Capex,
    startDate:id},
    success: function(response){   
            if(id < response){
            // alert('Date is must be greater than the Planned Start of the whole Project');
            Swal.fire(
                'Oppss!',
                'Date is must be greater than the Planned Start of the whole Project',
                'warning'
              )
          
            document.getElementById("PlannedStart"+Id).style.backgroundColor = "#ff5c33";
            document.getElementById("NumDays"+Id).style.backgroundColor = "#ff5c33";
           
             }
             else{
            document.getElementById("PlannedStart"+Id).style.backgroundColor = "#ccffcc";
            document.getElementById("NumDays"+Id).style.backgroundColor = "#ccffcc";
            
             }
     
         }        
    });

}

function triggerDateEnd(DateEnd){
    var Capex = $('#CapexNo').val();
    var planstart = $('#PlannedStart').val();
    $.ajax({
    type: "POST",
    url: "AssignedWorks/DateValidatorEnd.php",
    data: {capex:Capex,
    EndDate:DateEnd},
    success: function(response){   
        if(DateEnd > response){
            alert('Date  must be less than or equal the Planned End( '+response+' )of the whole Project');           
            $('#BtnSave').hide();
            
        }
        else{

        }
       
    
    }
    
    });

}

function GetRowId(){
    $('.Chkbx').change(function() {
        if(this.checked) {
            var returnVal = Swal.fire(
                'Reminder',
                'Are you sure?',
                'info'
              );
            $(this).prop("checked", returnVal);
            // var RowId = $(this).val();
            // alert (RowId);
           
        }
       
    });
}

function InputDays(DaysVal,Id){
    var Capex = $('#CapexNo').val();
    var PlannedStart = new Date ($('#PlannedStart'+Id).val());
    var newdate = new Date(PlannedStart);
    var NumDays = parseInt(DaysVal);
    newdate.setDate(PlannedStart.getDate()+NumDays);
    let convertDate = JSON.stringify(newdate)
    var finalDate = convertDate.slice(1, 11)
    var EndDate = finalDate;
    $("#PlannedEnd"+Id).val(finalDate);  
        $.ajax({
            type: "POST",
            url: "AssignedWorks/DateValidatorEnd.php",
            data: {capex:Capex,EndDate:EndDate},
            success: function(response){   
                if(EndDate > response){
                    // alert('Date  must be less than or equal the Planned End( '+response+' )of the whole Project !!');
                    Swal.fire(
                        'Opps!',
                        'Date  must be less than or equal the Planned End( '+response+' )of the whole Project!',
                        'warning'
                      );
                    document.getElementById("PlannedEnd"+Id).style.backgroundColor = "#ff5c33";
                    // $('#BtnSave').hide();
                }else{
                    document.getElementById("PlannedEnd"+Id).style.backgroundColor = "#ccffcc";
                    // $('#BtnSave').show();
                }            
            }
        
        });

}

