<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/ProductEntity.php';
require_once APPPATH . 'models/entity/CatalogEntity.php';

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

        * Cette fonction permet de récupérer le stock d'un produit, uniquement les vivant
    
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

        * Function getStock

        @param int $idProduct
        @return Any

        * Cette fonction permet de récupérer le stock d'un produit
    
    */
    public function getStockAll(int $idProduct): array
    {

        // * Requete SQL pour récupérer le stock du produit
        $queryStock = $this->db->query("Call catalog.getStockAll(" . $idProduct . ")");

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

            // * On ajoute l'objet au tableau de retour
            array_push($listProduct, $newProduct);
        }

        // * On retourne le tableau de retour
        return $listProduct;
    }

    /*

        * Function findById

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

    /* 

        * Function heHaveProductById

        * Permet de savoir si l'id correspond à un produit

        @param int $id
        @return bool
    
    */
    public function heHaveProductById(int $id) : bool
    {

        // * Requete SQL pour récupérer le produit par son id
        $queryProduct = $this->db->query("Call product.getProductById(" . $id . ")");

        // * On stocke le résultat de la requete dans un tableau
        $product = $queryProduct->row();

        // * On crée un objet ProductEntity
        $queryProduct->next_result();
        $queryProduct->free_result();

        // * On vérifie que le produit n'est pas nul
        return ($product != null);

    }

    /*

        * Function findByName

        @param string $name
        @return ?ProductEntity

        * Retourne un produit par son nom
    
    */
    public function findByName(string $nameProduct): ?ProductEntity
    {

        $nameProduct = str_replace("'", "\'", $nameProduct);

        // * Requete SQL pour récupérer le produit par son id
        $queryProduct = $this->db->query("Call product.getProductByName('" . $nameProduct . "')");

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

    /*

        * Function findByNameWithoutSelf

        @param string $name
        @return bool

        * Permet de savoir si le nom du produit est en double
    
    */
    public function findByNameWithoutSelf(string $nameProduct, int $id) : bool
    {
        $nameProduct = str_replace("'", "\'", $nameProduct);

        // * Requete SQL pour récupérer le produit par son id
        $queryProduct = $this->db->query(
            "Call product.getProductByNameWithoutSelf('" . $nameProduct . "' , " . $id . ")"
        );

        // * On stocke le résultat de la requete dans un tableau
        $product = $queryProduct->row();

        // * On crée un objet ProductEntity
        $queryProduct->next_result();
        $queryProduct->free_result();

        return ($product == null);

    }

    /*

        * Function findAllSortBySportCat

        @return array

        * Retourne un tableau de produit par sport et par type
    
    */
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

    /*

        * Function getAllAsAlive

        @return array

        * Retourne tous les produits en vie
    
    */
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

    /*

        * Function getAllAsNotAlive

        @return array

        * Retourne tous les produits mort
    
    */
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

    /*

        * Function getProductByRangeAndSportAndType

        @param array $range, string $sport, string $type

        @return array

        * Retourne tous les produits par le sport et le type en fonction d'un intervalle donné
    
    */
    public function getProductByRangeAndSportAndType(array $range, string $sport, string $type) : array
    {

        $listProduct = array();

        $queryProduct = $this->db->query(
            "Call product.getProductByRangeAndSportAndType(?, ?, ?, ?)",
            array($range[0], $range[1], $sport, $type)
        );

        $products = $queryProduct->result();

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

    /*

        * Function filterByBrand

        @param string $title, array $products, array $get

        @return array

        * Filtre les produits par les marques
    
    */
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

    /*

        * Function filterByCategory

        @param string $title, array $products, array $get

        @return array

        * Filtre les produits par les catégories
    
    */
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

    /*

        * Function filterBySport

        @param string $title, array $products, array $get

        @return array

        * Filtre les produits par les sports
    
    */
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

    /*

        * Function filterByPrice

        @param string $title, array $products, array $get

        @return array

        * Filtre les produits par les prix
    
    */
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

    /*

        * Function search

        @param string $title, array $products, string $search

        @return array

        * Filtre les produits en fonction de la recherche
    
    */
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

    /*

        * Function filtred

        @param array $get, array $products

        @return array

        * Renvoie les produits filtrés
    
    */
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

    /*

        * Function filtredWithoutSportAndType

        @param array $get, array $products

        @return array

        * Renvoie les produits filtrés sans le sport et le type
    
    */
    public function filtredWithoutSportAndType(array $get, array $products) : array
    {

        if (empty($get)) {

            return array(
                'title' => "Tous les produits",
                'products' => $products,
                'productNotFiltredByBrand' => $products
            );
        }

        $title = "Produits filtrés par :";

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

    /*

        * Function getAllBrand

        @return array

        * Renvoie la liste de toutes les marques
    
    */
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

    /*

        * Function getAllBrandByProducts

        @param array $products

        @return array

        * Renvoie la liste de toutes les marques en fonction des produits
    
    */
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

    /*

        * Function addProduct

        @param array $post, array $images

        @return int

        * Permet d'ajouter un produit tout en renvoyant son id
    
    */
    public function addProduct(array $post, array $images) : int
    {

        $id = $this->generateId();
        $name = $post['name'];
        $brand = $post['brand'];
        $price = $post['price'];
        $type = $post['type'];
        $sport = $post['sport'];
        $description = $post['description'];
        $gender = $post['genre'];

        $name = str_replace("'", "\'", $name);
        $brand = str_replace("'", "\'", $brand);
        $description = str_replace("'", "\'", $description);

        $date = date("Y-m-d H:i:s");

        $strImages = "";

        foreach ($images as $image) {

            if ($image != "default.jpg") {

                $strImages .= "import/" . $image . ";";

            }
        }

        $strImages = substr($strImages, 0, -1);

        $query = $this->db->query(
"Call product.addProduct($id,'$type',$sport,'$brand','$name','$gender',$price,'$description','$strImages',1,'$date')"
        );

        $query->next_result();
        $query->free_result();

        return $id;

    }

    /*

        * Function editProduct

        @param array $post, int $id

        @return void

        * Permet de modifier un produit
    
    */
    public function editProduct(array $post, int $id) : void
    {
    
        $name = $post['name'];
        $brand = $post['brand'];
        $price = $post['price'];
        $type = $post['type'];
        $sport = $post['sport'];
        $description = $post['description'];
        $gender = $post['genre'];

        $name = str_replace("'", "\'", $name);
        $brand = str_replace("'", "\'", $brand);
        $description = str_replace("'", "\'", $description);

        $query = $this->db->query(
            "Call product.updateProduct($id, '$type', $sport, '$brand', '$name', '$gender', $price, '$description')"
        );

        $query->next_result();
        $query->free_result();

    }

    /*

        * Function addImages

        @param array $images, int $id

        @return void

        * Permet d'ajouter des images à un produit
    
    */
    public function addImages(array $images, int $id) : void
    {

        $product = $this->findById($id);

        $strImages = ";";

        foreach ($images as $image) {

                $strImages .= "import/" . $image . ";";

        }

        $strImages = substr($strImages, 0, -1);

        $strImages = $product->getImageString() . $strImages;

        $query = $this->db->query(
            "Call product.updateImage($id, '$strImages')"
        );

        $query->next_result();
        $query->free_result();

    }

    /*

        * Function editCoverImage

        @param string $image , int $id

        @return void

        * Permet de modifier l'image de ouverture d'un produit
    
    */
    public function editCoverImage(string $image, int $id) : void
    {

        $product = $this->findById($id);

        $strImages = $product->getImageString();

        $cover = str_replace("upload/images/", "", $product->getCoverName());

        $strImages = str_replace($cover, "import/" . $image, $strImages);

        $query = $this->db->query(
            "Call product.updateImage($id, '$strImages')"
        );

        $query->next_result();
        $query->free_result();

    }

    /*

        * Function deleteImage

        @param int $id, string $image

        @return void

        * Permet de supprimer une image d'un produit
    
    */
    public function deleteImage(int $id, string $image) : void
    {

        $product = $this->findById($id);

        $strImages = $product->getImageString();

        $strImages = str_replace("$image", "", $strImages);

        $strImages = str_replace(";;", ";", $strImages);

        $query = $this->db->query(
            "Call product.updateImage($id, '$strImages')"
        );

        $query->next_result();
        $query->free_result();



        // TODO : A sécuriser
        // ! Danger ! Supprime l'image du serveur

        unlink('upload/images/' . $image);

    }

    /*

        * Function revive

        @param int $id

        @return void

        * Permet de ressucité un produit
    
    */
    public function revive(int $id)
    {

        $query = $this->db->query("Call product.revive($id)");

        $query->next_result();
        $query->free_result();

    }

    /*

        * Function delete

        @param int $id

        @return void

        * Permet de supprimer un produit
    
    */
    public function delete(int $id)
    {

        $query = $this->db->query("Call product.delProduct($id)");

        $query->next_result();
        $query->free_result();

    }

    /*

        * Function getAllCategory

        @return array

        * Permet de récupérer toutes les catégories
    
    */
    public function getAllCategory() : array
    {

        return array(
            'Chaussure',
            'Vếtement',
            'Equipement',
        );

    }

    /*

        * Function getAllSport

        @return array

        * Permet de récupérer tous les sports
    
    */
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

    /*

        * Function getAllSportName

        @return array

        * Permet de récupérer tous les noms des sports
    
    */
    public function getAllSportName() : array
    {

        $querySport = $this->db->query("Call sport.getAll()");

        $sport = $querySport->result();

        $querySport->next_result();
        $querySport->free_result();

        $listSport = array();

        foreach ($sport as $sport) {

            array_push($listSport, $sport->name);

        }
        return $listSport;

    }

    /*

        * Function getAllSportId

        @return array

        * Permet de récupérer tous les id des sports
    
    */
    public function getAllSportId() : array
    {

        $querySport = $this->db->query("Call sport.getAll()");

        $sport = $querySport->result();

        $querySport->next_result();
        $querySport->free_result();

        $listSport = array();

        foreach ($sport as $sport) {

            array_push($listSport, intval($sport->nusport));

        }
        return $listSport;

    }

    /*

        * Function verifRange

        @param string $range

        @return bool

        * Permet de vérifier si l'intervalle est correct
    
    */
    public function verifRange(string $range) : Bool
    {

        $range = explode(";", $range);

        if (
            count($range) == 2 &&
            is_numeric($range[0]) &&
            is_numeric($range[1]) &&
            $range[0] >= 0 &&
            $range[1] >= 1

        ) {

            return true;

        }
        
        return false;

    }

    /*

        * Function CountAllProduct

        @return Int

        * Renvoie le nombre total de produit
    
    */
    public function countAllProduct() : Int
    {
            
            $query = $this->db->query("Call product.countAll()");
    
            $count = $query->result();
    
            $query->next_result();
            $query->free_result();
    
            return $count[0]->count;
    }

    /*

        * Function CountAllProductBySport

        @param int $sport

        @return Int

        * Renvoie le nombre total de produit en fonction d'un sport
    
    */
    public function countByTypeAndSport(string $type, int $sport) : Int
    {
            
            $query = $this->db->query("Call product.countByTypeAndSport('" . $type . "', " . $sport .")");
    
            $count = $query->result();
    
            $query->next_result();
            $query->free_result();
    
            return $count[0]->count;
    }

    /*

        * Function getSize

        @param ProductEntity $product

        @return array

        * Renvoie les tailles triées d'un produit
    
    */
    public function getSize(ProductEntity $product) : array
    {
        $stocks = $product->getStock();

        $res = [];

        foreach ($stocks as $values) {
            array_push($res, $values->getSize());
        }

        $res = array_unique($res);

        if ($product->getType() == "Chaussure") {

            sort($res);

        } else {

            usort($res, array($this ,"sortSizeString"));

        }

        return $res;
    }

    /*

        * Function avalaibleColor

        @param ProductEntity $product

        @return array

        * Renvoie les couleurs disponibles d'un produit
    
    */
    public function avalaibleColor(ProductEntity $product) : array
    {
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

    /*

        * Function avalaibleSize

        @param ProductEntity $product

        @param string $color

        @return array

        * Renvoie les tailles disponibles d'un produit
    
    */
    public function avalaibleSize($product, $color) : array
    {
        $tailledispo = [];
        foreach ($product->getStock() as $stock) {
            if ($stock->getColor() == $color && $stock->getQuantity() != 0) {
                array_push($tailledispo, $stock->getSize());
            }
        }

        return $tailledispo;
    }

    /*

        * Function getCatalogsByProductId

        @param int $id

        @return array

        * Permet d'avoir le catalogue d'un produit
    
    */
    public function getCatalogsByProductId(int $id) : array
    {

        $query = $this->db->query("Call catalog.getStock($id)");

        $catalogs = $query->result();

        $query->next_result();
        $query->free_result();

        $listCatalogs = array();

        foreach ($catalogs as $catalog) {

            $newCatalog = new CatalogEntity;

            $newCatalog->setId($catalog->id);
            $newCatalog->setNuProduct($catalog->nuproduct);
            $newCatalog->setReference($catalog->reference);
            $newCatalog->setColor($catalog->color);
            $newCatalog->setSize($catalog->size);
            $newCatalog->setQuantity($catalog->quantity);
            $newCatalog->setIsALive($catalog->isALive);

            array_push($listCatalogs, $newCatalog);

        }

        $listColor = array();

        foreach ($listCatalogs as $catalog) {

            if (!in_array($catalog->getColor(), $listColor)) {
                array_push($listColor, $catalog->getColor());
            }

        }

        $sortListCatalog = array();

        foreach ($listColor as $color) {

            $sortListCatalog[$color] = array();

            foreach ($listCatalogs as $catalog) {

                if ($catalog->getColor() == $color) {
                    array_push($sortListCatalog[$color], $catalog);
                }

            }
        }

        return $sortListCatalog;

    }

    /*

        * Function getCatalogsByProducts

        @param array $products

        @return array

        * Permet d'avoir le catalogue des produits données en paramètre
    
    */
    public function getCatalogsByProducts(array $products) : array
    {
    
        if (empty($products)) {
            return array();
        }

        $listCatalogs = array();

        foreach ($products as $product) {

            $category = $this->getCatalogsByProductId($product->getId());

            $listCatalogs[$product->getId()] = $category;

        }

        return $listCatalogs;

    }

    /*

        * Function findCatalogById

        @param int $id

        @return ?CatalogEntity

        * Permet d'avoir le catalogue par son id
    
    */
    public function findCatalogById(int $id) : ?CatalogEntity
    {
    
        $queryCatalog = $this->db->query("Call catalog.getCatalogById($id)");

        $catalog = $queryCatalog->row();

        // * On crée un objet ProductEntity
        $queryCatalog->next_result();
        $queryCatalog->free_result();

        // * On vérifie que le produit n'est pas nul
        if ($catalog != null) {

            $newCatalog = new CatalogEntity;

            $newCatalog->setId($catalog->id);
            $newCatalog->setNuProduct($catalog->nuproduct);
            $newCatalog->setReference($catalog->reference);
            $newCatalog->setColor($catalog->color);
            $newCatalog->setSize($catalog->size);
            $newCatalog->setQuantity($catalog->quantity);
            $newCatalog->setIsALive($catalog->isALive);

            return $newCatalog;

        } else {

            return null;

        }
    }

    /*

        * Function updateCatalogQuantity

        @param CatalogEntity $catalog

        @return void

        * Permet de modifier la quantité d'un variant
    
    */
    public function updateCatalogQuantity(CatalogEntity $catalog) : void
    {

        $id = $catalog->getId();
        $quantity = $catalog->getQuantity();

        $this->db->query("Call catalog.updateCatalogQuantite($id, $quantity)");

    }

    /* 

        * Function deleteCatalog

        @param int

        * Permet de supprimer un variant
    
    */
    public function deleteCatalog(int $id) : void
    {

        $this->db->query("Call catalog.deleteCatalog($id)");

    }

    /*

        * Function heHaveCatalog

        @param CatalogEntity $catalog

        @return bool

        * Permet de savoir si un variant existe
    
    */
    public function heHaveCatalog(CatalogEntity $catalog) : bool
    {

        $nuproduct = $catalog->getNuProduct();
        $color = $catalog->getColor();
        $size = $catalog->getSize();

        $query = $this->db->query("Call catalog.heHaveCatalog($nuproduct, '$color', '$size')");

        $result = $query->row();

        $query->next_result();
        $query->free_result();

        return (!$result->count == 0);

    }

    /*

        * Function addCatalog

        @param CatalogEntity $catalog

        @return void

        * Permet d'ajouter un variant
    
    */
    public function addCatalog(CatalogEntity $catalog) : void
    {

        $id = $this->generateCatalogId();
        $nuproduct = $catalog->getNuProduct();
        $reference = $catalog->getReference();
        $color = $catalog->getColor();
        $size = $catalog->getSize();
        $quantity = $catalog->getQuantity();

        $date = date("Y-m-d H:i:s");

        $this->db->query(
            "Call catalog.addCatalog($id, $nuproduct, '$reference', '$color', '$size', $quantity, 1, '$date')"
        );

    }

    /*

        * Function getAllSizeByType

        @param string $type

        @return array

        * Permet de avoir toutes les tailles en fonction du type de produit
    
    */
    public function getAllSizeByType(string $type) : array
    {

        $type = $this->formatStr($type);

        if ($type == $this->formatStr("Vếtement") ||
        $type == $this->formatStr("Vêtement") ||
        $type == $this->formatStr("Equipement")) {

            return array("XXS", "XS", "S", "M", "L", "XL", "XXL");

        } elseif ($type == $this->formatStr("Chaussure")) {

            $size = array();

            for ($i = 30; $i <= 50; $i++) {

                array_push($size, $i);

            }

            return $size;

        } else {

            return array();

        }
    }

    /*

        * Function sortSizeString

        @param string $a, string $b

        * Permet de trier les tailles
    
    */
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

    /*

        * Function generateId

        @return int

        * Permet de générer un id aléatoire pour un produit
    
    */
    private function generateId() : int
    {

        $id = rand(10000, 999999999);

        if ($this->heHaveProductById($id)) {

            $id = $this->generateId();

        }

        return $id;

    }

    /*

        * Function generateCatalogId

        @return int

        * Permet de générer un id aléatoire pour un variant
    
    */
    private function generateCatalogId() : int
    {

        $id = rand(10000, 999999999);

        if ($this->findCatalogById($id) != null) {

            $id = $this->generateId();

        }

        return $id;

    }

    /*

        * Function formatStr

        @param string $str

        @return string

        * Permet de formater une chaine de caractère
    
    */
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
}
