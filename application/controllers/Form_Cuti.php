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

	// Proses pengajuan cuti baru dengan pengecekan cuti menunggu konfirmasi
	public function proses_cuti()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 1) {

			$id_user = $this->input->post("id_user");

			// Cek apakah ada cuti yang masih menunggu konfirmasi (id_status_cuti = 1)
			$cuti_menunggu = $this->m_cuti->cekCutiMenunggu($id_user);

			if ($cuti_menunggu) {
				// Jika ada cuti yang masih menunggu, tampilkan pesan error
				$this->session->set_flashdata('error', 'Anda tidak bisa mengajukan cuti baru karena ada cuti yang masih menunggu konfirmasi.');
				redirect('Form_Cuti/view_pegawai');
			} else {
				// Proses pengajuan cuti baru jika tidak ada cuti yang menunggu konfirmasi
				$alasan = $this->input->post("alasan");
				$perihal_cuti = $this->input->post("perihal_cuti");
				$mulai = $this->input->post("mulai");
				$berakhir = $this->input->post("berakhir");
				$id_cuti = md5($id_user . $alasan . $mulai);

				$id_status_cuti = 1; // Status menunggu konfirmasi

				// Insert data cuti baru
				$hasil = $this->m_cuti->insert_data_cuti('cuti-' . substr($id_cuti, 0, 5), $id_user, $alasan, $mulai, $berakhir, $id_status_cuti, $perihal_cuti);

				if ($hasil == false) {
					$this->session->set_flashdata('eror_input', 'Terjadi kesalahan saat mengajukan cuti.');
				} else {
					$this->session->set_flashdata('input', 'Pengajuan cuti berhasil diajukan.');
				}
				redirect('Form_Cuti/view_pegawai');
			}

		} else {
			$this->session->set_flashdata('loggin_err');
			redirect('Login/index');
		}
	}


}
