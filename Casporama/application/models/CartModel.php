<?php

// * On importe les classes nécessaires

require_once APPPATH . 'models/entity/ProductEntity.php';
require_once APPPATH . 'models/entity/CartEntity.php';


/*

    * Class CartModel

    * Cette classe permet de gérer le panier

*/
class CartModel extends CI_Model {

    public function addProductCartDB(UserEntity $user) {

        $carts = $this->CartModel->getCart();

        if ($carts != null) {

            $iduser = $user->getId();

            $idcart = $this->maxIdCart($iduser);


            foreach ($carts as $cart) {
                $id = $this->generateId();

                $datestring = 'Y-m-d H:i:s';
                $time = time();
                $date = date($datestring, $time);

                $dateExp = date($datestring,$time+6*3600);
            
                $this->db->query("Call cart.addCart(".$id.",".$iduser.",".$idcart.",".$cart->getvariant()->getId().",".$cart->getQuantity().","."'".$date."'".","."'".$dateExp."'".")");
            }
            
            delete_cookie('cart');
        }
    }

    private function generateId(): Int
    {

        $id = rand(10000, 999999999);

        if ($this->heHaveCartById($id)) {

            $id = $this->generateId();
        }

        return $id;
    }

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

    public function maxIdCart(int $iduser) : int {
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
    
    public function getCartDB(UserEntity $user) : ?array {

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


            // * On attend un résultat
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

            array_push($res,$newcart);
            
        } 
    
        $alreadydone = array();
        for ($i = 0; $i < count($res); $i++) {
            $cart = array();
            if (!in_array($res[$i]->getIdcart(),$alreadydone)) {
                array_push($cart,$res[$i]);
                array_push($alreadydone,$res[$i]->getIdCart());
                for ($j = $i+1; $j < count($res); $j++) {
                    if ($res[$i]->getIdcart() == $res[$j]->getIdcart()) {
                        array_push($cart,$res[$j]);
                    }
                }
                $user->setCart($cart);
            }
        }
        
        return $user->getCart();

    }

    public function getVariant(int $idproduct, string $color, string $size) : int {

        $product = $this->ProductModel->findById($idproduct);

        foreach ($product->getStock() as $stock) {
            if ($stock->getColor() == $color && $stock->getSize() == $size) {
                return $stock->getId();
            }
        }
    }

    public function addProductCart(int $idproduct, int $idvariant, int $quantity = 1) {

        $cookieValue = get_cookie('cart');  

        $cookieValue .= "$idproduct"."P"."$idvariant"."P"."$quantity"."C";   

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

    public function getCart() :?array {
        
        $cookieValue = get_cookie('cart');
        

        if ($cookieValue != null) {
            $values = array_slice(explode("C",$cookieValue),0,-1);
            $res = array();

            foreach ($values as $value) {

                $div = explode("P",$value);

                $cart = new CartEntity;
                $product = $this->ProductModel->findById($div[0]);

                $cart->setIdcart(0);
                $cart->setProduct($product);
                $cart->setvariant($product->getVariant(intval($div[1])));
                $cart->setQuantity($div[2]);

                array_push($res,$cart);
            }
            return $res;
        }

        return null;
    }

    public function modifyQuantity(array $newQuantity) {
        
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

    public function modifyCartDB(int $newquantity, int $user, int $cart, int $variant) {
        $this->db->query("call cart.modifyQuantity($newquantity,$user,$cart,$variant)");
    }

    public function deleteProduct(int $delproduct,int $delvariant) {
        $cart = $this->getCart();

        if ($cart != null) {
            $cookieValue = "";
            foreach ($cart as $product) {
                $idvariant = $product->getVariant()->getId();
                $idproduct = $product->getProduct()->getId();
                if ($idvariant != $delvariant && $idproduct != $delproduct) {
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
    }

    public function deleteCart(int $idcart, int $iduser) {
        $this->db->query("call cart.deleteCart($idcart,$iduser)");
    }

    public function deleteProductDB(int $iduser, int $id) {
        $this->db->query("call cart.deleteProductDB($iduser,$id)");
    }

    public function totalCart(array $cart) :float {
        $res = 0.0;
        foreach ($cart as $products) {
            $res += $products->getProduct()->getPrice() * $products->getQuantity();
        }
        return $res;
    }

}
