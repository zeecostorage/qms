<?php 
    include '../../config/database.php';
    include '../../config/header.php'; 
    include '../../controller/dashboardController.php'; 
    
    $data_card = json_decode(getCardData($con));

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Event</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_card[0]->total_event?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Event Active</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_card[1]->total_event?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Event Inactive</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_card[2]->total_event?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-window-close fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Event Pending</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_card[3]->total_event?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="m-0 font-weight-bold text-primary">List Event Pending</h2>
                                        </div>
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
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    $event_list = getEventPending($con);

                                                    foreach ($event_list as $value) {
                                                        echo '<tr>';
                                                        echo '<td>'.$value['name'].'</td>';
                                                        echo '<td>'.date("d-m-Y",strtotime($value['start_date'])).'</td>';
                                                        echo '<td>'.date("d-m-Y",strtotime($value['end_date'])).'</td>';
                                                        echo '<td>
                                                                <a href="#" id="edit" data-toggle="modal" data-target="#formStaff"  class="btn btn-primary btn-icon-split" onclick="editForm(this)" data-myval="'.$value['id'].'" >
                                                                    <span class="text">Action</span>
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
                        <div class="col-xl-12 col-md-12 mb-4">
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Queue Management System 2021. Powered by zeecostorage.</span>
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
                                        <select class="form-control  form-control-user" id="status" name="statusEdit" aria-label="Default select example" required>

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
                    <a class="btn btn-primary" href="../staff/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div> -->

</body>

<?php include '../../config/footer.php'; ?>


<script type="text/javascript">
    $( document ).ready(function() {
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

        $("form#formEvent input#submit").click(function(event){
            event.preventDefault();

            var name        = $("form#formEvent input#name").val();
            var description = $("form#formEvent textarea#description").val();
            var start_date  = $("form#formEvent input#start_date").val();
            var end_date    = $("form#formEvent input#end_date").val();
            var status      = $("form#formEvent select#statusEdit").val();
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
            url : "../../controller/dashboardController.php",
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