$(document).ready(function(){
    $('#BtnReject').hide();
});

    function RemarksKeyUp(){  
        var Remarks = $("#Remarks").val();
        if(Remarks==''){
            $('#BtnReject').hide(); 
        }
        if(Remarks!=''){
            $('#BtnReject').show();
            $('#reMarks').val(Remarks); 
        }
    }

function ApproveButton(id){       
    var r = confirm("Are You sure? You want to approve this billing??");
    if (r == true) { 
        $.ajax({
            type: "POST",
            url: "Approvers/FirstApproverPosting.php",
            data: {Id:id},
            success: function(response){
                $("#AlertMessage").html(response); 
                setTimeout(function(){
                    $( "#dataTable" ).load( "ApprovalOfBilling.php #dataTable" );
                    reloadData();
                    }, 250);
            }
        });
    }
    else{

    }
}

function ReapproveButton(billType,Id){ 
        var Capex = $("#capex_"+Id).val();
        var B_Type = billType;
        var Remarks = $("#Remarks_"+Id).val();
        
            $.ajax({
                type: "POST",
                url: "Approvers/Reapproval.php",
                data: {Capex:Capex, B_Type:B_Type, Remarks:Remarks},
                success: function(response){
                    // $("#AlertMessage").html(response); 
                    alert(response);
                    location.reload();
                }
            });
        

}

function BackToEo(id){     
    var r = confirm("Are You sure? You want this billing back to EO for edit??");
    if (r == true) {  
    $.ajax({
        type: "POST",
        url: "Approvers/BackToEoPostingProcess.php",
        data: {Id:id},
        success: function(response){
            $("#AlertMessage").html(response); 
            setTimeout(function(){
                $( "#dataTable" ).load( "ApprovalOfRejectedBilling.php #dataTable" );
                reloadData();
                }, 250);
        }
      });
    }
    else{

    }

}

function RejectedByHead(billType,Id){ 
    var Capex = $("#capex_"+Id).val();
    var B_Type = billType;
    var Remarks = $("#Remarks_"+Id).val();
    
        $.ajax({
            type: "POST",
            url: "Approvers/RejectedByHead.php",
            data: {Capex:Capex, Id:Id, Remarks:Remarks},
            success: function(response){
                // $("#AlertMessage").html(response); 
                alert(response);
                location.reload();
            }
        });
    

}