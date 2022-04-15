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

        if ($mapel->id_mapel == 'KqyMAXUx') {
            //masuk paket dsini
            // die('masuk');
            // $simulasi = $this->HM->listSimulasiPaket($mapel->id_mapel);
            $paket = $this->Crud_model->listingOneAll('tbl_paket', 'is_active', 1);

            $data = [
                'mapel'    => $mapel,
                'paket'    => $paket,
                'content'  => 'home/home/index_paket'
            ];
            $this->load->view('home/layout/wrapper', $data, FALSE);
        } else {
            // die('masuk');
            $simulasi = $this->HM->listSimulasi($mapel->id_mapel);

            $data = [
                'mapel'    => $mapel,
                'simulasi'    => $simulasi,
                'content'  => 'home/home/index'
            ];
            $this->load->view('home/layout/wrapper', $data, FALSE);
        }
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

    function paket($id_paket)
    {
        $this->load->model('home/Kecermatan_model', 'KM');
        $id_user = $this->session->userdata('id_user');
        $cek = $this->HM->cekPaket($id_user, $id_paket);

        if ($cek) {
            $this->HM->insertMPaket($id_user, $id_paket);
        }

        $simulasi = $this->HM->listSimulasiPaket($id_paket);
        // $member = $this->SM->getMemberSimulasiUserPaket($id_user, $);
        $data = [
            // 'mapel'    => $mapel,
            'simulasi'  => $simulasi,
            'content'  => 'home/home/paket_simulasi'
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
