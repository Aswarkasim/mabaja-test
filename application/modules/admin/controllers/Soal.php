<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{



  public function __construct()
  {
    parent::__construct();
    is_logged_in_admin();
    $this->load->model('admin/Soal_model', 'SM');
  }


  public function index()
  {
    $id_simulasi = $this->session->userdata('id_simulasi');
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_simulasi', $id_simulasi);
    $data = [
      'delete'   => 'admin/soal/delete/',
      'edit'     => 'admin/soal/edit/',
      'add'       => 'admin/soal/add',
      'soal'     => $soal,
      'simulasi'     => $simulasi,
      'id_simulasi'     => $id_simulasi,
      'content'  => 'admin/soal/index'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }


  function add()
  {

    $this->load->helper('string');
    $id_simulasi = $this->session->userdata('id_simulasi');
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);

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
        'klasifikasi'     => $i->post('klasifikasi'),
        'no_soal'        => $i->post('no_soal')

      ];
      $this->Crud_model->add('tbl_soal', $data);

      $a = 'A';
      $option = 5;
      switch ($simulasi->type_option) {
        case 'B':
          $option = 2;
          break;
        case 'C':
          $option = 3;
          break;
        case 'D':
          $option = 4;
          break;
        case 'E':
          $option = 5;
          break;
        case 'F':
          $option = 6;
          break;
        case 'G':
          $option = 7;
          break;
        case 'H':
          $option = 8;
          break;
      }

      for ($i = 0; $i < $option; $i++) {
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
    $id_simulasi = $this->session->userdata('id_simulasi');
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);

    if ($simulasi->id_mapel == 'RPIuQJc5') {
      $jawaban_kecermatan = $this->Crud_model->listingOneAll('tbl_jawaban_kecermatan', 'id_soal', $id_soal);
      foreach ($jawaban_kecermatan as $row) {
        $this->Crud_model->delete('tbl_jawaban_kecermatan', 'id_jawaban_kecermatan', $row->id_jawaban_kecermatan);
      }
    }

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

  function addDocumentSoal()
  {
    $this->load->helper('string');
    $id_simulasi = $this->session->userdata('id_simulasi');
    $i = $this->input;
    if (!empty($_FILES['soal_kecermatan']['name'])) {
      $config['upload_path']   = './assets/uploads/dokumen/';
      $config['allowed_types'] = 'pdf|doc|docx|xlx';
      $config['max_size']      = '100000'; // KB 
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('soal_kecermatan')) {
        $this->upload->display_errors();
        print_r('galgal');
        die;
        redirect('admin/soal/add/');
      } else {

        $upload_data = ['uploads' => $this->upload->data()];
        $data = [
          'id_soal'        => random_string(),
          'id_simulasi'       => $id_simulasi,
          'no_sesi' => $this->input->post('no_sesi'),
          'soal_kecermatan'        => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->add('tbl_soal', $data);

        $no_soal = 1;

        for ($i = 1; $i <= 4; $i++) {
          $dataJawaban = [
            'id_jawaban_kecermatan'     => random_string(),
            'id_soal'                   => $data['id_soal'],
            'no_soal_kecermatan'                   => $no_soal++
          ];
          $this->Crud_model->add('tbl_jawaban_kecermatan', $dataJawaban);
        }
        $this->session->set_flashdata('msg', 'Soal ditambahkan');
        redirect('admin/soal/detailKecermatan/' . $data['id_soal']);
      }
    } else {
      print_r('gagal');
      die;
    }
  }

  function detailKecermatan($id_soal)
  {


    $soal = $this->Crud_model->listingOne('tbl_soal', 'id_soal', $id_soal);
    $jawaban_kecermatan = $this->SM->listJawabanKecermatan($id_soal);
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $soal->id_simulasi);
    $data = [
      'title'     => 'ID Soal Simulasi : ' . $id_soal,
      'add'       => 'admin/soal/add',
      'back'      => 'admin/soal',
      'simulasi'      => $simulasi,
      'soal'      => $soal,
      'jawaban_kecermatan'      => $jawaban_kecermatan,
      'content'   => 'admin/soal/kecermatan'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  //bagaimana cara mengambil id jawaban kecermatan??
  function makeChoiceKecermatan()
  {
    $i = $this->input;

    $id_soal = $i->post('id_soal');
    $no_soal = $i->post('no_soal');

    $jawaban = $this->SM->getIdJawabanKecermatan($id_soal, $no_soal);

    $data  = [
      'jawaban' => $i->post('jawaban')
    ];
    $this->Crud_model->edit('tbl_jawaban_kecermatan', 'id_jawaban_kecermatan', $jawaban->id_jawaban_kecermatan, $data);
    redirect('admin/soal/detailKecermatan/' . $i->post('id_soal'));
  }

  //DeleteChoiceKecermatan



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
