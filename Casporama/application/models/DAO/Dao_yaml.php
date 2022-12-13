<?php

require_once APPPATH . 'interfaces/DaoInterface.php';


class Dao_yaml extends CI_Model implements DaoInterface {

    public function __construct()
    {
        $files = glob( "./DaoFile/export/yaml/" ."*" );
        if ($files && count($files) >= 6) {
            array_map('unlink', glob("./DaoFile/export/yaml/*.yaml"));
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
        $path = "./DaoFile/export/yaml/$time"."_"."$id.yaml";
        $fp = fopen($path,"w");
        $result = $query->result_array();
        $results = [];
        $val = 0;
        foreach ($result as $i) {
            $test = [];
            $test[$table.$val] = $i;
            array_push($results,$test);
            $val++;
        }
        
        $msg = yaml_emit($results);
        fwrite($fp,$msg);
        
        fclose($fp);
        return $path;
    }
    
    function addData($file, $table) {

        $yamls = yaml_parse_file($file);

        foreach ($yamls as $yaml) {
            foreach ($yaml as $value) {
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
        }
        unlink($file);
    }
}

?>
