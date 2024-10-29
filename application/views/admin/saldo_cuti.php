<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php if ($this->session->flashdata('success_update')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Berhasil mengupdate total cuti",
                icon: "success"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('error_update')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Gagal mengupdate total cuti",
                icon: "erorr"
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
                            <h1 class="m-0">Data Saldo Cuti</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Saldo Cuti</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- saldo_cuti.php -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Menampilkan Saldo Cuti Semua Karyawan -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Saldo Cuti Semua Karyawan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jabatan</th>
                                            <th>Total Cuti</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($data_cuti as $cuti): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $cuti['nama_lengkap']; ?></td>
                                                <td><?= $cuti['jabatan']; ?></td>
                                                <td><?= $cuti['total_cuti']; ?></td>
                                                <td>
                                                    <!-- Tombol Edit Total Cuti -->
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editTotalCuti<?= $cuti['id_user']; ?>">
                                                        Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Modal Edit Total Cuti -->
                <?php foreach ($data_cuti as $cuti): ?>
                    <div class="modal fade" id="editTotalCuti<?= $cuti['id_user']; ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Total Cuti
                                        <?= $cuti['nama_lengkap']; ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= base_url(); ?>Cuti/update_total_cuti_admin" method="POST">
                                        <input type="hidden" name="id_user" value="<?= $cuti['id_user']; ?>">
                                        <div class="form-group">
                                            <label for="total_cuti">Total Cuti</label>
                                            <input type="number" class="form-control" id="total_cuti" name="total_cuti"
                                                value="<?= $cuti['total_cuti']; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <?php $this->load->view("admin/components/js.php") ?>


</body>

</html>