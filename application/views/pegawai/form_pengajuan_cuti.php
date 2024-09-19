<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pegawai/components/header.php") ?>
    <!-- Include SweetAlert CSS if necessary -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php if ($this->session->flashdata('input')) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                title: 'Success!',
                text: 'Pengajuan leave/absence berhasil diajukan!',
                icon: 'success'
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('error_tunggu')) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Anda tidak bisa mengajukan cuti baru karena ada cuti yang masih menunggu konfirmasi.',
                icon: 'error'
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('error')) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.0/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                title: 'Error!',
                text: '<?= $this->session->flashdata('error'); ?>',
                icon: 'error'
            });
        </script>
    <?php } ?>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>assets/admin_lte/dist/img/Loading.png"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <?php $this->load->view("pegawai/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("pegawai/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">APPLICATION LEAVE/ABSENCE</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Setting</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <form action="<?= base_url(); ?>Form_Cuti/proses_cuti" method="POST" enctype="multipart/form-data">
                        <input type="text" value="<?= $this->session->userdata('id_user') ?>" name="id_user" hidden>
                        <div class="form-group">
                            <label for="alasan">Alasan</label>
                            <textarea class="form-control" id="alasan" rows="3" name="alasan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="perihal_cuti">Jenis Cuti/Absen </label>
                            <select class="form-control" id="jenis_cuti" name="perihal_cuti" required>
                                <option value="">Pilih Jenis Cuti</option>
                                <option value="annual_leave">Annual Leave</option>
                                <option value="public_holiday">Public Holiday</option>
                                <option value="sick_leave">Sick Leave</option>
                                <option value="extra_off">Extra Off</option>
                                <option value="marriage_leave">Marriage Leave</option>
                                <option value="maternity_leave">Maternity Leave</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mulai">Mulai Cuti/Absen </label>
                            <input type="date" class="form-control" id="mulai" aria-describedby="mulai" name="mulai"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="berakhir">Berakhir Cuti/Absen </label>
                            <input type="date" class="form-control" id="berakhir" aria-describedby="berakhir"
                                name="berakhir" required>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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
    <!-- ./wrapper -->

    <?php $this->load->view("pegawai/components/js.php") ?>
</body>

</html>