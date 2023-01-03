<?php

/*

    * OrderEntity

    * Cette classe représente une entité de la table order

*/

class OrderEntity {

    private int $idorder;
    private DateTime $dateorder;
    private ProductEntity $product;
    private LocationEntity $location;
    private int $quantity;
    private int $iduser;
    private string $state;

    public function getIdorder() : Int {
        return $this->idorder;
    }

    public function setIdorder(int $idorder) {
        $this->idorder = $idorder;
    }

    public function getIduser() : Int {
        return $this->iduser;
    }

    public function setIduser(int $iduser) {
        $this->iduser = $iduser;
    }

    public function getDate() : DateTime {
        return $this->dateorder;
    }

    public function setDate(DateTime $dateorder) {
        $this->dateorder = $dateorder;
    }

    public function getProduct() : ProductEntity {
        return $this->product;
    }

    public function setProduct(ProductEntity $product) {
        $this->product = $product;
    }

    public function getLocation() : LocationEntity {
        return $this->location;
    }

    public function setLocation(LocationEntity $location) {
        $this->location = $location;
    }

    public function getQuantity() : Int {
        return $this->quantity;
    }

    public function setQuantity(int $quantity) {
        $this->quantity = $quantity;
    }

    public function getState() : String {
        return $this->state;
    }

    public function setState(String $state) {
        $this->state = $state;
    }
}