<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Card Controller

    @method index
    @method add
    @method saveCart
    @method modifyQuantity
    @method modifyCart
    @method modifyCartDB
    @method deleteProduct
    @method deleteCart
    @method deleteCartDB

    * Ce controlleur permet de gérer le panier

*/
class Cart extends CI_Controller
{

    /*

        * Constructeur

        * On charge les modèles et les librairies

    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->model('ProductModel');
    }

    /*

        * Index

        * On charge la vue du panier

    */
    public function index() : void
    {

        $cart = $this->CartModel->getCart();

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        $dataContent['total'] = 0;
        $dataContent['fraisdeport'] = 0;
        $dataContent['TVA'] = 0;
        
        if ($cart != null) {
            if ($this->UserModel->isConnected()) {
                $user = $this->UserModel->getUserBySession();
                if ($user->getStatus() == 'Caspor') {
                    $total = $this->CartModel->totalCart($cart)*0.95;
                } else {
                    $total = $this->CartModel->totalCart($cart);
                }
            }else {
                $total = $this->CartModel->totalCart($cart);
            }
            $dataContent['total'] = round($total,2);
            $dataContent['TVA'] = round($total * 0.20,2);
            $dataContent['mainCart'] = $cart;
            $dataContent['quantity'] = $this->CartModel->getQuantityByCart(array($cart));
            $dataContent['fraisdeport'] = 5;
        }

        if ($this->UserModel->isConnected()) {

            if (!isset($user)) {
                $user = $this->UserModel->getUserBySession();
            }

            $carts = $this->CartModel->getCartDB($user);

            if ($carts != null) {
                $dataContent['savedCart'] = $carts;
                foreach ($carts as $cart) {
                    if ($user->getStatus() == 'Caspor') {
                        $totalClient = $this->CartModel->totalCart($cart)*0.95;
                    } else {
                        $totalClient = $this->CartModel->totalCart($cart);
                    }
                    $totals[$cart[0]->getIdcart()] = $totalClient;
                    $totals[$cart[0]->getIdcart()] = round(($totals[$cart[0]->getIdcart()] * 1.20)+5,2);
                }
                $dataContent['totals'] = $totals;
            } 
        } 

        $colors = array (
            'Football' => '#D3E2D3',
            'Badminton' => '#D9E6F4',
            'Volleyball' => '#FBFBC3',
            'Arts-martiaux' => '#FFB4B0'
        );

        $dataContent['colors'] = $colors;


        $data = array(
            'content' => $dataContent
        );


        // * On charges les sous-vues dans la vue principale avec les données affilie.
        $this->LoaderView->load('Cart/index', $data);
    }

    /*

        * Add

        * On ajoute un produit au panier

    */
    public function add() : void
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

    /*

        * saveCart

        * On enregistre le panier

    */
    public function saveCart() : void
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

    /*

        * modifyQuantity

        * Cette fonction permet de modifier la quandtité du panier

    */
    public function modifyQuantity() : void
    {

        $this->CartModel->modifyQuantity($this->input->post());

        redirect("Cart");
    }

    /*

        * modifyCart

        @param int $id

        * Cette fonction permet de mofifier le pannier

    */
    public function modifyCart(int $id = null) : void
    {

        if ($id == null) {
            $idcart = (int) $this->input->get('idcart');
        } else {
            $idcart = $id;
        }

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $carts = $this->CartModel->getCartDBById($user->getId(), $idcart);

            if ($carts != null) {

                $dataContent['quantity'] = $this->CartModel->getQuantityByCart(array($carts));

                if ($user->getStatus() == 'Caspor') {
                    $total = (($this->CartModel->totalCart($carts)*0.95)*1.20)+5;
                } else {
                    $total = ($this->CartModel->totalCart($carts)*1.20)+5;
                }

                $totals[$carts[0]->getIdcart()] = $total;
                $dataContent['totals'] = $totals;

                $dataContent['cart'] = $carts;

                $colors = array (
                    'Football' => '#D3E2D3',
                    'Badminton' => '#D9E6F4',
                    'Volleyball' => '#FBFBC3',
                    'Arts-martiaux' => '#FFB4B0'
                );

                $dataContent['colors'] = $colors;
                
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

    /*

        * modifyCartDB

        * Cette fonction permet de modifier le pannier
        * dans la base de données

    */
    public function modifyCartDB() : void
    {

        $post = $this->input->post();

        $id["user"] = $post['iduser'];
        $id["cart"] = $post['idcart'];

        $quantities = array_diff($post, $id);

        foreach ($quantities as $idvariant => $newquantity) {
            $this->CartModel->modifyCartDB((int) $newquantity, (int) $id['user'], (int) $id['cart'], (int) $idvariant);
        }

        redirect('Cart');

    }

    /*

        * deleteProduct

        * Cette fonction permet de supprimer un produit du panier

    */
    public function deleteProduct() : void
    {
        $get = $this->input->get();
        $this->CartModel->deleteProduct($get["idproduit"],$get["idvariant"]);

        redirect("Cart");
    }

    /*

        * deleteCart

        * Cette fonction permet de supprimer un panier

    */
    public function deleteCart() : void
    {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $this->CartModel->deleteCart($this->input->get('idcart'), $user->getId());

            redirect("Cart");

            
        } else {

            redirect('User/login');

        }
    }

    /*

        * deleteProductDB

        * Cette fonction permet de supprimer un produit du panier
        * dans la base de données

    */
    public function deleteProductDB()
    {

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

