<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_jenis_kelamin');
		$this->load->model('m_department');

	}

	public function view_super_admin()
	{

		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {

			$data['pegawai'] = $this->m_user->get_all_pegawai();
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['department_p'] = $this->m_department->get_all_department()->result_array(); // Ambil data departemen
			$this->load->view('super_admin/pegawai', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}

	}

	public function view_admin()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 2) {

			$data['pegawai'] = $this->m_user->get_all_pegawai(); // Ambil data pegawai
			$data['jenis_kelamin_p'] = $this->m_jenis_kelamin->get_all_jenis_kelamin()->result_array();
			$data['department_p'] = $this->m_department->get_all_department()->result_array(); // Ambil data departemen
			$this->load->view('admin/pegawai', $data);

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	//tambah lebih dari 1 pegawai

	public function tambah_pegawai()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$email = $this->input->post("email");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$id_department = $this->input->post("id_department"); // Ambil departemen dari input
			$id_user_level = 1;
			$id = md5($username . $email . $password);

			$hasil = $this->m_user->insert_pegawai($id, $username, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $id_department);

			if ($hasil == false) {
				$this->session->set_flashdata('error', 'Gagal menambahkan pegawai.');
				redirect('Pegawai/view_admin');
			} else {
				$this->session->set_flashdata('success', 'Pegawai berhasil ditambahkan.');
				redirect('Pegawai/view_admin');
			}
		} else {
			$this->session->set_flashdata('login_err', 'Anda tidak memiliki hak akses.');
			redirect('Login/index');
		}
	}


	public function upload_excel()
	{
		if ($this->session->userdata('logged_in') == true && $this->session->userdata('id_user_level') == 2) {
			if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
				$path = $_FILES['file']['tmp_name'];

				// Include PHPExcel
				require_once APPPATH . 'third_party/Classes/PHPExcel.php';
				$objPHPExcel = PHPExcel_IOFactory::load($path);

				// Mengambil sheet aktif
				$sheet = $objPHPExcel->getActiveSheet();
				$highestRow = $sheet->getHighestRow();

				for ($row = 2; $row <= $highestRow; $row++) { // Mulai dari baris kedua
					$username = $sheet->getCell('A' . $row)->getValue();
					$password = $sheet->getCell('B' . $row)->getValue();
					$email = $sheet->getCell('C' . $row)->getValue();
					$nama_lengkap = $sheet->getCell('D' . $row)->getValue();
					$id_jenis_kelamin = $sheet->getCell('E' . $row)->getValue();
					$no_telp = $sheet->getCell('F' . $row)->getValue();
					$alamat = $sheet->getCell('G' . $row)->getValue();
					$id_department = $sheet->getCell('H' . $row)->getValue(); // Ambil id_department dari kolom H
					$id_user_level = 1;
					$id = md5($username . $email . $password);

					$data = array(
						'id' => $id,
						'username' => $username,
						'email' => $email,
						'password' => $password,
						'id_user_level' => $id_user_level,
						'nama_lengkap' => $nama_lengkap,
						'id_jenis_kelamin' => $id_jenis_kelamin,
						'no_telp' => $no_telp,
						'alamat' => $alamat,
						'id_department' => $id_department // Tambahkan id_department
					);

					$this->m_user->insert_pegawai($id, $username, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat, $id_department);
				}

				$this->session->set_flashdata('success', 'Data pegawai berhasil diunggah.');
				redirect('Pegawai/view_admin');
			} else {
				$this->session->set_flashdata('error', 'Silakan unggah file Excel.');
				redirect('Pegawai/view_admin');
			}
		} else {
			$this->session->set_flashdata('login_err', 'Anda tidak memiliki hak akses.');
			redirect('Login/index');
		}
	}

	// sampai sini

	// function untuk download template


	public function edit_pegawai()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 2) {

			
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$email = $this->input->post("email");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$id_department = $this->input->post("id_department");
			$id_user_level = 1;
			$id = $this->input->post("id_user");

			


			$hasil = $this->m_user->update_pegawai($id, $username, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat,$id_department);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_edit', 'eror_edit');
				redirect('Pegawai/view_admin');
			} else {
				$this->session->set_flashdata('edit', 'edit');
				redirect('Pegawai/view_admin');
			}

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}

	}

	public function hapus_pegawai()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 2) {

			$id = $this->input->post("id_user");


			$hasil = $this->m_user->delete_pegawai($id);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_hapus', 'eror_hapus');
				redirect('Pegawai/view_admin');
			} else {
				$this->session->set_flashdata('hapus', 'hapus');
				redirect('Pegawai/view_admin');
			}

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	public function super_admin_tambah_pegawai()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$email = $this->input->post("email");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$id_user_level = 1;
			$id = md5($username . $email . $password);


			$hasil = $this->m_user->insert_pegawai($id, $username, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat);

			if ($hasil == false) {
				$this->session->set_flashdata('eror', 'eror');
				redirect('Pegawai/view_super_admin');
			} else {
				$this->session->set_flashdata('input', 'input');
				redirect('Pegawai/view_super_admin');
			}
		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}

	}

	public function super_admin_edit_pegawai()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {

			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$email = $this->input->post("email");
			$nama_lengkap = $this->input->post("nama_lengkap");
			$id_jenis_kelamin = $this->input->post("id_jenis_kelamin");
			$no_telp = $this->input->post("no_telp");
			$alamat = $this->input->post("alamat");
			$id_user_level = 1;
			$id = $this->input->post("id_user");


			$hasil = $this->m_user->update_pegawai($id, $username, $email, $password, $id_user_level, $nama_lengkap, $id_jenis_kelamin, $no_telp, $alamat);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_edit', 'eror_edit');
				redirect('Pegawai/view_super_admin');
			} else {
				$this->session->set_flashdata('edit', 'edit');
				redirect('Pegawai/view_super_admin');
			}

		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}

	public function super_admin_hapus_pegawai()
	{
		if ($this->session->userdata('logged_in') == true and $this->session->userdata('id_user_level') == 3) {

			$id = $this->input->post("id_user");


			$hasil = $this->m_user->delete_pegawai($id);

			if ($hasil == false) {
				$this->session->set_flashdata('eror_hapus', 'eror_hapus');
				redirect('Pegawai/view_super_admin');
			} else {
				$this->session->set_flashdata('hapus', 'hapus');
				redirect('Pegawai/view_super_admin');
			}


		} else {

			$this->session->set_flashdata('loggin_err', 'loggin_err');
			redirect('Login/index');

		}
	}


}