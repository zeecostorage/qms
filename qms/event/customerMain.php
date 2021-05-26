<?php 
    include '../../config/header.php'; 
    include '../../controller/waitingController.php';  
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
                                            <h2 class="m-0 font-weight-bold text-primary">My Booking List</h2>
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
                                                    <th>Company Name</th>
                                                    <th>Event Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $user_list = getWaitingCustomer($con);
                                                    $status = status();
                                                    $html = '<tr><td></td><td></td><td></td><td></td></tr>';
                                                    $i = 0;

                                                    foreach ($user_list as $value) {
                                                        if($i == 0){
                                                            $html =  '<tr>';
                                                            $html .=  '<td>'.$value['client_name'].'</td>';
                                                            $html .=  '<td>'.$value['event_name'].'</td>';
                                                            $html .=  '<td>'.date("d-m-Y",strtotime($value['waiting_date'])).'</td>';
                                                            $html .=  '<td>'.date('h.i A', strtotime($value['waiting_time'])).'</td>';
                                                            $html .=  '</tr>';
                                                        }else{
                                                            $html .=  '<tr>';
                                                            $html .=  '<td>'.$value['client_name'].'</td>';
                                                            $html .=  '<td>'.$value['event_name'].'</td>';
                                                            $html .=  '<td>'.date("d-m-Y",strtotime($value['waiting_date'])).'</td>';
                                                            $html .=  '<td>'.date('h.i A', strtotime($value['waiting_time'])).'</td>';
                                                            $html .=  '</tr>';
                                                        }
                                                        $i++;

                                                    }

                                                    echo $html;

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-3 col-md-12 mb-4">
                    </div>

                    <div class="row">
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
                                    <input type="hidden" name="appointment_id" id="appointment_id">
                                    <input type="hidden" name="wait_date" id="wait_date">
                                    <input type="hidden" name="time" id="time">
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
                                        <div id="dateBooking">
                                            
                                        </div>
                                        <br><br>
                                        <div id="timeBooking">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <input type="submit" id="submit" class="btn btn-primary" value="Book">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal" id="cancel">Cancel</button>
                                </form>
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

        $("form#formAppointment input#submit").click(function(event){
            event.preventDefault();

            var mode = $("form#formAppointment #mode").val();

            if(mode == "2"){
                console.log("edit");

                $("form#formAppointment input#action").val("saveWaiting");

                var form_value = $('#formAppointment').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/waitingController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    success:function(data){
                        // console.log(data);
                        alert("Successfully Booked An Appointment.");
                        $("#cancel").click();
                        location.reload();
                        // cancel
                    },
                    error: function(msg) {
                    }
                });
            }
        });
        
    });

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
            url : "../../controller/waitingController.php",
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
            url : "../../controller/waitingController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                console.log(data);

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
                html += '<td><a href="#" id="edit" data-toggle="modal" data-target="#modalAppointment" class="btn btn-primary btn-icon-split" onclick="editFormappointment(this)" data-myval="'+json[i]['appointment_id']+'" ><span class="text">Book</span></a></td>';
                html += '</tr>';

            }
        }

        $("#tableAppointment").html(html);
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
            url : "../../controller/waitingController.php",
            data : form_value,
            // dataType : 'json',
            // async: false,
            success:function(data){

                var json = JSON.parse(data);

                $("form#formAppointment input#id").val(json[0]['id']);
                $("form#formAppointment input#name").val(json[0]['name']);
                $("form#formAppointment textarea#description").val(json[0]['description']);
                $("form#formAppointment select#status").val(json[0]['status']).change();
                $("form#formAppointment input#appointment_id").val(id);

                var html = "";

                var dateObj1 =  new Date(json[1]['start_date']);
                var dateObj2 =  new Date(json[1]['end_date']);

                while ( dateObj1.getTime() <= dateObj2.getTime() )
                {
                    for(var i = 2; i < json.length; i++){
                        if(json[i]['day'] == dateObj1.getDay()){
                            html += "<button id='book' class='btn btn-success mb-2' type='button' onclick='getTime("+json[i]['start_time']+",\""+dateObj1.getDate()+"-"+(parseInt(dateObj1.getMonth())+1)+"-"+dateObj1.getFullYear()+"\")'>"+dateObj1.getDate()+"-"+(parseInt(dateObj1.getMonth())+1)+"-"+dateObj1.getFullYear()+" ("+getDay(json[i]['day'])+")</button>&nbsp;";
                        }
                    }

                   dateObj1.setDate(dateObj1.getDate() + 1);
                }

                $("#dateBooking").html(html);
                $("form#formAppointment input#mode").val("2");

                $("form#formAppointment input#name").attr('readonly', true);
                $("form#formAppointment textarea#description").attr('readonly', true);
                $("form#formAppointment select#status").attr('disabled', 'disabled');

            },
            error: function(msg) {
            }
        });
    }

    function getTime(time,date){
        console.log(date);

        $("form#formAppointment input#wait_date").val(date);

        html = "";
        if(time == "1"){
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"08:00:00\")'>8.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"08:15:00\")'>8.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"08:30:00\")'>8.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"08:45:00\")'>8.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:00:00\")'>9.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:15:00\")'>9.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:30:00\")'>9.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:45:00\")'>9.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:00:00\")'>10.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:15:00\")'>10.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:30:00\")'>10.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:45:00\")'>10.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:00:00\")'>11.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:15:00\")'>11.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:30:00\")'>11.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:45:00\")'>11.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:00:00\")'>12.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:15:00\")'>12.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:30:00\")'>12.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:45:00\")'>12.45 PM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:00:00\")'>1.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:15:00\")'>1.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:30:00\")'>1.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:45:00\")'>1.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:00:00\")'>2.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:15:00\")'>2.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:30:00\")'>2.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:45:00\")'>2.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:00:00\")'>3.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:15:00\")'>3.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:30:00\")'>3.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:45:00\")'>3.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:00:00\")'>4.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:15:00\")'>4.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:30:00\")'>4.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:45:00\")'>4.45 PM</button>&nbsp;";
        }

        if(time == "2"){
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:00:00\")'>9.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:15:00\")'>9.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:30:00\")'>9.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"09:45:00\")'>9.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:00:00\")'>10.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:15:00\")'>10.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:30:00\")'>10.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:45:00\")'>10.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:00:00\")'>11.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:15:00\")'>11.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:30:00\")'>11.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:45:00\")'>11.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:00:00\")'>12.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:15:00\")'>12.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:30:00\")'>12.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:45:00\")'>12.45 PM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:00:00\")'>1.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:15:00\")'>1.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:30:00\")'>1.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:45:00\")'>1.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:00:00\")'>2.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:15:00\")'>2.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:30:00\")'>2.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:45:00\")'>2.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:00:00\")'>3.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:15:00\")'>3.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:30:00\")'>3.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:45:00\")'>3.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:00:00\")'>4.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:15:00\")'>4.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:30:00\")'>4.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:45:00\")'>4.45 PM</button>&nbsp;";
        }

        if(time == "3"){
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:00:00\")'>10.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:15:00\")'>10.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:30:00\")'>10.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"10:45:00\")'>10.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:00:00\")'>11.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:15:00\")'>11.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:30:00\")'>11.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:45:00\")'>11.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:00:00\")'>12.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:15:00\")'>12.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:30:00\")'>12.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:45:00\")'>12.45 PM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:00:00\")'>1.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:15:00\")'>1.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:30:00\")'>1.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:45:00\")'>1.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:00:00\")'>2.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:15:00\")'>2.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:30:00\")'>2.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:45:00\")'>2.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:00:00\")'>3.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:15:00\")'>3.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:30:00\")'>3.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:45:00\")'>3.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:00:00\")'>4.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:15:00\")'>4.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:30:00\")'>4.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:45:00\")'>4.45 PM</button>&nbsp;";
        }

        if(time == "4"){
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:00:00\")'>11.00 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:15:00\")'>11.15 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:30:00\")'>11.30 AM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"11:45:00\")'>11.45 AM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:00:00\")'>12.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:15:00\")'>12.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:30:00\")'>12.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:45:00\")'>12.45 PM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:00:00\")'>1.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:15:00\")'>1.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:30:00\")'>1.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:45:00\")'>1.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:00:00\")'>2.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:15:00\")'>2.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:30:00\")'>2.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:45:00\")'>2.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:00:00\")'>3.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:15:00\")'>3.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:30:00\")'>3.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:45:00\")'>3.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:00:00\")'>4.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:15:00\")'>4.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:30:00\")'>4.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:45:00\")'>4.45 PM</button>&nbsp;";
        }

        if(time == "5"){
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:00:00\")'>12.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:15:00\")'>12.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:30:00\")'>12.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"12:45:00\")'>12.45 PM</button>&nbsp;";

            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:00:00\")'>1.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:15:00\")'>1.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:30:00\")'>1.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:45:00\")'>1.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:00:00\")'>2.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:15:00\")'>2.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:30:00\")'>2.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:45:00\")'>2.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:00:00\")'>3.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:15:00\")'>3.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:30:00\")'>3.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:45:00\")'>3.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:00:00\")'>4.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:15:00\")'>4.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:30:00\")'>4.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:45:00\")'>4.45 PM</button>&nbsp;";
        }

        if(time == "6"){
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:00:00\")'>1.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:15:00\")'>1.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:30:00\")'>1.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"13:45:00\")'>1.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:00:00\")'>2.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:15:00\")'>2.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:30:00\")'>2.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"14:45:00\")'>2.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:00:00\")'>3.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:15:00\")'>3.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:30:00\")'>3.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"15:45:00\")'>3.45 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:00:00\")'>4.00 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:15:00\")'>4.15 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:30:00\")'>4.30 PM</button>&nbsp;";
            html += "<button class='btn btn-success mb-2' type='button' onclick='setTime(\"16:45:00\")'>4.45 PM</button>&nbsp;";
        }

        $("#timeBooking").html(html);
        $("#timeBooking").show();
    }

    function setTime(time){
        $("form#formAppointment input#time").val(time);
    }

    function getDay(day){
        if(day == "1"){
            return "Monday";
        }
        if(day == "2"){
            return "Tuesday";
        }
        if(day == "3"){
            return "Wednesday";
        }
        if(day == "4"){
            return "Thursday";
        }
        if(day == "5"){
            return "Friday";
        }
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