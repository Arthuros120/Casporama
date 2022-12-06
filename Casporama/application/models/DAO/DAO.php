<?php

abstract class DAO extends CI_Model {
    private string $file;

    function getFile() {
        return $this->file;
    }

    function setFile($file) {
        $this->file = $file;
    }

    function getAllData($id,$table) {}
    function getData($id,$table,$filter) {}
    function addData($file) {}
}

?>