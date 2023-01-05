<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/ProductEntity.php';

/*

    * Class ProductModel

    * Cette classe permet de gérer les produits

*/
class ProductModel extends CI_Model
{

    /*
    
        * Function findIdBySport

        @param string $sport
        @return int

        * Cette fonction permet de récupérer l'id du sport
    
    */
    public function findIdBySport(string $sport): int
    {

        // * Requete SQL pour récupérer l'id du sport
        $queryIdSport = $this->db->query("Call sport.getIdSport('" . $sport . "')");

        // * On extrait l'id du sport du résultat de la requete

        if ($queryIdSport->row() != null) {

            $idSport = (int) $queryIdSport->row()->nusport;
        } else {

            $idSport = -1;
        }


        // * On passe l'id du sport en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryIdSport->next_result();
        $queryIdSport->free_result();

        // * On retourne l'id du sport
        return $idSport;
    }

    /*

        * Function findNameSportbyId

        @param int $sport
        @return string

        * Cette fonction permet de récupérer le nom du sport par l'id
        * du sport
    
    */
    public function findNameSportbyId(int $sport): String
    {

        // * Requete SQL pour récupérer le nom du sport
        $queryIdSport = $this->db->query("Call sport.getNameSport('" . $sport . "')");

        // * On extrait le nom du sport du résultat de la requete
        $idSport = $queryIdSport->row()->name;

        // * On passe le nom du sport en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryIdSport->next_result();
        $queryIdSport->free_result();

        // * On retourne le nom du sport
        return $idSport;
    }

    /*

        * Function heHaveAStockById

        @param int $idProduct
        @return bool

        * Cette fonction permet de savoir si un produit a du stock
    
    */
    public function heHaveAStockById(int $idProduct): bool
    {

        // * Requete SQL pour récupérer le stock du produit
        $queryStock = $this->db->query("Call catalog.getStockTotal('" . $idProduct . "')");

        // * On extrait le stock du produit du résultat de la requete
        $stock = (int) $queryStock->row()->stock;

        // * On passe le stock du produit en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryStock->next_result();
        $queryStock->free_result();

        // * Si il n'y a pas de stock, on retourne false sinon true
        if ($stock > 0) {

            return true;
        }
        return false;
    }

    /*

        * Function getStock

        @param int $idProduct
        @return Any

        * Cette fonction permet de récupérer le stock d'un produit
    
    */
    public function getStock(int $idProduct): array
    {

        // * Requete SQL pour récupérer le stock du produit
        $queryStock = $this->db->query("Call catalog.getStock(" . $idProduct . ")");

        // * On extrait le stock du produit du résultat de la requete
        $stock = $queryStock->result();

        // * On passe le stock du produit en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryStock->next_result();
        $queryStock->free_result();

        // * On retourne le stock du produit
        return $stock;
    }

    /*

        * Function getStockTotal

        @param int $idProduct
        @return int

        * Cette fonction permet de récupérer le stock total d'un produit
    
    */
    public function getStockTotal(int $idProduct)
    {

        // * Requete SQL pour récupérer le stock du produit
        $queryStock = $this->db->query("Call catalog.getStockTotal(" . $idProduct . ")");

        // * On extrait le stock du produit du résultat de la requete
        $stock = (int) $queryStock->row()->total;

        // * On passe le stock du produit en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryStock->next_result();
        $queryStock->free_result();

        // * On retourne le stock du produit
        return $stock;
    }

    /*

        * Function findBySportType

        @param string $sport
        @param string $type
        @return array

        * Retourne les produits d'un sport et d'un type
    
    */
    public function findBySportType(string $sport, string $type): array
    {


        // * Initialisation du tableau de retour
        $listProduct = array();

        // * On récupère l'id du sport
        $idSport = $this->findIdBySport($sport);

        // * Requete SQL pour récupérer les produits par le sport et id
        $queryProduct = $this->db->query("Call product.getProductBySportType(" . $idSport . ", '" . $type . "')");

        // * On stocke le résultat de la requete dans un tableau
        $products = $queryProduct->result();

        // * On passe l'id du sport en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryProduct->next_result();
        $queryProduct->free_result();

        // * On parcours les résultats de la requete
        foreach ($products as &$product) {

            // * On crée un objet ProductEntity
            $newProduct = new ProductEntity();

            // * On hydrate l'objet
            $newProduct->setId($product->idproduct);
            $newProduct->setType($product->type);
            $newProduct->setSport($product->nusport);
            $newProduct->setBrand($product->brand);
            $newProduct->setName($product->name);
            $newProduct->setGenre($product->gender);
            $newProduct->setPrice($product->price);
            $newProduct->setDescription($product->description);

            // * On ajoute une image de couverture si une image est fournie
            if ($product->image != null) {
                $newProduct->setImage($product->image);
            } else {
                $newProduct->setImage("");
            }

            //$newProduct->set_Stock($this->getStock($product->idproduit));

            // * On ajoute l'objet au tableau de retour
            array_push($listProduct, $newProduct);
        }

        // * On retourne le tableau de retour
        return $listProduct;
    }

