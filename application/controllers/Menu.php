<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
        if (empty($this->session->userdata('userName'))) {
            redirect('Admin');
        }
    }

    public function index()
    {
        $data['cekdata'] = $this->Mcrud->cek('tbl_menu');
        $data['menu'] = $this->Mcrud->get_all_data('tbl_menu')->result();
        $this->load->view("admin/menu/index", $data);
    }

    public function add()
    {
        $this->load->view('admin/menu/form_add');
    }

    public function save()
    {
        $config['upload_path']          = './upload/gambar/';
        $config['allowed_types']        = 'gif|jpg|JPG|png|PNG';
        $config['max_size']             = 10000; // maksimal ukuran
        $config['max_width']            = 10000; //lebar maksimal
        $config['max_height']           = 10000; //tinggi maksimal
        $config['overwrite']            = true;
        $this->load->library('upload', $config);

        $this->upload->do_upload('gambar');

        $nama = $this->input->post('nama');
        $desc = $this->input->post('deskripsi');
        $harga = $this->input->post('harga');
        $gambar = $this->upload->data();
        $gambar = $gambar['file_name'];

        if ($nama == NULL && $desc == NULL && $harga == NULL) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data belum diisi!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('menu');
        } else {
            $data = array(
                'nama' => $nama,
                'harga' => $harga,
                'deskripsi' => $desc,
                'gambar' => $gambar
            );

            $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data baru berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            $this->Mcrud->insert('tbl_menu', $data);
            redirect('Menu');
        }
    }

    public function getid($id)
    {
        $dataWhere = array('id' => $id);
        $data['menu'] = $this->Mcrud->get_by_id('tbl_menu', $dataWhere)->row_object();
        $this->load->view('admin/menu/form_edit', $data);
    }

    public function edit()
    {
        $config['upload_path']          = './upload/gambar/';
        $config['allowed_types']        = 'gif|jpg|JPG|png|PNG';
        $config['max_size']             = 10000; // maksimal ukuran
        $config['max_width']            = 10000; //lebar maksimal
        $config['max_height']           = 10000; //tinggi maksimal
        $config['overwrite']            = true;
        $this->load->library('upload', $config);

        $this->upload->do_upload('gambar');

        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $desc = $this->input->post('deskripsi');
        $harga = $this->input->post('harga');
        $gambar = $this->upload->data();
        $gambar = $gambar['file_name'];

        if ($nama == NULL && $desc == NULL && $harga == NULL) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data belum diisi!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('menu');
        } else {
            $data = array(
                'nama' => $nama,
                'harga' => $harga,
                'deskripsi' => $desc,
                'gambar' => $gambar
            );

            $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diubah!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            $this->Mcrud->update('tbl_menu', $data, 'id', $id);
            redirect('Menu');
        }
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $this->Mcrud->delete($where, 'tbl_menu');
        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('Menu');
    }
}
