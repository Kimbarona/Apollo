$(document).ready(function () {
    LoadAddNewProject();
    LoadTableContent();
   
});


function LoadAddNewProject(){
    $.ajax({
        type: "POST",
        url: "ProjectMasterlist/AddNewProject.php",
        data:{},
        success: function(response){
            $('#AddNewProjectPanel').html(response);
            addNewProject();
            
        }
    })
}

function LoadTableContent(){
    $.ajax({
        type: "POST",
        url: "ProjectMasterlist/Table.php",
        data:{},
        success: function(response){
            $('#TableContent').html(response);
        }
    })
}

function addNewProject(){
    $("#AddProjectListForm").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: "ProjectMasterlist/ProjectPostingToClass.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (response) {
                $("#AlertProjectMasterlist").html(response);
                ClearField();
                LoadTableContent();
                // location.reload();
               
            }
        });
    });
}


function ClearField(){
    $("#OrganizationNumber").val("");
    $("#CapexNumber").val("");
    $("#ProjectName").val("");
    $("#BusinessUnit").val("");
    $("#project_Description").val("");
    $("#Reason").val("");
    $("#BudgetedAmount").val("");
    $("#ContractAmountStatus").val("");
    $("#Proponent").val("");
    $("#ProjectStatus").val("");
}