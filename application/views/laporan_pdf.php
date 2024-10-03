<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application for Leave</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 15px;
            font-size: 12px;
            line-height: 1.2;
        }

        .header {
            text-align: center;
        }

        .section {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .section-title {
            font-weight: bold;
            border-bottom: 1px solid black;
            margin-bottom: 5px;
        }

        .form-table {
            width: 100%;
            border-collapse: collapse;
        }

        .form-table td {
            padding: 8px;
        }

        .form-table td:first-child {
            width: 25%;
        }

        .form-table td:nth-child(2) {
            width: 30%;
            padding-right: 20px;
        }

        .form-table td:nth-child(3) {
            width: 15%;
        }

        .form-table td:nth-child(4) {
            width: 30%;
        }

        .signature {
            text-align: right;
        }
    </style>
</head>

<body>
    <?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }

    $id = 0;
    foreach ($cuti as $i):
        $id++;
        $id_cuti = $i['id_cuti'];
        $id_user = $i['id_user'];
        $nama_lengkap = $i['nama_lengkap'];
        $alasan = $i['alasan'];
        $nip = $i['nip'];
        $pangkat = $i['pangkat'];
        $jabatan = $i['jabatan'];
        $perihal_cuti = $i['perihal_cuti'];
        $tgl_diajukan = $i['tgl_diajukan'];
        $mulai = $i['mulai'];
        $berakhir = $i['berakhir'];
        $id_status_cuti = $i['id_status_cuti'];
        $total_cuti = $i['total_cuti'];

        // Hitung jumlah hari cuti diambil
        $cuti_diambil_query = $this->db->query("SELECT DATEDIFF(berakhir, mulai) + 1 AS jumlah_hari_cuti FROM cuti WHERE id_cuti = '$id_cuti'");
        $cuti_diambil = $cuti_diambil_query->row()->jumlah_hari_cuti;

        // Hitung total cuti yang disetujui oleh Super Admin
        $total_cuti_disetujui_query = $this->db->query("
            SELECT SUM(DATEDIFF(berakhir, mulai) + 1) AS total_disetujui 
            FROM cuti 
            WHERE id_user = '$id_user' AND id_status_cuti = 2"); // 2 berarti disetujui
        $total_cuti_disetujui = $total_cuti_disetujui_query->row()->total_disetujui;

        // Hitung Balance Due
        $balance_due = $total_cuti - $total_cuti_disetujui; // Total cuti - total cuti yang diambil
    ?>
        <div class="header">
            <img src="<?= base_url(); ?>assets/login/images/GDHY.png" alt="Logo" height="150" width="200">
            <h3><u>APPLICATION FOR LEAVE / ABSENCE</u></h3>
        </div>

        <br>

        <div class="section">
            <table class="form-table">
                <tr>
                    <td>Name</td>
                    <td>: <?= $nama_lengkap ?></td>
                    <td>ID No</td>
                    <td>: <?= $nip ?></td>
                </tr>
                <tr>
                    <td>Position / Department</td>
                    <td>: <?= $jabatan ?></td>
                </tr>
                <tr>
                    <td>Commencement Date</td>
                    <td>: <?= date('d-m-Y', strtotime(($tgl_diajukan))) ?></td>
                </tr>
            </table>
        </div>
        <br>

        <div class="section">
            <div class="section-title"></div>
            <table class="form-table">
                <tr>
                    <td>Period of Leave</td>
                    <td>: From
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= date('d-m-Y', strtotime(($mulai))) ?>
                    </td>
                    <td>To</td>
                    <td>:
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= date('d-m-Y', strtotime(($berakhir))) ?>
                    </td>
                    <td>(<?= $cuti_diambil ?>) days</td>
                </tr>
                <tr>
                    <td>Nature of Leave</td>
                    <td>: <?= $perihal_cuti ?></td>
                </tr>
                <tr>
                    <td>Reason for Leave</td>
                    <td>: <?= $alasan ?></td>
                </tr>
                <tr>
                    <td>Leave Address</td>
                    <td>: </td>
                </tr>
            </table>
        </div>

        <div class="section-title"></div>
        <div class="section">
            <div class="section-title">
                <center>DEPARTMENT USE ONLY</center>
            </div>
            <table class="form-table">
                <tr>
                    <td>Granted leave from</td>
                    <td>: ........................................</td>
                    <td>to</td>
                    <td>: ........................................</td>
                    <td>() days</td>
                </tr>
                <tr>
                    <td>To report for Duty on</td>
                    <td>: ........................................</td>
                </tr>
            </table>
        </div>

        <br>
        <div class="section">
            <table class="form-table">
                <tr>
                    <td>----------------------------</td>
                    <td style="text-align: right;">----------------------------</td>
                </tr>
                <tr>
                    <td>Employee</td>
                    <td style="text-align: right;">Department Head</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="section-title"></div>
        <div class="section">
            <div class="section-title">
                <center>HRD USE ONLY</center>
            </div>
            <table class="form-table">
                <tr>
                    <td>Leave Entitlement</td>
                    <td>:  </td> <!-- Total cuti sebelum di ACC -->
                </tr>
                <tr>
                    <td>Leave Taken</td>
                    <td>: <?= $cuti_diambil ?> days</td> <!-- Cuti yang diambil -->
                </tr>
                <tr>
                    <td>Balance Due</td>
                    <td>: <?= $total_cuti ?> days</td> <!-- Total cuti yang disetujui -->
                </tr>
            </table>
        </div>

        <br>

        <div class="section">
            <table class="form-table">
                <tr>
                    <td>----------------------------</td>
                    <td style="text-align: right;">----------------------------</td>
                </tr>
            </table>
        </div>

    <?php endforeach; ?>
</body>

</html>
