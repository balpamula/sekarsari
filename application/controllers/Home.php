<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
    }

    public function index()
    {
        $data['menu'] = $this->Mcrud->get_all_data('tbl_menu')->result();
        $this->load->view("user/index", $data);
    }

    // public function menu()
    // {
    //     $data['cekdata'] = $this->Mcrud->cek('tbl_menu');
    //     $data['menu'] = $this->Mcrud->get_all_data('tbl_menu')->result();
    //     $this->load->view("user/menu", $data);
    // }

    public function order($id)
    {
        $dataWhere = array('id' => $id);
        $data['menu'] = $this->Mcrud->get_by_id('tbl_menu', $dataWhere)->row_object();
        $this->load->view('User/order', $data);
    }

    public function payment()
    {
        $this->load->view("user/payment");
    }

    public function save_order()
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

            $this->session->set_flashdata('alert', '<div class="modal fade" id="alertModal" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Informasi</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="alert alert-success" role="alert">
                                                                        <h4 class="alert-heading">Terima kasih sudah memesan!</h4>
                                                                        <hr>
                                                                        <p>Tunggu pesan WhatsApp dari kami untuk informasi pemesanan anda!</p>
                                                                        <hr>
                                                                        <p class="mb-0">Pastikan data yang anda masukkan sudah benar ya!</p>
                                                                    </div>                                                               
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>');
            $this->Mcrud->insert('tbl_order', $data);
            redirect('Home');
        }
    }

    public function save_bayar()
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
        $this->session->set_flashdata('alert', '<div class="modal fade" id="alertModal" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Informasi</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="alert alert-success" role="alert">
                                                                    <h4 class="alert-heading">Konfirmasi pembayaran diterima!</h4>
                                                                    <hr>
                                                                    <p>Nota pembayaran akan dikirimkan melalui pesan WhatsApp!</p>
                                                                </div>                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>');

        $this->Mcrud->insert('tbl_payment', $data);
        redirect('Home');
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
            // Kirim order error ke browser
            echo json_encode(array("error" => "Kode pesanan tidak ditemukan"));
        }
    }
}
