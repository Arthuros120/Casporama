<?php

// * On importe les classes nécessaires

require_once APPPATH . 'models/entity/ProductEntity.php';
require_once APPPATH . 'models/entity/CartEntity.php';


/*

    * Class CartModel

    * Public

    @method addProductCartDB(UserEntity $user)
    @method heHaveCartById(int $id)
    @method maxIdCart(int $iduser)
    @method getCartDB(UserEntity $user)
    @method getCart()
    @method modifyQuantity(array $newQuantity)
    @method modifyCardDB(
                            int $newquantity,
                            int $user,
                            int $cart,
                            int $variant
                            )
    @method deleteProduct(
        int $delproduct
        int $delvariant
    )
    @method deleteProductDB(
        int $iduser
        int $id
    )
    @method totalCart(array $cart) float
    @method getCartDBbyId(int $iduser, int $idcart) array
    @method getQuantityByCart(array $carts) array

    ! Private

    @method generateId() int

    * Cette classe permet de gérer le panier

*/
class CartModel extends CI_Model
{

    /*
    
        * addProductCartDB

        @param UserEntity $user
        
        * Cette fonction permet d'ajouter un produit au panier
        * dans la base de données

    */
    public function addProductCartDB(UserEntity $user)
    {

        $carts = $this->CartModel->getCart();

        if ($carts != null) {

            $iduser = $user->getId();

            $idcart = $this->maxIdCart($iduser);


            foreach ($carts as $cart) {
                $id = $this->generateId();

                $datestring = 'Y-m-d H:i:s';
                $time = time();
                $date = date($datestring, $time);

                $dateExp = date($datestring, $time + 6 * 3600);
            
                $this->db->query(
                    "Call cart.addCart(".$id.",".$iduser.",".$idcart.",".$cart->getvariant()->getId().",".$cart->getQuantity().","."'".$date."','".$dateExp."'".")");
            }
            
            delete_cookie('cart');
        }
    }

    /*
    
        * heHaveCartById

        @param int $product
        @return bool
        
        * Vérifie si un panier existe avec un Id

    */
    public function heHaveCartById(int $id): Bool
    {

        $query = $this->db->query("Call cart.verifyId('" . $id . "')");

        $cart = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne le résultat
        if (isset($cart->idcard)) {

            return true;
        }

        return false;
    }

    /*
    
        * maxIdCart

        @param int $iduser
        @return int
        
        * Cette fonction permet de récupérer le dernier idcart

    */
    public function maxIdCart(int $iduser) : int
    {
        $query = $this->db->query("Call cart.maxIdCart('" . $iduser . "')");

        $cart = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne le résultat
        if (isset($cart->max)) {

            return $cart->max+1;
        }

        return 1;
    }
    
    /*
    
        * getCartDB

        @param UserEntity $user
        @return ?array
        
        * Cette fonction permet de récupérer le panier de l'utilisateur

    */
    public function getCartDB(UserEntity $user) : ?array
    {

        $query = $this->db->query("call cart.getCartById('" . $user->getId() . "')");

        $carts = $query->result_array();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        

        if (count($carts) == 0) {
            return null;
        }

        $res = array();

        foreach ($carts as $cart) {

            $query = $this->db->query("call catalog.getCatalogByVariant('" . $cart["idvariant"] . "')");
            $catalog = $query->result_array();

            $query->next_result();
            $query->free_result();

            $product = $this->ProductModel->findById($catalog[0]["nuproduct"]);
            
            $newcart = new CartEntity;
            $newcart->setId($cart["id"]);
            $newcart->setIduser($cart["iduser"]);
            $newcart->setIdcart($cart["idcart"]);
            $newcart->setProduct($product);
            $newcart->setvariant($product->getVariant($cart["idvariant"]));
            $newcart->setQuantity($cart["quantity"]);

            array_push($res, $newcart);
            
        }
    
        $alreadydone = array();
        for ($i = 0; $i < count($res); $i++) {
            $cart = array();
            if (!in_array($res[$i]->getIdcart(), $alreadydone)) {
                array_push($cart, $res[$i]);
                array_push($alreadydone, $res[$i]->getIdCart());
                for ($j = $i+1; $j < count($res); $j++) {
                    if ($res[$i]->getIdcart() == $res[$j]->getIdcart()) {
                        array_push($cart, $res[$j]);
                    }
                }
                $user->setCart($cart);
            }
        }
        
        return $user->getCart();

    }

