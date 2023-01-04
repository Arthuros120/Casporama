<?php
/*

    * StockEntity

    * Cette classe représente une entité de la table catalog

*/
class StockEntity
{
    private int $id;
    private int $reference;

    private int $nuproduct;

    private string $color;
    private string $size;

    private int $quantity;


    /*
    
        * Function getId
    
        @return int
    
        * Cette fonction retourne l'id de l'entité
    
    */
    public function getId() : int
    {

        return $this->id;

    }

    /*
    
        * Function setId
    
        @param int $id
    
        * Cette fonction modifie l'id de l'entité
    
    */
    public function setId(int $id)
    {

        $this->id = $id;

    }

    /*
    
        * Function getReference
    
        @return int
    
        * Cette fonction retourne le reference de l'entité
    
    */
    public function getReference() : int
    {

        return $this->reference;

    }

    /*
    
        * Function setReference
    
        @param int $reference
    
        * Cette fonction modifie la reference de l'entité
    
    */
    public function setReference(int $reference)
    {

        $this->reference = $reference;

    }
    /**
     * @return int
     */
    public function getNuproduct(): int
    {
        return $this->nuproduct;
    }

    /**
     * @param int $nuproduct
     */
    public function setNuproduct(int $nuproduct): void
    {
        $this->nuproduct = $nuproduct;
    }

    /*
    
        * Function getColor
    
        @return string
    
        * Cette fonction retourne le couleur de l'entité
    
    */
    public function getColor() : string
    {

        return $this->color;

    }

    /*
    
        * Function setcolor
    
        @param string $color
    
        * Cette fonction modifie le couleur de l'entité
    
    */
    public function setColor(string $color)
    {

        $this->color = $color;

    }

    /*
    
        * Function getSize
    
        @return string
    
        * Cette fonction retourne la taille de l'entité
    
    */
    public function getSize() : string
    {

        return $this->size;

    }

    /*
    
        * Function setSize
    
        @param string $Size
    
        * Cette fonction modifie la taille de l'entité
    
    */
    public function setSize(string $size)
    {

        $this->size = $size;

    }

    /*
    
        * Function getQuantity
    
        @return int
    
        * Cette fonction retourne la quantité de l'entité
    
    */
    public function getQuantity() : int
    {

        return $this->quantity;

    }

    /*
    
        * Function setQuantity
    
        @param int $quantity
    
        * Cette fonction modifie la quantité de l'entité
    
    */
    public function setQuantity(int $quantity)
    {

        $this->quantity = $quantity;

    }

}
