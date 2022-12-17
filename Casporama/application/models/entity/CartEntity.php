<?php

/*

    * CartEntity

    * Cette classe représente une entité de la table card

*/
class CartEntity {

    private int $id;
    private int $iduser;
    private int $idcart;
    private ProductEntity $product;
    private int $quantity;


    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getIduser() : int {
        return $this->iduser;
    }

    public function setIduser(int $iduser) {
        $this->iduser = $iduser;
    }

    public function getIdcart() : int {
        return $this->idcart;
    }

    public function setIdcart(int $idcart) {
        $this->idcart = $idcart;
    }

    public function getProduct() : ProductEntity {
        return $this->product;
    }

    public function setProduct(ProductEntity $product) {
        $this->product = $product;
    }

    public function getQuantity() : int {
        return $this->quantity;
    }

    public function setQuantity(int $quantity) {
        $this->quantity = $quantity;
    }

}

?>