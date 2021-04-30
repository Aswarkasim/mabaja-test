<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecermatan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('home/Home_model', 'HM');
    $this->load->model('home/Soal_model', 'SM');
  }


  public function index()
  {
    $data = [
      'content'  => 'home/soal/kecermatan'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }

  function petunjuk($id_simulasi)
  {


    $this->load->helper('string');
    $id_user = $this->session->userdata('id_user');
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $kolom = $this->Crud_model->listingOneAll('tbl_kolom', 'id_simulasi', $id_simulasi);
    $member = $this->HM->detailMemberKecermatanPetunjuk($id_user, $id_simulasi);


    if ($member == null) {
      foreach ($kolom as $row) {
        $dataMember = [
          'id_member'     => random_string(),
          'id_simulasi'   => $id_simulasi,
          'id_kolom'   => $row->id_kolom,
          'id_user'       => $id_user,
          'urutan_kecermatan'     => $row->urutan,
          'is_done'     => 0,
        ];
        $this->Crud_model->add('tbl_member', $dataMember);
      }
    }

    $data = [
      'simulasi' => $simulasi,
      'content'  => 'home/home/petunjuk'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }

  function start($id_simulasi, $urutan)
  {

    $this->load->helper('string');

    $butir = $this->uri->segment('4');
    $id_user = $this->session->userdata('id_user');
    $kolom = $this->Crud_model->listingOneAll('tbl_kolom', 'id_simulasi', $id_simulasi);


    $id_kolom = '';

    foreach ($kolom as $k) {
      if ($k->urutan == $urutan) {
        $id_kolom = $k->id_kolom;
      }
    }


    $member = $this->HM->detailMemberKecermatan($id_user, $id_simulasi, $id_kolom, $urutan);
    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_kolom', $id_kolom);
    $task = $this->Crud_model->listingOneAll('tbl_task', 'id_member', $member->id_member);
    // print_r($id_kolom);
    //get satu soal

    if (($member->time_start == null) || $member->time_end == null) {
      $time_start = date('y-m-d H:i:s');
      $endTime = strtotime("+2 minutes", strtotime($time_start));
      $time_end = date('y-m-d H:i:s', $endTime);

      $dataTime = [
        'time_start'  => $time_start,
        'time_end'    => $time_end
      ];
      $this->Crud_model->edit('tbl_member', 'id_member', $member->id_member, $dataTime);
    }



    if ($task == null) {

      foreach ($soal as $row) {
        $dataTask = [
          'id_task'   => random_string(),
          'id_user'   => $id_user,
          'id_simulasi'  => $id_simulasi,
          'id_kolom'  =>  $id_kolom,
          'id_member'  => $member->id_member,
          'id_soal'   => $row->id_soal,
          'no_soal'   => $row->no_soal
        ];
        $this->Crud_model->add('tbl_task', $dataTask);
      }
    }
    if ($this->session->userdata('id_kolom')) {
      $this->session->unset_userdata('id_kolom');
      $this->session->set_userdata('id_kolom', $id_kolom);
    } else {
      $this->session->set_userdata('id_kolom', $id_kolom);
    }

    redirect('home/kecermatan/butir/1', 'refresh');
  }


  function butir($no_soal)
  {
    $id_user = $this->session->userdata('id_user');
    $id_kolom = $this->session->userdata('id_kolom');
    $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $id_kolom);
    $soal = $this->SM->butirSoalKecermatan($id_user, $id_kolom, $no_soal);
    $member = $this->HM->detailMemberKecermatan($id_user, $kolom->id_simulasi, $kolom->id_kolom);
    // print_r($id_kolom);
    // die;
    if ($soal == null) {
      __is_boolean('tbl_member', 'id_member', $member->id_member, 'is_done', '1');
      redirect('home/kecermatan/result/' . $member->id_member . '/' . $kolom->id_simulasi);
    }
    $data = [
      'kolom'    => $kolom,
      'soal'    => $soal,
      'member'    => $member,
      'content'  => 'home/soal/kecermatan'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }

  // Submit jawaban
  function submit($id_task, $no_next, $jawaban)
  {
    $data = [
      'jawaban_kecermatan'  => $jawaban,
    ];
    $this->Crud_model->edit('tbl_task', 'id_task', $id_task, $data);
    redirect('home/kecermatan/butir/' . $no_next);
  }

  function result($id_member, $id_simulasi)
  {

    $member = $this->Crud_model->listingOne('tbl_member', 'id_member', $id_member);
    $kolom = $this->Crud_model->listingOneAll('tbl_kolom', 'id_simulasi', $id_simulasi);

    $task = $this->SM->soalTaskKecermatan($id_member);

    $urutan_kolom = $member->urutan_kecermatan + 1;

    //get  data semua kolom user dari tabel member


    //tampilkan hasil
    $skor = 0;
    foreach ($task as $t) {

      if ($t->jawaban_kecermatan == $t->j_kecermatan) {
        $skor = $skor + 1;
      }
    }

    __is_boolean('tbl_member', 'id_member', $id_member, 'nilai_akhir', $skor);
    $data = [
      'skor'    => $skor,
      'id_simulasi' => $id_simulasi,
      'urutan_kolom' => $urutan_kolom,
      'kolom' => $kolom,
      // 'rekap_member' => $rekap_member,
      'content'  => 'home/soal/result_kecermatan'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }
}
/* End of file Controllername.php */
