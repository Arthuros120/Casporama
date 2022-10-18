<?php

require_once APPPATH . 'models/entity/ProductEntity.php';

class ProductModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function findBySportType($sport, $type) : Int{

        $queryIdSport = $this->db->query("Call getIdSport('".$sport."')");

        $idSport = $queryIdSport->row()->idSport;

        echo $idSport;

        return $idSport;

    }

}