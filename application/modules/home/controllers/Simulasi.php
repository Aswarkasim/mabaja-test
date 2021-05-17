<?php

use function GuzzleHttp\Promise\exception_for;

defined('BASEPATH') or exit('No direct script access allowed');

class Simulasi extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    is_logged_in_user();
    $this->load->model('home/Home_model', 'HM');
  }


  function index()
  {
  }

  function petunjuk($id_simulasi)
  {
    $this->load->helper('string');
    $id_user = $this->session->userdata('id_user');
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $member = $this->HM->detailMember($id_user, $id_simulasi);

    if ($member == null) {
      $dataMember = [
        'id_member'     => random_string(),
        'id_simulasi'   => $id_simulasi,
        'id_user'       => $id_user,
        'is_done'     => 0,
      ];
      $this->Crud_model->add('tbl_member', $dataMember);
    }

    $data = [
      'simulasi' => $simulasi,
      'content'  => 'home/home/petunjuk'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }



  function start($id_simulasi)
  {
    try {
      $this->load->helper('string');
      $id_user = $this->session->userdata('id_user');

      $soal = $this->HM->listKlasifikasi($id_simulasi);
      $member = $this->HM->detailMember($id_user, $id_simulasi);


      $task = $this->Crud_model->listingOneAll('tbl_task', 'id_member', $member->id_member);

      $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
      // print_r($member);
      // die;

      if (($member->time_start == null) || $member->time_end == null) {
        $time_start = date('y-m-d H:i:s');
        $endTime = strtotime("+" . $simulasi->waktu . " minutes", strtotime($time_start));
        $time_end = date('y-m-d H:i:s', $endTime);

        $dataTime = [
          'waktu'       => $simulasi->waktu * 60,
          'time_start'  => $time_start,
          'time_end'    => $time_end
        ];
        $this->Crud_model->edit('tbl_member', 'id_member', $member->id_member, $dataTime);
      }

      if (empty($task)) {
        foreach ($soal as $row) {

          $dataTask = [
            'id_task'   => random_string(),
            'id_user'   => $id_user,
            'id_simulasi'  => $id_simulasi,
            'id_member'  => $member->id_member,
            'id_soal'   => $row->id_soal,
            'no_soal'   => $row->no_soal
          ];
          $this->Crud_model->add('tbl_task', $dataTask);
        }
      }
      // $this->session->set_flashdata('msg', 'Pembayaran valid dan user terlah diaktifkan');
      if ($this->session->userdata('id_simulasi')) {
        $this->session->unset_userdata('id_simulasi');
        $this->session->set_userdata('id_simulasi', $id_simulasi);
      } else {
        $this->session->set_userdata('id_simulasi', $id_simulasi);
      }
      redirect('home/soal/butir/1', 'refresh');
    } catch (Exception $e) {
      echo $e;
    }
  }

  function startKecermatan()
  {
    $this->load->helper('string');
    $id_user = $this->session->userdata('id_user');
  }
}

/* End of file Controllername.php */
