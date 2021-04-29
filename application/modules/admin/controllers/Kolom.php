<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Kolom extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // is_logged_in_admin();

    $this->load->model('admin/Soal_model', 'SM');
  }


  public function index($id_simulasi)
  {

    $tombol  = [
      'add'     => 'admin/kolom/add',
      'edit'    => 'admin/kolom/edit/',
      'delete'  => 'admin/kolom/delete/'
    ];

    $kolom = $this->Crud_model->listingOneAll('tbl_kolom', 'id_simulasi', $id_simulasi);
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $data = [
      'simulasi' => $simulasi,
      'kolom' => $kolom,
      'tombol'   => $tombol,
      'content' => 'admin/kolom/index'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function detail($id_kolom)
  {

    $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $id_kolom);
    $soal = $this->SM->listKecermatan($id_kolom);
    $data = [
      'back'  => 'admin/kolom/index/' . $kolom->id_simulasi,
      'kolom' => $kolom,
      'soal' => $soal,
      'content' => 'admin/kolom/detail'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function add()
  {

    $this->load->helper('string');
    $i = $this->input;

    $id_simulasi = $i->post('id_simulasi');

    $data = [
      'urutan'   => $i->post('urutan'),
      'jumlah_soal'   => $i->post('jumlah_soal'),
      'id_simulasi' => $id_simulasi,
      'id_kolom'   => random_string()
    ];
    $this->Crud_model->add('tbl_kolom', $data);
    $this->session->set_flashdata('msg', 'kolom berhasil ditambah');
    redirect('admin/kolom/index/' . $id_simulasi);
  }
  function edit($id_kolom)
  {
    $valid = $this->form_validation;

    $i = $this->input;
    $data = [
      'nama_kolom'   => $i->post('nama_kolom'),
      'id_kolom'   => $id_kolom
    ];
    $this->Crud_model->edit('tbl_kolom', 'id_kolom', $id_kolom, $data);
    $this->session->set_flashdata('msg', 'kolom berhasil diedit');
    redirect('admin/kolom');
  }

  function delete($id_kolom)
  {
    $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $id_kolom);
    $id_simulasi = $kolom->id_simulasi;
    $this->Crud_model->delete('tbl_kolom', 'id_kolom', $id_kolom);
    $this->session->set_flashdata('msg', 'data telah dihapus');
    redirect('admin/kolom/index/' . $id_simulasi);
  }
}
