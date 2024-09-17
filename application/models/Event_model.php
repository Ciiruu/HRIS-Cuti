<?php
class Event_model extends CI_Model {

    // Mengambil semua event dari database
    public function fetch_all_events() {
        return $this->db->get('events')->result_array(); // Asumsikan tabelnya bernama 'events'
    }

    // Menambah event baru ke database
    public function insert_event($data) {
        $this->db->insert('events', $data);
    }

    // Mengupdate event yang ada di database
    public function update_event($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }

    // Menghapus event dari database
    public function delete_event($id) {
        $this->db->where('id', $id);
        $this->db->delete('events');
    }
}
?>
