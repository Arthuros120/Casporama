<?php

require_once APPPATH . 'interfaces/DAO.php';


class DAO_YAML extends CI_Model implements DAO {


    function getAllData($id,$table) {
        if (in_array($table,['user','location','information'])) {
            $query = $this->db->query("Call user.getAll$table()");
        } else {
            $query = $this->db->query("Call $table.getAll()");
        }
        
        $time = date("Y-m-d-h:i:s",time());
        $fp = fopen("./DAO/export/yaml/$time"."_"."$id.yaml","w");
        $result = $query->result_array();
        $msg = json_encode($result);
        fwrite($fp,$msg);
        
        fclose($fp);
    }
    
    function addData($file, $table) {

        $yaml = yaml_parse_file($file);
        var_dump($yaml);

        // foreach ($json_data as $value) {
        //     $size = count($value);
        //     if ($size != count($this->db->query("desc $table")->result_array())) {
        //         errorFile("Nombre de colonne insuffisant", $table);
        //         break;
        //     }
        //     try {
        //         if (in_array($table,['user','location','information'])) {

        //             $query ="Call user.add$table(";
        //             $dataRequete = [];
        //             foreach ($value as $i) {
        //                 $query .= "?,";
        //                 array_push($dataRequete,$i);
        //             }
        //             $query = substr($query,0,-1);
        //             $query .= ")";
        //             $this->db->db_debug = false;
        //             $err = $this->db->query($query, $dataRequete);
        //             $this->db->db_debug = true;

        //         } else {

        //             $query ="Call $table.add$table(";
        //             $dataRequete = [];
        //             foreach ($value as $i) {
        //                 $query .= "?,";
        //                 array_push($dataRequete,$i);
        //             }
        //             $query = substr($query,0,-1);
        //             $query .= ")";
        //             $this->db->db_debug = false;
        //             $err = $this->db->query($query, $dataRequete);
        //             $this->db->db_debug = true;

        //         }
                
        //         if ($err == false) {
        //             errorFile($this->db->error(), $table);
        //         }

        //     } catch (Error $err) {
        //         errorFile($err, $table);
        //     }
        // }

    }

    function getData($id,$table,$filter) {

    }
}

?>