    /*
    
        * getVariant

        @param int $idproduct
        @param string $color
        @param string $size

        @return int
        
        * Cette fonction permet de récupérer tout les variant d'un produit

    */
    public function getVariant(int $idproduct, string $color, string $size) : int
    {

        $product = $this->ProductModel->findById($idproduct);

        foreach ($product->getStock() as $stock) {
            if ($stock->getColor() == $color && $stock->getSize() == $size) {
                return $stock->getId();
            }
        }
    }

    /*
    
        * addProductCart

        @param int $idproduct
        @param int $idvariant
        @param int $quantity

        @return void
        
        * Cette fonction permet d'ajouter un produit au panier

    */
    public function addProductCart(int $idproduct, int $idvariant, int $quantity = 1) : void
    {

        $cookieValue = get_cookie('cart');

        if ($quantity == 1 && $cookieValue != null) {
            $cart = array_slice(explode("C", $cookieValue), 0, -1);
            foreach ($cart as $product) {
                $value = explode("P", $product);
                if ($value[0] == $idproduct && $value[1] == $idvariant) {
                    $quantity += $value[2];
                }
            }
            $cookieValue = $this->deleteProduct($idproduct, $idvariant);
        }

        $stocks = $this->ProductModel->findById($idproduct)->getStock();
        foreach ($stocks as $stock) {
            if ($stock->getId() == $idvariant) {
                $quantitymax = $stock->getQuantity();
            }
        }

        if ($quantity > $quantitymax) {
            $quantity = $quantitymax;
        }

        $cookieValue .= "$idproduct"."P"."$idvariant"."P"."$quantity"."C";

        // * On crée le cookie
        $cookieSettings = array(
            'name'   => 'cart',
            'value'  => $cookieValue,
            'expire' => 0,
            'secure' => false,
            'httponly' => true
        );
       
        // * On envoie le cookie
        $this->input->set_cookie($cookieSettings);

    }


    /*
    
        * getCart

        @return ?array
        
        * Cette fonction permet de récupérer le panier

    */
    public function getCart() : ?array
    {
        
        $cookieValue = get_cookie('cart');
        

        if ($cookieValue != null) {
            $values = array_slice(explode("C", $cookieValue), 0, -1);
            $res = array();

            foreach ($values as $value) {

                $div = explode("P", $value);

                $cart = new CartEntity;
                $product = $this->ProductModel->findById($div[0]);

                $cart->setIdcart(0);
                $cart->setProduct($product);
                $cart->setvariant($product->getVariant(intval($div[1])));
                if ($div[2] > $cart->getVariant()->getQuantity()) {
                    $cart->setQuantity($cart->getVariant()->getQuantity());
                } else {
                    $cart->setQuantity($div[2]);
                }

                array_push($res, $cart);
            }
            return $res;
        }

        return null;
    }

    /*
    
        * modifyQuantity

        @param array $newQuantity

        @return string
        
        * Cette fonction permet de modifier la quantité d'un produit dans le panier

    */
    public function modifyQuantity(array $newQuantity)
    {
        
        $cart = $this->getCart();

        if ($cart != null) {
            $cookieValue = "";
            foreach ($cart as $product) {
                $idvariant = $product->getVariant()->getId();
                $cookieValue .= $product->getProduct()->getId()."P"."$idvariant"."P".$newQuantity[$idvariant]."C";
            }
        }

        // * On crée le cookie
        $cookieSettings = array(
            'name'   => 'cart',
            'value'  => $cookieValue,
            'expire' => 0,
            'secure' => true,
            'httponly' => true
        );

        // * On envoie le cookie
        $this->input->set_cookie($cookieSettings);

    }

    /*
    
        * modifyCartDB

        @param int $newquantity
        @param int $user
        @param int $cart
        @param int $variant

        @return string
        
        * Cette fonction permet de modifier le panier dans la db

    */
    public function modifyCartDB(int $newquantity, int $user, int $cart, int $variant)
    {
        $this->db->query("call cart.modifyQuantity($newquantity,$user,$cart,$variant)");
    }

