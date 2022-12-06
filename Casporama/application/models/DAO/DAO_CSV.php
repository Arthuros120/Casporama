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
        $fp = fopen("./DAO/export/csv/$table/$time.$id.csv","w");
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
    function getData($id,$table,$filter) {

    }
    function addData($file, $table) {

        $fp = fopen($file, "r"); 
        $first = true;
        $size = 0;
        while (($row = fgetcsv($fp)) !== false) {
            if (!$first) {
                try {
                    if (in_array($table,['user','location','information'])) {
                        $query ="Call user.add$table(";
                        $dataRequete = [];
                        for ($i = 0; $i < $size; $i++) {
                            $query .= "?,";
                            array_push($dataRequete,$row[$i]);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
                        $this->db->query($query, $dataRequete);
                    } else {
                        $query ="Call $table.add$table(";
                        $dataRequete = [];
                        for ($i = 0; $i < $size; $i++) {
                            $query .= "?,";
                            array_push($dataRequete,$row[$i]);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
                        $this->db->query($query, $dataRequete);
                    }
                } catch (Error $err) {
                    $time = date("Y-m-d-h:i:s",time());
                    $errorFile = fopen("./DAO/error/$table._.$time.csv","w");
                    fwrite($errorFile,"SQL error : ".$err);
                    fclose($errorFile);
                }
            } else {
                $size = count($row);
                if ($size != count($this->db->query("desc $table;")->result_array())) {
                    $time = date("Y-m-d-h:i:s",time());
                    $errorFile = fopen("./DAO/error/$table._.$time.csv","w");
                    fwrite($errorFile,"Nombres de colonnes insuffisantes");
                    fclose($errorFile);
                    break;
                }
                $first = false;
            }
        }
        fclose($fp);        

    }
}

?>

