<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in_user();
        // __is_complete_data_profile($id_user);
        $this->load->model('home/Home_model', 'HM');
    }
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
        $kelas = $this->Crud_model->listingOne('tbl_kelas', 'id_kelas', $user->id_kelas);

        $mapel = $this->Crud_model->listingOne('tbl_mapel', 'id_mapel', $kelas->id_mapel);
        $simulasi = $this->HM->listSimulasi($mapel->id_mapel);
        $data = [
            'mapel'    => $mapel,
            'simulasi'    => $simulasi,
            'content'  => 'home/home/index'
        ];
        $this->load->view('home/layout/wrapper', $data, FALSE);
    }

    public function petunjuk($id_simulasi)
    {
        $simulasi = $this->Crud_model->listingOne('tbl_simulasi', 'id_simulasi', $id_simulasi);
        $data = [
            'simulasi' => $simulasi,
            'content'  => 'home/home/petunjuk'
        ];
        $this->load->view('home/layout/wrapper', $data, FALSE);
    }

    public function soal()
    {
        $data = [
            'content'  => 'home/soal/index'
        ];
        $this->load->view('home/layout/wrapper', $data, FALSE);
    }

    public function develop()
    {
        $data = [
            'content'  => 'home/home/develop'
        ];
        $this->load->view('home/layout/wrapper', $data, FALSE);
    }
}
