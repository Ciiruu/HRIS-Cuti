<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDHY</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="<?= base_url(); ?>assets/admin_lte/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- fullCalendar -->
    <link href="<?= base_url(); ?>assets/admin_lte/plugins/fullcalendar/main.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <?php $this->load->view("admin/components/header.php") ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("admin/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("admin/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Calendar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-body p-0">
                                    <!-- THE CALENDAR -->
                                    <div id="calendar"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <?php $this->load->view("admin/components/js.php") ?>

    <!-- fullCalendar 2.2.5 -->
    <script src="<?= base_url(); ?>assets/admin_lte/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/admin_lte/plugins/fullCalendar/main.js"></script>
    <!-- Page specific script -->
    <script>
        $(document).ready(function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',

                events: '<?= base_url() ?>calendar/load_events', // Memuat event dari controller
                selectable: true,
                selectHelper: true,
                editable: true,
                droppable: true,

                // Menambahkan event baru dengan pop-up form
                select: function (info) {
                    Swal.fire({
                        title: 'Add New Event',
                        html: `
        <div class="form-group">
            <label for="title">Event Title</label>
            <input id="title" class="swal2-input" placeholder="Enter event title">
        </div>
        <div class="form-group">
            <label for="start">Start Date & Time</label>
            <input id="start" class="swal2-input" type="datetime-local" value="${info.startStr}">
        </div>
        <div class="form-group">
            <label for="end">End Date & Time</label>
            <input id="end" class="swal2-input" type="datetime-local" value="${info.endStr}">
        </div>
    `,
                        confirmButtonText: 'Add Event',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel',
                        preConfirm: () => {
                            const title = Swal.getPopup().querySelector('#title').value;
                            const start = Swal.getPopup().querySelector('#start').value;
                            const end = Swal.getPopup().querySelector('#end').value;

                            if (!title) {
                                Swal.showValidationMessage('Please enter an event title');
                                return false;
                            }
                            if (!start || !end) {
                                Swal.showValidationMessage('Please select both start and end dates');
                                return false;
                            }

                            return { title: title, start: start, end: end };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= base_url() ?>calendar/insert_event',
                                type: 'POST',
                                data: result.value,
                                success: function () {
                                    calendar.refetchEvents(); // Reload event setelah ditambahkan
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Event Created',
                                        text: 'The event was created successfully!',
                                        confirmButtonText: 'OK'
                                    });
                                },
                                error: function () {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'There was an error creating the event.',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });

                },

                // Mengedit event
                eventDrop: function (event) {
                    var id = event.event.id;
                    var start = event.event.startStr;
                    var end = event.event.endStr;
                    var title = event.event.title;

                    $.ajax({
                        url: '<?= base_url() ?>calendar/update_event',
                        type: 'POST',
                        data: { id: id, title: title, start: start, end: end },
                        success: function () {
                            calendar.refetchEvents();
                            Swal.fire({
                                icon: 'success',
                                title: 'Event Updated',
                                text: 'Event was updated successfully!',
                                confirmButtonText: 'OK'
                            });
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error updating the event.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                },

                // Menghapus event dengan konfirmasi
                eventClick: function (event) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = event.event.id;

                            $.ajax({
                                url: '<?= base_url() ?>calendar/delete_event',
                                type: 'POST',
                                data: { id: id },
                                success: function () {
                                    calendar.refetchEvents();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Event Deleted',
                                        text: 'Event was deleted successfully!',
                                        confirmButtonText: 'OK'
                                    });
                                },
                                error: function () {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'There was an error deleting the event.',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            });
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>



    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>