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
        $this->load->model('CartModel');
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

    public function chooseLocation() {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $idcart = $this->input->get('idcart');

            if ($idcart == 0) {
                $cart = $this->CartModel->getCart();
                if ($cart == null) {
                    redirect('Cart');
                }
            }

            $user = $this->UserModel->getUserBySession();

            $locations = $this->LocationModel->getLocationsByUserId($user->getId(),true);

            $dataContent['locations'] = $locations;

            $dataContent['idcart'] = $idcart;

            $data = array(
                'content' => $dataContent
            );

    
            $this->LoaderView->load('Order/chooseLocation',$data);
            
            
        } else {

            redirect('User/login');

        } 
        
    }

    public function addOrder() {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $idcart = $this->input->get('idcart');
            $idlocation = $this->input->get('idlocation');

            $user = $this->UserModel->getUserBySession();

            $this->OrderModel->addOrder($idcart,$user,$idlocation);


            redirect("Order");
            
            
        } else {

            redirect('User/login');

        } 

    }

}