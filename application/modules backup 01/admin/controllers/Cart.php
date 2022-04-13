<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in_admin();

        $this->load->model('admin/Admin_model', 'AM');
    }


    public function index()
    {

        // echo date('F');
        $mydate = "2010-05-12 13:57:01";
        $month = date("Y", strtotime($mydate));
        echo $month;

        $payment = $this->AM->month();
        //print_r($payment);


        $monthNum  = 3;
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F'); // March
        //   print_r($monthName);

        $graph = $this->AM->graph();
        $data = [
            'title'     => 'Cart',
            'graph'     => $graph,
            'content'   => 'admin/dashboard/cart'
        ];

        $this->load->view('admin/layout/wrapper', $data, FALSE);
    }
}

/* End of file Cart.php */
