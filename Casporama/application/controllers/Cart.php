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
        $cart = $this->CartModel->getCart();

        $dataContent['total'] = 0;

        if ($cart != null) {
            $dataContent['total'] = $this->CartModel->totalCart($cart);
            $dataContent['mainCart'] = $cart;
        }

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $carts = $this->CartModel->getCartDB($user);

            if ($carts != null) {
                $dataContent['quantity'] = $this->CartModel->getQuantityByCart($carts);
                $dataContent['savedCart'] = $carts;
            } 
        } 
        

        $data = array(
            'content' => $dataContent
        );


        // * On charges les sous-vues dans la vue principale avec les données affilie.
        $this->LoaderView->load('Cart/index', $data);
    }

    public function add()
    {

        $color = substr($this->input->post("color"), 0, -1);
        $color = str_replace('+', ' ', $color);
        $size = $this->input->post("size");
        $idproduct = intval($this->input->post("idproduct"));
        
        if ($size != null && $color != null) {
    
            $idvariant = $this->CartModel->getVariant($idproduct,$color,$size);

            $this->CartModel->addProductCart($idproduct,$idvariant);

            redirect('Cart');
        } else {
            redirect('shop/product/'.$idproduct);
        }
        
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

            $carts = $this->CartModel->getCartDBById($user->getId(),$idcart);

            if ($carts != null) {

                $dataContent['quantity'] = $this->CartModel->getQuantityByCart(array($carts));

                $dataContent['cart'] = $carts;  
                $data = array(
                    'content' => $dataContent
                );
                
                $this->LoaderView->load('Cart/modify', $data);
                
            } else {
                redirect("Cart");
            }
            
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
