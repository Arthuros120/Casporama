<?php

// * On importe les classes nécessaires
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
    
}
