$(document).ready(function () {
    LoadInputNewContratorName();
    LoadInputedContractorListTable();
    
 
});


function LoadInputNewContratorName(){
    $.ajax({
        type: "POST",
        url: "InputContractorList/ContractorForm.php",
        data:{},
        success: function(response){
            $('#AddNewContractorListForm').html(response);
            addNewContractorName();
           
            
        }
    })
}

function LoadInputedContractorListTable(){
    $.ajax({
        type: "POST",
        url: "InputContractorList/ContractorTable.php",
        data:{},
        success: function(response){
            $('#TableContent').html(response);
        }
    })
}



function addNewContractorName(){
    $("#InputNewContractorListForm").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: "InputContractorList/PostingToClass.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (response) {
                $("#AlertContractorName").html(response);
                ClearField();
                LoadInputedContractorListTable();
               
            }
        });
    });
}


function ClearField(){
    $("#ContractorName").val("");
    $("#ContactPerson").val("");
    $("#ContractorAddress").val("");
    $("#ContactNumber").val("");
}