<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
    }


    public function index()
    {
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $valid = $this->form_validation;
        $valid->set_rules('nama_aplikasi', 'Nama Aplikasi', 'required', array('required' => '%s tidak boleh kosong'));

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'konfigurasi ',
                'back'      => 'barang/konfigurasi',
                'konfigurasi'    => $konfigurasi,
                'content'   => 'admin/konfigurasi/edit'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_aplikasi'   => $i->post('nama_aplikasi'),
                'instagram'   => $i->post('instagram'),
                'facebook'   => $i->post('facebook'),
                'twitter'   => $i->post('twitter')
            ];
            $this->Crud_model->edit('tbl_konfigurasi', 'id_konfigurasi', '1', $data);
            $this->session->set_flashdata('msg', 'Konfigurasi diubah');
            redirect('admin/konfigurasi');
        }
    }

    function banner()
    {
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $data = [
            'title'     => 'Ubah Banner',
            'konfigurasi'    => $konfigurasi,
            'content'   => 'admin/konfigurasi/banner'
        ];
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function uploadBanner()
    {
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        if (!empty($_FILES['banner']['name'])) {
            $config['upload_path']   = './assets/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
            $config['max_size']      = '100000'; // KB 
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('banner')) {
                $this->upload->display_errors();
                redirect('admin/konfigurasi/banner');
            } else {

                if ($konfigurasi->banner != "") {
                    unlink($konfigurasi->banner);
                }
                $upload_data = ['uploads' => $this->upload->data()];
                $data = [
                    'banner'        => $config['upload_path'] . $upload_data['uploads']['file_name']
                ];
                $this->Crud_model->edit('tbl_konfigurasi', 'id_konfigurasi', '1', $data);
                $this->session->set_flashdata('msg', 'Banner diubah');
                redirect('admin/konfigurasi/banner');
            }
        }
    }


    function logo()
    {
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        $data = [
            'title'     => 'Ubah Logo',
            'konfigurasi'    => $konfigurasi,
            'content'   => 'admin/konfigurasi/logo'
        ];
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function uploadLogo()
    {
        $konfigurasi = $this->Crud_model->listingOne('tbl_konfigurasi', 'id_konfigurasi', '1');
        if (!empty($_FILES['logo']['name'])) {
            $config['upload_path']   = './assets/uploads/images/';
            $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
            $config['max_size']      = '100000'; // KB 
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('logo')) {
                $this->upload->display_errors();
                redirect('admin/konfigurasi/logo');
            } else {

                if ($konfigurasi->logo != "") {
                    unlink($konfigurasi->logo);
                }
                $upload_data = ['uploads' => $this->upload->data()];
                $data = [
                    'logo'        => $config['upload_path'] . $upload_data['uploads']['file_name']
                ];
                $this->Crud_model->edit('tbl_konfigurasi', 'id_konfigurasi', '1', $data);
                $this->session->set_flashdata('msg', 'Logo diubah');
                redirect('admin/konfigurasi/logo');
            }
        }
    }
}
