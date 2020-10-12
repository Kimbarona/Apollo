$(document).ready(function(){
    $('#BtnReject').hide();   
});

function RemarksKeyUp(val){  
    if(!val){
        $('#BtnReject').hide(); 
    }
    else{
        $('#BtnReject').show();
    }
}

function ApproveButton(id){       
    $.ajax({
        type: "POST",
        url: "Approvers/FinalApprovalPosting.php",
        data: {Id:id},
        success: function(response){
            // $("#AlertMessage").html(response); 
            alert(response);
            location.reload();
        }
      });
}

function RejectFunction(billType,Id){
    var Capex = $("#capex_"+Id).val();
    var B_Type = billType;
    var Remarks = $("#Remarks_"+Id).val();
   
        $.ajax({
            type: "POST",
            url: "Approvers/RejectedBilling.php",
            data: {Capex:Capex, B_Type:B_Type, Remarks:Remarks},
            success: function(response){
                // $("#AlertMessage").html(response); 
                alert(response);
                location.reload();
            }
        });
}