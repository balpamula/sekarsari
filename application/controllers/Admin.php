<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mcrud');
    }

    public function dashboard()
    {

        $data['total'] = $this->Mcrud->getPendapatan();
        $data['jmlOrder'] = $this->Mcrud->getOrder();
        $data['belumBayar'] = $this->Mcrud->getBelumBayar();
        $data['sudahBayar'] = $this->Mcrud->getSudahBayar();
        $this->load->view("admin/dashboard", $data);
    }

    public function index()
    {
        $this->load->view("admin/form_login");
    }
}
