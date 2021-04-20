<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{



  public function __construct()
  {
    parent::__construct();
    is_logged_in_admin();
  }


  public function index()
  {
    $id_simulasi = $this->session->userdata('id_simulasi');
    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_simulasi', $id_simulasi);
    $data = [
      'delete'   => 'admin/soal/delete/',
      'edit'     => 'admin/soal/edit/',
      'add'       => 'admin/soal/add',
      'soal'     => $soal,
      'id_simulasi'     => $id_simulasi,
      'content'  => 'admin/soal/index'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }


  function add()
  {

    $this->load->helper('string');
    $id_simulasi = $this->session->userdata('id_simulasi');

    $valid = $this->form_validation;

    $valid->set_rules('butir_soal', 'Butir Soal', 'required');

    if ($valid->run() === FALSE) {
      $data = [
        'title'     => 'Soal Simulasi',
        'add'       => 'admin/soal/add',
        'back'      => 'admin/soal',
        'simulasi'     => $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi),
        'content'   => 'admin/soal/add'
      ];
      $this->load->view('admin/layout/wrapper', $data, FALSE);
    } else {
      $i = $this->input;
      $fokus_tes = $i->post('fokus_tes_tka');
      if ($fokus_tes == '') {
        $fokus_tes = $i->post('fokus_tes_tps');
      }
      $data = [
        'id_soal'        => random_string(),
        'id_simulasi'       => $id_simulasi,
        'butir_soal'     => $i->post('butir_soal'),
        'no_soal'        => $i->post('no_soal')

      ];
      $this->Crud_model->add('tbl_soal', $data);

      $a = 'A';

      for ($i = 0; $i < 5; $i++) {
        $dataPilihan = [
          'id_pilihan'    => random_string(),
          'id_soal'       => $data['id_soal'],
          'anotasi'       => $a++
        ];
        $this->Crud_model->add('tbl_pilihan', $dataPilihan);
      }
      $this->session->set_flashdata('msg', 'ditambah');
      redirect('admin/soal/detail/' . $data['id_soal'], 'refresh');
    }
  }

  function detail($id_soal)
  {

    $this->load->model('admin/Soal_model', 'SM');
    $soal = $this->Crud_model->listingOne('tbl_soal', 'id_soal', $id_soal);
    $pilihan = $this->SM->listPilihan($id_soal);
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $soal->id_simulasi);
    $data = [
      'title'     => 'ID Soal Simulasi : ' . $id_soal,
      'add'       => 'admin/soal/add',
      'back'      => 'admin/soal',
      'simulasi'      => $simulasi,
      'soal'      => $soal,
      'pilihan'      => $pilihan,
      'content'   => 'admin/soal/detail'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function deleteSoal($id_soal)
  {
    $pilihan = $this->Crud_model->listingOneAll('tbl_pilihan', 'id_soal', $id_soal);
    for ($i = 0; $i < count($pilihan); $i++) {
      $this->Crud_model->delete('tbl_pilihan', 'id_soal', $id_soal);
    }
    $this->Crud_model->delete('tbl_soal', 'id_soal', $id_soal);
    $this->session->set_flashdata('msg', 'Soal dihapus');
    redirect('admin/soal');
  }

  function makeChoice()
  {
    $i = $this->input;
    $id_pilihan = $i->post('id_pilihan');
    $data  = [
      'butir_pilihan' => $i->post('butir_pilihan'),
      'poin' => $i->post('poin')
    ];
    $this->Crud_model->edit('tbl_pilihan', 'id_pilihan', $id_pilihan, $data);
    redirect('admin/soal/detail/' . $i->post('id_soal'));
  }

  function deleteChoice($id_soal, $id_pilihan)
  {
    $data = [
      'butir_pilihan' => '',
      'poin'          => ''
    ];
    $this->Crud_model->edit('tbl_pilihan', 'id_pilihan', $id_pilihan, $data);
    redirect('admin/soal/detail/' . $id_soal);
  }

  function is_trueChoice()
  {
    $id_soal = $this->input->post('id_soal');
    $id_pilihan = $this->input->post('id_pilihan');
    $data = [
      'id_pilihan' => $id_pilihan
    ];
    $this->Crud_model->edit('tbl_soal', 'id_soal', $id_soal, $data);
    redirect('admin/soal/detail/' . $id_soal);
  }

  function is_doneSoal($value, $id_soal)
  {
    if ($value == 0) {
      $id_simulasi = $this->session->userdata('id_simulasi');
      __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_active', $value);
    }
    $message = "";
    if ($value == '1') {
      $message = "Soal telah selesai dan disimpan";
    } else {
      $message = "Soal disimpan sebagai draft";
    }
    $data = [
      'is_done' => $value
    ];
    $this->Crud_model->edit('tbl_soal', 'id_soal', $id_soal, $data);
    $this->session->set_flashdata('msg', $message);
    redirect('admin/soal/detail/' . $id_soal);
  }

  function pembahasan($id_soal)
  {
    $soal = $this->Crud_model->listingOne('tbl_soal', 'id_soal', $id_soal);
    if (!empty($_FILES['pembahasan']['name'])) {
      $config['upload_path']   = './assets/uploads/pembahasan/';
      $config['allowed_types'] = 'pdf|doc|docx|xlx';
      $config['max_size']      = '100000'; // KB 
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('pembahasan')) {
        $this->upload->display_errors();
        redirect('admin/soal/detail/' . $id_soal);
      } else {
        if ($soal->pembahasan != "") {
          unlink($soal->pembahasan);
        }
        $upload_data = ['uploads' => $this->upload->data()];
        $data = [
          'pembahasan'        => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->edit('tbl_soal', 'id_soal', $id_soal, $data);
        $this->session->set_flashdata('msg', 'Pembahasan diupload');
        redirect('admin/soal/detail/' . $id_soal);
      }
    }
  }

  function upload()
  {
    if (isset($_FILES['upload']['name'])) {
      $file = $_FILES['upload']['tmp_name'];
      $file_name = $_FILES['upload']['name'];
      $file_name_array = explode(".", $file_name);
      $extension = end($file_name_array);
      $new_image_name = rand() . '.' . $extension;
      chmod('upload', 0777);
      $allowed_extension = array("jpg", "gif", "png");
      if (in_array($extension, $allowed_extension)) {
        move_uploaded_file($file, 'assets/uploads/soal/' . $new_image_name);
        $function_number = $_GET['CKEditorFuncNum'];
        $url = base_url() . 'assets/uploads/soal/' . $new_image_name;
        $message = '';
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
      }
    }
  }
}
