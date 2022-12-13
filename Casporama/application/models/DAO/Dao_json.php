<?php

require_once APPPATH . 'interfaces/DaoInterface.php';

class Dao_json extends CI_Model implements DaoInterface {

    public function __construct()
    {
        $files = glob( "./DaoFile/export/json/" ."*" );
        if ($files && count($files) >= 6) {
            array_map('unlink', glob("./DaoFile/export/json/*.json"));
        }
    }


    function getData($id,$table,$filter = null) {
        try {
            $this->db->db_debug = false;
            if (in_array($table,['user','location','information'])) {
                $query = $this->db->query("Call user.getAll$table()");
            } else {
                $query = $this->db->query("Call $table.getAll()");
            }
            $this->db->db_debug = true;

            if ($query == false) {
                errorFile($this->db->error(), $table);
                return;
            }
        } catch (Error $err) {
            errorFile($err, $table);
            return;
        }
        
        $time = date("Y-m-d-h:i:s",time());
        $path = "./DaoFile/export/json/$time"."_"."$id.json";
        $fp = fopen($path,"w");
        $result = $query->result_array();
        $msg = json_encode($result);
        fwrite($fp,$msg);
        
        fclose($fp);
        return $path;
    }
    
    function addData($file, $table) {

        $json = file_get_contents($file);
        $json_data = json_decode($json,true);

        foreach ($json_data as $value) {
            $size = count($value);
            if ($size != count($this->db->query("desc $table")->result_array())) {
                errorFile("Nombre de colonne insuffisant", $table);
                return;
            }
            try {
                $this->db->db_debug = false;
                if (in_array($table,['user','location','information'])) {

                    $query ="Call user.add$table(";
                    $dataRequete = [];
                    foreach ($value as $i) {
                        $query .= "?,";
                        array_push($dataRequete,$i);
                    }
                    $query = substr($query,0,-1);
                    $query .= ")";
                    
                    $err = $this->db->query($query, $dataRequete);

                } else {

                    $query ="Call $table.add$table(";
                    $dataRequete = [];
                    foreach ($value as $i) {
                        $query .= "?,";
                        array_push($dataRequete,$i);
                    }
                    $query = substr($query,0,-1);
                    $query .= ")";
                    
                    $err = $this->db->query($query, $dataRequete);

                }
                $this->db->db_debug = true;
                
                if ($err == false) {
                    errorFile($this->db->error(), $table);
                    return;
                }

            } catch (Error $err) {
                errorFile($err, $table);
                return;
            }
        }

        unlink($file);

    }
}

?>
