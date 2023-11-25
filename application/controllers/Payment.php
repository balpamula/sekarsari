<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
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
        $data['cekdata'] = $this->Mcrud->cek('tbl_payment');
        $data['payment'] = $this->Mcrud->dataPayment()->result();
        $this->load->view("admin/payment/index", $data);
    }

    public function status_bayar_Y($id)
    {
        $where = array('id' => $id);
        $status = $this->Mcrud->get_by_id('tbl_order', $where)->row_object();

        $update = array('status_bayar' => "Y");

        $this->Mcrud->update('tbl_order', $update, 'id', $id);
        redirect('Payment');
    }

    public function status_bayar_N($id)
    {
        $where = array('id' => $id);
        $status = $this->Mcrud->get_by_id('tbl_order', $where)->row_object();

        $update = array('status_bayar' => "N");

        $this->Mcrud->update('tbl_order', $update, 'id', $id);
        redirect('Payment');
    }

    public function add()
    {
        $this->load->view("admin/payment/form_add");
    }

    public function get_order_id($id)
    {
        $id = $this->input->post('id');
        $data = $this->Mcrud->get_order_id($id);
        echo json_encode($data);
    }

    public function getDataOrder($id)
    {
        // Ambil data order dari database
        $order = $this->Mcrud->getOrderById($id);

        // Cek apakah data ditemukan
        if ($order) {
            // Kirim data order kembali ke browser dalam format JSON
            echo json_encode($order);
        } else {
            // Kirim pesan error ke browser
            echo json_encode(array("error" => "Data order tidak ditemukan"));
        }
    }

    public function save()
    {

        $config['upload_path']          = './upload/bukti/';
        $config['allowed_types']        = 'gif|jpg|JPG|png|PNG';
        $config['max_size']             = 10000; // maksimal ukuran
        $config['max_width']            = 10000; //lebar maksimal
        $config['max_height']           = 10000; //tinggi maksimal
        $config['overwrite']            = true;
        $this->load->library('upload', $config);

        $this->upload->do_upload('bukti');

        $id = $this->input->post('id');
        $id_pesan = $this->input->post('id_pesan');
        $bukti = $this->upload->data();
        $bukti = $bukti['file_name'];
        $waktu_konfirmasi = date('Y-m-d H:i:s');

        $data = array(
            'id' => $id,
            'id_pesan' => $id_pesan,
            'bukti' => $bukti,
            'waktu_konfirmasi' => $waktu_konfirmasi
        );


        $this->Mcrud->insert('tbl_payment', $data);
        redirect('Payment');
    }

    public function save_frontend()
    {

        $config['upload_path']          = './upload/bukti/';
        $config['allowed_types']        = 'gif|jpg|JPG|png|PNG';
        $config['max_size']             = 10000; // maksimal ukuran
        $config['max_width']            = 10000; //lebar maksimal
        $config['max_height']           = 10000; //tinggi maksimal
        $config['overwrite']            = true;
        $this->load->library('upload', $config);

        $this->upload->do_upload('bukti');

        $id = $this->input->post('id');
        $id_pesan = $this->input->post('id_pesan');
        $bukti = $this->upload->data();
        $bukti = $bukti['file_name'];
        $waktu_konfirmasi = date('Y-m-d H:i:s');

        $data = array(
            'id' => $id,
            'id_pesan' => $id_pesan,
            'bukti' => $bukti,
            'waktu_konfirmasi' => $waktu_konfirmasi
        );


        $this->Mcrud->insert('tbl_payment', $data);
        redirect('Home/payment');
    }
}
