<?php

/*

    * CartEntity

    @method getId int
    @method setId int
    @method getIduser int
    @method setIduser int
    @method getIdcart int
    @method setIdcart int
    @method getProduct ProductEntity
    @method setProduct ProductEntity
    @method getvariant StockEntity
    @method setvariant StockEntity
    @method getQuantity int
    @method setQuantity int

    * Cette classe représente une entité de la table cart

*/
class CartEntity
{

    private int $id;
    private int $iduser;
    private int $idcart;
    private ProductEntity $product;
    private StockEntity $variant;
    private int $quantity;

    /*
    
        * getId

        @return int

        * Retourne l'id de l'entité

    */
    public function getId() : int
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

        * Retourne l'iduser de l'entité
    */
    public function getIduser() : int
    {
        return $this->iduser;
    }

    /*
    
        * setIduser

        @param int $iduser

        * Définit l'iduser de l'entité

    */
    public function setIduser(int $iduser)
    {
        $this->iduser = $iduser;
    }

    /*
    
        * getIdcart

        @return int

        * Retourne l'idcart de l'entité

    */
    public function getIdcart() : int
    {
        return $this->idcart;
    }

    /*
    
        * setIdcart

        @param int $idcart

        * Définit l'idcart de l'entité

    */
    public function setIdcart(int $idcart)
    {
        $this->idcart = $idcart;
    }

    /*

        * getProduct

        @return ProductEntity

        * Retourne le produit de l'entité

    */
    public function getProduct() : ProductEntity
    {
        return $this->product;
    }

    /*

        * setProduct

        @param ProductEntity $product

        * Définit le produit de l'entité

    */
    public function setProduct(ProductEntity $product)
    {
        $this->product = $product;
    }

    /*
    
        * getvariant

        @return StockEntity

        * Retourne la variante de l'entité

    */
    public function getvariant() : StockEntity
    {
        return $this->variant;
    }

    /*
    
        * setvariant

        @param StockEntity $variant

        * Définit la variante de l'entité

    */
    public function setvariant(StockEntity $variant)
    {
        $this->variant = $variant;
    }

    /*
    
        * getQuantity

        @return int

        * Retourne la quantité de l'entité

    */
    public function getQuantity() : int
    {
        return $this->quantity;
    }

    /*
    
        * setQuantity

        @param int $quantity

        * Définit la quantité de l'entité

    */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

}
