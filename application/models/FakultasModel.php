<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FakultasModel extends CI_Model {

    public function getAll() {
        return $this->db->get('fakultas')->result_array();
    }

    public function getById($id) {
        return $this->db->where('fakultas_id', $id)->get('fakultas')->row_array();
    }

    public function insert($data) {
        return $this->db->insert('fakultas', $data);
    }

    public function update($id, $data) {
        return $this->db->where('fakultas_id', $id)->update('fakultas', $data);
    }

    public function delete($id) {
        return $this->db->where('fakultas_id', $id)->delete('fakultas');
    }
}