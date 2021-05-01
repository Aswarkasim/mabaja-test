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

    if (!empty($_FILES['petunjuk']['name'])) {
      $config['upload_path']   = './assets/uploads/images/';
      $config['allowed_types'] = 'gif|jpg|png|PNG|svg|jpeg|JPG|JPEG';
      $config['max_size']      = '24000'; // KB 
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('petunjuk')) {
        $this->upload->display_errors();
        $this->index($id_simulasi);
      } else {
        $upload_data = ['uploads' => $this->upload->data()];

        $i = $this->input;

        $data = [
          'urutan'   => $i->post('urutan'),
          'jumlah_soal'   => $i->post('jumlah_soal'),
          'id_simulasi' => $id_simulasi,
          'id_kolom'   => random_string(),
          'petunjuk'             => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->add('tbl_kolom', $data);
        $this->session->set_flashdata('msg', 'kolom berhasil ditambah');
        redirect('admin/kolom/index/' . $id_simulasi);
      }
    }
  }

  function edit($id_kolom)
  {
    $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $id_kolom);
    $valid = $this->form_validation;

    $i = $this->input;

    if (!empty($_FILES['petunjuk']['name'])) {
      $config['upload_path']   = './assets/uploads/images/';
      $config['allowed_types'] = 'gif|jpg|png|PNG|svg|jpeg|JPG|JPEG';
      $config['max_size']      = '24000'; // KB 
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('petunjuk')) {
        $this->upload->display_errors();
        $this->index($kolom->id_simulasi);
      } else {

        if ($kolom->petunjuk != "") {
          unlink($kolom->petunjuk);
        }

        $upload_data = ['uploads' => $this->upload->data()];

        $i = $this->input;

        $data = [
          'id_kolom'      => $id_kolom,
          'jumlah_soal'   => $i->post('jumlah_soal'),
          'id_simulasi'   => $kolom->id_simulasi,
          'petunjuk'             => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->edit('tbl_kolom', 'id_kolom', $id_kolom, $data);
        $this->session->set_flashdata('msg', 'kolom berhasil diubah');
        redirect('admin/kolom/index/' . $kolom->id_simulasi);
      }
    } else {
      $i = $this->input;

      $data = [
        'id_kolom'      => $id_kolom,
        'jumlah_soal'   => $i->post('jumlah_soal'),
        'id_simulasi'   => $kolom->id_simulasi,
      ];
      $this->Crud_model->edit('tbl_kolom', 'id_kolom', $id_kolom, $data);
      $this->session->set_flashdata('msg', 'kolom berhasil diubah');
      redirect('admin/kolom/index/' . $kolom->id_simulasi);
    }
  }

  function delete($id_kolom)
  {
    $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $id_kolom);
    $id_simulasi = $kolom->id_simulasi;

    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_kolom', $id_kolom);
    foreach ($soal as $row) {
      $this->Crud_model->delete('tbl_soal', 'id_soal', $row->id_soal);
    }

    $this->Crud_model->delete('tbl_kolom', 'id_kolom', $id_kolom);
    $this->session->set_flashdata('msg', 'data telah dihapus');
    redirect('admin/kolom/index/' . $id_simulasi);
  }
}
