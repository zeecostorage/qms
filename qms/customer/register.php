<?php 
    include '../../config/header.php'; 
    include '../../config/lkp.php'; 

?>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image-customer"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" id="register" action="add.php" method="POST">
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
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address *" required>
                                </div>
                                <div class="form-group ">
                                    <input type="text" class="form-control form-control-user" id="street" name="street"
                                        placeholder="Street *" required>
                                </div>
                                <div class="form-group ">
                                    <input type="text" class="form-control form-control-user" id="street2" name="street2"
                                        placeholder="Street">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="postcode" name="postcode"
                                            placeholder="Postcode *" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="city" name="city"
                                            placeholder="City *" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" id="state" name="state" aria-label="Default select example" style="border-radius: 10rem;" required>
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
                                        <select class="form-control" id="country" name="country" aria-label="Default select example" style="border-radius: 10rem;" required>
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
                                        <input type="text" class="form-control form-control-user" id="contact" name="contact"
                                            placeholder="Contact Number *" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="company" name="company" aria-label="Default select example" style="border-radius: 10rem;" required>
                                          <option selected>Company *</option>
                                          
                                            <?php
                                                
                                                $client = getClient($con);

                                                foreach($client as $value) {
                                                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password *" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="repeatPassword" name="repeatPassword" placeholder="Repeat Password *" required>
                                    </div>
                                </div>
                                <input type="submit" id="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="../customer/login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

<?php include '../../config/footer.php'; ?>

<script type="text/javascript">
    $( document ).ready(function() {

        $("#submit").click(function(){
            var password = $("#password").val(); 
            var repeatPassword = $("#repeatPassword").val(); 

            if(password != repeatPassword){
                alert("Please enter the same password");
            }else{
                $( "#register" ).submit();
            }
        });

        $("#repeatPassword").keyup(function(){
            var password = $("#password").val(); 

            console.log(password);
            console.log(this.value);

            if(password != this.value){
                $("#repeatPassword").css("border", "1px solid red");
            }else{
                $("#repeatPassword").css("border", "1px solid #d1d3e2");
            }
        });
    });
</script>