<!DOCTYPE html>
<html lang="en">

<head>
    <title>GDHY</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url(); ?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- CSS Utama -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/login/css/main.css">
    <!-- Sweetalert -->
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/favicon.ico" />
    <script src="<?= base_url() ?>node_modules/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
            font-family: 'poppins', sans-serif;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
        }

        .container img {
            width: 11.5rem;
            height: 11.5rem;
            margin: 0 auto 1rem auto;
            display: block;
        }

        .form-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            text-align: center;
            color: #333;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 2.5rem 0.75rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group i {
            position: absolute;
            left: 0.75rem;
            color: #999;
            font-size: 1.25rem;
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <?php if ($this->session->flashdata('success_log_out')) { ?>
        <script>
            swal({
                title: "Success!",
                text: "Anda Berhasil Log Out!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('input')) { ?>
        <script>
            swal({
                title: "Berhasil Terdaftar!",
                text: "Silahkan Anda Login!",
                icon: "success"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('eror')) { ?>
        <script>
            swal({
                title: "Eror!",
                text: "Terjadi Kesalahan Dalam Proses data!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('loggin_err_no_user')) { ?>
        <script>
            swal({
                title: "Error!",
                text: "Anda Belum Terdaftar!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('loggin_err_pass')) { ?>
        <script>
            swal({
                title: "Error!",
                text: "Password Yang Anda Masukan Salah!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('loggin_err_no_access')) { ?>
        <script>
            swal({
                title: "Error!",
                text: "Anda Belum Memiliki Akses!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('loggin_err')) { ?>
        <script>
            swal({
                title: "Error!",
                text: "Sesi Anda Habis!",
                icon: "error"
            });
        </script>
    <?php } ?>

    <div class="container">
        <img src="<?= base_url(); ?>assets/login/images/GDHY.png" alt="IMG">
        <div class="form-title">Application For Leave / Absence</div>
        <form action="<?= base_url(); ?>Login/proses" method="POST">
            <div class="form-group">
                <i class="fa fa-user"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url(); ?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url(); ?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/login/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="<?= base_url(); ?>assets/login/js/main.js"></script>

</body>

</html>