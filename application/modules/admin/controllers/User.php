<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
        $this->load->model('admin/Soal_model', 'SM');
    }


    public function index()
    {
        $user = $this->Crud_model->listing('tbl_user');
        $data = [
            'add'      => 'user/user/add',
            'edit'      => 'user/user/edit/',
            'delete'      => 'user/user/delete/',
            'user'      => $user,
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
        $this->Crud_model->delete('tbl_user', 'id_user', $id_user);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('user/user');
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
}
