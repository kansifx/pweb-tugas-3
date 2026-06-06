<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('FakultasModel');
    }

    public function index() {
        $data['fakultas'] = $this->FakultasModel->getAll();
        $header['title'] = 'Daftar Fakultas';
        
        $this->load->view('layout/header', $header);
        $this->load->view('fakultas/index', $data);
        $this->load->view('layout/footer');
    }

    public function tambah() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title'  => 'Tambah Fakultas',
                'button' => 'Simpan',
                'action' => base_url('fakultas/tambah'),
                'fakultas' => null
            ];
            $this->load->view('layout/header', $data);
            $this->load->view('fakultas/form', $data);
            $this->load->view('layout/footer');
        } else {
            $save = [
                'fakultas_id'   => $this->input->post('fakultas_id'),
                'fakultas_name' => $this->input->post('fakultas_name')
            ];
            $this->FakultasModel->insert($save);
            $this->session->set_flashdata('swal', ['icon' => 'success', 'title' => 'Berhasil!', 'text' => 'Data fakultas disimpan.']);
            redirect('fakultas');
        }
    }

    public function ubah($id) {
        $fakultas = $this->FakultasModel->getById($id);
        if (!$fakultas) {
            $this->session->set_flashdata('swal', ['icon' => 'warning', 'title' => 'Gagal!', 'text' => 'Data tidak ditemukan.']);
            redirect('fakultas');
        }

        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title'  => 'Ubah Fakultas',
                'button' => 'Update',
                'action' => base_url('fakultas/ubah/'.$id),
                'fakultas' => $fakultas
            ];
            $this->load->view('layout/header', $data);
            $this->load->view('fakultas/form', $data);
            $this->load->view('layout/footer');
        } else {
            $update = ['fakultas_name' => $this->input->post('fakultas_name')];
            $this->FakultasModel->update($id, $update);
            $this->session->set_flashdata('swal', ['icon' => 'success', 'title' => 'Berhasil!', 'text' => 'Data fakultas diubah.']);
            redirect('fakultas');
        }
    }

    public function hapus($id) {
        if ($this->FakultasModel->getById($id)) {
            $this->FakultasModel->delete($id);
            $this->session->set_flashdata('swal', ['icon' => 'warning', 'title' => 'Dihapus!', 'text' => 'Data fakultas telah dihapus.']);
        }
        redirect('fakultas');
    }

    private function _rules() {
        $this->form_validation->set_rules('fakultas_id', 'ID Fakultas', 'required|numeric|is_unique[fakultas.fakultas_id]');
        $this->form_validation->set_rules('fakultas_name', 'Nama Fakultas', 'required|min_length[3]|max_length[100]');
    }
}