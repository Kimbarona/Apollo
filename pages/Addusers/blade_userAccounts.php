<div class="col-lg-5 col-ml-12">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div id="AlertUserAccount"></div>
                <div class="card-body">
                    <h4 class="header-title">Add new user here</h4>
                    <form class="needs-validation" method="POST" id="RegisterAccountForm" >
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationCustom01">First name</label>
                                <input type="text" name="FirstName" class="form-control" id="FirstName" placeholder="" required="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="validationCustom02">Last name</label>
                                <input type="text"  name="LastName" class="form-control" id="LastName" placeholder=""  required="">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            
                        </div>

                        <div class="form-row">
                             <div class="col-md-5 mb-3">
                                <label for="validationCustomUsername">Username</label>
                                <div class="input-group">
                                    
                                    <input type="text" name="userName" class="form-control" id="UserName" placeholder="" aria-describedby="inputGroupPrepend" required="">
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="validationCustomUsername">Password</label>
                                <div class="input-group">
                                   
                                    <input type="text" name="Password" class="form-control" id="PassWord" placeholder="" aria-describedby="inputGroupPrepend" required="">
                                    <div class="invalid-feedback">
                                        Please choose a password.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                    <label for="validationCustomUsername">Position</label>
                                <select class="form-control" id="Position" name="position">
                                    <option>Select Position</option>
                                    <option>Engineer Head</option>
                                    <option>Planning</option>
                                    <option>Eo</option>
                                    <option>Cost and budget</option>
                                </select>
                            </div>
                        </div>

                     
                        <button class="btn btn-primary" type="type" id="btnUserRegistration">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- datatable here... -->
