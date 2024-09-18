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
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                events: '<?= base_url() ?>calendar/load_events',
                timeZone: 'local',
                selectable: true,
                selectHelper: true,
                editable: true,
                droppable: true,

                select: function (info) {
                    Swal.fire({
                        title: 'Add New Event',
                        html: `
                            <div style="text-align: left; padding: 0 20px;">
                                <div style="margin-bottom: 15px;">
                                    <label for="event-name" style="display: block; margin-bottom: 5px; font-weight: bold;">Event name</label>
                                    <input id="event-name" class="swal2-input" style="width: 100%; margin: 0;" placeholder="Enter your event name">
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="width: 48%;">
                                        <label for="event-start" style="display: block; margin-bottom: 5px; font-weight: bold;">Event start</label>
                                        <input id="event-start-date" class="swal2-input" type="date" style="width: 100%; margin: 0 0 5px 0;" value="${info.startStr.split('T')[0]}">
                                        <input id="event-start-time" class="swal2-input" type="time" style="width: 100%; margin: 0;">
                                    </div>
                                    <div style="width: 48%;">
                                        <label for="event-end" style="display: block; margin-bottom: 5px; font-weight: bold;">Event end</label>
                                        <input id="event-end-date" class="swal2-input" type="date" style="width: 100%; margin: 0 0 5px 0;" value="${info.endStr.split('T')[0]}">
                                        <input id="event-end-time" class="swal2-input" type="time" style="width: 100%; margin: 0;">
                                    </div>
                                </div>
                            </div>
                        `,
                        showCloseButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Save Event',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                            closeButton: 'btn btn-light'
                        },
                        buttonsStyling: false,
                        didOpen: () => {
                            const closeButton = Swal.getCloseButton();
                            closeButton.innerHTML = '&times;';
                            closeButton.style.fontSize = '24px';
                            closeButton.style.padding = '0';
                            closeButton.style.margin = '0';
                            closeButton.style.lineHeight = '1';
                        },
                        preConfirm: () => {
                            const eventName = document.getElementById('event-name').value;
                            const startDate = document.getElementById('event-start-date').value;
                            const startTime = document.getElementById('event-start-time').value;
                            const endDate = document.getElementById('event-end-date').value;
                            const endTime = document.getElementById('event-end-time').value;

                            if (!eventName || !startDate || !startTime || !endDate || !endTime) {
                                Swal.showValidationMessage('Please fill in all fields');
                                return false;
                            }

                            return {
                                title: eventName,
                                start: `${startDate}T${startTime}`,
                                end: `${endDate}T${endTime}`
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const eventData = result.value;
                            $.ajax({
                                url: '<?= base_url() ?>calendar/insert_event',
                                method: 'POST',
                                data: eventData,
                                success: function (response) {
                                    calendar.addEvent(eventData);
                                    Swal.fire('Success!', 'Event added successfully', 'success');
                                },
                                error: function () {
                                    Swal.fire('Error!', 'Failed to add event', 'error');
                                }
                            });
                        }
                    });
                },

                // Event Drop (Drag and Drop) update function
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



                eventClick: function (event) {
                    var eventStart = event.event.start;
                    var eventEnd = event.event.end;

                    // Formatkan tanggal dan waktu untuk input
                    var formattedStartDate = moment(eventStart).format('YYYY-MM-DD');
                    var formattedStartTime = moment(eventStart).format('HH:mm');
                    var formattedEndDate = eventEnd ? moment(eventEnd).format('YYYY-MM-DD') : '';
                    var formattedEndTime = eventEnd ? moment(eventEnd).format('HH:mm') : '';

                    Swal.fire({
                        title: 'Edit or Delete Event',
                        html: `
                            <div style="text-align: left; padding: 0 20px;">
                                <div style="margin-bottom: 15px;">
                                    <label for="event-name" style="display: block; margin-bottom: 5px; font-weight: bold;">Event name</label>
                                    <input id="event-name" class="swal2-input" style="width: 100%; margin: 0;" value="${event.event.title}">
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <div style="width: 48%;">
                                        <label for="event-start" style="display: block; margin-bottom: 5px; font-weight: bold;">Event start</label>
                                        <input id="event-start-date" class="swal2-input" type="date" style="width: 100%; margin: 0 0 5px 0;" value="${formattedStartDate}">
                                        <input id="event-start-time" class="swal2-input" type="time" style="width: 100%; margin: 0;" value="${formattedStartTime}">
                                    </div>
                                    <div style="width: 48%;">
                                        <label for="event-end" style="display: block; margin-bottom: 5px; font-weight: bold;">Event end</label>
                                        <input id="event-end-date" class="swal2-input" type="date" style="width: 100%; margin: 0 0 5px 0;" value="${formattedEndDate}">
                                        <input id="event-end-time" class="swal2-input" type="time" style="width: 100%; margin: 0;" value="${formattedEndTime}">
                                    </div>
                                </div>
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Save Changes',
                        cancelButtonText: '<i class="fa fa-trash"></i> Delete Event',
                        showCloseButton: true,
                        customClass: {
                            cancelButton: 'btn btn-danger btn-space', // Tambahkan kelas untuk space
                            confirmButton: 'btn btn-success btn-space', // Tambahkan kelas untuk space
                            closeButton: 'btn btn-light'
                        },
                        preConfirm: () => {
                            const eventName = document.getElementById('event-name').value;
                            const startDate = document.getElementById('event-start-date').value;
                            const startTime = document.getElementById('event-start-time').value;
                            const endDate = document.getElementById('event-end-date').value;
                            const endTime = document.getElementById('event-end-time').value;

                            if (!eventName || !startDate || !startTime) {
                                Swal.showValidationMessage('Please fill in all required fields');
                                return false;
                            }

                            return {
                                id: event.event.id,
                                title: eventName,
                                start: `${startDate}T${startTime}`,
                                end: endDate && endTime ? `${endDate}T${endTime}` : null
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const updatedEvent = result.value;
                            $.ajax({
                                url: '<?= base_url() ?>calendar/update_event',
                                type: 'POST',
                                data: updatedEvent,
                                success: function () {
                                    event.event.setProp('title', updatedEvent.title);
                                    event.event.setStart(updatedEvent.start);
                                    event.event.setEnd(updatedEvent.end);
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
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
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
                                            event.event.remove();
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
                }

            });

            calendar.render();
        });
    </script>

</body>

</html>