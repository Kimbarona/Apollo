$(document).ready(function () {
    EnrollProjectPanel();
    LoadTableContent();
    
    
});


function EnrollProjectPanel() {
    $.ajax({
        type: "POST",
        url: "enrollProject/enrollProjectForm.php",
        data: {},
        success: function (response) {
            $('#EnrollProjectPanel').html(response);
            LoadEnrollNew();
            // ComputeDownPayment();
         
        }
    })
}


// function ComputeDownPayment() {
//     $('#Percent').keyup(function () {
//         var textone;
//         var texttwo;
//         textone = parseFloat($('#ContractAmount').val());
//         texttwo = parseFloat($('#Percent').val());
//         var result = textone * texttwo *10;
//         $('#DownPayment').val(result.toLocaleString('en'));
//     });
// }



function LoadEnrollNew(){
    $("#EnrollProjectForm").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: "enrollProject/EnrollPostingToClass.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (response) {
                $("#AlertEnrollList").html(response);
                ClearField();
                LoadTableContent();
            }
        });
     
    });
}

function LoadTableContent(){
    $.ajax({
        type: "POST",
        url: "enrollProject/Table.php",
        data:{},
        success: function(response){
            $('#TableContent').html(response);
        
        }
    })
}

function ClearField(){
    $("#CapexNumber").val("");
    $("#ProjectName").val("");
    $("#Contractor").val("");
    $("#AssignEo").val("");
    $("#NtpDate").val("");
    $("#StartDate").val("");
    $("#EndDate").val("");
    $("#ContractAmount").val("");
    $("#DownPayment").val("");
}