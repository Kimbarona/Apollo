
<div class="modal fade bd-example-modal-sm" id="AddSubScopeModal<?php echo $row['Scope_id']?>">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        <div id="SubScopeAlert"></div>
            <div class="modal-header">
                <h5 class="modal-title">Add Sub Scope</h5>
               <form action="" method="POST" id="SubscopesForm">
            </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="SubScope" name="SubScope" placeholder="Enter Sub Scope" required/>
                </div>
                <input type="hidden" class="form-control" name="scopeid" id="scopeid" value="<?php echo $row['Scope_id']?>" readonly/>
                <div class="modal-footer">
                    <button type="type" class="btn btn-primary" name="btnsubmit">Save</button>
                    <button type="button" class="btn btn-secondary" id="btnClose" data-dismiss="modal">Close</button>
                </div>
                </form>
        </div>
    </div>
</div>
<!-- modal ni view -->
<div class="modal fade bd-example-modal-sm" id="ViewSubScopeModal<?php echo $row['Scope_id']?>">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $row['GenScopes']; ?></h5>
                </div>
                <div class="modal-body">
                <?php
                $ID = $row['Scope_id'];
                    $view = $EnrollScopes->runQuery("SELECT apollo_added_subscopes.SubScopes, apollo_genscopes.GenScopes FROM apollo_added_subscopes INNER JOIN apollo_genscopes ON apollo_added_subscopes.parent_id = apollo_genscopes.Scope_id  WHERE parent_id=$ID");
                    $view->execute();
                        while($row = $view->fetch(PDO::FETCH_ASSOC)){
                    ?>

                      <!-- Basic List Group start -->                                                                         
                                <ul class="list-group">
                                    <li class="list-group-item"><?php echo $row['SubScopes']; ?></li>
                                </ul>
                    <!-- Basic List Group end -->
                   
                <?php
                    
                    }
                ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                </div>
        </div>
    </div>
</div>

<script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
<script>
    $(document).ready(function ($) {
        $("#btnsubmit").click(function (e) {
            e.preventDefault();

            var SubScope = $('#SubScope').val();
            var scopeid = $('#scopeid').val();
           

            $.ajax({
                type: "POST",
                url: "enrollscopes/modal_addsubscopes.php",
                data: {SubScope:SubScope, scopeid:scopeid},
                success: function (msg) {
                    $("#SubScopeAlert").html(msg);
                   
                    
                    
                    // console.log(msg);
                }
            
            });
        
        });
});
</script>
