<?php

require_once APPPATH . 'interfaces/DAO.php';

class DAO_XML extends CI_Model implements DAO {


    function getAllData($id,$table) {
        if (in_array($table,['user','location','information'])) {
            $query = $this->db->query("Call user.getAll$table()");
        } else {
            $query = $this->db->query("Call $table.getAll()");
        }
        
        $_xml = new SimpleXMLElement("<$table"."s/>");

        $result = $query->result_array();
         
        $cpt = 0;
        foreach ($result as $value) { 
            $test = $_xml->addChild($table.$cpt);
            $cpt++;
            foreach ($value as $i => $y) {
                $test->addChild($i,$y);
            }
        }

        $msg = $_xml->asXML();
        
        $time = date("Y-m-d-H:i:s",time());
        $fp = fopen("./DAO/export/xml/$time"."_"."$id.xml","w");
        fwrite($fp,$msg);
        fclose($fp);
    }
    
    function addData($file, $table) {

        $xmldata = simplexml_load_file($file);

        foreach ($xmldata->children() as $value) {
            $size = count($value);
            if ($size != count($this->db->query("desc $table")->result_array())) {
                errorFile("Nombre de colonne insuffisant", $table);
                break;
            }
            try {
                if (in_array($table,['user','location','information'])) {

                    $query ="Call user.add$table(";
                    $dataRequete = [];
                    foreach ($value->children() as $i) {
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
                    foreach ($value->children() as $i) {
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

    function getData($id,$table,$filter) {

    }
}

?>

