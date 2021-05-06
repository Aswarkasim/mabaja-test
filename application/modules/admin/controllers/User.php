<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
        $this->load->model('admin/Soal_model', 'SM');
        $this->load->model('admin/Admin_model', 'HM');
    }


    public function index($id_kelas = null)
    {
        $user = $this->HM->listUser($id_kelas);
        $kelas = $this->Crud_model->listing('tbl_kelas');

        $title = '';
        if ($id_kelas != null) {
            $detailKelas = $this->Crud_model->listingOne('tbl_kelas', 'id_kelas', $id_kelas);
            $title = $detailKelas->nama_kelas;
        }

        $data = [
            'add'      => 'admin/user/add',
            'edit'      => 'admin/user/edit/',
            'delete'      => 'admin/user/delete/',
            'title'        => $title,
            'kelas'      => $kelas,
            'user'      => $user,
            'id_kelas_now'      => $id_kelas,
            'content'   => 'admin/user/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function detail($id_user)
    {
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
        $member = $this->SM->myPaket($id_user);
        // $member = $this->Crud_model->listingOneAll('tbl_member', 'id_user', $id_user);
        $data = [
            'user'      => $user,
            'member'      => $member,
            'content'   => 'admin/user/detail'
        ];
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function delete($id_user)
    {
        $task = $this->Crud_model->listingOneAll('tbl_task', 'id_user', $id_user);
        foreach ($task as $row) {
            $this->Crud_model->delete('tbl_task', 'id_task', $row->id_task);
        }

        $member = $this->Crud_model->listingOneAll('tbl_member', 'id_user', $id_user);
        foreach ($member as $row) {
            $this->Crud_model->delete('tbl_member', 'id_member', $row->id_member);
        }

        $this->Crud_model->delete('tbl_user', 'id_user', $id_user);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('admin/user');
    }

    public function role()
    {
        $role = $this->Crud_model->listing('tbl_user_role');
        $data = [
            'add'       => 'roleAdd',
            'edit'      => 'roleEdit/',
            'delete'    => 'roleDelete/',
            'role'      => $role,
            'content'   => 'admin/role/index'
        ];
        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function is_active($value, $id_user)
    {
        __is_boolean('tbl_user', 'id_user', $id_user, 'is_read', '1');
        $data = [
            'is_active' => $value
        ];
        $this->Crud_model->edit('tbl_user', 'id_user', $id_user, $data);
        redirect('admin/user', 'refresh');
    }

    function cheangeKelas($id_user, $id_kelas = null)
    {
        $user = $this->Crud_model->listingOne('tbl_user', 'id_user', $id_user);
        $id_kelas_now = $user->id_kelas;
        __is_boolean('tbl_user', 'id_user', $id_user, 'id_kelas', $id_kelas);
        redirect('admin/user/index/' . $id_kelas_now, 'refresh');
    }
}
