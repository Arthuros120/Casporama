<?php


class ProductEntity {

    private int $id;
    private int $reference;

    private string $type;
    private string $sport;

    private string $brand;
    private string $name;

    private string $genre;

    private float $price;

    private string $description;

    private string $image;

    private array $stock;

    public function get_id(){

        return $this->id;

    }

    public function set_id(int $id){

        $this->id = $id;

    }

    public function get_reference(){

        return $this->reference;

    }

    public function set_reference(int $reference){

        $this->reference = $reference;

    }

    public function get_type(){

        return $this->type;

    }

    public function set_type(string $type){

        $this->type = $type;

    }

    public function get_sport(){

        return $this->sport;

    }

    public function set_sport(int $sport){

        $this->sport = $sport;

    }

    public function get_brand(){

        return $this->brand;

    }

    public function set_brand(string $brand){

        $this->brand = $brand;

    }

    public function get_name(){

        return $this->name;

    }

    public function set_name(string $name){

        $this->name = $name;

    }

    public function get_genre(){

        return $this->genre;

    }

    public function set_genre(string $genre){

        $this->genre = $genre;

    }

    public function get_price(){

        return $this->price;

    }

    public function set_price(float $price){

        $this->price = $price;

    }

    public function get_description(){

        return $this->description;

    }

    public function set_description(string $description){

        $this->description = $description;

    }

    public function get_image(){

        return $this->image;

    }

    public function set_image(string $image){

        

        $this->image = $image;

    }

    public function get_stock(){

        return $this->stock;

    }

    public function set_stock(array $stock){

        $this->stock = $stock;

    }

}