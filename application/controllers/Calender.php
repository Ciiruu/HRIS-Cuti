<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load library calender CI jika diperlukan
        $this->load->library('calendar');
    }

    public function view_admin() {
        // Data untuk kalender, misalnya: tanggal tertentu dengan event
        $data['calendar'] = $this->calendar->generate();

        // Load halaman kalender di AdminLTE
        $this->load->view('admin/calender_view', $data);
    }
}
?>
