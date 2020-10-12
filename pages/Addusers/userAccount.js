function userAccountRegistration() {
    $("#RegisterAccountForm").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: "RequestToRegister.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (response) {
                $("#AlertUserAccount").html(response);
                ClearField();
            }
        });
    });
    
}

function ClearField(){
    $("#FirstName").val("");
    $("#LastName").val("");
    $("#UserName").val("");
    $("#PassWord").val("");
    $("#Position").val("");
}