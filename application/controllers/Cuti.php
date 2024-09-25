<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_cuti');
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
	}

	public function view_super_admin()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {

			$data['cuti'] = $this->m_cuti->get_all_cuti()->result_array();
			$this->load->view('super_admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}
	// menunggu konfirmasi
	public function view_waiting_cuti()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {

			// Fetch only accepted leaves (id_status_cuti = 2)
			$data['cuti'] = $this->m_cuti->get_waiting_cuti()->result_array();
			$this->load->view('super_admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}


	// acc cuti
	public function view_accepted_cuti()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {

			// Fetch only accepted leaves (id_status_cuti = 2)
			$data['cuti'] = $this->m_cuti->get_accepted_cuti()->result_array();
			$this->load->view('super_admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	// tolak cuti
	public function view_reject_cuti()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {

			// Fetch only accepted leaves (id_status_cuti = 2)
			$data['cuti'] = $this->m_cuti->get_reject_cuti()->result_array();
			$this->load->view('super_admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}


	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 2) {

			$data['cuti'] = $this->m_cuti->get_all_cuti()->result_array();
			$this->load->view('admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}

	}

	// menunggu konfirmasi
	public function view_admin_waiting_cuti()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 2) {

			// Fetch only accepted leaves (id_status_cuti = 2)
			$data['cuti'] = $this->m_cuti->get_waiting_cuti()->result_array();
			$this->load->view('admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}


	// acc cuti
	public function view_admin_accepted_cuti()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 2) {

			// Fetch only accepted leaves (id_status_cuti = 2)
			$data['cuti'] = $this->m_cuti->get_accepted_cuti()->result_array();
			$this->load->view('admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	// tolak cuti
	public function view_admin_reject_cuti()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 2) {

			// Fetch only accepted leaves (id_status_cuti = 2)
			$data['cuti'] = $this->m_cuti->get_reject_cuti()->result_array();
			$this->load->view('admin/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	public function view_pegawai($id_user)
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 1) {

			$data['cuti'] = $this->m_cuti->get_all_cuti_by_id_user($id_user)->result_array();
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();

			$this->load->view('pegawai/cuti', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	//  menunggu konfirmasi
	public function view_pegawai_waiting_cuti($id_user)
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 1) {
			$data['cuti'] = $this->m_cuti->get_waiting_cuti_by_id_user($id_user, 1)->result_array(); // Status 1 untuk menunggu konfirmasi
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
			$this->load->view('pegawai/cuti', $data);
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}

	public function view_pegawai_accepted_cuti($id_user)
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 1) {
			$data['cuti'] = $this->m_cuti->get_accepted_cuti_by_id_user($id_user, 2)->result_array(); // Status 2 untuk diterima
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
			$this->load->view('pegawai/cuti', $data);
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}

	public function view_pegawai_reject_cuti($id_user)
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 1) {
			$data['cuti'] = $this->m_cuti->get_reject_cuti_by_id_user($id_user, 3)->result_array(); // Status 3 untuk ditolak
			$data['pegawai'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->row_array();
			$data['jenis_kelamin'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['pegawai_data'] = $this->m_user->get_pegawai_by_id($this->session->userdata('id_user'))->result_array();
			$this->load->view('pegawai/cuti', $data);
		} else {
			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');
		}
	}
	

	public function hapus_cuti()
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");

		$hasil = $this->m_cuti->delete_cuti($id_cuti);

		if ($hasil == false) {
			$this->session->set_flashdata('eror_hapus', 'eror_hapus');
		} else {
			$this->session->set_flashdata('hapus', 'hapus');
		}

		redirect('Cuti/view_pegawai/' . $id_user);
	}

	public function hapus_cuti_admin()
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");

		$hasil = $this->m_cuti->delete_cuti($id_cuti);

		if ($hasil == false) {
			$this->session->set_flashdata('eror_hapus', 'eror_hapus');
		} else {
			$this->session->set_flashdata('hapus', 'hapus');
		}

		redirect('Cuti/view_admin');
	}

	public function edit_cuti_admin()
	{
		$id_cuti = $this->input->post("id_cuti");
		$alasan = $this->input->post("alasan");
		$perihal_cuti = $this->input->post("perihal_cuti");
		$tgl_diajukan = $this->input->post("tgl_diajukan");
		$mulai = $this->input->post("mulai");
		$berakhir = $this->input->post("berakhir");


		$hasil = $this->m_cuti->update_cuti($alasan, $perihal_cuti, $tgl_diajukan, $mulai, $berakhir, $id_cuti);

		if ($hasil == false) {
			$this->session->set_flashdata('eror_edit', 'eror_edit');
		} else {
			$this->session->set_flashdata('edit', 'edit');
		}

		redirect('Cuti/view_admin');
	}

	public function acc_cuti_admin($id_status_cuti)
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");
		$alasan_verifikasi = $this->input->post("alasan_verifikasi");

		$hasil = $this->m_cuti->confirm_cuti($id_cuti, $id_status_cuti, $alasan_verifikasi);

		if ($hasil == false) {
			$this->session->set_flashdata('eror_input', 'eror_input');
		} else {
			$this->session->set_flashdata('input', 'input');
		}

		redirect('Cuti/view_admin/' . $id_user);
	}

	public function acc_cuti_super_admin($id_status_cuti)
	{

		$id_cuti = $this->input->post("id_cuti");
		$id_user = $this->input->post("id_user");
		$alasan_verifikasi = $this->input->post("alasan_verifikasi");

		$hasil = $this->m_cuti->confirm_cuti($id_cuti, $id_status_cuti, $alasan_verifikasi);

		if ($hasil == false) {
			$this->session->set_flashdata('eror_input', 'eror_input');
		} else {
			$this->session->set_flashdata('input', 'input');
		}

		redirect('Cuti/view_super_admin/' . $id_user);
	}

}