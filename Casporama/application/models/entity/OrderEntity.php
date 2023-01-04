<?php

/*

    * OrderEntity

    * Cette classe représente une entité de la table order

*/

class OrderEntity {

    private int $id;
    private int $idorder;
    private string $dateorder;
    private ProductEntity $product;
    private LocationEntity $location;
    private StockEntity $variant;
    private int $quantity;
    private int $iduser;
    private string $state;

    public function getId() : Int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

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

    public function getDate() : string {
        return $this->dateorder;
    }

    public function setDate(string $dateorder) {
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

    public function getVariant() : StockEntity {
        return $this->variant;
    }

    public function setVariant(StockEntity $variant) {
        $this->variant = $variant;
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