<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("pegawai/components/header.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Data Berhasil Ditambahkan!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
        <script>
            swal({
                title: "Erorr!",
                text: "Data Gagal Ditambahkan!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <!-- notif cuti -->

    <?php if ($this->session->flashdata('success_message')): ?>
        <script>
            swal({
                title: "Success!",
                text: "<?php echo $this->session->flashdata('success_message'); ?>",
                icon: "success",
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error_message')): ?>
        <script>
            swal({
                title: "Error!",
                text: "<?php echo $this->session->flashdata('error_message'); ?>",
                icon: "error",
            });
        </script>
    <?php endif; ?>


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
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        // Cek apakah data total_cuti sudah didefinisikan dan valid
                                        if (isset($total_cuti)) {
                                            // Tampilkan total cuti jika ada
                                            if ($total_cuti > 0) {
                                                echo 'Total Cuti: ' . $total_cuti . ' Hari';
                                            } else {
                                                echo 'Tolong Input';
                                            }
                                        } else {
                                            // Jika data cuti pegawai tidak ada atau belum diatur
                                            echo 'Tolong Input';
                                        }
                                        ?>
                                    </h3>
                                    <p>Total Cuti</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer btn btn-secondary" data-toggle="modal"
                                    data-target="#totalCutiModal">Input Total Cuti <i
                                        class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="totalCutiModal" tabindex="-1" role="dialog"
                            aria-labelledby="totalCutiModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="totalCutiModalLabel">Isi Total Cuti</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if (isset($total_cuti) && $total_cuti > 0): ?>
                                            <p>Total cuti sudah diisi: <?php echo $total_cuti; ?> Hari. Anda tidak bisa
                                                mengubahnya.</p>
                                        <?php else: ?>
                                            <form id="form-total-cuti"
                                                action="<?php echo site_url('cuti/update_total_cuti'); ?>" method="post">
                                                <div class="form-group">
                                                    <label for="total_cuti">Total Cuti Anda</label>
                                                    <input type="number" class="form-control" id="total_cuti"
                                                        name="total_cuti" required min="0" max="365">
                                                </div>
                                                <input type="hidden" name="id_user"
                                                    value="<?= $this->session->userdata('id_user'); ?>">
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <?php if (!isset($total_cuti) || $total_cuti == 0): ?>
                                            <button type="submit" form="form-total-cuti"
                                                class="btn btn-success">Simpan</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= $cuti['total_cuti'] ?></h3>

                                    <p>Semua Pengajuan Cuti/Absen</p>
                                </div>
                                <div class="icon">
                                    <i class="ion-document-text"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_pegawai/<?= $this->session->userdata('id_user'); ?>"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $cuti_acc['total_cuti'] ?></h3>

                                    <p>Pengajuan Cuti/Absen Diterima</p>
                                </div>
                                <div class="icon">
                                    <i class="ion-arrow-graph-up-right"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_pegawai_accepted_cuti/<?= $this->session->userdata('id_user'); ?>"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $cuti_reject['total_cuti'] ?></h3>

                                    <p>Pengajuan Cuti/Absen Ditolak</p>
                                </div>
                                <div class="icon">
                                    <i class="ion-arrow-graph-down-right"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_pegawai_reject_cuti/<?= $this->session->userdata('id_user'); ?>"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= $cuti_confirm['total_cuti'] ?></h3>

                                    <p>Menunggu Cuti/Absen DiKonfirmasi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion-load-d"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_pegawai_waiting_cuti/<?= $this->session->userdata('id_user'); ?>"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box" style="background-color: #48bb78;">
                                <div class="inner">
                                    <h3><?php
                                    // echo var_dump($cuti_pegawai[0]['mulai']);
                                    // echo var_dump($cuti_pegawai[0]['berakhir']);
                                    if ($cuti_pegawai == null) {
                                        echo 'Belum Ada';
                                    } else {
                                        $now = time(); // or your date as well
                                        $your_date = strtotime($cuti_pegawai[0]['berakhir']);
                                        $datediff = $your_date - $now;

                                        $date_akhir = round($datediff / (60 * 60 * 24));



                                        $now = time(); // or your date as well
                                        $your_date = strtotime($cuti_pegawai[0]['mulai']);
                                        $datediff = $now - $your_date;

                                        $date_mulai = round($datediff / (60 * 60 * 24));



                                        if ($date_mulai >= 0 and $date_akhir >= 0) {
                                            echo $date_akhir . ' Hari Lagi';
                                        } else {
                                            echo "Belum Ada";
                                        }
                                    }

                                    ?></h3>

                                    <p>Sisa Waktu Cuti/Absen</p>
                                </div>
                                <div class="icon">
                                    <i class="ion-clock"></i>
                                </div>
                                <a href="<?= base_url(); ?>Cuti/view_pegawai_accepted_cuti/<?= $this->session->userdata('id_user'); ?>"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header" style="font-weight: bold;">
                                    <h3>PERHATIAN!!!</h3>
                                </div>
                                <div class="card-body">
                                    <!-- <h5 class="card-title">Syarat Pengambilan Cuti/Libur</h5> -->
                                    <p class="card-text">
                                        1. <b>Batas Waktu Pengajuan Cuti:</b><br>
                                        Pengajuan cuti harus dilakukan <b>maksimal 1 Minggu sebelum tanggal libur</b>
                                        yang
                                        diinginkan. Jika pengajuan dilakukan setelah batas waktu ini, cuti tidak dapat
                                        diproses.<br><br>

                                        2. <b>Persetujuan HR:</b><br>
                                        Jika tanggal cuti <b>tidak disetujui oleh HR</b>, admin akan memberikan
                                        pemberitahuan kepada pemohon apakah ingin mengubah tanggal cuti atau libur.
                                        Namun, hak untuk <b>mengubah tanggal cuti berada pada admin HR</b>, sehingga
                                        pemohon hanya bisa mengikuti tanggal yang ditentukan setelah proses
                                        perubahan.<br><br>

                                        3. <b>Proses Setelah Persetujuan Cuti:</b><br>
                                        Jika cuti/libur telah <b>disetujui (di-ACC)</b>, pemohon dapat <b>mengunduh
                                            surat persetujuan cuti</b> dan menggunakan surat tersebut untuk <b>meminta
                                            tanda tangan</b> sebagai bukti resmi cuti.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    Cuti Besar
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Cuti Besar</h5>
                                    <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime, nobis quidem enim repellendus impedit sunt officia, quasi iure atque reiciendis! Nam voluptate doloribus fugiat reiciendis? Maiores labore nobis corrupti.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    Cuti Sakit
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Cuti Besar</h5>
                                    <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate neque libero quod tenetur quia maiores minus accusantium sint suscipit, nulla nihil assumenda dolorem repellat mollitia blanditiis tempore placeat earum sapiente.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    Cuti Melahirkan
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Cuti Melahirkan</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium ipsam minus explicabo ullam accusantium quisquam animi sit nobis numquam, voluptatibus neque omnis aliquam maxime tenetur architecto, accusamus corporis tempore?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    Cuti Alasan Penting
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Cuti Alasan Penting</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, cum, deserunt nesciunt cumque saepe dicta id consequuntur odio quas dolore perspiciatis quia expedita, similique debitis nisi itaque incidunt enim non!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    Cuti Bersama
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Cuti Bersama</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse possimus dolores laborum dolor exercitationem nemo repellat recusandae nihil! Harum, aliquam eveniet? Impedit laudantium expedita ipsa dolorem cum provident nesciunt? Maiores.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Cuti
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Cuti </h5>
                            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vel officiis labore adipisci quo incidunt. Explicabo asperiores sint tenetur eaque id optio repellendus nostrum. Quas, fugit soluta odit accusantium cumque nemo?
                            </p>
                        </div>
                    </div> -->
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