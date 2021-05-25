<?php 
    include '../../config/header.php'; 
?>

    <style>
        .fc-head-container{
            background-color: #6666ff;
            color: white;
        }
        .fc-day-header{
            font-size: 10px !important;
            font-weight: bold !important;
        }
        h2{
            font-size: 17px !important;
        }
        .fc-content{
            height: 6px !important;
        }
        .fc-title{
            font-size: 10px !important;
        }
        button.fc-prev-button{
            visibility: hidden;
        }
        button.fc-next-button{
            visibility: hidden;
        }
        button.fc-today-button{
            visibility: hidden;
        }
        button.fc-month-button{
            visibility: hidden;
        }
        button.fc-agendaWeek-button{
            visibility: hidden;
        }
        button.fc-agendaDay-button{
            visibility: hidden;
        }
    </style>

    <div id="calendar"></div>

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
                                    <!-- <div id="calendar"></div> -->
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.print.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
$(document).ready(function() {
    
    $("#calendar").fullCalendar({
        height: 388
    });

    $("#calendar").fullCalendar( 'gotoDate', paramYear+'-01-15' );

});

</script>