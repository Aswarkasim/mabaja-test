<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Banner extends CI_Controller
{

  public function index()
  {
    $this->load->helper('string');

    $banner = $this->Crud_model->listing('tbl_banner');
    $required = '%s tidak boleh kosong';
    $valid = $this->form_validation;
    $valid->set_rules('urutan', 'Urutan', 'required|is_unique[tbl_banner.urutan]', ['required' => $required, 'is_unique' => 'Urutan <strong>' . $this->input->post('urutan') . '</strong> telah ada. silakan masukkan angka urutan yang lain']);
    if (empty($_FILES['gambar']['name'])) {
      $valid->set_rules('gambar', 'Gambar', 'required');
    }
    if ($valid->run()) {
      if (!empty($_FILES['gambar']['name'])) {
        $config['upload_path']   = './assets/uploads/banner/';
        $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
        $config['max_size']      = '24000'; // KB 
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
          $data = [
            'banner'    => $banner,
            'error'     => $this->upload->display_errors(),
            'content'   => 'admin/banner/index'
          ];
          $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
          $upload_data = ['uploads' => $this->upload->data()];

          $data = [
            'id_banner'      => random_string('numeric', '5'),
            'topik'        => $this->input->post('topik'),
            'deskripsi'        => $this->input->post('deskripsi'),
            'urutan'        => $this->input->post('urutan'),
            'warna_text'        => $this->input->post('warna_text'),
            'gambar'        => $config['upload_path'] . $upload_data['uploads']['file_name']
          ];
          $this->Crud_model->add('tbl_banner', $data);
          $this->session->set_flashdata('msg', 'Banner ditambahkan');
          redirect('admin/banner/index');
        }
      }
    }
    $data = [
      'banner'    => $banner,
      'content'   => 'admin/banner/index'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  public function edit($id_banner)
  {

    $banner = $this->Crud_model->listingOne('tbl_banner', 'id_banner', $id_banner);
    $required = '%s tidak boleh kosong';
    $valid = $this->form_validation;
    $valid->set_rules('topik', 'Topik', 'required', ['required' => $required]);
    // if (empty($_FILES['gambar']['name'])) {
    //     $valid->set_rules('gambar', 'Gambar', 'required');
    // }
    if ($valid->run()) {
      if (!empty($_FILES['gambar']['name'])) {
        $config['upload_path']   = './assets/uploads/banner/';
        $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
        $config['max_size']      = '24000'; // KB 
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
          $data = [
            'banner'    => $banner,
            'error'     => $this->upload->display_errors(),
            'content'   => 'admin/banner/edit'
          ];
          $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
          if ($banner->gambar != "") {
            unlink('assets/uploads/banner/' . $banner->gambar);
          }
          $upload_data = ['uploads' => $this->upload->data()];

          $data = [
            'id_banner'      => $id_banner,
            'topik'        => $this->input->post('topik'),
            'deskripsi'        => $this->input->post('deskripsi'),
            'gambar'        => $config['upload_path'] . $upload_data['uploads']['file_name']
          ];
          $this->Crud_model->edit('tbl_banner', 'id_banner', $id_banner, $data);
          $this->session->set_flashdata('msg', 'Banner ditambahkan');
          redirect('admin/konfigurasi/banner/index');
        }
      } else {
        $data = [
          'id_banner'      => $id_banner,
          'topik'        => $this->input->post('topik'),
          'deskripsi'        => $this->input->post('deskripsi'),
          'urutan'        => $this->input->post('urutan')
        ];
        $this->Crud_model->edit('tbl_banner', 'id_banner', $id_banner, $data);
        $this->session->set_flashdata('msg', 'Banner ditambahkan');
        redirect('admin/banner/index');
      }
    }
    $data = [
      'banner'    => $banner,
      'content'   => 'admin/banner/edit'
    ];
    $this->load->view('admin/layout/wrapper', $data, FALSE);
  }

  function delete($id_banner)
  {
    $gambar = $this->Crud_model->listingOne('tbl_banner', 'id_banner', $id_banner);
    unlink($gambar->gambar);
    $this->Crud_model->delete('tbl_banner', 'id_banner', $id_banner);
    $this->session->set_flashdata('msg', 'Gambar telah dihapus');

    redirect('admin/banner', 'refresh');
  }
}
