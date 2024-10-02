<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_cuti');
        $this->load->model('m_user');  // Pastikan model m_user dimuat
    }

    public function surat_cuti_pdf($id_cuti)
    {
        // Ambil data cuti berdasarkan ID cuti
        $data['cuti'] = $this->m_cuti->get_all_cuti_by_id_cuti($id_cuti)->result_array();

        if (!empty($data['cuti'])) {
            $id_user = $data['cuti'][0]['id_user'];  // Ambil id_user dari data cuti

            // Mengambil jumlah hari cuti dari database
            $jumlah_hari_cuti_data = $this->m_cuti->get_jumlah_hari_cuti($id_cuti);
            $cuti_diambil = isset($jumlah_hari_cuti_data['jumlah_hari_cuti']) ? $jumlah_hari_cuti_data['jumlah_hari_cuti'] + 1 : 0; // +1 untuk menghitung hari mulai dan berakhir

            // Ambil total cuti user dari tabel user_detail
            $total_cuti_awal = $this->m_user->get_total_cuti_by_user($id_user)['total_cuti'];
            $data['total_cuti_awal'] = $total_cuti_awal; // Simpan total cuti awal

            // Hitung sisa cuti
            $data['cuti_diambil'] = $cuti_diambil; // Set cuti diambil
            $data['sisa_cuti'] = $total_cuti_awal - $cuti_diambil; // Hitung sisa cuti
        } else {
            // Jika tidak ada data cuti
            $data['cuti_diambil'] = 0; // Set cuti diambil menjadi 0
            $data['total_cuti_awal'] = 0; // Set total cuti awal menjadi 0
            $data['sisa_cuti'] = 0; // Set sisa cuti menjadi 0
        }

        // Generate PDF
        $this->load->library('pdf');
        $this->pdf->setPaper('Letter', 'potrait');
        $this->pdf->set_option('isRemoteEnabled', true);
        $this->pdf->filename = "APPLICATION FOR LEAVE-ABSENCE.pdf";
        $this->pdf->load_view('laporan_pdf', $data);
    }



}
?>