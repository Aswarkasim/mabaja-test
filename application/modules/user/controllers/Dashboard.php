<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    is_logged_in_user();

    $id_user  = $this->session->userdata('id_user');
    __is_complete_data_profile($id_user);
    $this->load->model('akun/Akun_model', 'AM');
  }


  public function index()
  {
    $id_user = $this->session->userdata('id_user');
    $mypaket = $this->AM->myPaket($id_user);
    $paket = $this->Crud_model->listing('tbl_paket');
    $data = [
      'mypaket'   => $mypaket,
      'paket'   => $paket,
      'content'  => 'akun/dashboard/index'
    ];
    $this->load->view('akun/layout/wrapper', $data, FALSE);

    // $this->load->view('akun/dashboard/index', FALSE);
  }
}
