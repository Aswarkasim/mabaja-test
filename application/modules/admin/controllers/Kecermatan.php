<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kecermatan extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('admin/Soal_model', 'SM');
  }


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

  function deleteMember($id_member)
  {

    $this->load->model('admin/Kecermatan_model', 'KM');

    $member = $this->Crud_model->listingOne('tbl_member', 'id_member', $id_member);
    // print_r($member);
    // die();
    $id_simulasi = $member->id_simulasi;
    $member_rekap = $this->SM->detailHasilMemberKecermatan($member->id_user, $id_simulasi);

    $skor = $this->KM->listSkorKecermatanAll($member->id_user, $id_simulasi);
    foreach ($skor as $row) {
      $this->Crud_model->delete('tbl_skor_kecermatan', 'id_skor_kecermatan', $row->id_skor_kecermatan);
    }

    $resume = $this->KM->listResumeKecermatan($member->id_user, $id_simulasi);
    foreach ($resume as $row) {
      $this->Crud_model->delete('tbl_resume_kecermatan', 'id_resume_kecermatan', $row->id_resume_kecermatan);
    }



    foreach ($member_rekap as $row) {
      $this->Crud_model->delete('tbl_member', 'id_member', $row->id_member);
      $task = $this->Crud_model->listingOneAll('tbl_task', 'id_member', $row->id_member);
      foreach ($task as $t) {
        $this->Crud_model->delete('tbl_task', 'id_task', $t->id_task);
      }
    }



    redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
  }



  function is_doneKolomKecermatan($value, $id_kolom)
  {
    $kolom = $this->Crud_model->listingOne('tbl_kolom', 'id_kolom', $id_kolom);
    $soal = $this->Crud_model->listingOneAll('tbl_soal', 'id_kolom', $id_kolom);

    if ($kolom->jumlah_soal != count($soal)) {
      $message = "Soal belum selesai";
      $this->session->set_flashdata('msg_er', $message);
    } else {
      $message = "";
      if ($value == '1') {
        $message = "Kolom telah selesai dan disimpan";
      } else {
        $message = "Kolom disimpan sebagai draft";
      }
      $data = [
        'is_active' => $value
      ];
      $this->Crud_model->edit('tbl_kolom', 'id_kolom', $id_kolom, $data);
      $this->session->set_flashdata('msg', $message);
    }

    redirect('admin/kolom/detail/' . $id_kolom);
  }

  function is_active_kecermatan($id_simulasi, $value)
  {
    $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
    $soal = $this->SM->countKolomDone($id_simulasi);
    if ($simulasi->jumlah_kolom != count($soal)) {
      $this->session->set_flashdata('msg_er', 'Jumlah soal belum cukup');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    } else {
      __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_active', $value);
      $this->session->set_flashdata('msg', 'Simulasi diaktifkan');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    }
  }

  function editSimulasiKecermatan($id_simulasi)
  {
    $kolom = $this->Crud_model->listingOneAll('tbl_kolom', 'id_simulasi', $id_simulasi);
    $i = $this->input;
    $jumlah_kolom = $i->post('jumlah_kolom');

    if (count($kolom) > $jumlah_kolom) {
      $this->session->set_flashdata('msg_er', 'Hapus kolom terlebih dahulu sebelum mengubah jumlah');
      redirect('admin/kolom/index/' . $id_simulasi);
    } else {
      if (count($kolom) < $jumlah_kolom) {
        __is_boolean('tbl_simulasi', 'id_simulasi', $id_simulasi, 'is_active', '0');
      }
      $data = [
        'nama_simulasi'  => $i->post('nama_simulasi'),
        'waktu'       => $i->post('waktu'),
        'jumlah_kolom' => $jumlah_kolom
      ];
      $this->Crud_model->edit('tbl_simulasi', 'id_simulasi', $id_simulasi, $data);
      $this->session->set_flashdata('msg', 'Simulasi diubah');
      redirect('admin/simulasi/detail/' . $id_simulasi, 'refresh');
    }
  }
}
