<?php 
    include '../../config/header.php'; 
    include '../../controller/reportController.php';  
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
        #divReport{
            display: none;
        }
        @media print {
            @page {
            /*size: A4 portrait;*/
                margin: 0; 
            }

            ul#accordionSidebar{
                display: none;
            }

            nav.navbar{
                display: none;
            }
            div#hideDiv{
                display: none;
            }
            div#divReport{
                display: block;
            }
            button#printButton{
                display: none;
            }
            footer.sticky-footer{
                display: none;
            }
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
                    <div class="row"  id="hideDiv">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h2 class="m-0 font-weight-bold text-primary">Report</h2>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="card-body">
                                    <form id="formReport" method="POST">
                                        <input type="hidden" name="action" id="action" value="getData">
                                        <input type="hidden" name="mode" id="mode" value="1">
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="h_month" id="h_month">
                                        <input type="hidden" name="h_year" id="h_year">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <select class="form-control  form-control-user" id="year" name="year" aria-label="Default select example" required>
                                                <option value="" selected>Year *</option>

                                                <?php
                                                    
                                                    $getYear = getYear();

                                                    foreach($getYear as $value) {
                                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Month</label>
                                            <select class="form-control  form-control-user" id="month" name="month" aria-label="Default select example" required>
                                                <option value="" selected>month *</option>

                                                <?php
                                                    
                                                    $getMonth = getMonth();

                                                    foreach($getMonth as $value) {
                                                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                        <br>
                                        <div id="buttonLogin">
                                            <button class="btn btn-primary" type="button" id="generateReport">Generate Report</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="divReport">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h4>Queue Management Report</h4><br>
                                    <div class="table-responsive" id="tableContent">
                                    </div>
                                    <button class="btn btn-success" type="button" id="printButton">Print</button>
                                </div>
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

</body>

<?php include '../../config/footer.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {

        $("#printButton").click(function(event){
            event.preventDefault();

            print_borang();
        });

        $("#generateReport").click(function(event){
            event.preventDefault();

            var flag = 0;

            var val_month = $("#month").val();
            var val_year = $("#year").val();

            console.log(val_month);
            console.log(val_year);

            if(val_month == ""){
                flag = 1;
            }
            if(val_year == ""){
                flag = 1;
            }

            if(flag == 0){

                $("#h_month").val(val_month);
                $("#h_year").val(val_year);

                var form_value = $('#formReport').serialize();
                console.log(form_value);

                jQuery.ajax({
                    type : "post",
                    url : "../../controller/reportController.php",
                    data : form_value,
                    // dataType : 'json',
                    // async: false,
                    beforeSend: function() {
                        block("content");
                    },
                    success:function(data){
                        console.log(data);
                        if(data != ""){
                            tableContent(data);
                        }else{
                            $("#tableContent").html("No Record Found");
                        }

                        unblock("content");
                        $("#divReport").show();
                        // print_borang();
                    },
                    error: function(msg) {
                    }
                });
            }else{
                alert("Please insert the mandatory field");
            }
        });    
    });

    function tableContent(data){
        var arr = JSON.parse(data);

        console.log(arr[0]);

        var html = "";

        for(var i = 0; i < arr[0].length; i++){

                html += "<b>"+arr[0][i]["event_name"]+" ("+convertDate(arr[0][i]["start_date"])+" - "+convertDate(arr[0][i]["end_date"])+")</b><br><br>";
                html += '<table class="table table-bordered"  width="100%" cellspacing="0">';
                html += '<tbody>';
            
                for(var j = 0; j < arr[1].length; j++){

                    var z = 1;
                    if(arr[0][i]["event_id"] == arr[1][j]["event_id"]){

                        for(var k = 0; k < arr[2].length; k++){
                            
                            if(arr[1][j]["appointment_id"] == arr[2][k]["appointment_id"]){ 
                                if(z == 1){
                                    html += "<tr>";
                                    html += "<td><b>Customer Name</b></td>";   
                                    html += "<td><b>Date</b></td>";   
                                    html += "<td><b>Time</b></td>";   
                                    html += "<td><b>Kaunter</b></td>";   
                                    html += "</tr>";
                                    html += "<tr>";
                                    html += "<td>"+arr[2][k]["queuename"]+"</td>";   
                                    html += "<td>"+convertDate2(arr[2][k]["wait_date"])+"</td>";   
                                    html += "<td>"+arr[2][k]["time"]+"</td>";   
                                    html += "<td>"+arr[2][k]["counterNum"]+"</td>";   
                                    html += "</tr>";
                                }else{
                                    html += "<tr>";
                                    html += "<td>"+arr[2][k]["queuename"]+"</td>";   
                                    html += "<td>"+convertDate2(arr[2][k]["wait_date"])+"</td>";   
                                    html += "<td>"+arr[2][k]["time"]+"</td>";   
                                    html += "<td>"+arr[2][k]["counterNum"]+"</td>";   
                                    html += "</tr>";

                                }
                                
                                z++;
                            }
                        }
                    }
                }

                html += '</tbody>';
                html += '</table>';
                html += '<br>';

        }


        $("#tableContent").html(html);
        
    }

    function convertDate(date){
        var arr = date.split("-");
        return arr[2]+"/"+arr[1]+"/"+arr[0];
    }

    function convertDate2(date){
        var arr = date.split("-");
        return arr[0]+"/"+arr[1]+"/"+arr[2];
    }

    function print_borang(){
        window.print();
        setTimeout(function () { window.close(); }, 100);
    }
    
    function block(className){
        $("#" + className).block({
            message: '<div class="semibold white"><span class="icon-spinner9 icon-spin text-left white"></span>&nbsp; Loading ...</div>',
            overlayCSS: {
                backgroundColor: '#353c48',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
    }
    
    function unblock(className){
        $("#" + className).unblock();
    }
</script>