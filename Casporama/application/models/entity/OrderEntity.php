<?php

class OrderEntity
{

    private int $idorder;
    private string $dateorder;
    private string $idproducts;
    private string $quantity;
    private int $iduser;
    private int $idlocation;
    private string $state;
    /**
     * @return int
     */
    public function getIdorder(): int
    {
        return $this->idorder;
    }

    /**
     * @param int $idorder
     */
    public function setIdorder(int $idorder): void
    {
        $this->idorder = $idorder;
    }

    /**
     * @return string
     */
    public function getDateorder(): string
    {
        return $this->dateorder;
    }

    /**
     * @param string $dateorder
     */
    public function setDateorder(string $dateorder): void
    {
        $this->dateorder = $dateorder;
    }

    /**
     * @return string
     */
    public function getIdproducts(): string
    {
        return $this->idproducts;
    }

    /**
     * @param string $idproducts
     */
    public function setIdproducts(string $idproducts): void
    {
        $this->idproducts = $idproducts;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getIduser(): int
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     */
    public function setIduser(int $iduser): void
    {
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getIdlocation(): int
    {
        return $this->idlocation;
    }

    /**
     * @param int $idlocation
     */
    public function setIdlocation(int $idlocation): void
    {
        $this->idlocation = $idlocation;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }



}