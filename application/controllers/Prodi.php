<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['ProdiModel', 'FakultasModel']);
    }

    public function index() {
        $data['prodi'] = $this->ProdiModel->getAll();
        $header['title'] = 'Daftar Program Studi';
        $this->load->view('layout/header', $header);
        $this->load->view('prodi/index', $data);
        $this->load->view('layout/footer');
    }

    public function tambah() {
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title'    => 'Tambah Prodi',
                'button'   => 'Simpan',
                'action'   => base_url('prodi/tambah'),
                'fakultas' => $this->FakultasModel->getAll(),
                'prodi'    => null
            ];
            $this->load->view('layout/header', $data);
            $this->load->view('prodi/form', $data);
            $this->load->view('layout/footer');
        } else {
            $save = [
                'prodi_id'     => $this->input->post('prodi_id'),
                'fakultas_id'  => $this->input->post('fakultas_id'),
                'prodi_name'   => $this->input->post('prodi_name'),
                'prodi_strata' => $this->input->post('prodi_strata'),
            ];
            $this->session->set_flashdata('swal', ['icon' => 'success', 'title' => 'Berhasil!', 'text' => 'Prodi berhasil ditambah.']);
            $this->ProdiModel->insert($save);
            redirect('prodi');
        }
    }

    public function ubah($id) {
        $prodi = $this->ProdiModel->getById($id);
        if (!$prodi) redirect('prodi');

        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title'    => 'Ubah Prodi',
                'button'   => 'Update',
                'action'   => base_url('prodi/ubah/'.$id),
                'fakultas' => $this->FakultasModel->getAll(),
                'prodi'    => $prodi
            ];
            $this->load->view('layout/header', $data);
            $this->load->view('prodi/form', $data);
            $this->load->view('layout/footer');
        } else {
            $update = [
                'fakultas_id'  => $this->input->post('fakultas_id'),
                'prodi_name'   => $this->input->post('prodi_name'),
                'prodi_strata' => $this->input->post('prodi_strata'),
            ];
            $this->ProdiModel->update($id, $update);
            $this->session->set_flashdata('swal', ['icon' => 'success', 'title' => 'Berhasil!', 'text' => 'Prodi diubah.']);
            redirect('prodi');
        }
    }

    public function hapus($id) {
        $this->ProdiModel->delete($id);
        $this->session->set_flashdata('swal', ['icon' => 'warning', 'title' => 'Dihapus!', 'text' => 'Prodi telah dihapus.']);
        redirect('prodi');
    }

    private function _rules() {
        $this->form_validation->set_rules('prodi_id', 'ID Prodi', 'required|numeric');
        $this->form_validation->set_rules('fakultas_id', 'Fakultas', 'required');
        $this->form_validation->set_rules('prodi_name', 'Nama Prodi', 'required|min_length[3]');
        $this->form_validation->set_rules('prodi_strata', 'Strata', 'required|in_list[D3,S1,S2]');
    }
}