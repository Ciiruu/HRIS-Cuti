<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model Event_model untuk mengelola event
        $this->load->model('Event_model');
    }

    // Menampilkan halaman kalender
    public function view_admin() {
        $this->load->view('admin/calendar_view'); // Load view calendar milikmu
    }

    // Mengambil semua event dari database dan kirimkan ke FullCalendar
    public function load_events() {
        $events = $this->Event_model->fetch_all_events(); // Panggil method dari model
        echo json_encode($events); // Kirim data event dalam format JSON
    }

    // Menambah event baru
    public function insert_event() {
        $data = array(
            'title' => $this->input->post('title'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end')
        );
        $this->Event_model->insert_event($data); // Simpan event ke database
    }

    // Mengupdate event yang ada
    public function update_event() {
        $id = $this->input->post('id');
        $data = array(
            'title' => $this->input->post('title'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end')
        );
        $this->Event_model->update_event($id, $data); // Update event di database
    }

    // Menghapus event
    public function delete_event() {
        $id = $this->input->post('id');
        $this->Event_model->delete_event($id); // Hapus event dari database
    }
}
?>