    /*

        * Function findBySport

        @param int $idProduct
        @return ?ProductEntity

        * Retourne un produit par son id
    
    */
    public function findById(int $idProduct): ?ProductEntity
    {

        // * Requete SQL pour récupérer le produit par son id
        $queryProduct = $this->db->query("Call product.getProductById(" . $idProduct . ")");

        // * On stocke le résultat de la requete dans un tableau
        $product = $queryProduct->row();

        // * On crée un objet ProductEntity
        $queryProduct->next_result();
        $queryProduct->free_result();

        // * On vérifie que le produit n'est pas nul
        if ($product != null) {

            // * On crée un objet ProductEntity
            $newProduct = new ProductEntity();

            // * On hydrate l'objet
            $newProduct->setId($product->idproduct);
            $newProduct->setType($product->type);
            $newProduct->setSport($product->nusport);
            $newProduct->setBrand($product->brand);
            $newProduct->setName($product->name);
            $newProduct->setGenre($product->gender);
            $newProduct->setPrice($product->price);
            $newProduct->setDescription($product->description);
            $newProduct->setIsALive($product->isALive);

            // * On ajoute une image de couverture si une image est fournie
            if ($product->image != null) {
                $newProduct->setImage($product->image);
            } else {
                $newProduct->setImage("");
            }

            $newProduct->setStock($this->getStock($product->idproduct));

            // * On retourne l'objet
            return $newProduct;
        } else {

            // * On retourne null
            return null;
        }
    }

    public function findAllSortBySportCat(): array
    {

        return array(

            'Football' => array(

                'Vetement' => $this->findBySportType('Football', 'Vetement'),

                'Chaussure' => $this->findBySportType('Football', 'Chaussure'),

                'Equipement' => $this->findBySportType('Football', 'Equipement')

            ),

            'Volleyball' => array(

                'Vetement' => $this->findBySportType('Volleyball', 'Vetement'),

                'Chaussure' => $this->findBySportType('Volleyball', 'Chaussure'),

                'Equipement' => $this->findBySportType('Volleyball', 'Equipement')

            ),

            'Arts-martiaux' => array(

                'Vetement' => $this->findBySportType('Arts-martiaux', 'Vetement'),

                'Chaussure' => $this->findBySportType('Arts-martiaux', 'Chaussure'),

                'Equipement' => $this->findBySportType('Arts-martiaux', 'Equipement')

            ),

            'Badminton' => array(

                'Vetement' => $this->findBySportType('Badminton', 'Vetement'),

                'Chaussure' => $this->findBySportType('Badminton', 'Chaussure'),

                'Equipement' => $this->findBySportType('Badminton', 'Equipement')

            ),

        );
    }

    public function getAllAsAlive(): array
    {

        // * Initialisation du tableau de retour
        $listProduct = array();

        // * Requete SQL pour récupérer les produits par le sport et id
        $queryProduct = $this->db->query("Call product.getAllAsAlive()");

        // * On stocke le résultat de la requete dans un tableau
        $products = $queryProduct->result();

        // * On passe l'id du sport en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryProduct->next_result();
        $queryProduct->free_result();

        // * On parcours les résultats de la requete
        foreach ($products as &$product) {

            // * On crée un objet ProductEntity
            $newProduct = new ProductEntity();

            // * On hydrate l'objet
            $newProduct->setId($product->idproduct);
            $newProduct->setType($product->type);
            $newProduct->setSport($product->nusport);
            $newProduct->setBrand($product->brand);
            $newProduct->setName($product->name);
            $newProduct->setGenre($product->gender);
            $newProduct->setPrice($product->price);
            $newProduct->setDescription($product->description);
            $newProduct->setIsALive($product->isALive);

            // * On ajoute une image de couverture si une image est fournie
            if ($product->image != null) {
                $newProduct->setImage($product->image);
            } else {
                $newProduct->setImage("");
            }
            
            // * On ajoute l'objet au tableau de retour
            array_push($listProduct, $newProduct);
        }

        // * On retourne le tableau de retour
        return $listProduct;
    }

