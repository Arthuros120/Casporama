<?php

/*

    * OrderEntity

    @method getId int
    @method setId void
    @method getIduser int
    @method setIduser void
    @method getDate string
    @method setDate void
    @method getLocation LocationEntity
    @method setLocation void
    @method getState string
    @method setState void
    @method getProducts array
    @method addProducts void
    @method getVariants array
    @method addVariants void
    @method getQuantities array
    @method addQuantities void
    @method setPrice void
    @method getPrice float

    * Cette classe représente une entité de la table order

*/

class OrderEntity
{

    private int $id;
    private string $dateorder;
    private array $products;// Array Des produits de la commande.
    private array $variants; // Array des variantes des produits commander.
    private LocationEntity $location;
    private array $quantities; // Array des quantite commander.
    private int $iduser;
    private string $state;
    private float $price;

    /*
    
        * getId
    
        @return int
    
        * Retourne l'id de l'entité
    
    */
    public function getId() : Int
    {
        return $this->id;
    }

    /*
    
        * setId
    
        @param int $id
    
        * Définit l'id de l'entité
    
    */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /*
    
        * getIduser
    
        @return int
    
        * Retourne l'id de l'utilisateur de l'entité
    
    */
    public function getIduser() : Int
    {
        return $this->iduser;
    }

    /*
    
        * setIduser
    
        @param int $iduser
    
        * Définit l'id de l'utilisateur de l'entité
    
    */
    public function setIduser(int $iduser)
    {
        $this->iduser = $iduser;
    }

    /*
    
        * getDate
    
        @return String
    
        * Retourne la date de l'entité
    
    */
    public function getDate() : string
    {
        return $this->dateorder;
    }

    /*
    
        * setDate
    
        @param String $dateorder
    
        * Définit la date de l'entité
    
    */
    public function setDate(string $dateorder)
    {
        $this->dateorder = $dateorder;
    }

    /*
    
        * getLocation
    
        @return LocationEntity
    
        * Retourne la location de l'entité
    
    */
    public function getLocation() : LocationEntity
    {
        return $this->location;
    }

    /*
    
        * setLocation
    
        @param LocationEntity $location
    
        * Définit la location de l'entité
    
    */
    public function setLocation(LocationEntity $location)
    {
        $this->location = $location;
    }

    /*
    
        * getState
    
        @return String
    
        * Retourne l'état de l'entité
    
    */
    public function getState() : String
    {
        return $this->state;
    }

    /*
    
        * setState
    
        @param String $state
    
        * Définit l'état de l'entité
    
    */
    public function setState(String $state)
    {
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
        if (!isset($this->products[$product->getId()])) {
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

    /**
     * @param float $price
     */
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

}
