<?php

class Login extends CI_Controller
{

    public function aksi_login()
    {
        $this->load->model('Mlogin');
        $u = $this->input->post('username');
        $p = $this->input->post('password');

        $cek = $this->Mlogin->cek_login($u, $p)->num_rows();
        if ($cek == 1) {
            $data_session = array(
                'userName' => $u,
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect('Admin/dashboard');
        } else {
            $error_msg = "Username atau password salah";
            $this->session->set_flashdata('error_msg', $error_msg);
            redirect('Admin');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Admin');
    }
}
