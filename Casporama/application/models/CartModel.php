<?php

// * On importe les classes nécessaires

use function PHPUnit\Framework\isEmpty;

require_once APPPATH . 'models/entity/ProductEntity.php';

/*

    * Class CartModel

    * Cette classe permet de gérer le panier

*/
class CartModel extends CI_Model {

    public function addProductCart(int $iduser,int $idcard,int $idproduct,int $quantity) {

        $id = $this->generateId();

        $datestring = 'Y-m-d h:i:s';
        $time = time();
        $date = date($datestring, $time);

        $dateExp = date($datestring,$time+6*3600);
    
        $this->db->query("Call cart.addCart(".$id.",".$iduser.",".$idcard.",".$idproduct.",".$quantity.",".$date.",".$dateExp.")");

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

        // * On récupère l'utilisateur en fonction de son id
        $query = $this->db->query("Call cart.verifyId('" . $id . "')");

        // * On vérifie si l'utilisateur existe
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
    
    public function getCart(UserEntity $user) : ?array {

        $query = $this->db->query("call cart.getCartById('" . $user->getId() . "')");

        $carts = $query->result_array();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        

        if (count($carts) == 0) {
            return null;
        }

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
            $newcart->setQuantity($cart["quantity"]);

            $user->setCart($newcart);
        } 
        
        return $user->getCart();

    }

}
