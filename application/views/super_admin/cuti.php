<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("super_admin/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Status Cuti Berhasil Diubah!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror_input')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Status Cuti Gagal Diubah!",
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
        <?php $this->load->view("super_admin/components/navbar.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php $this->load->view("super_admin/components/sidebar.php") ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Pengajuan</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Pengajuan</li>
                            </ol>
                        </div><!-- /.col -->
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
                                    <h3 class="card-title">Data Pengajuan Karyawan</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table mb-0 table-borderless table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Total Cuti</th> <!-- Tambahkan header Total Cuti -->
                                                <th>Alasan</th>
                                                <th>Diajukan</th>
                                                <th>Mulai</th>
                                                <th>Berakhir</th>
                                                <th>Perihal</th>
                                                <th>Verifikasi</th>
                                                <th>Status</th>
                                                <!-- <th>Cetak Surat</th> -->
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $no = 0;
                                            foreach ($cuti as $i):
                                                $no++;
                                                $id_cuti = $i['id_cuti'];
                                                $id_user = $i['id_user'];
                                                $nama_lengkap = $i['nama_lengkap'];
                                                $total_cuti = $i['total_cuti'];
                                                $alasan = $i['alasan'];
                                                $tgl_diajukan = $i['tgl_diajukan'];
                                                $mulai = $i['mulai'];
                                                $berakhir = $i['berakhir'];
                                                $id_status_cuti = $i['id_status_cuti'];
                                                $alasan_verifikasi = $i['alasan_verifikasi'];
                                                $perihal_cuti = $i['perihal_cuti'];

                                                ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $nama_lengkap ?></td>
                                                    <td><?= $total_cuti ?> Hari</td>
                                                    <td><?= $alasan ?></td>
                                                    <td><?= date('d-M-Y', strtotime($tgl_diajukan)) ?></td>
                                                    <td><?= date('d-M-Y', strtotime($mulai)) ?></td>
                                                    <td><?= date('d-M-Y', strtotime($berakhir)) ?></td>
                                                    <td><?= $perihal_cuti ?></td>
                                                    <td><?php if ($alasan_verifikasi == NULL) { ?>
                                                            <a href="" class="btn btn-warning">
                                                                Belum Ada
                                                            </a>
                                                        <?php } else { ?>
                                                            <?= $alasan_verifikasi ?>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php if ($id_status_cuti == 1) { ?>
                                                            <div class="table-responsive">
                                                                <div class="table table-striped table-hover ">
                                                                    <a href="" class="badge bg-warning" data-toggle="modal"
                                                                        data-target="#edit_data_pegawai">
                                                                        Menunggu
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php } elseif ($id_status_cuti == 2) { ?>
                                                            <div class="table-responsive">
                                                                <div class="table table-striped table-hover ">
                                                                    <a href="" class="badge bg-success" data-toggle="modal"
                                                                        data-target="#edit_data_pegawai">
                                                                        Diterima
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php } elseif ($id_status_cuti == 3) { ?>
                                                            <div class="table-responsive">
                                                                <div class="table table-striped table-hover ">
                                                                    <a href="" class="badge bg-danger" data-toggle="modal"
                                                                        data-target="#edit_data_pegawai">
                                                                        Ditolak
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <!-- <td><?php if ($id_status_cuti == 2) { ?>
                                                            <a href="<?= base_url(); ?>Cetak/surat_cuti_pdf/<?= $id_cuti ?>"
                                                                class="btn btn-success">
                                                                Cetak Surat
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="#" class="btn btn-danger">
                                                                Belum Dapat Mencetak
                                                            </a>
                                                        <?php } ?>
                                                    </td> -->
                                                    <td>
                                                        <div>
                                                            <a href="" class="btn btn-success" data-toggle="modal"
                                                                data-target="#setuju<?= $id_cuti ?>">
                                                                <i class="fas fa-check"></i>
                                                            </a>
                                                            <a href="" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#tidak_setuju<?= $id_cuti ?>">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </div>
                                                    </td>


                                                </tr>

                                                <!-- Modal Setuju Cuti -->
                                                <div class="modal fade" id="setuju<?= $id_cuti ?>" tabindex="-1"
                                                    aria-labelledby="modalLabelSetuju" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success text-white">
                                                                <h5 class="modal-title" id="modalLabelSetuju">Konfirmasi
                                                                    Persetujuan Cuti</h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url() ?>Cuti/acc_cuti_super_admin/2"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id_cuti"
                                                                        value="<?php echo $id_cuti ?>" />
                                                                    <input type="hidden" name="id_user"
                                                                        value="<?php echo $id_user ?>" />
                                                                    <p class="text-center">Apakah kamu yakin ingin
                                                                        menyetujui pengajuan ini?</p>
                                                                    <div class="form-group">
                                                                        <label for="alasan_verifikasi"
                                                                            class="font-weight-bold">Alasan</label>
                                                                        <textarea class="form-control"
                                                                            id="alasan_verifikasi" name="alasan_verifikasi"
                                                                            rows="3"
                                                                            placeholder="Masukkan alasan persetujuan"></textarea>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-center">
                                                                        <button type="button" class="btn btn-outline-danger"
                                                                            data-dismiss="modal">Tidak</button>
                                                                        <button type="submit" class="btn btn-success">Ya,
                                                                            Setujui</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Tidak Setuju Cuti -->
                                                <div class="modal fade" id="tidak_setuju<?= $id_cuti ?>" tabindex="-1"
                                                    aria-labelledby="modalLabelTolak" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title" id="modalLabelTolak">Konfirmasi
                                                                    Penolakan Cuti</h5>
                                                                <button type="button" class="close text-white"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="<?php echo base_url() ?>Cuti/acc_cuti_super_admin/3"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <input type="hidden" name="id_cuti"
                                                                        value="<?php echo $id_cuti ?>" />
                                                                    <input type="hidden" name="id_user"
                                                                        value="<?php echo $id_user ?>" />
                                                                    <p class="text-center">Apakah kamu yakin ingin menolak
                                                                        pengajuan ini?</p>
                                                                    <div class="form-group">
                                                                        <label for="alasan_verifikasi"
                                                                            class="font-weight-bold">Alasan</label>
                                                                        <textarea class="form-control"
                                                                            id="alasan_verifikasi" name="alasan_verifikasi"
                                                                            rows="3"
                                                                            placeholder="Masukkan alasan penolakan"></textarea>
                                                                    </div>
                                                                    <div class="modal-footer justify-content-center">
                                                                        <button type="button" class="btn btn-outline-danger"
                                                                            data-dismiss="modal">Tidak</button>
                                                                        <button type="submit" class="btn btn-secondary">Ya,
                                                                            Tolak</button>
                                                                    </div>
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

    <?php $this->load->view("super_admin/components/js.php") ?>
</body>

</html>