$(document).ready(function () {
    LoadInputNewEngineer();
    LoadInputedEngineerListTable();
    
 
});


function LoadInputNewEngineer(){
    $.ajax({
        type: "POST",
        url: "EngineerList/EngineerForm.php",
        data:{},
        success: function(response){
            $('#AddNewEngineerListForm').html(response);
            addNewEngineerName();
           
            
        }
    })
}

function LoadInputedEngineerListTable(){
    $.ajax({
        type: "POST",
        url: "EngineerList/EngineerTable.php",
        data:{},
        success: function(response){
            $('#TableContent').html(response);
        }
    })
}



function addNewEngineerName(){
    $("#InputNewEngineerListForm").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: "EngineerList/PostingToClass.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (response) {
                $("#AlertEngineerName").html(response);
                ClearField();
                LoadInputedEngineerListTable();
               
            }
        });
    });
}


function ClearField(){
    $("#EngineerName").val("");
    $("#EngineerPosition").val("");
  
}