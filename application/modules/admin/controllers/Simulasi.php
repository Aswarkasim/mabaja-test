<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Simulasi extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in_admin();
    $this->load->model('admin/Soal_model', 'SM');
  }

  public function index($id_mapel = null)
  {
    if ($id_mapel) {
      $simulasi = $this->SM->listSimulasiMapel($id_mapel);
    } else {
      $simulasi = $this->SM->listSimulasi();
    }

    $data = [
      'simulasi'    => $simulasi,
      'add'      => 'admin/simulasi/add',
      'edit'      => 'admin/simulasi/edit/',
      'delete'      => 'admin/simulasi/delete/',
      'title'     => 'Simulasi',
      'content'   => 'admin/simulasi/index'
    ];

    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  public function add()
  {

    $this->load->helper('string');
    $mapel = $this->Crud_model->listing('tbl_mapel');


    $required = '%s tidak boleh kosong';
    $valid = $this->form_validation;
    $valid->set_rules('nama_simulasi', 'Nama Simulasi', 'required', ['required' => $required]);
    if ($valid->run()) {
      if (!empty($_FILES['cover']['name'])) {
        $config['upload_path']   = './assets/uploads/images/';
        $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
        $config['max_size']      = '24000'; // KB 
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('cover')) {
          $data = [
            'title'    => 'Tambah Simulasi',
            'add'    => 'admin/simulasi/add',
            'back'    => 'admin/simulasi',
            'mapel'   => $mapel,
            'error'     => $this->upload->display_errors(),
            'content'  => 'admin/simulasi/add'
          ];
          $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
          $upload_data = ['uploads' => $this->upload->data()];

          $i = $this->input;

          $data = [
            'id_simulasi'       => random_string('numeric'),
            'nama_simulasi'     => $i->post('nama_simulasi'),
            'id_mapel'       => $i->post('id_mapel'),
            'waktu'             => $i->post('waktu'),
            'jumlah_soal'       => $i->post('jumlah_soal'),
            'cover'             => $config['upload_path'] . $upload_data['uploads']['file_name']
          ];
          $this->Crud_model->add('tbl_simulasi', $data);
          $this->session->set_flashdata('msg', 'Simulasi ditambahkan');
          redirect('admin/simulasi');
        }
      }
    }
    $data = [
      'title'    => 'Tambah Simulasi',
      'add'    => 'admin/simulasi/add',
      'back'    => 'admin/simulasi',
      'mapel'   => $mapel,
      'content'  => 'admin/simulasi/add'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }



  function edit($id_simulasi)
  {

    $i = $this->input;
    $data = [
      'nama_simulasi'  => $i->post('nama_simulasi'),
      'jumlah_soal' => $i->post('jumlah_soal'),
      'waktu'       => $i->post('waktu')
    ];
    $this->Crud_model->edit('tbl_simulasi', 'id_simulasi', $id_simulasi, $data);
    $this->session->set_flashdata('msg', 'Simulasi diubah');
    redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
  }

  function detail($id_simulasi)
  {

    if ($this->session->userdata('id_simulasi')) {
      $this->session->unset_userdata('id_simulasi');
      $this->session->set_userdata('id_simulasi', $id_simulasi);
    } else {
      $this->session->set_userdata('id_simulasi', $id_simulasi);
    }

    $simulasi = $this->SM->detailSimulasi($id_simulasi);
    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_simulasi', $id_simulasi);
    $member = $this->SM->listMember($id_simulasi, '50');


    $data = [
      'simulasi'  => $simulasi,
      'simulasi'  => $simulasi,
      'member'  => $member,
      'content'  => 'admin/simulasi/detail'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function delete($id_simulasi)
  {

    $this->Crud_model->delete('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $this->session->set_flashdata('msg', 'dihapus');
    redirect('admin/simulasi');
  }

  function editPetunjuk()
  {
    $id_simulasi = $this->session->userdata('id_simulasi');
    $data = [
      'petunjuk' => $this->input->post('petunjuk')
    ];
    $this->Crud_model->edit('tbl_simulasi', 'id_simulasi', $id_simulasi, $data);
    $this->session->set_flashdata('msg', 'Petunjuk diperbaharui');
    redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
  }

  function is_active($id_simulasi, $value)
  {
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_simulasi', $id_simulasi);
    if ($simulasi->jumlah_soal != count($soal)) {
      $this->session->set_flashdata('msg_er', 'Jumlah soal belum cukup');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    } else {
      __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_active', $value);
      $this->session->set_flashdata('msg', 'Simulasi diaktifkan');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    }
  }


  function is_pembahasan($id_simulasi, $value)
  {
    __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_pembahasan', $value);
    $this->session->set_flashdata('msg', 'Pembahasan simulasi diaktifkan');
    redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
  }
  function is_rangking($id_simulasi, $value)
  {

    __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_rangking', $value);
    $this->session->set_flashdata('msg', 'Rangking simulasi diaktifkan');
    redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
  }
}
