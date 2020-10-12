$(document).ready(function(){
    $("#SubscopesForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({ 
            type: "POST",
            url: "modal_addsubscopes.php",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
            // $("#SubScopeAlert").html(response);
            // ClearField();
            // $('#btnClose').click();
            console.log(data);
          
            }
            });

        });
});
function ClearField(){
    $("#Subscope").val("");   
}



    

       