<?php

require_once APPPATH . 'models/entity/ProductEntity.php';

class ProductModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function findIdSport($sport) : int {

        $queryIdSport = $this->db->query("Call getIdSport('".$sport."')");

        $idSport = (int) $queryIdSport->row()->nusport;

        $queryIdSport->next_result(); 
        $queryIdSport->free_result();

        return $idSport;

    }

    function findBySportType($sport, $type) : array {

        $listProduct = array();

        $idSport = $this->findIdSport($sport);

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

}