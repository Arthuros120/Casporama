<?php

/*

    * CatalogEntity

    @method getId int
    @method setId void
    @method getNuProduct int
    @method setNuProduct void
    @method getReference string
    @method setReference void
    @method getColor string
    @method setColor void
    @method getSize : string
    @method setSize void
    @method getQuantity int
    @method setQuantity void
    @method getIsALive bool
    @method setIsALive void

    * Cette classe représente une entité de la table catalog

*/
class CatalogEntity
{

    private int $id;
    private int $nuProduct;

    private string $reference;

    private string $color;
    private string $size;

    private int $quantity;

    private bool $isALive;

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
    
        * getNuProduct

        @return int

        * Retourne le numéro de produit de l'entité

    */
    public function getNuProduct() : int
    {
        return $this->nuProduct;
    }

    /*
    
        * setNuProduct

        @param int $nuProduct

        * Définit le numéro de produit de l'entité

    */
    public function setNuProduct(int $nuProduct)
    {
        $this->nuProduct = $nuProduct;
    }

    /*
    
        * getReference
    
        @return string
    
        * Retourne la référence de l'entité
    
        */
    public function getReference() : string
    {
        return $this->reference;
    }

    /*
    
        * setReference
    
        @param string $reference
    
        * Définit la référence de l'entité
    
    */
    public function setReference(string $reference)
    {
        $this->reference = $reference;
    }

    /*
    
        * getColor
    
        @return string
    
        * Retourne la couleur de l'entité
    
    */
    public function getColor() : string
    {
        return $this->color;
    }

    /*
    
        * setColor
    
        @param string $color
    
        * Définit la couleur de l'entité
    
    */
    public function setColor(string $color)
    {
        $this->color = $color;
    }

    /*
    
        * getSize
    
        @return string
    
        * Retourne la taille de l'entité
    
    */
    public function getSize() : string
    {
        return $this->size;
    }

    /*
    
        * setSize
    
        @param string $size
    
        * Définit la taille de l'entité
    
    */
    public function setSize(string $size)
    {
        $this->size = $size;
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

    /*
    
        * getIsALive
    
        @return bool
    
        * Retourne la disponibilité de l'entité
    
    */
    public function getIsALive() : bool
    {
        return $this->isALive;
    }

    /*
    
        * setIsALive
    
        @param bool $isALive
    
        * Définit la disponibilité de l'entité
    
    */
    public function setIsALive(bool $isALive)
    {
        $this->isALive = $isALive;
    }
}
