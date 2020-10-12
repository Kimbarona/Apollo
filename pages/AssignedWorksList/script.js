function reloadData(){
    var FilterCapex = $('#FilterCapex').val();
    
    $.ajax({
        type: "POST",
        url: "AssignedWorksList/SearchAssignedWorksList.php",
        data: {FilterCapex:FilterCapex},
        success: function(response){
            $("#ContainerTable").html(response);
            // // alert(response);
            // console.log(response);
        }
    });

}  