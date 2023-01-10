<?php

/*

    * CatalogEntity

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

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getNuProduct() : int
    {
        return $this->nuProduct;
    }

    public function setNuProduct(int $nuProduct)
    {
        $this->nuProduct = $nuProduct;
    }

    public function getReference() : string
    {
        return $this->reference;
    }

    public function setReference(string $reference)
    {
        $this->reference = $reference;
    }

    public function getColor() : string
    {
        return $this->color;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function getSize() : string
    {
        return $this->size;
    }

    public function setSize(string $size)
    {
        $this->size = $size;
    }

    public function getQuantity() : int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getIsALive() : bool
    {
        return $this->isALive;
    }

    public function setIsALive(bool $isALive)
    {
        $this->isALive = $isALive;
    }
}
