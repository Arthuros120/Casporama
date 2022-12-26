<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Card Controller

    
*/
class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $dataValue = array();
        $cart = $this->CartModel->getCart();

        if ($cart != null) {
            array_push($dataValue,$cart);
        }

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $carts = $this->CartModel->getCartDB($user);

            foreach ($carts as $value) {
                array_push($dataValue,$value);
            }
            
        } 

        $data['carts'] = $dataValue;
        
        $this->load->view('cart/homeContent',$data);
    }

    public function add()
    {

        $color = substr($this->input->post("color"), 0, -1);
        $size = $this->input->post("size");
        $idproduct = intval($this->input->post("idproduct"));
        
    
        $idvariant = $this->CartModel->getVariant($idproduct,$color,$size);

        $this->CartModel->addProductCart($idproduct,$idvariant);

        redirect('/Cart');
        
    }

    public function saveCart()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();
    

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();
            
            $this->CartModel->addProductCartDB($user);

            redirect("./Cart");

        } else {

            redirect("User/login");
        }
    }

    public function modifyQuantity() {
        var_dump("test");
    }
}
