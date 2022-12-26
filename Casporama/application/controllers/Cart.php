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

            if ($carts != null) {
                foreach ($carts as $value) {
                    array_push($dataValue,$value);
                }
            }
            
        } 
        $total = [];

        foreach ($dataValue as $carts) {
            $total[$carts[0]->getIdcart()] = $this->CartModel->totalCart($carts);
        }

        $data['carts'] = $dataValue;
        $data['total'] = $total;
        
        $this->load->view('cart/homeContent',$data);
    }

    public function add()
    {

        $color = substr($this->input->post("color"), 0, -1);
        $size = $this->input->post("size");
        $idproduct = intval($this->input->post("idproduct"));
        var_dump($idproduct);
    
        $idvariant = $this->CartModel->getVariant($idproduct,$color,$size);

        $this->CartModel->addProductCart($idproduct,$idvariant);

        redirect('Cart');
        
    }

    public function saveCart()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();
    

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();
            
            $this->CartModel->addProductCartDB($user);

            redirect("Cart");

        } else {

            redirect("User/login");
        }
    }

    public function modifyQuantity() {

        $this->CartModel->modifyQuantity($this->input->post());

        redirect("Cart");
    }

    public function modifyCart(int $id = null) {

        if ($id == null) {
            $idcart = (int) $this->input->get('idcart');
        } else {
            $idcart = $id;
        }

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $carts = $this->CartModel->getCartDB($user);

            if ($carts != null) {
                foreach ($carts as $cart) {
                    if ($cart[0]->getIdcart() == $idcart) {
                        $res = $cart;
                    }
                }
            }

            $data['cart'] = $res;            

            $this->load->view('cart/modify/homeContent',$data);            
            
        } else {

            redirect('User/login');

        }

    }

    public function modifyCartDB() {

        $post = $this->input->post();

        $id["user"] = $post['iduser'];
        $id["cart"] = $post['idcart'];

        $quantities = array_diff($post,$id);

        foreach ($quantities as $idvariant => $newquantity) { 
            $this->CartModel->modifyCartDB((int) $newquantity,(int) $id['user'],(int) $id['cart'],(int) $idvariant);
        }

        redirect('Cart');

    }

    public function deleteProduct() {
        $get = $this->input->get();
        $this->CartModel->deleteProduct($get["idproduit"],$get["idvariant"]);

        redirect("Cart");
    }

    public function deleteCart() {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $this->CartModel->deleteCart($this->input->get('idcart'), $user->getId());  

            redirect("Cart");

            
        } else {

            redirect('User/login');

        }
    }

    public function deleteProductDB() {

        $get = $this->input->get();

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $this->CartModel->deleteProductDB($user->getId(), $get['id']);  

            $this->modifyCart($get['idcart']);

            
        } else {

            redirect('User/login');

        }

    }
}
