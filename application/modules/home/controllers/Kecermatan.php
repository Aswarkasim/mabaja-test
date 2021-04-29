<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecermatan extends CI_Controller
{

  public function index()
  {
    $data = [
      'content'  => 'home/soal/kecermatan'
    ];
    $this->load->view('home/layout/wrapper', $data, FALSE);
  }
}

/* End of file Controllername.php */
