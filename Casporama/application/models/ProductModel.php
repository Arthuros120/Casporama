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

    public function filterByBrand(string $title, array $products, array $get): array
    {

        if (!empty($get['brand'])) {

            $brand = $get['brand'];

            $listBrand = explode(',', $brand);

            $title .= " Marques -> ";

            foreach ($listBrand as $category) {

                $title .= $category . " - ";
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

    public function filterByCategory($title, $products, $get): array
    {

        if (!empty($get['category'])) {

            $category = $get['category'];

            $listCategory = explode(',', $category);

            $title .= " Catégorie -> ";

            foreach ($listCategory as $category) {

                $title .= $category . " - ";
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
