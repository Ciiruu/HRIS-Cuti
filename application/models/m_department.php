<?php

class M_department extends CI_Model
{
    // Fungsi untuk mengambil semua data departemen dari tabel departemen
    public function get_all_department()
    {
        $hasil = $this->db->query('SELECT * FROM department');
        return $hasil;
    }

}


