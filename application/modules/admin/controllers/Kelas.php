<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in_admin();

    $this->load->model('admin/Admin_model', 'AM');
    $this->load->model('admin/Soal_model', 'SM');
  }


  public function index()
  {
    $tombol  = [
      'add'     => 'admin/kelas/add',
      'edit'    => 'admin/kelas/edit/',
      'delete'  => 'admin/kelas/delete/'
    ];
    $kelas = $this->AM->listKelas();
    $mapel = $this->Crud_model->listing('tbl_mapel');

    $data = [
      'kelas' => $kelas,
      'mapel' => $mapel,
      'tombol'   => $tombol,
      'content' => 'admin/kelas/index'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function add()
  {

    $this->load->helper('string');

    $valid = $this->form_validation;
    // $valid->set_rules('id_kelas', 'Kode Kaategori', 'macthes[tbl_kelas.id_kelas]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));
    $valid->set_rules('nama_kelas', 'Nama Kaategori', 'macthes[tbl_kelas.nama_kelas]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));


    if ($valid->run() === TRUE) {
      $this->index();
    } else {
      $i = $this->input;
      $data = [
        'nama_kelas'   => $i->post('nama_kelas'),
        'id_kelas'   => random_string()
      ];
      $this->Crud_model->add('tbl_kelas', $data);
      $this->session->set_flashdata('msg', 'kelas berhasil ditambah');
      redirect('admin/kelas', 'refresh');
    }
  }
  function edit($id_kelas)
  {
    $valid = $this->form_validation;
    // $valid->set_rules('id_kelas', 'Kode Kaategori', 'macthes[tbl_kelas.id_kelas]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));
    // $valid->set_rules('nama_kelas', 'Nama Kaategori', 'macthes[tbl_kelas.nama_kelas]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));


    if ($valid->run() === TRUE) {
      $this->index();
    } else {
      $i = $this->input;
      $data = [
        'nama_kelas'   => $i->post('nama_kelas'),
        'id_kelas'   => $id_kelas
      ];
      $this->Crud_model->edit('tbl_kelas', 'id_kelas', $id_kelas, $data);
      $this->session->set_flashdata('msg', 'kelas berhasil diedit');
      redirect('admin/kelas', 'refresh');
    }
  }

  function delete($id_kelas)
  {
    $user = $this->Crud_model->listingOneAll('tbl_user', 'id_kelas', $id_kelas);
    foreach ($user as $row) {
      __is_boolean('tbl_user', 'id_user', $row->id_user, 'id_kelas', null);
    }
    $this->Crud_model->delete('tbl_kelas', 'id_kelas', $id_kelas);
    $this->session->set_flashdata('msg', 'data telah dihapus');
    redirect('admin/kelas', 'refresh');
  }

  function is_active($value, $id_kelas)
  {
    __is_boolean('tbl_kelas', 'id_kelas', $id_kelas, 'is_active', $value);
    $this->session->set_flashdata('msg', 'Kelas diaktifkan');
    redirect('admin/kelas', 'refresh');
  }

  function cheangeMapel($id_kelas, $id_mapel = null)
  {

    if ($id_mapel === 'KqyMAXUx') {
      $paket = $this->Crud_model->listingOneAll('tbl_paket', 'is_active', 1);
      if ($paket) {
        __is_boolean('tbl_kelas', 'id_kelas', $id_kelas, 'id_mapel', $id_mapel);
        $this->session->set_flashdata('msg', 'Mapel diubah');
      } else {
        $this->session->set_flashdata('msg_er', 'Tidak paket POLRI yang Aktif yang aktif');
      }
      redirect('admin/kelas', 'refresh');
    } else {

      $simulasi = $this->SM->cekSimulasiActive($id_mapel);

      if (count($simulasi) >= 1) {
        __is_boolean('tbl_kelas', 'id_kelas', $id_kelas, 'id_mapel', $id_mapel);
        $this->session->set_flashdata('msg', 'Mapel diubah');
      } else {
        $this->session->set_flashdata('msg_er', 'Tidak ada simulasi yang aktif');
      }
      redirect('admin/kelas', 'refresh');
    }
  }
}
