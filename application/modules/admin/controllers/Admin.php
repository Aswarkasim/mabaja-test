<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();
    }


    public function index()
    {
        $admin = $this->Crud_model->listing('tbl_admin');
        $data = [
            'add'      => 'admin/admin/add',
            'edit'      => 'admin/admin/edit/',
            'delete'      => 'admin/admin/delete/',
            'admin'      => $admin,
            'content'   => 'admin/admin/index'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }

    function add()
    {

        $valid = $this->form_validation;

        $valid->set_rules('nama_admin', 'Nama Admin', 'required');
        $valid->set_rules('email', 'Email', 'required|is_unique[tbl_admin.email]|valid_email');
        $valid->set_rules('password', 'Password', 'required');
        $valid->set_rules('re_password', 'Retype Password', 'required|matches[password]');

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Tambah Admin',
                'add'       => 'admin/admin/add',
                'back'      => 'admin/admin',
                'content'   => 'admin/admin/add'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;
            $data = [
                'nama_admin'     => $i->post('nama_admin'),
                'email'         => $i->post('email'),
                'password'      => sha1($i->post('password')),
                'role'          => $i->post('role'),
                'is_active'     => $i->post('is_aktif')
            ];
            $this->Crud_model->add('tbl_admin', $data);
            $this->session->set_flashdata('msg', 'ditambah');
            redirect('admin/admin/add', 'refresh');
        }
    }

    function edit($id_admin)
    {
        $admin = $this->Crud_model->listingOne('tbl_admin', 'id_admin', $id_admin);

        $valid = $this->form_validation;

        $valid->set_rules('nama_admin', 'Nama Admin', 'required');
        $valid->set_rules('email', 'Email', 'required|valid_email');
        $valid->set_rules('password', 'Password', 'matches[re_password]');
        $valid->set_rules('re_password', 'Retype Password', 'matches[password]');

        if ($valid->run() === FALSE) {
            $data = [
                'title'     => 'Edit ' . $admin->nama_admin,
                'edit'       => 'admin/admin/edit/',
                'back'      => 'admin/admin',
                'admin'      => $admin,
                'content'   => 'admin/admin/edit'
            ];
            $this->load->view('admin/layout/wrapper', $data, FALSE);
        } else {
            $i = $this->input;

            $password = "";
            if ($i->post('password') != "") {
                $password = sha1($i->post('password'));
            } else {
                $password = $admin->password;
            }
            $data = [
                'id_admin'       => $id_admin,
                'nama_admin'     => $i->post('nama_admin'),
                'email'         => $i->post('email'),
                'password'      => $password,
                'role'          => $i->post('role'),
                'is_active'     => $i->post('is_aktif')
            ];
            $this->Crud_model->edit('tbl_admin', 'id_admin', $id_admin, $data);
            $this->session->set_flashdata('msg', 'diedit');
            redirect('admin/admin/edit/' . $id_admin, 'refresh');
        }
    }

    function delete($id_admin)
    {
        $this->Crud_model->delete('tbl_admin', 'id_admin', $id_admin);
        $this->session->set_flashdata('msg', 'dihapus');
        redirect('admin/admin');
    }

    public function role()
    {
        $role = $this->Crud_model->listing('tbl_admin_role');
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
