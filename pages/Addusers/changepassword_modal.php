<?php
    require_once("class_userAccount.php");
    $user = new user();
?>
<div id="ShowAlertsuccess"></div>
<div class="modal fade" id="changepass<?php $row['username'];?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" id="CloseModal" data-dismiss="modal" ><span>&times;</span></button>
            </div>
                <div class="modal-body">
                <form action="">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Confirm Username</label>
                            <input type="text" name="ConfirmUsername" class="form-control" id="ConfirmUsername" placeholder="" required>
                        </div>
                    </div> 
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Enter New Password</label>
                            <input type="text" name="Enternewpassword" class="form-control" id="Enternewpassword" placeholder="" required>
                        </div>
                    </div> 
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnSave">Save changes</button>
                    </div>
             </form>
        </div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script>
         $("#btnSave").click(function(){
            var newpass = $('#Enternewpassword').val();
            var oldusername = $('#ConfirmUsername').val();

                $.ajax({ 
                type: "POST",
                url: "Addusers/changepasswordposting.php",
                data: {newpass:newpass, oldusername:oldusername}, // serializes the form's elements.
                success: function(response)
                {
            
                $("#ShowAlertsuccess").html(response);
                // location.reload();
                $('#CloseModal').click();
                $("#Enternewpassword").val(""); 
                $("#ConfirmUsername").val(""); 
                // console.log(response);
            
                }
                });
            }); 
   </script>