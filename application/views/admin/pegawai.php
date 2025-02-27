<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("admin/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('berhasil_tambah1')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Ditambahkan!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('gagal_tambah1')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Ditambahkan!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('edit')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Diedit!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_edit')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Diedit!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('hapus')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Dihapus!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_hapus')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Dihapus !",
                icon: "error"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('success_unggah')) { ?>
        <script>
            swal({
                title: "Success",
                text: "Data pegawai berhasil Diunggah.",
                icon: "success"
            });
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('error_unggah')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Diunggah",
                icon: "error"
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
                            <h1 class="m-0">Data Karyawan</h1>
                        </div><!-- /.col -->

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Karyawan</li>
                            </ol>
                        </div><!-- /.col -->

                        <!-- <button type="button" class="btn btn-primary mt-3 mr-2" data-toggle="modal" data-target="#exampleModal">
                            Download Template Excel
                        </button> -->

                        <button type="button" class="btn btn-primary mt-3 mr-2" data-toggle="modal"
                            data-target="#exampleModal">
                            <i class="fas fa-upload"></i> Upload Excel
                        </button>


                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambah1">
                            <i class="fas fa-plus"></i> Tambah 1 Data
                        </button>

                        <br>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Karyawan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Department</th> <!-- Tambahkan header untuk departemen -->
                                                <th>Username</th>
                                                <th>Nama Lengkap</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No Telp</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($pegawai as $i):
                                                $no++;
                                                $id_user = $i['id_user']; // Pastikan ini ada
                                                $username = $i['username']; // Pastikan ini ada
                                                $password = isset($i['password']) ? $i['password'] : ''; // Pastikan ini ada
                                                $email = $i['email']; // Pastikan ini ada
                                                $nama_lengkap = $i['nama_lengkap']; // Pastikan ini ada
                                                $jenis_kelamin = $i['jenis_kelamin']; // Pastikan ini ada
                                                $no_telp = $i['no_telp']; // Pastikan ini ada
                                                $alamat = $i['alamat']; // Pastikan ini ada
                                                $nama_department = $i['nama_department'];

                                                ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $nama_department ?></td> <!-- Tampilkan nama departemen -->
                                                    <td><?= $username ?></td>
                                                    <td><?= $nama_lengkap ?></td>
                                                    <td><?= $jenis_kelamin ?></td>
                                                    <td><?= $no_telp ?></td>
                                                    <td><?= $alamat ?></td>
                                                    <td>
                                                        <div class="table-responsive">
                                                            <div class="table table-striped table-hover ">
                                                                <a href="" class="btn btn-primary" data-toggle="modal"
                                                                    data-target="#edit_data_pegawai<?= $id_user ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <div class="table table-striped table-hover ">
                                                                <a href="" data-toggle="modal"
                                                                    data-target="#hapus<?= $id_user ?>"
                                                                    class="btn btn-danger"><i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>

                                                <!-- Modal Hapus Data Pegawai -->
                                                <div class="modal fade" id="hapus<?= $id_user ?>" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data
                                                                    Karyawan
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?php echo base_url() ?>Pegawai/hapus_pegawai"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="hidden" name="id_user"
                                                                                value="<?php echo $id_user ?>" />
                                                                            <p>Apakah kamu yakin ingin menghapus data
                                                                                ini?</i></b></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger ripple"
                                                                            data-dismiss="modal">Tidak</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success ripple save-category">Ya</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Edit Pegawai -->
                                                <div class="modal fade" id="edit_data_pegawai<?= $id_user ?>" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Data Karyawan</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?= base_url(); ?>Pegawai/edit_pegawai"
                                                                    method="POST">
                                                                    <input type="text" value="<?= $id_user ?>"
                                                                        name="id_user" hidden>
                                                                    <div class="form-group">
                                                                        <label for="id_department">Departemen</label>
                                                                        <select class="form-control" id="id_department"
                                                                            name="id_department" required>
                                                                            <?php foreach ($department_p as $dept): ?>
                                                                                <option value="<?= $dept['id_department']; ?>">
                                                                                    <?= $dept['nama_department']; ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="username">Username</label>
                                                                        <input type="text" class="form-control"
                                                                            id="username" aria-describedby="username"
                                                                            name="username" value="<?= $username ?>"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="password">Password</label>
                                                                        <input type="text" class="form-control"
                                                                            id="password" aria-describedby="password"
                                                                            name="password" value="<?= $password ?>"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">email</label>
                                                                        <input type="text" class="form-control" id="email"
                                                                            aria-describedby="email" name="email"
                                                                            value="<?= $email ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nama_lengkap">Nama Lengkap</label>
                                                                        <input type="text" class="form-control"
                                                                            id="nama_lengkap"
                                                                            aria-describedby="nama_lengkap"
                                                                            name="nama_lengkap" value="<?= $nama_lengkap ?>"
                                                                            required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="id_jenis_kelamin">Jenis Kelamin</label>
                                                                        <select class="form-control" id="id_jenis_kelamin"
                                                                            name="id_jenis_kelamin" required>
                                                                            <?php foreach ($jenis_kelamin_p as $u):
                                                                                $id = $u["id_jenis_kelamin"];
                                                                                $jenis_kelamin = $u["jenis_kelamin"];
                                                                                ?>
                                                                                <option value="<?= $id ?>" <?php if ($id == $jenis_kelamin) {
                                                                                      echo 'selected';
                                                                                  } else {
                                                                                      echo '';
                                                                                  } ?>><?= $jenis_kelamin ?>
                                                                                </option>

                                                                            <?php endforeach ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="no_telp">No Telp</label>
                                                                        <input type="text" class="form-control" id="no_telp"
                                                                            aria-describedby="no_telp" name="no_telp"
                                                                            value="<?= $no_telp ?>" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat</label>
                                                                        <input type="text" class="form-control" id="alamat"
                                                                            aria-describedby="alamat" name="alamat"
                                                                            value="<?= $alamat ?>" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <!-- Modal Tambah Pegawai lebih dari 1 -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <i class="fas fa-user-plus"></i> Tambah Pegawai
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url(); ?>Pegawai/upload_excel" method="POST"
                                enctype="multipart/form-data">
                                <!-- Input file untuk mengunggah Excel -->
                                <div class="form-group">
                                    <label for="file">
                                        <i class="fas fa-file-excel"></i> Unggah File Excel
                                    </label>
                                    <input type="file" class="form-control" id="file" name="file" accept=".xls, .xlsx"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Unggah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.content-wrapper -->

        <!-- tambah 1 pegawai -->

        <!-- Modal Tambah Pegawai -->
        <div class="modal fade" id="tambah1" tabindex="-1" aria-labelledby="tambah1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambah1">Tambah Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url(); ?>Pegawai/tambah_pegawai" method="POST">
                            <div class="form-group">
                                <label for="id_department">Departemen</label>
                                <select class="form-control" id="id_department" name="id_department" required>
                                    <?php foreach ($department_p as $dept): ?>
                                        <option value="<?= $dept['id_department']; ?>"><?= $dept['nama_department']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" aria-describedby="username"
                                    name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" aria-describedby="password"
                                    name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" aria-describedby="email" name="email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap"
                                    aria-describedby="nama_lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="form-group">
                                <label for="id_jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin" required>
                                    <?php foreach ($jenis_kelamin_p as $u):
                                        $id = $u["id_jenis_kelamin"];
                                        $jenis_kelamin = $u["jenis_kelamin"];
                                        ?>
                                        <option value="<?= $id ?>"><?= $jenis_kelamin ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No Telp</label>
                                <input type="text" class="form-control" id="no_telp" aria-describedby="no_telp"
                                    name="no_telp" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" aria-describedby="alamat"
                                    name="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="total_cuti">Total Cuti</label>
                                <input type="number" class="form-control" id="total_cuti" name="total_cuti" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <?php $this->load->view("admin/components/js.php") ?>
</body>

</html>