<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Timer extends CI_Controller
{

  public function index()
  {
    $data = [
      'content'  => 'home/timer'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }

  function submit()
  {

    $this->load->helper('string');
    $waktu  = $this->input->post('number');
    // die($waktu);

    $data = [
      'id_test' => random_string(),
      'waktu'         => $waktu,
    ];
    $this->Crud_model->add('tbl_test', $data);

    redirect('home/timer', 'refresh');
  }
}

/* End of file Controllername.php */
