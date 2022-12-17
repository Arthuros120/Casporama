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

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $carts = $this->CartModel->getCart($user);

            $data['carts'] = $carts;
            
            $this->load->view('cart/homeContent',$data);

        } else {

            redirect("User/login");
        }
    }

    public function add($quantity = 1)
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $color = substr($this->input->post("color"), 0, -1);
            $size = $this->input->post("size");
            $idproduct = intval($this->input->post("idproduct"));

            $product = $this->ProductModel->findById($idproduct);

            foreach ($product->getStock() as $stock) {
                if ($stock->getColor() == $color && $stock->getSize() == $size) {
                    $idvariant = $stock->getId();
                }
            }

            if ($user->getCart() == null) {
                $user->setCart();
            }


            $this->CartModel->addProductCart($user->getId(),$user->getCart()[-1]->getId(),$idvariant,$quantity);

            // redirect("./Cart");

        } else {

            redirect("User/login");
        }
    }
}
