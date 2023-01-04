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
        $this->load->model('ProductModel');
        $this->load->model('LocationModel');
    }

    public function index() {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $orders = $this->OrderModel->getOrderByUser($user);

            $data = array();

            if ($orders != null) {
                $dataContent['orders'] = $orders;

                $data = array(
                    'content' => $dataContent
                );
            }


            $this->LoaderView->load('Order/index',$data);
            
            
        } else {

            redirect('User/login');

        }

        


    }

}