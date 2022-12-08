<?php

require_once APPPATH . 'interfaces/DAO.php';

class DAO_CSV extends CI_Model implements DAO{

    public function __construct()
    {
        $folders = glob( "./DAO/export/csv/" ."*" );
        foreach ($folders as $folder) {
            $files = glob( "$folder/" ."*" );
            if ($files && count($files) >= 6) {
                array_map('unlink', glob("$folder/*.csv"));
            }
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
        $fp = fopen("./DAO/export/csv/$table/$time"."_"."$id.csv","w");
        $result = $query->result_array();

        $header = [];

        foreach ($result[0] as $key => $value) {

            array_push($header,$key);

        }

        fputcsv($fp,$header);

        foreach ($result as $value) {
            fputcsv($fp,$value);
        }
        
        fclose($fp);
    }
    
    function addData($file, $table) {

        $fp = fopen($file, "r"); 
        $first = true;
        $size = 0;
        while (($row = fgetcsv($fp)) !== false) {
            if (!$first) {
                try {
                    $this->db->db_debug = false;
                    if (in_array($table,['user','location','information'])) {
                        $query ="Call user.add$table(";
                        $dataRequete = [];
                        for ($i = 0; $i < $size; $i++) {
                            $query .= "?,";
                            array_push($dataRequete,$row[$i]);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
                        
                        $err = $this->db->query($query, $dataRequete);
                        
                    } else {
                        $query ="Call $table.add$table(";
                        $dataRequete = [];
                        for ($i = 0; $i < $size; $i++) {
                            $query .= "?,";
                            array_push($dataRequete,$row[$i]);
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
            } else {
                $size = count($row);
                if ($size != count($this->db->query("desc $table")->result_array())) {
                    errorFile("Nombre de colonne insuffisant", $table);
                    return;
                }
                $first = false;
            }
        }
        fclose($fp);
        unlink($file);

    }
}

?>