    public function getAllAsNotAlive(): array
    {

        // * Initialisation du tableau de retour
        $listProduct = array();

        // * Requete SQL pour récupérer les produits par le sport et id
        $queryProduct = $this->db->query("Call product.getAllNotAlive()");

        // * On stocke le résultat de la requete dans un tableau
        $products = $queryProduct->result();

        // * On passe l'id du sport en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryProduct->next_result();
        $queryProduct->free_result();

        // * On parcours les résultats de la requete
        foreach ($products as &$product) {

            // * On crée un objet ProductEntity
            $newProduct = new ProductEntity();

            // * On hydrate l'objet
            $newProduct->setId($product->idproduct);
            $newProduct->setType($product->type);
            $newProduct->setSport($product->nusport);
            $newProduct->setBrand($product->brand);
            $newProduct->setName($product->name);
            $newProduct->setGenre($product->gender);
            $newProduct->setPrice($product->price);
            $newProduct->setDescription($product->description);
            $newProduct->setIsALive($product->isALive);

            // * On ajoute une image de couverture si une image est fournie
            if ($product->image != null) {
                $newProduct->setImage($product->image);
            } else {
                $newProduct->setImage("");
            }
            
            // * On ajoute l'objet au tableau de retour
            array_push($listProduct, $newProduct);
        }

        // * On retourne le tableau de retour
        return $listProduct;
    }

    public function filterByBrand(string $title, array $products, array $get): array
    {

        if (!empty($get['brand'])) {

            $brand = $get['brand'];

            $listBrandUgly = explode(',', $brand);
            $listBrand = [];

            $title .= " Marques -> ";

            foreach ($listBrandUgly as $category) {

                $title .= $category . " - ";
                array_push($listBrand, $this->formatStr($category));

            }

            $title = substr($title, 0, -3) . ", ";

            // * Initialisation du tableau de retour
            $listProductByBrand = array();

            // * On parcours le tableau de produit
            foreach ($products as &$product) {

                if (in_array($this->formatStr($product->getBrand()), $listBrand)) {

                    // * On ajoute l'objet au tableau de retour
                    array_push($listProductByBrand, $product);
                }
            }

            // * On retourne le tableau de retour
            return array(
                'title' => $title,
                'products' => $listProductByBrand
            );

        } else {

            return array(

                'title' => $title,
                'products' => $products

            );
        }
    }

    public function filterByCategory(string $title, array $products, array $get): array
    {

        if (!empty($get['category'])) {

            $category = $get['category'];

            $listCategoryUgly = explode(',', $category);
            $listCategory = [];

            $title .= " Catégorie -> ";

            foreach ($listCategoryUgly as $category) {

                $title .= $category . " - ";
                array_push($listCategory, $this->formatStr($category));

            }

            $title = substr($title, 0, -3) . ", ";

            // * Initialisation du tableau de retour
            $listProductByCategory = array();

            // * On parcours le tableau de produit
            foreach ($products as &$product) {

                if (in_array($this->formatStr($product->getType()), $listCategory)) {

                    // * On ajoute l'objet au tableau de retour
                    array_push($listProductByCategory, $product);
                }
            }

            // * On retourne le tableau de retour
            return array(
                'title' => $title,
                'products' => $listProductByCategory
            );
        } else {

            return array(
                'title' => $title,
                'products' => $products
            );
        }
    }

    public function filterBySport(string $title, array $products, array $get) : array
    {

        if (!empty($get['sport'])) {

            $sport = $get['sport'];

            $listSportUgly = explode(',', $sport);
            $listSport = [];

            $title .= " Sport -> ";

            foreach ($listSportUgly as $sport) {

                $title .= $sport . " - ";
                array_push($listSport, $this->formatStr($sport));

            }

            $title = substr($title, 0, -3) . ", ";

            // * Initialisation du tableau de retour
            $listProductBySport = array();

            // * On parcours le tableau de produit
            foreach ($products as &$product) {

                if (in_array($this->formatStr($product->getSportName()), $listSport)) {

                    // * On ajoute l'objet au tableau de retour
                    array_push($listProductBySport, $product);
                }
            }

            // * On retourne le tableau de retour
            return array(
                'title' => $title,
                'products' => $listProductBySport
            );

        } else {

            return array (
                'title' => $title,
                'products' => $products
            );
        }
    }

    public function filterByPrice(string $title, array $products, array $get) : array
    {
    
        if (!empty($get['price']) && stristr($get['price'], '-')) {

            $price = $get['price'];

            $listPrice = explode('-', $price);

            $title .= " Prix -> " . $listPrice[0] . "€ - " . $listPrice[1] . "€, ";

            // * Initialisation du tableau de retour
            $listProductByPrice = array();

            // * On parcours le tableau de produit

            foreach ($products as &$product) {

                if ($product->getPrice() >= $listPrice[0] && $product->getPrice() <= $listPrice[1]) {

                    // * On ajoute l'objet au tableau de retour
                    array_push($listProductByPrice, $product);
                }
            }

            // * On retourne le tableau de retour

            return array(
                'title' => $title,
                'products' => $listProductByPrice
            );

        } else {

            return array(
                'title' => $title,
                'products' => $products
            );


        }
    }

