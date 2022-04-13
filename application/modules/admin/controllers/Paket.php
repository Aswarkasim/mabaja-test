<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // is_logged_in_admin();
  }


  public function index()
  {
    $tombol  = [
      'add'     => 'admin/paket/add',
      'edit'    => 'admin/paket/edit/',
      'delete'  => 'admin/paket/delete/'
    ];

    $paket = $this->Crud_model->listing('tbl_paket');
    $data = [

      'paket' => $paket,
      'tombol'   => $tombol,
      'content' => 'admin/paket/index'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function detail($id_paket)
  {
    $simulasi = $this->Crud_model->listingOneAll('tbl_simulasi', 'id_paket', $id_paket);
    $paket = $this->Crud_model->listingOne('tbl_paket', 'id_paket', $id_paket);
    $data = [
      'simulasi'    => $simulasi,
      'paket'    => $paket,
      // 'add'      => 'admin/simulasi/add/',
      // 'edit'      => 'admin/simulasi/edit/',
      // 'delete'      => 'admin/simulasi/delete/',
      'title'     => 'Simulasi ',
      'content'   => 'admin/paket/detail'
    ];
    // }

    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function add()
  {

    $this->load->helper('string');

    $valid = $this->form_validation;
    // $valid->set_rules('id_paket', 'Kode Kaategori', 'macthes[tbl_paket.id_paket]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));
    $valid->set_rules('nama_paket', 'Nama Kaategori', 'macthes[tbl_paket.nama_paket]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));


    if ($valid->run() === TRUE) {
      $this->index();
    } else {

      $i = $this->input;
      $data = [
        'nama_paket'   => $i->post('nama_paket'),
        'id_paket'   => random_string()
      ];
      $this->Crud_model->add('tbl_paket', $data);

      $data = [
        'id_simulasi'       => random_string('numeric'),
        'nama_simulasi'     => 'Kecerdasan',
        'id_mapel'          => 'UxWSqb6E',
        'id_paket'          => $data['id_paket'],
        'waktu'             => 120,
        'jumlah_soal'       => 100,
        'type_option'       => 'E',
      ];
      $this->Crud_model->add('tbl_simulasi', $data);

      $data = [
        'id_simulasi'       => random_string('numeric'),
        'nama_simulasi'     => 'Kepribadian',
        'id_mapel'          => 'mrHXIR2D',
        'id_paket'          => $data['id_paket'],
        'waktu'             => 120,
        'jumlah_soal'       => 100,
        'type_option'       => 'E',
      ];
      $this->Crud_model->add('tbl_simulasi', $data);


      $data = [
        'id_simulasi'       => random_string('numeric'),
        'nama_simulasi'     => 'Kecermatan',
        'id_mapel'          => 'RPIuQJc5',
        'id_paket'          => $data['id_paket'],
        'waktu'             => 2,
        'jumlah_kolom'      => 5,
        'jumlah_soal'       => 100,
        'type_option'       => 'E',
      ];
      $this->Crud_model->add('tbl_simulasi', $data);

      $this->session->set_flashdata('msg', 'paket berhasil ditambah');
      redirect('admin/paket', 'refresh');
    }
  }
  function edit($id_paket)
  {
    $valid = $this->form_validation;
    // $valid->set_rules('id_paket', 'Kode Kaategori', 'macthes[tbl_paket.id_paket]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));
    // $valid->set_rules('nama_paket', 'Nama Kaategori', 'macthes[tbl_paket.nama_paket]', array('matches' => '%s telah ada. Silahkan masukkan kode yang lain'));


    if ($valid->run() === TRUE) {
      $this->index();
    } else {
      $i = $this->input;
      $data = [
        'nama_paket'   => $i->post('nama_paket'),
        'id_paket'   => $id_paket
      ];
      $this->Crud_model->edit('tbl_paket', 'id_paket', $id_paket, $data);
      $this->session->set_flashdata('msg', 'paket berhasil diedit');
      redirect('admin/paket', 'refresh');
    }
  }

  function delete($id_paket)
  {
    $this->Crud_model->delete('tbl_paket', 'id_paket', $id_paket);
    $this->session->set_flashdata('msg', 'data telah dihapus');
    redirect('admin/paket', 'refresh');
  }

  function is_active($id_paket, $value)
  {

    $this->load->model('admin/Soal_model', 'SM');

    $simulasi = $this->SM->cekSimulasiPaket($id_paket);
    // die($simulasi);
    if (count($simulasi) === 3) {
      $data = [
        'is_active' => $value
      ];
      $this->Crud_model->edit('tbl_paket', 'id_paket', $id_paket, $data);
      $this->session->set_flashdata('msg', 'Paket telah diaktifkan');
      redirect('admin/paket/detail/' . $id_paket, 'refresh');
    } else {
      $this->session->set_flashdata('msg', 'Masih ada simulasi yang belum Aktif');
      redirect('admin/paket/detail/' . $id_paket, 'refresh');
    }
  }
}
