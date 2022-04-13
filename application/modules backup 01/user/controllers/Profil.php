<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{

  protected $table = 'tbl_user';
  protected $base = 'akun/profil';


  public function __construct()
  {
    parent::__construct();
    is_logged_in_user();
  }



  public function index()
  {
    $id_user = $this->session->userdata('id_user');
    $profil = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    $data = [
      'profil'   => $profil,
      'content'   => 'user/profil/index'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);

    // $this->load->view('home/index', FALSE);
  }


  public function edit()
  {
    $id_user = $this->session->userdata('id_user');
    $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    // print_r($user);
    // die;

    $valid = $this->form_validation;

    $valid->set_rules('namalengkap', 'Password Lama', 'required');

    if ($valid->run() === FALSE) {
      $data = [
        'user'    => $user,
        'content'   => 'user/profil/edit'
      ];
      $this->load->view('home/layout/wrapper', $data, FALSE);
    } else {
      $i = $this->input;
      $data = [
        'namalengkap'       => $i->post('namalengkap'),
        'gender'            => $i->post('gender'),
        'tanggal_lahir'     => $i->post('tanggal_lahir'),
        'nohp'              => $i->post('nohp')
      ];
      $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
      $this->load->view('home/layout/wrapper', $data, FALSE);
      $this->session->set_flashdata('msg', 'Password diubah');
      redirect('user/profil', 'refresh');
    }
  }


  function ubahGambar()
  {
    $id_user = $this->session->userdata('id_user');
    $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
    if (!empty($_FILES['foto']['name'])) {
      $config['upload_path']   = './assets/uploads/images/';
      $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
      $config['max_size']      = '24000'; // KB 
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('foto')) {
        $this->upload->display_errors();
        redirect('user/profil');
      } else {
        if ($user->foto != "") {
          unlink($user->foto);
        }
        $upload_data = ['uploads' => $this->upload->data()];
        $data = [
          'foto'        => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
        $this->session->set_flashdata('msg', 'Gamba diubah');
        redirect('user/profil');
      }
    }
  }

  function hapusFoto()
  {
    $id_user = $this->session->userdata('id_user');
    $foto = $this->Crud_model->listingOne($this->table, 'id_user', $id_user)->foto;
    if ($foto != "") {
      unlink($foto);
    }
    $data = [
      'foto'   => ""
    ];
    $this->Crud_model->edit($this->table, 'id_user', $id_user, $data);
    $this->session->set_flashdata('msg', 'Foto dihapus');
    redirect($this->base);
  }
}
