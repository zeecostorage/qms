<?php 
    include '../../config/header.php'; 
    include '../../controller/userController.php';  
    include '../../config/lkp.php'; 

?>
    
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

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
                                            <input type="text" class="form-control form-control-user" id="firstname" name="firstname"
                                                placeholder="First Name *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="lastname" name="lastname"
                                                placeholder="Last Name *" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control form-control-user" id="email" name="email"
                                                placeholder="Email Address *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="contact" name="contact"
                                                placeholder="Contact Number *" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="street" name="street"
                                                placeholder="Street *" required>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="street2" name="street2"
                                                placeholder="Street">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="postcode" name="postcode"
                                                placeholder="Postcode *">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="city" name="city"
                                                placeholder="City *" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
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
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Password *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password *" required>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="submit" id="submit" class="btn btn-primary" value="Save">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancel">Cancel</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
    </div>

</body>

<?php include '../../config/footer.php'; ?>

<script type="text/javascript">
    $( document ).ready(function() {

        $("#cancel").click(function(){
            close();
        });

        $("button.close").click(function(){
            close();
        });

        $("#formStaffButton").click(function(){
            $("#exampleModalLabel").html("Add New Staff");
            $("#password").attr("placeholder", "Password *");
            $("#repeatPassword").attr("placeholder", "Repeat Password *");
        });

        $("#submit").click(function(event){
            event.preventDefault();

            var firstname       = $("#firstname").val();
            var lastname        = $("#lastname").val();
            var email           = $("#email").val();
            var contact         = $("#contact").val();
            var street          = $("#street").val();
            var postcode        = $("#postcode").val();
            var city            = $("#city").val();
            var state           = $("#state").val();
            var country         = $("#country").val();
            var password        = $("#password").val();
            var repeatPassword  = $("#repeatPassword").val();
            var mode            = $("#mode").val();

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
                    $("#repeatPassword").css("border", "1px solid red");
                    alert("Please enter the same password");
                    flag = 2;

                }
            }else if(mode == "2"){
                if(password != "" && repeatPassword != ""){
                    if(password != repeatPassword){
                        $("#repeatPassword").css("border", "1px solid red");
                        alert("Please enter the same password");
                        flag = 2;

                    }
                }
            }

            if(flag == 0 && mode != "2"){

                $("#action").val("checkingEmail");

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
                

                $("#action").val("editUser");

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

    function getUserDetail(value){

        $("#exampleModalLabel").html("Edit Staff");
        $("#password").attr("placeholder", "Password");
        $("#repeatPassword").attr("placeholder", "Repeat Password");

        var email = value.getAttribute('data-myval');

        $("#email").val(email);
        $("#action").val("getUserDetail");

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
                $("#firstname").val(json['firstname']);
                $("#lastname").val(json['lastname']);
                $("#email").val(json['email']);
                $("#contact").val(json['contact']);
                $("#street").val(json['street']);
                $("#postcode").val(json['postcode']);
                $("#city").val(json['city']);
                $("#state").val(json['state']).change();
                $("#country").val(json['country']).change();
                $("#mode").val("2");

                $("#email").attr('readonly', true);


            },
            error: function(msg) {
            }
        });
    }

    function save(){

        $("#action").val("saveUser");

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
        $("#firstname").val("");
        $("#lastname").val("");
        $("#email").val("");
        $("#contact").val("");
        $("#street").val("");
        $("#postcode").val("");
        $("#city").val("");
        $("#state").val("");
        $("#country").val("");
        $("#password").val("");
        $("#repeatPassword").val("");
    }
</script>