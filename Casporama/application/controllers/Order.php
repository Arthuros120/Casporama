<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Order Controller

    
*/
class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
    }

    public function index() {

        $this->load->view("order/homeContent");

    }

}