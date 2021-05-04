<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Soal extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    is_logged_in_user();
    $this->load->model('home/Home_model', 'HM');
    $this->load->model('home/Soal_model', 'SM');
  }


  public function index()
  {
  }
  public function butir()
  {
    //  print_r($this->session->userdata('id_simulasi'));
    $id_simulasi = $this->session->userdata('id_simulasi');
    $id_user = $this->session->userdata('id_user');
    // $status = $this->uri->segment('4');
    $butir = $this->uri->segment('4');
    $task = $this->SM->butirSoal($id_user, $id_simulasi, $butir);
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);

    if ($this->uri->segment(4) == $simulasi->jumlah_soal) {
      $this->session->set_userdata('id_task', $task->id_task);
      $this->session->userdata('id_task');
    }

    $member = $this->HM->detailMember($id_user, $id_simulasi);

    $soalTerjawab = $this->SM->soalTerjawab($member->id_member, 'belum');

    if ($task != null) {
      $soal = $this->Crud_model->listingOne('tbl_soal', 'id_soal', $task->id_soal);
      $data = [
        'soal'    => $soal,
        'task'    => $task,
        'member'    => $member,
        'soalTerjawab'    => $soalTerjawab,
        'simulasi'    => $simulasi,
        'listSoal' => $this->SM->listSoal($task->id_member),
        'content'  => 'home/soal/index'
      ];
      $this->load->view('home/layout/wrapper', $data, FALSE);
    } else {
      $task = $this->SM->butirSoal($id_user, $id_simulasi, '1');
      // $this->resultTask($task->id_task, $task->id_simulasi, $task->id_member);
      redirect('home/soal/confirm/' . $task->id_task . '/' . $task->id_simulasi . '/' . $task->id_member, 'refresh');
    }
  }

  function confirm($id_task, $id_simulasi, $id_member)
  {
    $data = [
      'id_task'     => $id_task,
      'id_simulasi'     => $id_simulasi,
      'id_member'     => $id_member,
      'content'     => 'home/soal/confirm'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }
  function submit($id_task)
  {
    if ($id_task == null) {
      $id_task = $this->session->userdata('id_task');
      print_r($id_task);
      die;
    }
    $task = $this->Crud_model->listingOne('tbl_task', 'id_task', $id_task);
    $no_soal = $task->no_soal + 1;
    $i = $this->input;
    $status = "";
    if ($_POST['ragu']) {
      $status = "ragu";
    } else if ($_POST['selesai']) {
      $status = "selesai";
    }
    $data = [
      'id_pilihan'  => $i->post('id_pilihan'),
      'is_done'     => $i->post('is_done'),
      'is_done'     => $status
    ];
    $this->Crud_model->edit('tbl_task', 'id_task', $id_task, $data);
    redirect('home/soal/butir/' . $no_soal);
  }

  function resultTask($id_task, $id_simulasi, $id_member)
  {

    $this->session->unset_userdata('id_task');

    __is_boolean('tbl_member', 'id_member', $id_member, 'is_done', '1');
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    // $task = $this->Crud_model->listingOneAll('tbl_task', 'id_member', $id_member);
    $task = $this->SM->kunciJawaban($id_member);
    $listSoal = $this->Crud_model->listingOneAll('tbl_soal', 'id_simulasi', $id_simulasi);

    // $benar = 0;
    $poin = 0;
    $nilai = 0;

    //cek apakah simulasi sama dengan kepribadian


    // if ($simulasi->id_mapel == 'mrHXIR2D') {
    //   $pilihan = $this->Crud_model->listingOne('tbl_pilihan', 'id_pilihan', $task->id_pilihan);
    //   $poin = $poin + $pilihan->poin;
    // } else {

    // foreach ($task as $row) {

    //   if ($row->id_pilihan == $row->kunci_jawaban) {
    //     $nilai = $nilai;
    //     $nilai = $nilai + 1;
    //     $poin = 0;
    //     if ($simulasi->id_mapel == 'Zatq9ywj' || $simulasi->id_mapel == 'UxWSqb6E' || $simulasi->id_mapel == 'mrHXIR2D') {
    //       $poin = $nilai;
    //     } else if ($simulasi->id_mapel == '45hTKPfdm') {
    //     } else {
    //       $jumlah = $simulasi->jumlah_soal;
    //       $poin = ($nilai / $jumlah) * 100;
    //     }
    //   }
    // }
    //}


    foreach ($task as $row) {
      if ($simulasi->id_mapel == 'Zatq9ywj' || $simulasi->id_mapel == 'UxWSqb6E' || $simulasi->id_mapel == 'mrHXIR2D') {
        if ($row->id_pilihan == $row->kunci_jawaban) {
          $poin = $poin + 1;
        }
      } else if ($simulasi->id_mapel == '45hTKPfdm') {
        $poin = $poin + $row->poin;
      } else {
        if ($row->id_pilihan == $row->kunci_jawaban) {
          $nilai = $nilai + 1;
          $jumlah = $simulasi->jumlah_soal;
          $poin = ($nilai / $jumlah) * 100;
        }
      }
    }



    $nilai_akhir = [
      'nilai_akhir' => $poin
    ];
    $this->Crud_model->edit('tbl_member', 'id_member', $id_member, $nilai_akhir);

    $data = [
      'poin'        => $poin,
      'simulasi'        => $simulasi,
      'listSoal'       => $listSoal,
      'content'     => 'home/soal/result_akademik'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }
}

/* End of file Controllername.php */
