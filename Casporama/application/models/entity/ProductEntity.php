<?php
/*

    * ProductEntity

    * Cette classe représente une entité de la table produit

*/
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

    private array $image;

    private array $stock;

    /*
    
        * Function get_id
    
        @return int
    
        * Cette fonction retourne l'id de l'entité
    
    */
    public function get_id() : int {

        return $this->id;

    }

    /*
    
        * Function set_id
    
        @param int $id
    
        * Cette fonction modifie l'id de l'entité
    
    */
    public function set_id(int $id){

        $this->id = $id;

    }

    /*
    
        * Function get_reference
    
        @return int
    
        * Cette fonction retourne la référence de l'entité
    
    */
    public function get_reference() : int {

        return $this->reference;

    }

    /*
    
        * Function set_reference
    
        @param int $reference
    
        * Cette fonction modifie la référence de l'entité
    
    */
    public function set_reference(int $reference){

        $this->reference = $reference;

    }

    /*
    
        * Function get_type
    
        @return string
    
        * Cette fonction retourne le type de l'entité
    
    */
    public function get_type() : string {

        return $this->type;

    }

    /*
    
        * Function set_type
    
        @param string $type
    
        * Cette fonction modifie le type de l'entité
    
    */
    public function set_type(string $type){

        $this->type = $type;

    }

    /*
    
        * Function get_sport
    
        @return string
    
        * Cette fonction retourne le sport de l'entité
    
    */
    public function get_sport() : string {

        return $this->sport;

    }

    /*
    
        * Function set_sport
    
        @param string $sport
    
        * Cette fonction modifie le sport de l'entité
    
    */
    public function set_sport(int $sport){

        $this->sport = $sport;

    }

    /*
    
        * Function get_brand
    
        @return string
    
        * Cette fonction retourne la marque de l'entité
    
    */
    public function get_brand() : string {

        return $this->brand;

    }

    /*
    
        * Function set_brand
    
        @param string $brand
    
        * Cette fonction modifie la marque de l'entité
    
    */
    public function set_brand(string $brand){

        $this->brand = $brand;

    }

    /*
    
        * Function get_name
    
        @return string
    
        * Cette fonction retourne le nom de l'entité
    
    */
    public function get_name() : string {

        return $this->name;

    }

    /*
    
        * Function set_name
    
        @param string $name
    
        * Cette fonction modifie le nom de l'entité
    
    */
    public function set_name(string $name){

        $this->name = $name;

    }

    /*
    
        * Function get_genre
    
        @return string
    
        * Cette fonction retourne le genre de l'entité
    
    */
    public function get_genre() : string {

        return $this->genre;

    }

    /*
    
        * Function set_genre
    
        @param string $genre
    
        * Cette fonction modifie le genre de l'entité
    
    */
    public function set_genre(string $genre){

        $this->genre = $genre;

    }

    /*
    
        * Function get_price
    
        @return float
    
        * Cette fonction retourne le prix de l'entité
    
    */
    public function get_price() : float {

        return $this->price;

    }

    /*
    
        * Function set_price
    
        @param float $price
    
        * Cette fonction modifie le prix de l'entité
    
    */
    public function set_price(float $price){

        $this->price = $price;

    }

    /*
    
        * Function get_description
    
        @return string
    
        * Cette fonction retourne la description de l'entité
    
    */
    public function get_description() : string {

        return $this->description;

    }

    /*
    
        * Function set_description
    
        @param string $description
    
        * Cette fonction modifie la description de l'entité
    
    */
    public function set_description(string $description){

        $this->description = $description;

    }

    /*
    
        * Function get_image
    
        @return array
    
        * Cette fonction retourne les images de l'entité
    
    */
    public function get_images() : array {

        return $this->image;
    }

    /*
    
        * Function set_image
    
        @param array $image
    
        * Cette fonction sélectione l'image principale
    
    */
    public function get_cover() : string {

        return base_url($this->image[0]);
    }

    /*
    
        * Function set_image
    
        @param array $image
    
        * Cette fonction modifie les images de l'entité
    
    */
    public function set_image(string $image){

        $this->image = explode(";", $image);

    }

    /*
    
        * Function get_stock
    
        @return array
    
        * Cette fonction retourne le stock de l'entité
    
    */
    public function get_stock() : array {

        return $this->stock;

    }

    /*
    
        * Function set_stock
    
        @param array $stock
    
        * Cette fonction modifie le stock de l'entité
    
    */
    public function set_stock(array $stock){

        $this->stock = $stock;

    }

}