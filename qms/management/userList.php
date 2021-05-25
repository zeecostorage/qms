<?php 
    include '../../config/header.php'; 
    include '../../controller/userController.php';  
    include '../../config/lkp.php'; 
    include '../../config/enum.php'; 

?>
    
    <style type="text/css">
        div#buttonSave{
            display: none;
        }

        div#buttonEdit{
            display: none;
        }
    </style>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include '../../config/menu.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                
                <?php include '../../config/toolbar.php'; ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Staff</h1> -->

                    <!-- DataTales Example -->
                    <div class="row">
                        <div class="col-xl-3 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="m-0 font-weight-bold text-primary">Company</h2>
                                        </div>
                                        <div id="buttonEditComp" class="col-lg-6" style="text-align: right">  
                                            <a href="#" class="btn btn-success bg-gradient-success btn-icon-split" onclick="editCompany()" data-toggle="modal" data-target="#editCompanyModal">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                <span class="text">Edit Profile Company</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <form id="editCompany" method="POST">
                                        <input type="hidden" name="action" id="action" value="getCompanyDetail" >
                                        <div class="form-group">
                                            <label for="fullname">Company Name</label>
                                            <input type="text" class="form-control form-control-user" id="fullname" name="fullname"
                                                placeholder="First Name *" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="fullname">Company Email</label>
                                                <input type="email" class="form-control form-control-user" id="email" name="email"
                                                    placeholder="Email Address *" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="fullname">Company Contact</label>
                                                <input type="text" class="form-control form-control-user" id="contact" name="contact"
                                                    placeholder="Contact Number *" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="fullname">Company Address Street</label>
                                                <input type="text" class="form-control form-control-user" id="street" name="street"
                                                    placeholder="Street *" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="fullname">Company Address Street 2</label>
                                                <input type="text" class="form-control form-control-user" id="street2" name="street2"
                                                    placeholder="Street">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="fullname">Company Address Postcode</label>
                                                <input type="text" class="form-control form-control-user" id="postcode" name="postcode"
                                                    placeholder="Postcode *">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="fullname">Company Address City</label>
                                                <input type="text" class="form-control form-control-user" id="city" name="city"
                                                    placeholder="City *" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="fullname">Company Address State</label>
                                                <select class="form-control  form-control-user" id="state" name="state" aria-label="Default select example" required>
                                                  <option selected>State *</option>

                                                    <?php
                                                        
                                                        $lkpState = getLkpState($con);

                                                        foreach($lkpState as $value) {
                                                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="fullname">Company Address Country</label>
                                                <select class="form-control form-control-user" id="country" name="country" aria-label="Default select example" required>
                                                  <option selected>Country *</option>
                                                  
                                                    <?php
                                                        
                                                        $lkpCountry = getLkpCountry($con);

                                                        foreach($lkpCountry as $value) {
                                                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <div class="col-xl-3 col-md-12 mb-4">
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="m-0 font-weight-bold text-primary">Staff List</h2>
                                        </div>
                                        <div class="col-lg-6" style="text-align: right">  
                                            <a href="#" id="formStaffButton" class="btn btn-success bg-gradient-success btn-icon-split" data-toggle="modal" data-target="#formStaff">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Staff</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Firstname</th>
                                                    <th>Lastname</th>
                                                    <th>Email</th>
                                                    <th>Contact Number</th>
                                                    <th>Role</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $user_list = getUserList($con);

                                                    foreach ($user_list as $value) {
                                                        echo '<tr>';
                                                        echo '<td><a href="#" id="edit" data-toggle="modal" data-target="#formStaff" onclick="getUserDetail(this)" data-myval="'.$value['email'].'">'.$value['firstname'].'</a></td>';
                                                        echo '<td>'.$value['lastname'].'</td>';
                                                        echo '<td>'.$value['email'].'</td>';
                                                        echo '<td>'.$value['contact'].'</td>';
                                                        echo '<td>'.$value['role_name'].'</td>';
                                                        echo '</tr>';

                                                    }

                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-3 col-md-12 mb-4">
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span><?php echo $footer;?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="formStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px !important;">
            <div class="modal-content">
                <div class="modal-header bg-primary text-gray-100">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-gray-100">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card o-hidden border-0 ">
                            <div class="card-body p-0">
                                <form id="register" action="add.php" method="POST">
                                    <input type="hidden" name="action" id="action">
                                    <input type="hidden" name="mode" id="mode">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="firstname">Firstname</label>
                                            <input type="text" class="form-control form-control-user" id="firstname" name="firstname"
                                                placeholder="First Name *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="lastname">Lastname</label>
                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname"
                                                placeholder="Last Name *" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email"
                                                placeholder="Email Address *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control form-control-user" id="contact" name="contact"
                                                placeholder="Contact Number *" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="street">Street</label>
                                            <input type="text" class="form-control form-control-user" id="street" name="street"
                                                placeholder="Street *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="street2">Street2</label>
                                            <input type="text" class="form-control form-control-user" id="street2" name="street2"
                                                placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="postcode">Postcode</label>
                                            <input type="text" class="form-control form-control-user" id="postcode" name="postcode"
                                                placeholder="Postcode *">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control form-control-user" id="city" name="city"
                                                placeholder="City *" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="state">State</label>
                                            <select class="form-control  form-control-user" id="state" name="state" aria-label="Default select example" required>
                                              <option value="" selected>State *</option>

                                                <?php
                                                    
                                                    $lkpState = getLkpState($con);

                                                    foreach($lkpState as $value) {
                                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="country">Country</label>
                                            <select class="form-control form-control-user" id="country" name="country" aria-label="Default select example" required>
                                              <option value="" selected>Country *</option>
                                              
                                                <?php
                                                    
                                                    $lkpCountry = getLkpCountry($con);

                                                    foreach($lkpCountry as $value) {
                                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="repeatPassword">Repeat Password</label>
                                            <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password *" required>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="buttonSave">
                                        <input type="submit" id="submit" class="btn btn-primary" value="Save">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancel">Cancel</button>
                                    </div>
                                    <div id="buttonEdit">
                                        <input type="button" id="edit" class="btn btn-primary" value="Edit">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

</body>

<?php include '../../config/footer.php'; ?>

<script type="text/javascript">
    $( document ).ready(function() {

        getCompanyDetail();

        $("form#register #cancel").click(function(){
            close();
        });

        $("div#formStaff button.close").click(function(){
            close();
        });

        $("input#edit").click(function(event){
            event.preventDefault();
            $("div#buttonSave").show();
            $("div#buttonEdit").hide();
            $("form#register input#firstname").attr('readonly', false);
            $("form#register input#lastname").attr('readonly', false);
            $("form#register input#contact").attr('readonly', false);
            $("form#register input#street").attr('readonly', false);
            $("form#register input#street2").attr('readonly', false);
            $("form#register input#postcode").attr('readonly', false);
            $("form#register input#city").attr('readonly', false);
            $("form#register select#state").attr('disabled', false);
            $("form#register select#country").attr('disabled', false);
            $("form#register input#password").attr('readonly', false);
            $("form#register input#repeatPassword").attr('readonly', false);
        });

        $("#formStaffButton").click(function(){
            $("div#buttonSave").show();
            $("div#buttonEdit").hide();
            $("#exampleModalLabel").html("Add New Staff");
            $("form#register input#password").attr("placeholder", "Password *");
            $("form#register input#repeatPassword").attr("placeholder", "Repeat Password *");

            $("form#register input#firstname").attr('readonly', false);
            $("form#register input#lastname").attr('readonly', false);
            $("form#register input#email").attr('readonly', false);
            $("form#register input#contact").attr('readonly', false);
            $("form#register input#street").attr('readonly', false);
            $("form#register input#street2").attr('readonly', false);
            $("form#register input#postcode").attr('readonly', false);
            $("form#register input#city").attr('readonly', false);
            $("form#register select#state").attr('disabled', false);
            $("form#register select#country").attr('disabled', false);
            $("form#register input#password").attr('readonly', false);
            $("form#register input#repeatPassword").attr('readonly', false);
        });

        $("#submit").click(function(event){
            event.preventDefault();

            var firstname       = $("form#register input#firstname").val();
            var lastname        = $("form#register input#lastname").val();
            var email           = $("form#register input#email").val();
            var contact         = $("form#register input#contact").val();
            var street          = $("form#register input#street").val();
            var postcode        = $("form#register input#postcode").val();
            var city            = $("form#register input#city").val();
            var state           = $("form#register select#state").val();
            var country         = $("form#register select#country").val();
            var password        = $("form#register input#password").val();
            var repeatPassword  = $("form#register input#repeatPassword").val();
            var mode            = $("form#register input#mode").val();

            var flag = 0;

            if(firstname == ""){
                var flag = 1;
            }
            if(lastname == ""){
                var flag = 1;
            }
            if(email == ""){
                var flag = 1;
            }
            if(contact == ""){
                var flag = 1;
            }
            if(street == ""){
                var flag = 1;
            }
            if(postcode == ""){
                var flag = 1;
            }
            if(city == ""){
                var flag = 1;
            }
            if(state == ""){
                var flag = 1;
            }
            if(country == ""){
                var flag = 1;
            }
            if(mode != "2"){
                if(password == ""){
                    var flag = 1;
                }
                if(repeatPassword == ""){
                    var flag = 1;
                }
                if(password != repeatPassword){
                    $("form#register input#repeatPassword").css("border", "1px solid red");
                    alert("Please enter the same password");
                    flag = 2;

                }
            }else if(mode == "2"){
                if(password != "" && repeatPassword != ""){
                    if(password != repeatPassword){
                        $("form#register input#repeatPassword").css("border", "1px solid red");
                        alert("Please enter the same password");
                        flag = 2;

                    }
                }
            }

            if(flag == 0 && mode != "2"){

                $("form#register input#action").val("checkingEmail");

                var form_value = $('#register').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/userController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    success:function(data){
                        
                        console.log(data);
                        if(data == "0"){
                            save();
                        }
                        // cancel
                    },
                    error: function(msg) {
                    }
                });

            }else if(flag == 0 && mode == "2"){
                

                $("form#register input#action").val("editUser");

                var form_value = $('#register').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/userController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    success:function(data){

                        alert("Successfully edit staff.");
                        $("#cancel").click();
                        location.reload();
                        // cancel
                    },
                    error: function(msg) {
                    }
                });
            }else if(flag == 1){
                alert("Please insert the mandatory field");
            }
        });
    });

    function getCompanyDetail(){
        var form_value = $('#editCompany').serialize();

        jQuery.ajax({
            type : "post",
            url : "../../controller/userController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                var json = JSON.parse(data);
                console.log(json['country']);

                $("form#editCompany input#fullname").val(json['fullname']);
                $("form#editCompany input#email").val(json['email']);
                $("form#editCompany input#contact").val(json['contact']);
                $("form#editCompany input#street").val(json['street']);
                $("form#editCompany input#street2").val(json['street2']);
                $("form#editCompany input#postcode").val(json['postcode']);
                $("form#editCompany input#city").val(json['city']);
                $("form#editCompany select#country").val(json['country']).change();
                $("form#editCompany select#state").val(json['state']).change();

                $("form#editCompany input#fullname").attr('readonly', true);
                $("form#editCompany input#email").attr('readonly', true);
                $("form#editCompany input#contact").attr('readonly', true);
                $("form#editCompany input#street").attr('readonly', true);
                $("form#editCompany input#street2").attr('readonly', true);
                $("form#editCompany input#postcode").attr('readonly', true);
                $("form#editCompany input#city").attr('readonly', true);
                $("form#editCompany select#country").attr('disabled', 'disabled');
                $("form#editCompany select#state").attr('disabled', 'disabled');


            },
            error: function(msg) {
            }
        });
    }

    function editCompany(){
        $("form#editCompany input#fullname").attr('readonly', false);
        // $("form#editCompany input#email").attr('readonly', false);
        $("form#editCompany input#contact").attr('readonly', false);
        $("form#editCompany input#street").attr('readonly', false);
        $("form#editCompany input#street2").attr('readonly', false);
        $("form#editCompany input#postcode").attr('readonly', false);
        $("form#editCompany input#city").attr('readonly', false);
        $("form#editCompany select#country").attr('disabled', false);
        $("form#editCompany select#state").attr('disabled', false);

        $("#buttonEditComp").html('<button class="btn btn-primary" type="button" data-dismiss="modal" id="saveEdit" onclick="saveEditfunc()">Save</button>&nbsp;<button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancelEdit" onclick="cancelEditfunc()">Cancel</button>');

    }

    function saveEditfunc(){
        $("form#editCompany input#action").val("saveCompany");

        var form_value = $('#editCompany').serialize();
        console.log(form_value);

        jQuery.ajax({
            type : "post",
            url : "../../controller/userController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                if(data == "1"){
                    alert("Successfully edit company profile.");
                    // $("#cancel").click();
                    location.reload();
                    // cancel
                }else{

                }

            },
            error: function(msg) {
            }
        });

    }

    function cancelEditfunc(){

        $("form#editCompany input#fullname").attr('readonly', true);
        $("form#editCompany input#email").attr('readonly', true);
        $("form#editCompany input#contact").attr('readonly', true);
        $("form#editCompany input#street").attr('readonly', true);
        $("form#editCompany input#street2").attr('readonly', true);
        $("form#editCompany input#postcode").attr('readonly', true);
        $("form#editCompany input#city").attr('readonly', true);
        $("form#editCompany select#country").attr('disabled', 'disabled');
        $("form#editCompany select#state").attr('disabled', 'disabled');


        $("#buttonEditComp").html('<a href="#" class="btn btn-success bg-gradient-success btn-icon-split" onclick="editCompany()" data-toggle="modal" data-target="#editCompanyModal"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text">Edit Profile Company</span></a>');

    }

    function getUserDetail(value){

        $("div#buttonSave").hide();
        $("div#buttonEdit").show();
        $("#exampleModalLabel").html("Edit Staff");

        $("form#register input#password").attr("placeholder", "Password");
        $("form#register input#repeatPassword").attr("placeholder", "Repeat Password");

        var email = value.getAttribute('data-myval');

        $("form#register input#email").val(email);
        $("form#register input#action").val("getUserDetail");

        var form_value = $('#register').serialize();

        jQuery.ajax({
            type : "post",
            url : "../../controller/userController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                console.log(data);

                var json = JSON.parse(data);
                console.log(json['city']);
                $("form#register input#firstname").val(json['firstname']);
                $("form#register input#lastname").val(json['lastname']);
                $("form#register input#email").val(json['email']);
                $("form#register input#contact").val(json['contact']);
                $("form#register input#street").val(json['street']);
                $("form#register input#postcode").val(json['postcode']);
                $("form#register input#city").val(json['city']);
                $("form#register select#state").val(json['state']).change();
                $("form#register select#country").val(json['country']).change();
                $("form#register input#mode").val("2");

                $("form#register input#firstname").attr('readonly', true);
                $("form#register input#lastname").attr('readonly', true);
                $("form#register input#email").attr('readonly', true);
                $("form#register input#contact").attr('readonly', true);
                $("form#register input#street").attr('readonly', true);
                $("form#register input#street2").attr('readonly', true);
                $("form#register input#postcode").attr('readonly', true);
                $("form#register input#city").attr('readonly', true);
                $("form#register select#state").attr('disabled', 'disabled');
                $("form#register select#country").attr('disabled', 'disabled');
                $("form#register input#password").attr('readonly', true);
                $("form#register input#repeatPassword").attr('readonly', true);


            },
            error: function(msg) {
            }
        });
    }

    function save(){

        $("form#register input#action").val("saveUser");

        var form_value = $('#register').serialize();
        console.log(form_value);

        jQuery.ajax({
            type : "post",
            url : "../../controller/userController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                alert("Successfully add new staff.");
                $("#cancel").click();
                location.reload();
                // console.log(data);
                // cancel
            },
            error: function(msg) {
            }
        });
    }

    function close(){
        $("form#register input#firstname").val("");
        $("form#register input#lastname").val("");
        $("form#register input#email").val("");
        $("form#register input#contact").val("");
        $("form#register input#street").val("");
        $("form#register input#postcode").val("");
        $("form#register input#city").val("");
        $("form#register select#state").val("");
        $("form#register select#country").val("");
        $("form#register input#password").val("");
        $("form#register input#repeatPassword").val("");
    }
</script>