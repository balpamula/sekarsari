<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
        $data['cekdata'] = $this->Mcrud->cek('tbl_order');
        $data['order'] = $this->Mcrud->dataOrder()->result();
        $data['menu'] = $this->Mcrud->get_all_data('tbl_menu')->result();
        $this->load->view("admin/order/index", $data,);
    }

    public function save()
    {
        $id = $this->input->post('id');
        $id_menu = $this->input->post('id_menu');
        $harga = $this->input->post('harga');
        $namaPemesan = $this->input->post('namaPemesan');
        $no_wa = $this->input->post('no_wa');
        $string = '+62' . substr(trim($no_wa), 1);
        $alamat = $this->input->post('alamat');
        $tgl_saji = $this->input->post('tgl_saji');
        $waktu_saji = $this->input->post('waktu_saji');
        $tgl_pesan = date('Y-m-d H:i:s');
        $jumlah = $this->input->post('jumlah');
        $total = $this->input->post('total');
        $status_bayar = "N";

        if ($namaPemesan == NULL) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data belum diisi!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('menu');
        } else {
            $data = array(
                'id' => $id,
                'id_menu' => $id_menu,
                'harga' => $harga,
                'namaPemesan' => $namaPemesan,
                'no_wa' => $string,
                'alamat' => $alamat,
                'tgl_saji' => $tgl_saji,
                'waktu_saji' => $waktu_saji,
                'tgl_pesan' => $tgl_pesan,
                'jumlah' => $jumlah,
                'total' => $total,
                'status_bayar' => $status_bayar
            );

            $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data baru berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            $this->Mcrud->insert('tbl_order', $data);
            redirect('Order');
        }
    }

    public function save_frontend()
    {
        $id = $this->input->post('id');
        $id_menu = $this->input->post('id_menu');
        $harga = $this->input->post('harga');
        $namaPemesan = $this->input->post('namaPemesan');
        $no_wa = $this->input->post('no_wa');
        $string = '+62' . substr(trim($no_wa), 1);
        $alamat = $this->input->post('alamat');
        $tgl_saji = $this->input->post('tgl_saji');
        $waktu_saji = $this->input->post('waktu_saji');
        $tgl_pesan = date('Y-m-d H:i:s');
        $jumlah = $this->input->post('jumlah');
        $total = $this->input->post('total');
        $status_bayar = "N";

        if ($namaPemesan == NULL) {
            $this->session->set_flashdata('alert', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data belum diisi!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('menu');
        } else {
            $data = array(
                'id' => $id,
                'id_menu' => $id_menu,
                'harga' => $harga,
                'namaPemesan' => $namaPemesan,
                'no_wa' => $string,
                'alamat' => $alamat,
                'tgl_saji' => $tgl_saji,
                'waktu_saji' => $waktu_saji,
                'tgl_pesan' => $tgl_pesan,
                'jumlah' => $jumlah,
                'total' => $total,
                'status_bayar' => $status_bayar
            );

            $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data baru berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            $this->Mcrud->insert('tbl_order', $data);
            redirect('Home/menu');
        }
    }

    public function getidmenu($id)
    {
        $dataWhere = array('id' => $id);
        $data['menu'] = $this->Mcrud->get_by_id('tbl_menu', $dataWhere)->row_object();
        $this->load->view('User/pesan', $data);
    }

    public function getid($id)
    {
        $dataWhere = array('id' => $id);
        $data['order'] = $this->Mcrud->get_by_id('tbl_order', $dataWhere)->row_object();
        $this->load->view('admin/order/form_edit', $data);
    }

    public function edit()
    {
        $id = $this->input->post('id');
        $id_menu = $this->input->post('id_menu');
        $harga = $this->input->post('harga');
        $namaPemesan = $this->input->post('namaPemesan');
        $no_wa = $this->input->post('no_wa');
        $alamat = $this->input->post('alamat');
        $tgl_saji = $this->input->post('tgl_saji');
        $waktu_saji = $this->input->post('waktu_saji');
        $jumlah = $this->input->post('jumlah');
        $total = $this->input->post('total');

        $data = array(
            'id_menu' => $id_menu,
            'harga' => $harga,
            'namaPemesan' => $namaPemesan,
            'no_wa' => $no_wa,
            'alamat' => $alamat,
            'tgl_saji' => $tgl_saji,
            'waktu_saji' => $waktu_saji,
            'jumlah' => $jumlah,
            'total' => $total,
        );


        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diupdate</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        $this->Mcrud->update('tbl_order', $data, 'id', $id);
        redirect('Order');
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $this->Mcrud->delete($where, 'tbl_order');
        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil dihapus!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('Order');
    }
}
