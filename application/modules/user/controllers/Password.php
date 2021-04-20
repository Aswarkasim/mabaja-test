<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    //Do your magic here
  }


  public function index()
  {
    $id_user = $this->session->userdata('id_user');
    $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    // print_r($user);
    // die;

    $valid = $this->form_validation;

    $valid->set_rules('password_lama', 'Password Lama', 'required');
    $valid->set_rules('password', 'Password', 'required|min_length[6]', ['min_length' => 'Password minimal 6 karakter']);
    $valid->set_rules('re_password', 'Password', 'required|matches[password]');

    if ($valid->run() === FALSE) {
      $data = [
        'user'    => $user,
        'content'   => 'user/password/index'
      ];
      $this->load->view('home/layout/wrapper', $data, FALSE);
    } else {
      $i = $this->input;

      $pass = sha1($i->post('password_lama'));

      if ($pass != $user->password) {
        $data = [
          'error'     => 'Password lama yang dimasukkan tidak sama',
          'content'   => 'user/password/index'
        ];
        $this->load->view('home/layout/wrapper', $data, FALSE);
      } else {

        $data = [
          'password'      => sha1($i->post('password'))
        ];
        $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
        $this->load->view('home/layout/wrapper', $data, FALSE);
        $this->session->set_flashdata('msg', 'Password diubah');
        redirect('user/password', 'refresh');
      }
    }
  }
}

/* End of file Password.php */
