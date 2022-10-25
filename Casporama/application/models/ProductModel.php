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

    // TODO: ¤ Continuer de commenté, Pause le 25/10/2022 à 20:04
    function findNameSportbyId(int $sport) : String {

        $queryIdSport = $this->db->query("Call getNameSport('".$sport."')");

        $idSport = $queryIdSport->row()->nom;

        $queryIdSport->next_result(); 
        $queryIdSport->free_result();

        return $idSport;

    }

    function heHaveAStockById(int $idProduct) : bool {

        $queryStock = $this->db->query("Call getStockTotal('".$idProduct."')");

        $stock = (int) $queryStock->row()->stock;

        $queryStock->next_result(); 
        $queryStock->free_result();

        if($stock > 0){
            return true;
        }else{
            return false;
        }

    }

    function getStock(int $idProduct){

        $queryStock = $this->db->query("Call getStock(".$idProduct.")");

        $stock = $queryStock->row();

        $queryStock->next_result(); 
        $queryStock->free_result();

        return $stock;

    }

    function getStockTotal(int $idProduct){

        $queryStock = $this->db->query("Call getStockTotal(".$idProduct.")");

        $stock = (int) $queryStock->row()->total;

        $queryStock->next_result(); 
        $queryStock->free_result();

        return $stock;

    }

    function findBySportType(string $sport, string $type) : array {

        $listProduct = array();

        $idSport = $this->findIdBySport($sport);

        $queryProduct = $this->db->query("Call getProductBySportType(".$idSport.", '".$type."')");

        $products = $queryProduct->result();

        foreach ($products as &$product) {

            $newProduct = new ProductEntity();

            $newProduct->set_Id($product->idproduit);
            $newProduct->set_Reference($product->reference);
            $newProduct->set_Type($product->type);
            $newProduct->set_Sport($product->nusport);
            $newProduct->set_Brand($product->marque);
            $newProduct->set_Name($product->nom);
            $newProduct->set_Genre($product->genre);
            $newProduct->set_Price($product->prix);
            $newProduct->set_Description($product->description);

            if ($product->image != null) {
                $newProduct->set_Image($product->image);
            }else{
                $newProduct->set_Image("");
            }

            //$newProduct->set_Stock($this->getStock($product->idproduit));

            array_push($listProduct, $newProduct);

        }

        return $listProduct;

    }

    function findById(int $idProduct) : ?ProductEntity {

        $queryProduct = $this->db->query("Call getProductById(".$idProduct.")");

        $product = $queryProduct->row();

        $queryProduct->next_result(); 
        $queryProduct->free_result();

        if ($product != null) {

            $newProduct = new ProductEntity();

            $newProduct->set_Id($product->idproduit);
            $newProduct->set_Reference($product->reference);
            $newProduct->set_Type($product->type);
            $newProduct->set_Sport($product->nusport);
            $newProduct->set_Brand($product->marque);
            $newProduct->set_Name($product->nom);
            $newProduct->set_Genre($product->genre);
            $newProduct->set_Price($product->prix);
            $newProduct->set_Description($product->description);

            if ($product->image != null) {
                $newProduct->set_Image($product->image);
            }else{
                $newProduct->set_Image("");
            }

            //$newProduct->set_Stock($this->getStock($product->idproduit));

            return $newProduct;

        }else{
            return null;
        }

    }

}