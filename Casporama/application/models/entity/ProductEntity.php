<?php

require_once APPPATH . 'models/entity/StockEntity.php';

/*

    * ProductEntity

    * Public

    @method getId int
    @method setId void
    @method getType string
    @method setType void
    @method getSport int
    @method getSportName string
    @method setSport void
    @method getBrand string
    @method setBrand void
    @method getName string
    @method setName void
    @method getGenre string
    @method setGenre void
    @method getPrice float
    @method setPrice void
    @method getDescription string
    @method getTinyDescription string
    @method setDescription void
    @method getImage array
    @method getImageString string
    @method getCover string
    @method getCoverName string
    @method getImagesWithoutCover array
    @method setImage void
    @method getStock array
    @method setStock void
    @method getIsALive bool
    @method setIsALive void

    ! Private

    @method raccourcirChaine string

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

    private bool $isALive;

    /*
    
        * Function getId
    
        @return int
    
        * Cette fonction retourne l'id de l'entité
    
    */
    public function getId(): int
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
    public function getType(): string
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
    public function getSport(): string
    {

        return $this->sport;
    }

    public function getSportName() : string
    {
        switch ($this->sport) {
            case 1:
                return 'Football';
            case 2:
                return 'Volleyball';
            case 3:
                return 'Badminton';
            case 4:
                return 'Arts-martiaux';
            default:
                return 'Sport inconnu';
        }
    }

    /*
    
        * Function setSport
    
        @param int $sport
    
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
    public function getBrand(): string
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
    public function getName(): string
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
    public function getGenre(): string
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
    public function getPrice(): float
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
    public function getDescription(): string
    {

        return $this->description;
    }

    /*
    
        * Function getTinyDescription
    
        @return string
    
        * Cette fonction retourne la description de l'entité en version réduite
    
    */
    public function getTinyDescription(int $size): string
    {

        return $this->raccourcirChaine($this->description, $size);
    }

    /*
    
        * Function setDescription
    
        @param string $description
    
        * Cette fonction modifie la description de l'entité
    
    */
    public function setDescription(string $description)
    {

        $this->description = trim($description);
    }

    /*
    
        * Function getImage
    
        @return array
    
        * Cette fonction retourne les images de l'entité
    
    */
    public function getImages(): array
    {

        return $this->image;
    }

    /*
    
        * Function getImageString
    
        @return string
    
        * Cette fonction retourne les images de l'entité en string
    
    */
    public function getImageString(): string
    {

        $imageString = str_replace("upload/images/", "", $this->image);

        $imageString = implode(';', $imageString);

        return $imageString;

    }

    /*
    
        * Function getCover

        * Cette fonction sélectione l'image principale
    
    */
    public function getCover(): string
    {

        return base_url($this->image[0]);
    }

    /*
    
        * Function getCoverName

        * Cette fonction sélectione l'image principale
    
    */
    public function getCoverName(): string
    {

        return $this->image[0];
    }

    /*

        * Function getImagesWithoutCover

        * Cette fonction retourne les images de l'entité sans l'image principale

    */
    public function getImagesWithoutCover(): array
    {

        $res = array();

        for ($i = 1; $i < count($this->image); $i++) {

            array_push($res, base_url($this->image[$i]));
        }

        return $res;
    }

    /*
    
        * Function setImage
    
        @param array $image
    
        * Cette fonction modifie les images de l'entité
    
    */
    public function setImage(string $image)
    {

        $imageTab = explode(";", $image);

        $this->image = array();

        foreach ($imageTab as $i) {

            if ($i != "") {

                array_push($this->image, "upload/images/" . $i);

            }
            
        }
        
    }


    /*
    
        * Function setStock
    
        @param array $stock
    
        * Cette fonction modifie le stock de l'entité
    
    */
    public function setStock(array $stock)
    {
        $res = array();

        foreach ($stock as &$i) {

            $newStockEntity = new StockEntity();

            $newStockEntity->setId((int) $i->id);
            $newStockEntity->setReference((int) $i->reference);
            $newStockEntity->setNuproduct((int)$i->nuproduct );
            $newStockEntity->setColor((string) $i->color);
            $newStockEntity->setSize((string) $i->size);
            $newStockEntity->setQuantity((int) $i->quantity);

            $res[] = $newStockEntity;
        }

        $this->stock = $res;
    }

    public function getVariant(int $idvariant) : ?StockEntity
    {
        foreach ($this->stock as $stock) {
            if ($stock->getId() == $idvariant) {
                return $stock;
            }
        }
        return null;
    }

    /*
    
        * Function getStock

        * Cette fonction retourne le stock de l'entité
    
    */

    public function getStock(): array
    {

        return $this->stock;
    }

    /*
    
        * Function setIsALive
    
        @param bool $isALive
    
        * Cette fonction set le statut de l'entité
    
    */
    public function setIsALive(bool $isALive)
    {

        $this->isALive = $isALive;

    }

    /*
    
        * Function getIsALive
    
        @return bool
    
        * Cette fonction retourne le statut de l'entité
    */
    public function getIsALive(): bool
    {

        return $this->isALive;

    }

    /**
     * La fonction raccourcirChaine() permet de réduire une chaine trop longue
     * passée en paramètre.
     *
     * Si la troncature a lieu dans un mot, la fonction tronque à l'espace suivant.
     *
     * @param : string $chaine le texte trop long à tronquer
     * @param : integer $tailleMax la taille maximale de la chaine tronquée
     * @return : string
     */
    private function raccourcirChaine($chaine, $tailleMax) : string
    {
        // Variable locale
        $positionDernierEspace = 0;
        if (strlen($chaine) >= $tailleMax) {
            $chaine = substr($chaine, 0, $tailleMax);
            $positionDernierEspace = strrpos($chaine, ' ');
            $chaine = substr($chaine, 0, $positionDernierEspace) . '...';
        }
        return $chaine;
    }
}
