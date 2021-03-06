<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
        $this->load->model('admin/Admin_model', 'AM');
    }


    public function index($tahun = null)
    {
        $id_admin = $this->session->userdata('id_admin');
        $admin = $this->Crud_model->listingOne('tbl_admin', 'id_admin', $id_admin);
        $listAdmin = $this->Crud_model->listing('tbl_admin');
        $mapel = $this->Crud_model->listingOne('tbl_mapel', 'is_active', '1');
        $simulasi = $this->Crud_model->listingOneAll('tbl_simulasi', 'id_mapel', $mapel->id_mapel);
        $listMapel = $this->Crud_model->listing('tbl_mapel');

        $user = $this->Crud_model->listing('tbl_user');


        $current = date('Y-m-d');
        $yearNow = date("Y", strtotime($current));



        if ($tahun == null) {
            $tahun = $yearNow;
        }

        $kelas = $this->AM->listKelas();

        $kelasAktif = $this->AM->kelasAktif('1');

        $userLimit = $this->AM->listUserDasboard();

        $data = [
            'title'     => 'Dashboard',
            'admin'      => $admin,
            'listAdmin'      => $listAdmin,
            'user'      => $user,
            'mapelDetail'      => $mapel,
            'mapel'      => $listMapel,
            'simulasi'      => $simulasi,
            'kelas'      => $kelas,
            'userLimit'      => $userLimit,
            'tahun'      => $tahun,
            'kelasAktif'      => $kelasAktif,
            'yearNow'      => $yearNow,
            'content'   => 'admin/dashboard/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Dashboard.php */
