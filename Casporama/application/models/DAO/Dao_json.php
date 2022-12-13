<?php

require_once APPPATH . 'interfaces/DaoInterface.php';

class Dao_json extends CI_Model implements DaoInterface {

    public function __construct()
    {
        $files = glob( "./upload/DaoFile/export/json/" ."*" );
        if ($files && count($files) >= 6) {
            array_map('unlink', glob("./upload/DaoFile/export/json/*.json"));
        }
    }


    function getData($id,$table,$filter) {
        try {
            $this->db->db_debug = false;
            if (in_array($table,['user','location','information'])) {
                $query = $this->db->query("Call user.getAll$table()");
            } else {
                $query = $this->db->query("Call $table.getAll()");
            }
            $this->db->db_debug = true;

            if ($query == false) {
                $err = errorFile($this->db->error(), $table);
                return $err;
            }
        } catch (Error $err) {
            $err = errorFile($err, $table);
            return $err;
        }
        
        $time = date("Y-m-d-h:i:s",time());
        $path = "./upload/DaoFile/export/json/$time"."_$table"."_$id.json";
        $fp = fopen($path,"w");
        $results = $query->result_array();

        $tab = [];

        if ($filter != null) {
            foreach ($results as $result) {
                $test = [];
                foreach ($result as $key => $value) {
                    if (in_array($key,$filter)) {
                        $test[$key] = $value;
                    }
                }
                array_push($tab,$test);
            }
        } else {
            $tab = $results;
        }

        $msg = json_encode($tab,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        fwrite($fp,$msg);
        
        fclose($fp);
        return $path;
    }
    
    function addData($file, $table) {

        $json = file_get_contents($file);
        $json_data = json_decode($json,true);

        foreach ($json_data as $value) { 
            $header = $this->db->query("desc $table")->result_array();
            if (count($value) != count($header)) {
                $err = errorFile("Nombre de colonne insuffisant", $table);
                return $err;
            }

            $cpt = 0;
            foreach ($value as $key => $test) {
                if ($key != $header[$cpt]["Field"]) {
                    $err = errorFile("Nom de colonne invalide : (".$key.") à la place de : (".$header[$cpt]["Field"].")", $table);
                    return $err;
                }
                $cpt++;
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
                    $err = errorFile($this->db->error(), $table);
                    return $err;
                }

            } catch (Error $err) {
                $err = errorFile($err, $table);
                return $err;
            }
        }

    }
}

?>

