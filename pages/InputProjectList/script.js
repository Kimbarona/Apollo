$(document).ready(function () {
    LoadInputNewProjectName();
    LoadInputedProjectNameTable();
    
 
});


function LoadInputNewProjectName(){
    $.ajax({
        type: "POST",
        url: "InputProjectList/AddNewProjectNameForm.php",
        data:{},
        success: function(response){
            $('#AddNewProjectListForm').html(response);
            addNewProjectName();
            EditProjectName();
            
        }
    })
}

function LoadInputedProjectNameTable(){
    $.ajax({
        type: "POST",
        url: "InputProjectList/InputedProjectTable.php",
        data:{},
        success: function(response){
            $('#TableContent').html(response);
        }
    })
}

function LoadProjectNameModal(){
    $.ajax({
        type: "POST",
        url: "InputProjectList/ModalEditProjectName.php",
        data:{},
        success: function(response){
            $('#').html(response);
        }
    })
}

function addNewProjectName(){
    $("#InputNewProjectNameForm").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: "InputProjectList/PostingToClass.php",
            data: form.serialize(), // serializes the form's elements.
            success: function (response) {
                $("#AlertProjectName").html(response);
                ClearField();
                LoadInputedProjectNameTable();
               
            }
        });
    });
}

function EditProjectName(){
    $("#FormEditProjectName").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');

        // $.ajax({
        //     type: "POST",
        //     url: "InputProjectList/PostingToClass.php",
        //     data: form.serialize(), // serializes the form's elements.
        //     success: function (response) {
        //         $("#AlertProjectName").html(response);
        //         ClearField();
        //         LoadInputedProjectNameTable();
               
        //     }
        // });
        console.log('ready');
    });
}

function ClearField(){
    $("#OrganizationNumber").val("");
    $("#CapexNumber").val("");
    $("#ProjectName").val("");
   
}