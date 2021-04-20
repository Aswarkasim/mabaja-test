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
        $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $current = date('Y-m-d');
        $yearNow = date("Y", strtotime($current));



        if ($tahun == null) {
            $tahun = $yearNow;
        }

        $penghasilanTahunan = $this->AM->sumPenghasilanTahunan($tahun);
        $penjualanTahunan = $this->AM->sumPenjualanTahunan($tahun);
        $persenan = $penghasilanTahunan->totalPenghasilan * 10 / 100;

        $data = [
            'title'     => 'Dashboard',
            'admin'      => $admin,
            'tahun'      => $tahun,
            'yearNow'      => $yearNow,
            'label'      => $label,
            'penghasilanTahunan' => $penghasilanTahunan->totalPenghasilan,
            'penjualanTahunan' => count($penjualanTahunan),
            'persenan' => $persenan,
            'content'   => 'admin/dashboard/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Dashboard.php */
