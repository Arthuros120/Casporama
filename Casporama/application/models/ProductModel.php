<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/ProductEntity.php';

/*

    * Class ProductModel

    * Cette classe permet de gérer les produits

*/
class ProductModel extends CI_Model {

    // Constructeur
    function __construct() {
        parent::__construct();
    }

    /*
    
        * Function findIdBySport

        @param string $sport
        @return int

        * Cette fonction permet de récupérer l'id du sport
    
    */
    function findIdBySport(string $sport) : int {

        // * Requete SQL pour récupérer l'id du sport
        $queryIdSport = $this->db->query("Call getIdSport('".$sport."')");

        // * On extrait l'id du sport du résultat de la requete
        $idSport = (int) $queryIdSport->row()->nusport;

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
    function findNameSportbyId(int $sport) : String {

        // * Requete SQL pour récupérer le nom du sport
        $queryIdSport = $this->db->query("Call getNameSport('".$sport."')");

        // * On extrait le nom du sport du résultat de la requete
        $idSport = $queryIdSport->row()->nom;

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
    function heHaveAStockById(int $idProduct) : bool {

        // * Requete SQL pour récupérer le stock du produit
        $queryStock = $this->db->query("Call getStockTotal('".$idProduct."')");

        // * On extrait le stock du produit du résultat de la requete
        $stock = (int) $queryStock->row()->stock;

        // * On passe le stock du produit en paramètre de la requete suivante et on repasse en mode normal (asynchrone)
        $queryStock->next_result(); 
        $queryStock->free_result();

        // * Si il n'y a pas de stock, on retourne false sinon true
        if($stock > 0){
            return true;
        }else{
            return false;
        }
    }

    /*

        * Function getStock

        @param int $idProduct
        @return Any

        * Cette fonction permet de récupérer le stock d'un produit
    
    */
    function getStock(int $idProduct){

        // * Requete SQL pour récupérer le stock du produit
        $queryStock = $this->db->query("Call getStock(".$idProduct.")");

        // * On extrait le stock du produit du résultat de la requete
        $stock = $queryStock->row();


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
    function getStockTotal(int $idProduct){

        // * Requete SQL pour récupérer le stock du produit
        $queryStock = $this->db->query("Call getStockTotal(".$idProduct.")");

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
    function findBySportType(string $sport, string $type) : array {


        // * Initialisation du tableau de retour
        $listProduct = array();

        // * On récupère l'id du sport
        $idSport = $this->findIdBySport($sport);

        // * Requete SQL pour récupérer les produits par le sport et id
        $queryProduct = $this->db->query("Call getProductBySportType(".$idSport.", '".$type."')");

        // * On stocke le résultat de la requete dans un tableau
        $products = $queryProduct->result();

        // * On parcours les résultats de la requete
        foreach ($products as &$product) {

            // * On crée un objet ProductEntity
            $newProduct = new ProductEntity();

            // * On hydrate l'objet
            $newProduct->set_Id($product->idproduit);
            $newProduct->set_Reference($product->reference);
            $newProduct->set_Type($product->type);
            $newProduct->set_Sport($product->nusport);
            $newProduct->set_Brand($product->marque);
            $newProduct->set_Name($product->nom);
            $newProduct->set_Genre($product->genre);
            $newProduct->set_Price($product->prix);
            $newProduct->set_Description($product->description);

            // * On ajoute une image de couverture si une image est fournie
            if ($product->image != null) {
                $newProduct->set_Image($product->image);
            }else{
                $newProduct->set_Image("");
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
    function findById(int $idProduct) : ?ProductEntity {

        // * Requete SQL pour récupérer le produit par son id
        $queryProduct = $this->db->query("Call getProductById(".$idProduct.")");

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
            $newProduct->set_Id($product->idproduit);
            $newProduct->set_Reference($product->reference);
            $newProduct->set_Type($product->type);
            $newProduct->set_Sport($product->nusport);
            $newProduct->set_Brand($product->marque);
            $newProduct->set_Name($product->nom);
            $newProduct->set_Genre($product->genre);
            $newProduct->set_Price($product->prix);
            $newProduct->set_Description($product->description);

            // * On ajoute une image de couverture si une image est fournie
            if ($product->image != null) {
                $newProduct->set_Image($product->image);
            }else{
                $newProduct->set_Image("");
            }

            //$newProduct->set_Stock($this->getStock($product->idproduit));

            // * On retourne l'objet
            return $newProduct;

        }else{

            // * On retourne null
            return null;
        }

    }

}