<?php

/*

    * OrderEntity

    * Cette classe représente une entité de la table order

*/

class OrderEntity {

    private int $id;
    private string $dateorder;
    private array $products;// Array Des produits de la commande.
    private array $variants; // Array des variantes des produits commander.
    private LocationEntity $location;
    private array $quantities; // Array des quantite commander.
    private int $iduser;
    private string $state;

    public function getId() : Int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
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


    public function getLocation() : LocationEntity {
        return $this->location;
    }

    public function setLocation(LocationEntity $location) {
        $this->location = $location;
    }


    public function getState() : String {
        return $this->state;
    }

    public function setState(String $state) {
        $this->state = $state;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param ProductEntity $product
     */
    public function addProducts(ProductEntity $product): void
    {
        if (!isset($this->products[$product->getId()])  ) {
            $this->products[$product->getId()] = $product;
        }

    }

    /**
     * @return array
     */
    public function getVariants(): array
    {
        return $this->variants;
    }

    /**
     * @param StockEntity $variant
     */
    public function addVariants(StockEntity $variant): void
    {
        $this->variants[] = $variant;
    }

    /**
     * @return array
     */
    public function getQuantities(): array
    {
        return $this->quantities;
    }

    /**
     * @param int $idvariant
     * @param int $quantity
     */
    public function addQuantities(int $idvariant, int $quantity): void
    {
        $this->quantities[$idvariant] = $quantity;
    }
}