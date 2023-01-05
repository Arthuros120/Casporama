<?php

require_once APPPATH . 'interfaces/DaoInterface.php';

class Dao_xml extends CI_Model implements DaoInterface {

    public function __construct()
    {
        $files = glob( "./upload/DaoFile/export/xml/" ."*" );
        if ($files && count($files) >= 6) {
            array_map('unlink', glob("./upload/DaoFile/export/xml/*.xml"));
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

        $_xml = new DomDocument('1.0','utf-8');
        $_xml->preserveWhiteSpace = false;
        $_xml->formatOutput = true;

        $root = $_xml->createElement($table);
        $root = $_xml->appendChild($root);
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
         
        $cpt = 0;
        foreach ($tab as $values) { 
            $occ = $_xml->createElement($table.$cpt);
            $occ = $root->appendChild($occ);
            $cpt++;
            foreach ($values as $i => $y) {
                
                $child = $_xml->createElement($i);
                $child = $occ->appendChild($child);
                if ($y != null) {
                    $value = $_xml->createTextNode($y);
                    $value = $child->appendChild($value);
                }
                
            }
        }

        
        $msg = $_xml->saveXML();
        
        $time = date("Y-m-d-H:i:s",time());
        $path = "./upload/DaoFile/export/xml/$time"."_$table"."_$id.xml";
        $fp = fopen($path,"w");
        fwrite($fp,$msg);
        fclose($fp);
        return $path;
    }
    
    function addData($file, $table) {

        $xmldata = simplexml_load_file($file);

        foreach ($xmldata->children() as $value) {
            if (!is_array($value)) {
                $err = errorFile("Format invalide", $table);
                return $err;
            }

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
                    foreach ($value->children() as $i) {
                        $query .= "?,";
                        if ( !(array)$i ) {
                            $i = null;
                        }
                        array_push($dataRequete,$i);
                    }
                    $query = substr($query,0,-1);
                    $query .= ")";
                    
                    $err = $this->db->query($query, $dataRequete);

                } else {

                    $query ="Call $table.add$table(";
                    $dataRequete = [];
                    foreach ($value->children() as $i) {
                        $query .= "?,";
                        if ( !(array)$i ) {
                            $i = null;
                        }
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

