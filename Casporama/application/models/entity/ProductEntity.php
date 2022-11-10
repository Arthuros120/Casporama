<?php
/*

    * ProductEntity

    * Cette classe représente une entité de la table produit

*/
class ProductEntity
{

    private int $id;

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
    
        * Function getType
    
        @return string
    
        * Cette fonction retourne le type de l'entité
    
    */
    public function getType() : string
    {

        return $this->type;

    }

    /*
    
        * Function setType
    
        @param string $type
    
        * Cette fonction modifie le type de l'entité
    
    */
    public function setType(string $type)
    {

        $this->type = $type;

    }

    /*
    
        * Function getSport
    
        @return string
    
        * Cette fonction retourne le sport de l'entité
    
    */
    public function getSport() : string
    {

        return $this->sport;

    }

    /*
    
        * Function setSport
    
        @param string $sport
    
        * Cette fonction modifie le sport de l'entité
    
    */
    public function setSport(int $sport)
    {

        $this->sport = $sport;

    }

    /*
    
        * Function getBrand
    
        @return string
    
        * Cette fonction retourne la marque de l'entité
    
    */
    public function getBrand() : string
    {

        return $this->brand;

    }

    /*
    
        * Function setBrand
    
        @param string $brand
    
        * Cette fonction modifie la marque de l'entité
    
    */
    public function setBrand(string $brand)
    {

        $this->brand = $brand;

    }

    /*
    
        * Function getName
    
        @return string
    
        * Cette fonction retourne le nom de l'entité
    
    */
    public function getName() : string
    {

        return $this->name;

    }

    /*
    
        * Function setName
    
        @param string $name
    
        * Cette fonction modifie le nom de l'entité
    
    */
    public function setName(string $name)
    {

        $this->name = $name;

    }

    /*
    
        * Function getGenre
    
        @return string
    
        * Cette fonction retourne le genre de l'entité
    
    */
    public function getGenre() : string
    {

        return $this->genre;

    }

    /*
    
        * Function setGenre
    
        @param string $genre
    
        * Cette fonction modifie le genre de l'entité
    
    */
    public function setGenre(string $genre)
    {

        $this->genre = $genre;

    }

    /*
    
        * Function getPrice
    
        @return float
    
        * Cette fonction retourne le prix de l'entité
    
    */
    public function getPrice() : float
    {

        return $this->price;

    }

    /*
    
        * Function setPrice
    
        @param float $price
    
        * Cette fonction modifie le prix de l'entité
    
    */
    public function setPrice(float $price)
    {

        $this->price = $price;

    }

    /*
    
        * Function getDescription
    
        @return string
    
        * Cette fonction retourne la description de l'entité
    
    */
    public function getDescription() : string
    {

        return $this->description;

    }

    /*
    
        * Function setDescription
    
        @param string $description
    
        * Cette fonction modifie la description de l'entité
    
    */
    public function setDescription(string $description)
    {

        $this->description = $description;

    }

    /*
    
        * Function getImage
    
        @return array
    
        * Cette fonction retourne les images de l'entité
    
    */
    public function getImages() : array
    {

        return $this->image;
    }

    /*
    
        * Function getCover

        * Cette fonction sélectione l'image principale
    
    */
    public function getCover() : string
    {

        return base_url($this->image[0]);
    }

    /*
    
        * Function setImage
    
        @param array $image
    
        * Cette fonction modifie les images de l'entité
    
    */
    public function setImage(string $image)
    {

        $this->image = explode(";", $image);

    }

    /*
    
        * Function getStock
    
        @return array
    
        * Cette fonction retourne le stock de l'entité
    
    */
    public function getStock() : array
    {

        return $this->stock;

    }

    /*
    
        * Function setStock
    
        @param array $stock
    
        * Cette fonction modifie le stock de l'entité
    
    */
    public function setStock(array $stock)
    {

        $this->stock = $stock;

    }

}
