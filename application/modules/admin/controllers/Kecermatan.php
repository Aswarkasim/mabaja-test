<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecermatan extends CI_Controller
{

  public function add()
  {

    $this->load->helper('string');
    $i = $this->input;

    $id_kolom = $i->post('id_kolom');
    if (!empty($_FILES['gambar']['name'])) {
      $config['upload_path']   = './assets/uploads/images/';
      $config['allowed_types'] = 'gif|jpg|png|PNG|svg|jpeg|JPG|JPEG';
      $config['max_size']      = '24000'; // KB 
      $this->upload->initialize($config);
      if (!$this->upload->do_upload('gambar')) {
        redirect('admin/kolom/detail/' . $id_kolom, 'refresh');
      } else {
        $upload_data = ['uploads' => $this->upload->data()];

        $data = [
          'id_soal'       => random_string('numeric'),
          'no_soal'        => $i->post('no_soal'),
          'butir_soal'        => $i->post('butir_soal'),
          'jawaban_kecermatan'        => $i->post('jawaban_kecermatan'),
          'id_kolom'      => $id_kolom,
          'gambar'        => $config['upload_path'] . $upload_data['uploads']['file_name']
        ];
        $this->Crud_model->add('tbl_soal', $data);
        redirect('admin/kolom/detail/' . $id_kolom);
      }
    } else {

      $data = [
        'id_soal'       => random_string('numeric'),
        'no_soal'        => $i->post('no_soal'),
        'butir_soal'        => $i->post('butir_soal'),
        'jawaban_kecermatan'        => $i->post('jawaban_kecermatan'),
        'id_kolom'      => $id_kolom
      ];
      $this->Crud_model->add('tbl_soal', $data);
      redirect('admin/kolom/detail/' . $id_kolom);
    }
  }

  function delete($id_soal)
  {
    $soal = $this->Crud_model->listingOne('tbl_soal', 'id_soal', $id_soal);
    if ($soal->gambar != null) {
      unlink($soal->gambar);
    }
    $this->Crud_model->delete('tbl_soal', 'id_soal', $id_soal);
    redirect('admin/kolom/detail/' . $soal->id_kolom);
  }
}
