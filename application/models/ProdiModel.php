<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdiModel extends CI_Model {

    public function getAll() {
        $this->db->select('prodi.*, fakultas.fakultas_name');
        $this->db->from('prodi');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id', 'left');
        return $this->db->get()->result_array();
    }

    public function getById($id) {
        return $this->db->where('prodi_id', $id)->get('prodi')->row_array();
    }

    public function insert($data) {
        return $this->db->insert('prodi', $data);
    }

    public function update($id, $data) {
        return $this->db->where('prodi_id', $id)->update('prodi', $data);
    }

    public function delete($id) {
        return $this->db->where('prodi_id', $id)->delete('prodi');
    }
}