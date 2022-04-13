 <?php

  defined('BASEPATH') or exit('No direct script access allowed');

  class Riwayat extends CI_Controller
  {

    public function __construct()
    {
      parent::__construct();
      is_logged_in_user();

      $this->load->model('user/User_model', 'UM');
    }


    public function index()
    {
      $id_user = $this->session->userdata('id_user');
      $riwayat = $this->UM->listRiwayat($id_user);
      $data = [
        'riwayat'   => $riwayat,
        'content'   => 'user/riwayat/index'
      ];
      $this->load->view('home/layout/wrapper', $data, FALSE);
    }
  }


  ?>