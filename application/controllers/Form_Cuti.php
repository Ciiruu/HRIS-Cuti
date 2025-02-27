<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_Cuti extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->helper('telegram');

	}

	// Menampilkan form pengajuan cuti untuk pegawai
	public function view_pegawai()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {

			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$this->load->view('pegawai/form_pengajuan_cuti', $data);

		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}


	// Proses pengajuan cuti baru dengan pengecekan cuti menunggu konfirmasi dan pengurangan total cuti
	public function proses_cuti()
	{
		// Memastikan user sudah login dan memiliki level user yang tepat
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {
			// Mengambil data dari input form
			$id_user = $this->input->post("id_user");
			$alasan = $this->input->post("alasan");
			$perihal_cuti = $this->input->post("perihal_cuti");
			$mulai = $this->input->post("mulai");
			$berakhir = $this->input->post("berakhir");
			$id_status_cuti = 1; // Status cuti: Menunggu konfirmasi

			// Mengecek saldo cuti user menggunakan model m_user
			$total_cuti_data = $this->m_user->get_total_cuti_by_user($id_user);
			$total_cuti = $total_cuti_data['total_cuti'];

			// Jika saldo atau total cuti belum diisi (atau bernilai nol), tampilkan pesan error
			if (empty($total_cuti) || $total_cuti <= 0) {
				$this->session->set_flashdata('error', 'Saldo cuti Anda belum diisi atau bernilai nol. Harap hubungi admin untuk mengisi saldo cuti Anda.');
				redirect('Form_Cuti/view_pegawai');
				return;
			}

			// Mengambil nama lengkap dari session
			$nama_lengkap = $this->session->userdata('nama_lengkap');

			// Menghitung jumlah hari cuti
			$datetime1 = new DateTime($mulai);
			$datetime2 = new DateTime($berakhir);
			$interval = $datetime1->diff($datetime2);
			$jumlah_hari_cuti = $interval->days + 1;

			// Cek jika jumlah hari cuti kurang dari atau sama dengan nol
			if ($jumlah_hari_cuti <= 0) {
				$this->session->set_flashdata('error', 'Tanggal berakhir harus lebih besar dari tanggal mulai.');
				redirect('Form_Cuti/view_pegawai');
				return;
			}

			// Simpan data pengajuan cuti
			$id_cuti = md5($id_user . $alasan . $mulai);
			$this->m_cuti->insert_data_cuti('cuti-' . substr($id_cuti, 0, 5), $id_user, $alasan, $mulai, $berakhir, $id_status_cuti, $perihal_cuti);

			// Kirim notifikasi ke super_admin
			$chat_id = '5272178819'; // Ganti dengan chat_id yang sesuai
			// Buat pesan notifikasi
			$message = "Permohonan cuti baru telah diajukan oleh $nama_lengkap.\n" .
				"Perihal: $perihal_cuti\n" .
				"Alasan: $alasan\n" .
				"Mulai: " . date('d-M-Y', strtotime($mulai)) . "\n" .
				"Berakhir: " . date('d-M-Y', strtotime($berakhir)) . "\n" .
				"Jumlah hari: $jumlah_hari_cuti\n" .
				"Status: Menunggu konfirmasi.";

			// Panggil fungsi untuk mengirim notifikasi dan simpan respons
			$response = send_telegram_notification($chat_id, $message);

			// Cek respons untuk logging
			if (isset($response['ok']) && $response['ok']) {
				log_message('info', 'Notifikasi berhasil dikirim ke Telegram: ' . $message);
			} else {
				log_message('error', 'Gagal mengirim notifikasi ke Telegram: ' . json_encode($response));
			}

			// Set flashdata dan redirect
			$this->session->set_flashdata('input', 'Pengajuan cuti berhasil diajukan.');
			redirect('Form_Cuti/view_pegawai');
		} else {
			// Jika user tidak memiliki izin, redirect ke halaman login
			$this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
			redirect('Login/index');
		}
	}
}
