<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // is_logged_in_admin();
  }


  public function index()
  {
    $tombol  = [
      'add'     => 'admin/mapel/add',
      'edit'    => 'admin/mapel/edit/',
      'delete'  => 'admin/mapel/delete/'
    ];

    $mapel = $this->Crud_model->listing('tbl_mapel');
    $data = [

      'mapel' => $mapel,
      'tombol'   => $tombol,
      'content' => 'admin/mapel/index'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function add()
  {

    $this->load->helper('string');

    $valid = $this->form_validation;
    // $valid->set_rules('id_mapel', 'Kode Kaategori', 'macthes[tbl_mapel.id_mapel]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));
    $valid->set_rules('nama_mapel', 'Nama Kaategori', 'macthes[tbl_mapel.nama_mapel]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));


    if ($valid->run() === TRUE) {
      $this->index();
    } else {
      $i = $this->input;
      $data = [
        'nama_mapel'   => $i->post('nama_mapel'),
        'id_mapel'   => random_string()
      ];
      $this->Crud_model->add('tbl_mapel', $data);
      $this->session->set_flashdata('msg', 'mapel berhasil ditambah');
      redirect('admin/mapel');
    }
  }
  function edit($id_mapel)
  {
    $valid = $this->form_validation;
    // $valid->set_rules('id_mapel', 'Kode Kaategori', 'macthes[tbl_mapel.id_mapel]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));
    // $valid->set_rules('nama_mapel', 'Nama Kaategori', 'macthes[tbl_mapel.nama_mapel]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));


    if ($valid->run() === TRUE) {
      $this->index();
    } else {
      $i = $this->input;
      $data = [
        'nama_mapel'   => $i->post('nama_mapel'),
        'id_mapel'   => $id_mapel
      ];
      $this->Crud_model->edit('tbl_mapel', 'id_mapel', $id_mapel, $data);
      $this->session->set_flashdata('msg', 'mapel berhasil diedit');
      redirect('admin/mapel');
    }
  }

  function delete($id_mapel)
  {
    $this->Crud_model->delete('tbl_mapel', 'id_mapel', $id_mapel);
    $this->session->set_flashdata('msg', 'data telah dihapus');
    redirect('admin/mapel');
  }

  function is_active($id_mapel)
  {
    $mapel = $this->Crud_model->listing('tbl_mapel');

    foreach ($mapel as $row) {
      if ($row->id_mapel != $id_mapel) {
        $data = [
          'is_active' => 0
        ];
        $this->Crud_model->edit('tbl_mapel', 'id_mapel', $row->id_mapel, $data);
      } else {
        $data = [
          'is_active' => 1
        ];
        $this->Crud_model->edit('tbl_mapel', 'id_mapel', $id_mapel, $data);
      }
    }

    $this->index();
  }
}
