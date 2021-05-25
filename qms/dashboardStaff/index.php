<?php 
    include '../../config/header.php'; 
?>

    <style>
        
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-12">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>
                                <div class="card-body">
                                    <div id="calendar"></div>
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

</body>

<?php include '../../config/footer.php'; ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" rel="stylesheet" /> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
$(document).ready(function() {

    $("#calendar").fullCalendar({
        header: {
            left: 'prev,next today myCustomButton',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          }
    });

    $("#calendar").fullCalendar( 'gotoDate', '2019-09-01' );

    var paramMonthJan = 'January';

    $('#calendar').fullCalendar('addEventSource',  
        function(start, end, timezone, callback) {
            var record_id = "2019";
            var url = "http://dev-ej-app.ppj.gov.my/jw/web/json/plugin/org.joget.cuti.cutiWebservice/service";
             console.log(record_id);
             console.log(url);
            $.ajax({
                url:url,
                type:'get',
                data:{action:"getDataHoliday", req_id:record_id},
                dataType: 'json',
                beforeSend: function () {
                    // block("calender");
                },
                success: function(data){
                    // var obj = JSON.parse(JSON.stringify(dataAjax));

                    console.log(data);
                    var data_event = [];
                    for(var i = 0; i < data.events.length; i++){
                        data_event.push({
                            title: data.events[i].title,
                            start: data.events[i].start,
                            allDay: true,
                            color: 'green'
                        });
                    }
                    console.log(data_event);
                    callback(data_event);
                    // unblock("calender");
                },
                error: function (request, status, error) {
                    console.log(error);
                }
            })
        }
    );
    
});

</script>