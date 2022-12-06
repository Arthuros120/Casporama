<?php

require_once APPPATH . 'models/DAO/DAO.php';

class DAO_CSV extends DAO {


    function getAllData($id,$table) {
        if (in_array($table,['user','location','information'])) {
            $query = $this->db->query("Call user.getAll$table()");
        } else {
            $query = $this->db->query("Call $table.getAll()");
        }
        
        $time = date("Y-m-d-h:i:s",time());
        $fp = fopen(base_url()."/DAO/export/csv/$table/$time.$id.csv","w");
        fwrite($fp,$query);
        fclose($fp);
    }
    function getData($id,$table,$filter) {

    }
    function addData($file) {

    }
}

?>

