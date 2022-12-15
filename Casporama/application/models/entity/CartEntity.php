<?php

/*

    * CartEntity

    * Cette classe représente une entité de la table card

*/
class CartEntity {

    private int $id;
    private array $products;


    public function getId() : int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getProducts() : array {
        return $this->products;
    }

    public function setProducts(array $products) {
        $this->products = $products;
    }

}

?>