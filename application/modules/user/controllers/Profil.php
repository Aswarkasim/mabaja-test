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

  function update()
  {
    $id_user = $this->session->userdata('id_user');
    $i = $this->input;
    $data = [
      'namalengkap'   => $i->post('namalengkap'),
      'email'         => $i->post('email'),
      'tanggal_lahir'  => $i->post('tanggal_lahir'),
      'gender'        => $i->post('gender'),
      'nohp'          => $i->post('nohp'),
      'instagram'     => $i->post('instagram'),
      'facebook'      => $i->post('facebook'),
    ];
    $this->Crud_model->edit($this->table, 'id_user', $id_user, $data);
    $this->session->set_flashdata('msg', 'Data profil diperbaharui');
    redirect($this->base, 'refresh');
  }

  function uploadFoto()
  {
    $id_user = $this->session->userdata('id_user');
    $profil = $this->Crud_model->listingOne($this->table, 'id_user', $id_user);
    if (!empty($_FILES['foto']['name'])) {
      $config['upload_path']   = './assets/uploads/images/users/';
      $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
      $config['max_size']      = '100000'; // KB 
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('foto')) {
        $this->upload->display_errors();
        redirect('home/nikah/daftar/dataPria');
      } else {

        if ($profil->foto != "") {
          unlink($profil->foto);
        }
        $upload_data = ['uploads' => $this->upload->data()];
        $data = [
          'foto'        => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->edit($this->table, 'id_user', $id_user, $data);
        $this->session->set_flashdata('msg', 'Foto diperbaharui');
        redirect($this->base);
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
