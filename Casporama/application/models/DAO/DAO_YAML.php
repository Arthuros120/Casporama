<?php

require_once APPPATH . 'interfaces/DAO.php';


class DAO_YAML extends CI_Model implements DAO {

    public function __construct()
    {
        $files = glob( "./DAO/export/yaml/" ."*" );
        if ($files && count($files) >= 10) {
            array_map('unlink', glob("./DAO/export/yaml/*.yaml"));
        }
    }

    function getData($id,$table,$filter = null) {
        if (in_array($table,['user','location','information'])) {
            $query = $this->db->query("Call user.getAll$table()");
        } else {
            $query = $this->db->query("Call $table.getAll()");
        }
        
        $time = date("Y-m-d-h:i:s",time());
        $fp = fopen("./DAO/export/yaml/$time"."_"."$id.yaml","w");
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
    }
    
    function addData($file, $table) {

        $yamls = yaml_parse_file($file);

        foreach ($yamls as $yaml) {
            foreach ($yaml as $value) {
                $size = count($value);
                if ($size != count($this->db->query("desc $table")->result_array())) {
                    errorFile("Nombre de colonne insuffisant", $table);
                    break;
                }
                try {
                    if (in_array($table,['user','location','information'])) {

                        $query ="Call user.add$table(";
                        $dataRequete = [];
                        foreach ($value as $i) {
                            $query .= "?,";
                            array_push($dataRequete,$i);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
                        $this->db->db_debug = false;
                        $err = $this->db->query($query, $dataRequete);
                        $this->db->db_debug = true;

                    } else {

                        $query ="Call $table.add$table(";
                        $dataRequete = [];
                        foreach ($value as $i) {
                            $query .= "?,";
                            array_push($dataRequete,$i);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
                        $this->db->db_debug = false;
                        $err = $this->db->query($query, $dataRequete);
                        $this->db->db_debug = true;

                    }
                    
                    if ($err == false) {
                        errorFile($this->db->error(), $table);
                    }

                } catch (Error $err) {
                    errorFile($err, $table);
                }
            }
        }

    }
}

?>

