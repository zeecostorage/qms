<?php 
    include '../../config/header.php'; 
    include '../../controller/counterController.php';  
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

        div#divAppointment{
            display: none;
        }

        div#addButtonAppointment{
            display: none;
        }
        div#fieldStatusSave{
            display: none;
        }
        div#fieldStatusEdit{
            display: none;
        }
        div#listCustomer{
            display: none;
        }
        div#listAllEvent{
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
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="m-0 font-weight-bold text-primary">Staff Detail</h2>
                                        </div>
                                        <!-- <div class="col-lg-6" style="text-align: right">  
                                            <a href="#" id="formStaffButton" class="btn btn-success bg-gradient-success btn-icon-split" onclick="addForm()" data-toggle="modal" data-target="#formStaff">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Event</span>
                                            </a>
                                        </div> -->
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <form id="formEvent" method="POST">
	                                    <input type="hidden" name="action" id="action">
	                                    <input type="hidden" name="mode" id="mode" value="1">
	                                    <input type="hidden" name="id" id="id">
	                                    <div class="form-group">
	                                        <label for="name">Name</label>
	                                        <input type="text" class="form-control form-control-user" id="name" name="name" value="<?php echo getStaffDetail($con);?>" 
	                                            placeholder="Name *" readonly>
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="description">Counter Number</label>
	                                        <input type="text" class="form-control form-control-user" id="counter_no" name="counter_no"
	                                            placeholder="Counter Number *" required>
	                                    </div>
	                                    <br>
	                                    <div id="buttonLogin">
	                                        <button class="btn btn-primary" type="button" id="buttonLogin">Login</button>
	                                    </div>
	                                </form>
                                </div>
                            </div>
                        <div class="col-xl-3 col-md-12 mb-4">
                    </div>

                    <div class="row" id="listAllEvent">


                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="m-0 font-weight-bold text-primary">Event</h2>
                                        </div>
                                        <!-- <div class="col-lg-6" style="text-align: right">  
                                            <a href="#" id="formStaffButton" class="btn btn-success bg-gradient-success btn-icon-split" onclick="addForm()" data-toggle="modal" data-target="#formStaff">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Event</span>
                                            </a>
                                        </div> -->
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Status</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $user_list = getEventCustomer($con);
                                                    $status = status();


                                                    foreach ($user_list as $value) {
                                                        echo '<tr>';
                                                        echo '<td><a href="#" id="edit" data-toggle="modal" data-target="#formStaff" onclick="editForm(this)" data-myval="'.$value['id'].'">'.$value['name'].'</a></td>';
                                                        echo '<td>'.date("d-m-Y",strtotime($value['start_date'])).'</td>';
                                                        echo '<td>'.date("d-m-Y",strtotime($value['end_date'])).'</td>';

                                                        foreach($status as $key) {
                                                            if($key['id'] == $value['status']){
                                                                echo '<td>'.$key['name'].'</td>';
                                                            }
                                                        }
                                                        echo '<td>
                                                                <a href="#" id="appointment" class="btn btn-primary btn-icon-split" onclick="listAppointment(this)" data-myval="'.$value['id'].'" >
                                                                    <span class="text">Appointment</span>
                                                                </a>
                                                            </td>';
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

                    <div class="row" id="divAppointment">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h2 class="m-0 font-weight-bold text-primary">Appointment</h2>
                                            <h5 class="m-0 font-weight-bold text-primary">Event - <span id="eventTitle"></span></h5>
                                        </div>
                                        <!-- <div id="addButtonAppointment" class="col-lg-4" style="text-align: right">  
                                            <a href="#" id="addButtonAppointment" class="btn btn-success bg-gradient-success btn-icon-split" onclick="addFormappointment()" data-toggle="modal" data-target="#modalAppointment">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Appointment</span>
                                            </a>
                                        </div> -->
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableAppointment">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-3 col-md-12 mb-4">
                    </div>
                    <div class="row" id="listCustomer">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="m-0 font-weight-bold text-primary">List Customer</h2>
                                        </div>
                                        <!-- <div class="col-lg-6" style="text-align: right">  
                                            <a href="#" id="formStaffButton" class="btn btn-success bg-gradient-success btn-icon-split" onclick="addForm()" data-toggle="modal" data-target="#formStaff">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                <span class="text">Add New Event</span>
                                            </a>
                                        </div> -->
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody id="customerList">
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

    <!-- Event Modal-->
    <div class="modal fade" id="formStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px !important;">
            <div class="modal-content">
                <div class="modal-header bg-primary text-gray-100">
                    <h5 class="modal-title" id="formModalTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-gray-100">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card o-hidden border-0 ">
                            <div class="card-body p-0">
                                <form id="formEvent" method="POST">
                                    <input type="hidden" name="action" id="action">
                                    <input type="hidden" name="mode" id="mode" value="1">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Name *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control form-control-user" id="description" name="description"
                                            placeholder="Description" required></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control form-control-user" id="start_date" name="start_date"
                                                placeholder="Start Date *" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="end_date">End Date</label>
                                            <input type="date" class="form-control form-control-user" id="end_date" name="end_date"
                                                placeholder="End Number *" required>
                                        </div>
                                    </div>
                                    <div id="fieldStatusSave" class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control  form-control-user" id="status" name="status" aria-label="Default select example" required>

                                            <?php
                                                
                                                $status = status();
                                                echo '<option value="'.$status[2]['id'].'">'.$status[2]['name'].'</option>';   

                                            ?>
                                        </select>
                                    </div>

                                    <div id="fieldStatusEdit" class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control  form-control-user" id="status" name="status" aria-label="Default select example" required>

                                            <?php
                                                
                                                $status = status();

                                                foreach($status as $value) {
                                                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div id="buttonSave">
                                        <input type="submit" id="submit" class="btn btn-primary" value="Save">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancel">Cancel</button>
                                    </div>
                                    <div id="buttonEdit">
                                        <!-- <input type="button" id="edit" class="btn btn-primary" value="Edit"> -->
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

    <!-- Appointment Modal-->
    <div class="modal fade" id="modalAppointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 800px !important;">
            <div class="modal-content">
                <div class="modal-header bg-primary text-gray-100">
                    <h5 class="modal-title" id="formModalAppointmentTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-gray-100">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="card o-hidden border-0 ">
                            <div class="card-body p-0">
                                <form id="formAppointment" method="POST">
                                    <input type="hidden" name="action" id="action">
                                    <input type="hidden" name="mode" id="mode" value="1">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="event_id" id="event_id">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            placeholder="Name *" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control form-control-user" id="description" name="description"
                                            placeholder="Description" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control  form-control-user" id="status" name="status" aria-label="Default select example" required>
                                          <option value="" selected>Status *</option>

                                            <?php
                                                
                                                $status = status();

                                                foreach($status as $value) {
                                                    echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                }

                                            ?>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="schedule">[ Booking ]</label>
                                        <br>
                                        <button class="btn btn-success" type="button" id="book">10-05-2021</button>&nbsp;
                                        <button class="btn btn-success" type="button">12-05-2021</button>&nbsp;
                                        <button class="btn btn-success" type="button">17-05-2021</button>
                                        <br><br>
                                        <div id="timeBooking">
                                            <button class="btn btn-success" type="button">1:00 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">1:15 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">1:30 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">1:45 PM</button><br><br>
                                            <button class="btn btn-success" type="button">2:00 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">2:15 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">2:30 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">2:45 PM</button><br><br>
                                            <button class="btn btn-success" type="button">3:00 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">3:15 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">3:30 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">3:45 PM</button><br><br>
                                            <button class="btn btn-success" type="button">4:00 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">4:15 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">4:30 PM</button>&nbsp;
                                            <button class="btn btn-success" type="button">4:45 PM</button><br>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div id="buttonSave">
                                        <input type="submit" id="submit" class="btn btn-primary" value="Save">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancel">Cancel</button>
                                    </div>
                                    <div id="buttonEdit">
                                        <input type="button" id="edit" class="btn btn-primary" value="Book">
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
    	$("#buttonLogin").click(function(event){
            event.preventDefault();

            var counter_no = $("input#counter_no").val();
            if(counter_no == ""){
            	alert("Please Enter Counter Number");
            }else{

	            $("#listAllEvent").show();
	            counter_no

	            $("input#counter_no").attr('readonly', true);
            }
    	});

    	
        $("#timeBooking").hide();
        $("#book").css("background-color","#1cc88a");
            $("#book").css("border-color","#1cc88a");

        $("#book").click(function(event){
            event.preventDefault();

            $("#book").css("background-color","#2e59d9");
            $("#book").css("border-color","#2e59d9");
            $("#timeBooking").show();
        });

        $("#formEvent button#cancel").click(function(event){
            event.preventDefault();

            close();
        });

        $("div#formStaff button.close").click(function(event){
            event.preventDefault();

            close();
        });

        $("form#formEvent input#edit").click(function(event){
            event.preventDefault();
            $("form#formEvent div#buttonSave").show();
            $("form#formEvent div#buttonEdit").hide();

            $("form#formEvent input#name").attr('readonly', false);
            $("form#formEvent textarea#description").attr('readonly', false);
            $("form#formEvent input#start_date").attr('readonly', false);
            $("form#formEvent input#end_date").attr('readonly', false);
            $("form#formEvent select#status").attr('disabled', false);
        });


        $("form#formAppointment input#edit").click(function(event){
            event.preventDefault();
            $("form#formAppointment div#buttonSave").show();
            $("form#formAppointment div#buttonEdit").hide();

            $("form#formAppointment input#name").attr('readonly', false);
            $("form#formAppointment textarea#description").attr('readonly', false);
            $("form#formAppointment select#status").attr('disabled', false);
            $("form#formAppointment select#timeMonday").attr('disabled', false);
            $("form#formAppointment select#timeTuesday").attr('disabled', false);
            $("form#formAppointment select#timeWednesday").attr('disabled', false);
            $("form#formAppointment select#timeThursday").attr('disabled', false);
            $("form#formAppointment select#timeFriday").attr('disabled', false);
        });

        $("form#formEvent input#submit").click(function(event){
            event.preventDefault();

            var name        = $("form#formEvent input#name").val();
            var description = $("form#formEvent textarea#description").val();
            var start_date  = $("form#formEvent input#start_date").val();
            var end_date    = $("form#formEvent input#end_date").val();
            var status      = $("form#formEvent select#status").val();
            var mode        = $("form#formEvent input#mode").val();

            var flag = 0;

            if(name == ""){
                var flag = 1;
            }
            if(start_date == ""){
                var flag = 1;
            }
            if(end_date == ""){
                var flag = 1;
            }
            if(status == ""){
                var flag = 1;
            }
            if(flag == 0 && mode != "2"){
                console.log("save");
                $("form#formEvent input#action").val("saveEvent");

                var form_value = $('#formEvent').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/eventController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    success:function(data){

                        alert("Successfully save appointment.");
                        $("#cancel").click();
                        location.reload();
                        // cancel
                    },
                    error: function(msg) {
                    }
                });

            }else if(flag == 0 && mode == "2"){
                console.log("edit");

                $("form#formEvent input#action").val("editEvent");

                var form_value = $('#formEvent').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/eventController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    success:function(data){

                        alert("Successfully edit appointment.");
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
        
        $("form#formAppointment input#submit").click(function(event){
            event.preventDefault();

            var name            = $("form#formAppointment input#name").val();
            var status          = $("form#formAppointment select#status").val();
            var mode            = $("form#formAppointment input#mode").val();

            var flag = 0;

            if(name == ""){
                var flag = 1;
            }
            if(status == ""){
                var flag = 1;
            }
            if(flag == 0 && mode != "2"){
                console.log("save");
                $("form#formAppointment input#action").val("saveAppointment");

                var form_value = $('#formAppointment').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/eventController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    success:function(data){

                        alert("Successfully save appointment.");
                        $("#cancel").click();
                        location.reload();
                        // cancel
                    },
                    error: function(msg) {
                    }
                });

            }else if(flag == 0 && mode == "2"){
                console.log("edit");

                $("form#formAppointment input#action").val("editAppointment");

                var form_value = $('#formAppointment').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/eventController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    success:function(data){

                        alert("Successfully edit appointment.");
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

    function addForm(){
        $("#formModalTitle").html("Add New Event");

        $("div#buttonSave").show();
        $("div#buttonEdit").hide();


        $("div#fieldStatusSave").show();
        $("div#fieldStatusEdit").hide();   
    }

    function editForm(value){
        $("form#formEvent #buttonSave").hide();
        $("form#formEvent #buttonEdit").show();

        $("div#fieldStatusSave").hide();
        $("div#fieldStatusEdit").show();


        $("#formModalTitle").html("Edit Event");

        var id = value.getAttribute('data-myval');

        $("form#formEvent input#action").val("getEventDetail");
        $("form#formEvent input#id").val(id);

        var form_value = $('#formEvent').serialize();

        jQuery.ajax({
            type : "post",
            url : "../../controller/eventController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                var json = JSON.parse(data);

                $("form#formEvent input#name").val(json['name']);
                $("form#formEvent textarea#description").val(json['description']);
                $("form#formEvent input#start_date").val(json['start_date']);
                $("form#formEvent input#end_date").val(json['start_date']);
                $("form#formEvent select#status").val(json['status']).change();
                $("form#formEvent input#mode").val("2");

                $("form#formEvent input#name").attr('readonly', true);
                $("form#formEvent textarea#description").attr('readonly', true);
                $("form#formEvent input#start_date").attr('readonly', true);
                $("form#formEvent input#end_date").attr('readonly', true);
                $("form#formEvent select#status").attr('disabled', 'disabled');


            },
            error: function(msg) {
            }
        });
    }

    function listAppointment(value){
        $("div#divAppointment").show();

        var event_id = value.getAttribute('data-myval');

        $("form#formAppointment input#action").val("getAppointmentCustomer");
        $("form#formAppointment input#event_id").val(event_id);

        var form_value = $('#formAppointment').serialize();

        jQuery.ajax({
            type : "post",
            url : "../../controller/eventController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                // console.log(data);

                tableAppointment(data);

            },
            error: function(msg) {
            }
        });
    }

    function tableAppointment(data){

        var json = JSON.parse(data);

        $("#eventTitle").html(json[0]['event_name']);

        if(json[0]['event_status'] == "1"){
            $("div#addButtonAppointment").show();
            $("form#formAppointment input#edit").show();
        }else{
            $("div#addButtonAppointment").hide();
            $("form#formAppointment input#edit").hide();
        }

        // console.log(json);

        var html = "";

        for(var i = 0; i < json.length; i++){

            if(data == "null" || (json[i]['appointment_id'] == null || json[i]['appointment_name'] == null || json[i]['appointment_desc'] == null || json[i]['appointment_status'] == null)){
                html += "<tr><td colspan='3' style='text-align:center'>No record</td></tr>";
            }else{
                
                html += '<tr>';
                html += '<td>'+json[i]['appointment_name']+'</td>';
                html += '<td>'+json[i]['appointment_desc']+'</td>';
                html += '<td>'+json[i]['appointment_status']+'</td>';
                html += '<td><a href="#" id="edit"  class="btn btn-primary btn-icon-split" onclick="listCustomer(this)" data-myval="'+json[i]['appointment_id']+'" ><span class="text">Waiting List</span></a></td>';
                html += '</tr>';

            }
        }

        $("#tableAppointment").html(html);
    }

    function addFormappointment(){
        $("#formModalAppointmentTitle").html("Add New Appointment");

        $("div#buttonSave").show();
        $("div#buttonEdit").hide();
    }

    function editFormappointment(value){
        $("form#formAppointment #buttonSave").hide();
        $("form#formAppointment #buttonEdit").show();

        $("#formModalAppointmentTitle").html("Book an Appointment");

        var id = value.getAttribute('data-myval');

        $("form#formAppointment input#action").val("getAppointmentForBooking");
        $("form#formAppointment input#id").val(id);

        var form_value = $('#formAppointment').serialize();

        jQuery.ajax({
            type : "post",
            url : "../../controller/eventController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                var json = JSON.parse(data);

                console.log(data);

                $("form#formAppointment input#id").val(json[0]['id']);
                $("form#formAppointment input#name").val(json[0]['name']);
                $("form#formAppointment textarea#description").val(json[0]['description']);
                $("form#formAppointment select#status").val(json[0]['status']).change();

                for(var i = 2; i < json.length; i++){
                    if(json[i]['day'] == "1"){
                        $("form#formAppointment select#timeMonday").val(json[i]['start_time']).change();
                    }
                    if(json[i]['day'] == "2"){
                        $("form#formAppointment select#timeTuesday").val(json[i]['start_time']).change();
                    }
                    if(json[i]['day'] == "3"){
                        $("form#formAppointment select#timeWednesday").val(json[i]['start_time']).change();
                    }
                    if(json[i]['day'] == "4"){
                        $("form#formAppointment select#timeThursday").val(json[i]['start_time']).change();
                    }
                    if(json[i]['day'] == "5"){
                        $("form#formAppointment select#timeFriday").val(json[i]['start_time']).change();
                    }
                }

                $("form#formAppointment input#mode").val("2");

                $("form#formAppointment input#name").attr('readonly', true);
                $("form#formAppointment textarea#description").attr('readonly', true);
                $("form#formAppointment select#status").attr('disabled', 'disabled');

            },
            error: function(msg) {
            }
        });
    }

    function listCustomer(value){
        $("#listCustomer").show();

        var id = value.getAttribute('data-myval');

        $("form#formAppointment input#action").val("getListCustomer");
        $("form#formAppointment input#id").val(id);

        var form_value = $('#formAppointment').serialize();

        jQuery.ajax({
            type : "post",
            url : "../../controller/counterController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                var json = JSON.parse(data);
                console.log(data);

                

                var html = "";

                for(var i = 0; i < json.length; i++){
                	html += "<tr>";
                	html += "<td>"+json[i]["waiting_name"];
                	html += "</td>";
                	html += "<td>"+json[i]["waiting_date"];
                	html += "</td>";
                	html += "<td>"+json[i]["waiting_time"];
                	html += "</td>";
                	html += "<td>";

                                html += '<a href="#" id="appointment" class="btn btn-success btn-icon-split" onclick="listAppointment(this)" data-myval="" >';
                                    html += '<span class="text">Start</span>';
                                html += '</a>';
                                html += '&nbsp;';
                                html += '<a href="#" id="appointment" class="btn btn-warning btn-icon-split" onclick="listAppointment(this)" data-myval="" >';
                                    html += '<span class="text">End</span>';
                                html += '</a>';

                	html += "</td>";
                	html += "</tr>";
                }

               	$("#customerList").html(html);

            },
            error: function(msg) {
            }
        });
    }

    function close(){
        $("form#formEvent input#name").val("");
        $("form#formEvent textarea#description").val("");
        $("form#formEvent input#start_date").val("");
        $("form#formEvent input#end_date").val("");
        $("form#formEvent select#status").val("");

        $("form#formEvent input#name").attr('readonly', false);
        $("form#formEvent textarea#description").attr('readonly', false);
        $("form#formEvent input#start_date").attr('readonly', false);
        $("form#formEvent input#end_date").attr('readonly', false);
        $("form#formEvent select#status").attr('disabled', false);
    }

</script>