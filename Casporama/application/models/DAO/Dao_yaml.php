<?php

require_once APPPATH . 'interfaces/DaoInterface.php';


class Dao_yaml extends CI_Model implements DaoInterface {

    public function __construct()
    {
        $files = glob( "./upload/DaoFile/export/yaml/" ."*" );
        if ($files && count($files) >= 6) {
            array_map('unlink', glob("./upload/DaoFile/export/yaml/*.yaml"));
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
                $err = errorFile($this->db->error(), $table);
                return $err;
            }
        } catch (Error $err) {
            $err = errorFile($err, $table);
            return $err;
        }
        
        $time = date("Y-m-d-h:i:s",time());
        $path = "./upload/DaoFile/export/yaml/$time"."_$table"."_$id.yaml";
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

        $yaml = [];
        $val = 0;
        foreach ($tab as $i) {
            $test = [];
            $test[$table.$val] = $i;
            array_push($yaml,$test);
            $val++;
        }
        
        
        $msg = yaml_emit($yaml);
        fwrite($fp,$msg);
        
        fclose($fp);
        return $path;
    }
    
    function addData($file, $table) {

        $yamls = yaml_parse_file($file);

        foreach ($yamls as $yaml) {
            foreach ($yaml as $value) {
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
}

?>

