<!-- Large modal -->

<div class="modal fade bd-example-modal-lg">
    <div class="modal-dialog modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Work Description</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
            <form id="framework_form">
            <?php
            ?>
                <div class="form-group">
                    <label for="exampleInputEmail1"></label>
                    <input type="email" class="form-control" value="" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="hidden to para sa project name">

            
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1"></label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="dito ung scope">
                </div>
                <div class="form-group" id="checkboxes">
                    <select id="framework" name="framework[]" multiple class="form-control" >
                        <option value="">sub 1</option>
                        <option value="">sub 2</option>
                        <option value="">sub 3</option>
                        <option value="">sub 4</option>
                        <option value="">sub 5</option>
                        <option value="">sub 6</option>
                    
                    </select> 
                  
            </div> 
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
