$(document).ready(function () {
    LoadAddNewScopes();
    LoadTableContent();
    
    
  
});

function LoadAddNewScopes(){
    $.ajax({
        type: "POST",
        url: "enrollscopes/enrollScopesForm.php",
        data:{},
        success: function(response){
            $('#EnrollScopesForm').html(response);
            AddNewGenScopes();
           
         
        }
    })
}

function LoadTableContent(){
    $.ajax({
        type: "POST",
        url: "enrollscopes/Table.php",
        data:{},
        success: function(response){
            $('#TableContent').html(response);
        }
    })
}

function AddNewGenScopes(){
    $("#EnrollScopesForm").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');
        var genScope = $('#genScope').val();

        $.ajax({
            type: "POST",
            url: "enrollscopes/EnrollPostingToClass.php",
            data: {genScope:genScope}, // serializes the form's elements.
            success: function (response) {
                $("#EnrollSubcopesAlert").html(response);
                ClearField();
                LoadTableContent();
                LoadAddNewScopes();
            }
        });
      
        
    });
}



function ClearField(){
    $("#genScope").val("");
}
