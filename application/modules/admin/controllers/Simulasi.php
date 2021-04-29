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
      'add'      => 'admin/simulasi/add/',
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
            'back'    => 'admin/simulasi/detail/' . $this->uri->segment(4),
            'mapel'   => $mapel,
            'error'     => $this->upload->display_errors(),
            'content'  => 'admin/simulasi/add'
          ];
          $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
          $upload_data = ['uploads' => $this->upload->data()];

          $i = $this->input;

          $jumlah_kolom = $i->post('jumlah_kolom');
          $data = [
            'id_simulasi'       => random_string('numeric'),
            'nama_simulasi'     => $i->post('nama_simulasi'),
            'id_mapel'          => $i->post('id_mapel'),
            'waktu'             => $i->post('waktu'),
            'jumlah_kolom'      => $jumlah_kolom,
            'jumlah_soal'       => $i->post('jumlah_soal'),
            'cover'             => $config['upload_path'] . $upload_data['uploads']['file_name']
          ];
          $this->Crud_model->add('tbl_simulasi', $data);


          // $a = 1;
          // for ($i = 1; $i <= $jumlah_kolom; $i++) {

          //   $kolom = [
          //     'id_kolom' => random_string('numeric'),
          //     'id_simulasi' => $data['id_simulasi'],
          //     'nama_kolom' => 'Kolom ' . $a++
          //   ];
          //   $this->Crud_model->add('tbl_kolom', $kolom);
          // }

          $this->session->set_flashdata('msg', 'Simulasi ditambahkan');
          redirect('admin/simulasi/index/' . $data['id_mapel']);
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

    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_simulasi', $id_simulasi);
    $i = $this->input;
    $jumlah_soal = $i->post('jumlah_soal');

    if (count($soal) > $jumlah_soal) {
      $this->session->set_flashdata('msg_er', 'Hapus soal terlebih dahulu sebelum mengubah jumlah');
      redirect('admin/soal');
    } else {
      if (count($soal) < $jumlah_soal) {
        __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_active', '0');
      }
      $data = [
        'nama_simulasi'  => $i->post('nama_simulasi'),
        'jumlah_soal' => $jumlah_soal,
        'waktu'       => $i->post('waktu')
      ];
      $this->Crud_model->edit('tbl_simulasi', 'id_simulasi', $id_simulasi, $data);
      $this->session->set_flashdata('msg', 'Simulasi diubah');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    }
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

    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $id_mapel = $simulasi->id_mapel;

    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_simulasi', $id_simulasi);

    foreach ($soal as $row) {
      $this->Crud_model->delete('tbl_soal', 'id_soal', $row->id_soal);
    }

    $this->Crud_model->delete('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $this->session->set_flashdata('msg', 'dihapus');
    redirect('admin/mapel/index/' . $id_mapel);
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
    $soal = $this->SM->countSoalDone($id_simulasi);
    if ($simulasi->jumlah_soal != count($soal)) {
      $this->session->set_flashdata('msg_er', 'Jumlah soal belum cukup');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    } else {
      __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_active', $value);
      $this->session->set_flashdata('msg', 'Simulasi diaktifkan');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    }
  }


  function uploadCover()
  {
    $id_simulasi = $this->session->userdata('id_simulasi');
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    if (!empty($_FILES['cover']['name'])) {
      $config['upload_path']   = './assets/uploads/images/';
      $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
      $config['max_size']      = '100000'; // KB 
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('cover')) {
        $this->upload->display_errors();
        redirect('admin/simulasi/detail/' . $id_simulasi);
      } else {

        if ($simulasi->cover != "") {
          unlink($simulasi->cover);
        }
        $upload_data = ['uploads' => $this->upload->data()];
        $data = [
          'cover'        => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->edit('tbl_simulasi', 'id_simulasi', $id_simulasi, $data);
        $this->session->set_flashdata('msg', 'Foto diperbaharui');
        redirect('admin/simulasi/detail/' . $id_simulasi);
      }
    }
  }

  function deleteMember($id_member)
  {
    $member = $this->Crud_model->listingOne('tbl_member', 'id_member', $id_member);
    $id_simulasi = $member->id_simulasi;
    $task = $this->Crud_model->listingOneAll('tbl_task', 'id_member', $id_member);
    foreach ($task as $row) {
      $this->Crud_model->delete('tbl_task', 'id_task', $row->id_task);
    }
    $this->Crud_model->delete('tbl_member', 'id_member', $id_member);
    $this->session->set_flashdata('msg', 'Ujian dapat diulangi');
    redirect('admin/simulasi/detail/' . $id_simulasi);
  }
}
