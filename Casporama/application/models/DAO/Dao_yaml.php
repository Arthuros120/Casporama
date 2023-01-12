<?php

require_once APPPATH . 'interfaces/DaoInterface.php';


/*

    Cette fonction gère le DAO pour l'extension YAML

*/
class Dao_yaml extends CI_Model implements DaoInterface {


    /*

        On vérifie qu'il y moins de 6 fichier
        dans le dossier permettant ainsi de ne pas surcharger le serveur.

    */
    public function __construct()
    {
        $files = glob( "./upload/DaoFile/export/yaml/" ."*" );
        if ($files && count($files) >= 6) {
            array_map('unlink', glob("./upload/DaoFile/export/yaml/*.yaml"));
        }
    }

    function getData($id,$table,$filter = null) : ?String {
        try {
            $this->db->db_debug = false;
            if (in_array($table,['user','location','information'])) {
                $query = $this->db->query("Call user.getAll$table()");
            } else if ($table != '`order`') {
                $query = $this->db->query("Call $table.getAll()");
            }
            $this->db->db_debug = true;

            if (isset($query) && $query == false) {
                $err = errorFile($this->db->error(), $table);
                return $err;
            }
        } catch (Error $err) {
            $err = errorFile($err, $table);
            return $err;
        }
        
        
        if (isset($query)) {    
            $results = $query->result_array();

            $query->next_result();
            $query->free_result();
        }

        if ($table == '`order`') {
            $orders = $this->OrderModel->getAllOrder();
        }


        if (isset($results) && $results != null) {

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

        } else if ($table == '`order`') {

            $tab = [];

            foreach ($orders as $order) {

                $query = $this->db->query("call `order`.getOrderById(" . $order->getId() . ")");

                $results = $query->result_array()[0 ];

                $query->next_result();
                $query->free_result();

                $row = array(
                    'id' => $order->getId(),
                    'iduser' => $order->getIduser(),
                    'dateorder' => $order->getDate(),
                    'idlocation' => $order->getLocation()->getId(),
                    'state' => $order->getState(),
                    'isALive' => $results['isALive'],
                    'dateLastUpdate' => $results['dateLastUpdate'],
                    'idproduct' => implode(",",array_map('getProductId',$order->getProducts())),
                    'idvariant' => implode(",",array_map('getVariantId',$order->getVariants())),
                    'quantity' => implode(",",$order->getQuantities())
                );

                if ($filter != null) {
                    array_push($tab,array_intersect_key($row,array_fill_keys($filter,'test')));
                } else {
                    array_push($tab,$row);
                }

            }
        } 
        
        if (isset($tab) && !empty($tab)) {

            $time = date("Y-m-d-h:i:s",time());
            $name = str_replace('`','',$table);
            $path = "./upload/DaoFile/export/yaml/$time"."_$name"."_$id.yaml";
            $fp = fopen($path,"w");

            $yaml = [];
            $val = 0;
            foreach ($tab as $i) {
                $test = [];
                $test[$name.$val] = $i;
                array_push($yaml,$test);
                $val++;
            }


            $msg = yaml_emit($yaml);
            fwrite($fp,$msg);
            
            fclose($fp);
            return $path;

        } else {
            return null;
        }
    }
    
    function addData($file, $table) {

        $yamls = yaml_parse_file($file);

        foreach ($yamls as $yaml) {
            foreach ($yaml as $value) {
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
                        foreach ($value as $i) {
                            $query .= "?,";
                            array_push($dataRequete,$i);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
                       
                        $err = $this->db->query($query, $dataRequete);
                    
                    } else if ($table == 'order_products') { 
                    
                        $query ="Call `order`.addProductToOrder(";
                        $dataRequete = [];
                        foreach ($value as $i) {
                            $query .= "?,";
                            array_push($dataRequete,$i);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
    
                        $err = $this->db->query($query, $dataRequete);
    
                    } else {

                        $query ="Call $table.add".str_replace('`','',$table)."(";
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