    public function search(string $title, array $products, string $search) : array
    {

        $title .= " Recherche -> " . $search . ", ";

        // * Initialisation du tableau de retour
        $listProductBySearch = array();

        $search = $this->formatStr($search);

        $search = explode(' ', $search);
        $countSearch = count($search);

        // * On parcours le tableau de produit
        foreach ($products as &$product) {

            $count = 0;

            foreach ($search as $word) {

                if (
                    stristr($this->formatStr($product->getName()), $word) ||
                    stristr($this->formatStr($product->getBrand()), $word)
                    ) {

                    $count++;

                }
            }

            if ($countSearch == $count) {

                // * On ajoute l'objet au tableau de retour
                array_push($listProductBySearch, $product);
            }

        }

        // * On retourne le tableau de retour
        return array(
            'title' => $title,
            'products' => $listProductBySearch
        );
    }

    public function filtred(array $get, array $products) : array
    {

        if (empty($get)) {

            return array(
                'title' => "Tous les produits",
                'products' => $products,
                'productNotFiltredByBrand' => $products
            );
        }

        $title = "Produits filtrés par :";

        $res = $this->filterByCategory($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        $res = $this->filterBySport($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        $res = $this->filterByPrice($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        if (!empty($get['search'])) {

            $res = $this->search($title, $products, $get['search']);
            $title = $res['title'];
            $products = $res['products'];

            
        }

        $productNotFiltredByBrand = $products;

        $res = $this->filterByBrand($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        return array(
            'title' => $title,
            'products' => $products,
            'productNotFiltredByBrand' => $productNotFiltredByBrand
        );

    }

    public function getAllBrand() : array
    {

        $queryBrand = $this->db->query("Call product.getAllBrand()");

        $res = $queryBrand->result();

        $queryBrand->next_result();
        $queryBrand->free_result();

        $listBrand = array();

        foreach ($res as $brand) {

            array_push($listBrand, $brand->brand);

        }

        sort($listBrand);

        return $listBrand;

    }

    public function getAllBrandByProducts(array $products) : array
    {

        $listBrand = array();

        foreach ($products as $product) {

            if (!in_array($product->getBrand(), $listBrand)) {

                array_push($listBrand, $product->getBrand());

            }

        }

        sort($listBrand);

        return $listBrand;

    }

    public function delete(int $id)
    {

        $query = $this->db->query("Call product.delProduct($id)");

        $query->next_result();
        $query->free_result();

    }

    public function getAllCategory() : array
    {

        return array(
            'Chaussure',
            'Vếtement',
            'Equipement',
        );

    }

    public function getAllSport() : array
    {

        $querySport = $this->db->query("Call sport.getAll()");

        $sport = $querySport->result();

        $querySport->next_result();
        $querySport->free_result();

        $listSport = array();

        foreach ($sport as $sport) {

            array_push($listSport, array(

                'id' => $sport->nusport,
                'name' => $sport->name,

            ));

        }

        sort($listSport);

        return $listSport;

    }

    private function formatStr(string $str): string
    {

        $str = trim($str);

        $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. 'œ'
        $str = preg_replace('#&[^;]+;#', '', $str);
        $str = str_replace('-', '+', $str);
        $str = str_replace('\'', '+', $str);

        $str = strtolower($str);

        return $str;
    }


    public function getSize(ProductEntity $product) {
        $stocks = $product->getStock();

        $res = [];

        foreach ($stocks as $values) {
            array_push($res,$values->getSize());
        }

        $res = array_unique($res);

        if ($product->getType() == "Chaussure") {

            sort($res);

        } else {

            usort($res, array($this ,"sortSizeString"));

        }

        return $res;
    }


    private function sortSizeString($a, $b)
    {

        $sizes = array(
        "XXS" => 0,
        "XS" => 1,
        "S" => 2,
        "M" => 3,
        "L" => 4,
        "XL" => 5,
        "XXL" => 6
        );

        $asize = $sizes[$a];
        $bsize = $sizes[$b];

        if ($asize == $bsize) {
            return 0;
        }

        return ($asize > $bsize) ? 1 : -1;
    }

    public function avalaibleColor($product) {
        $avalaibleColors = [];

        foreach ($product->getStock() as $value) {
            $color = $value->getColor();
            if ($color != null) {
                if (!in_array(str_replace(' ', '+', $color),$avalaibleColors)) {
                    array_push($avalaibleColors, str_replace(' ', '+', $color));
                }
            }
        }

        return $avalaibleColors;
    }

    public function avalaibleSize($product, $color) {
        $tailledispo = [];
        foreach ($product->getStock() as $stock) {
            if ($stock->getColor() == $color && $stock->getQuantity() != 0) {
                array_push($tailledispo, $stock->getSize());
            }
        }

        return $tailledispo;
    }
    
}