    /*
    
        * deleteProduct

        @param int $delproduct
        @param int $delvariant

        @return string
        
        * Cette fonction permet de supprimer un produit du panier

    */
    public function deleteProduct(int $delproduct, int $delvariant)
    {
        $cart = $this->getCart();

        if ($cart != null) {
            $cookieValue = "";
            foreach ($cart as $product) {
                $idvariant = $product->getVariant()->getId();
                $idproduct = $product->getProduct()->getId();
                if (($idproduct != $delproduct) || ($idvariant != $delvariant && $idproduct == $delproduct)) {
                    $cookieValue .= $idproduct."P"."$idvariant"."P".$product->getQuantity()."C";
                }
            }
        }

        // * On crée le cookie
        $cookieSettings = array(
            'name'   => 'cart',
            'value'  => $cookieValue,
            'expire' => 0,
            'secure' => true,
            'httponly' => true
        );

        // * On envoie le cookie
        $this->input->set_cookie($cookieSettings);

        return $cookieValue;
    }

    /*
    
        * deleteCart

        @param int $idcart
        @param int $iduser

        @return void
        
        * Cette fonction permet de supprimer un panier

    */
    public function deleteCart(int $idcart, int $iduser)
    {
        $this->db->query("call cart.deleteCart($idcart,$iduser)");
    }

    /*
    
        * deleteProductDB

        @param int $iduser
        @param int $id

        @return void
        
        * Cette fonction permet de supprimer un produit du panier dans la db

    */
    public function deleteProductDB(int $iduser, int $id)
    {
        $this->db->query("call cart.deleteProductDB($iduser,$id)");
    }

    /*
    
        * totalCart

        @param array $cart

        @return float
        
        * Cette fonction permet de retourner le total du panier

    */
    public function totalCart(array $cart) : float
    {
        $res = 0.0;
        foreach ($cart as $products) {
            $res += $products->getProduct()->getPrice() * $products->getQuantity();
        }
        return $res;
    }

    /*
    
        * getCartDBbyID

        @param int $iduser
        @param int $idcart
        
        * Cette fonction permet de retourner le panier de l'utilisateur

    */
    public function getCartDBbyID(int $iduser, int $idcart)
    {

        $query = $this->db->query("call cart.getCartIdcart($iduser,$idcart)");

        $carts = $query->result_array();

        $query->next_result();
        $query->free_result();

        $res = array();
        foreach ($carts as $cart) {

            $query = $this->db->query("call catalog.getCatalogByVariant('" . $cart["idvariant"] . "')");
            $catalog = $query->result_array();

            $query->next_result();
            $query->free_result();

            $product = $this->ProductModel->findById($catalog[0]["nuproduct"]);
            
            $newcart = new CartEntity;
            $newcart->setId($cart["id"]);
            $newcart->setIduser($cart["iduser"]);
            $newcart->setIdcart($cart["idcart"]);
            $newcart->setProduct($product);
            $newcart->setvariant($product->getVariant($cart["idvariant"]));
            $newcart->setQuantity($cart["quantity"]);

            array_push($res, $newcart);
        }

        return $res;

    }

    /*
    
        * getQuantityByCart

        @param array $carts

        @return array
        
        * Cette fonction permet de retourner le panier de l'utilisateur

    */
    public function getQuantityByCart(array $carts) : array
    {

        $quantity = [];
        foreach ($carts as $cart) {
            foreach ($cart as $product) {
                $quantity[
                    $product->getVariant()->getId()
                    ] = array_combine(
                        range(
                            1,
                            $product->getVariant()->getQuantity()
                        ),
                        range(
                            1,
                            $product->getVariant()->getQuantity()
                        )
                    );
            }
        }
        return $quantity;
    }

    /*
    
        * generateId

        @return int
        
        * Cette permet de générer un id pour le panier

    */
    private function generateId(): Int
    {

        $id = rand(10000, 999999999);

        if ($this->heHaveCartById($id)) {

            $id = $this->generateId();
        }

        return $id;
    }

}
