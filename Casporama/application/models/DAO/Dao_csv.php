<?php

require_once APPPATH . 'interfaces/DaoInterface.php';

class Dao_csv extends CI_Model implements DaoInterface {

    public function __construct()
    {
        $folders = glob( "./upload/DaoFile/export/csv/" ."*" );
        foreach ($folders as $folder) {
            $files = glob( "$folder/" ."*" );
            if ($files && count($files) >= 6) {
                array_map('unlink', glob("$folder/*.csv"));
            }
        }
    }


    function getData($id,$table,$filter) :?string {
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

            $time = date("Y-m-d-h:i:s",time());
            $name = str_replace('`','',$table);
            $path = "./upload/DaoFile/export/csv/$name/$time"."_$name"."_$id.csv";
            $fp = fopen($path,"w");

            $header = [];            

            foreach ($results[0] as $key => $value) {
                if ($filter != null) {
                    if (in_array($key,$filter)) {
                        array_push($header,$key);
                    }
                } else {
                    array_push($header,$key);
                }
            }

            if (isset($size)) {
                foreach ($results[$size] as $key => $value) {
                    if ($filter != null) {
                        if (in_array($key,$filter)) {
                            array_push($header,$key);
                        }
                    } else {
                        array_push($header,$key);
                    }
                }
            }
            
            fputcsv($fp,$header);

            $values = [];
            foreach ($results as $result) {
                foreach ($result as $key => $value) {
                    if ($filter != null) {
                        if (in_array($key,$filter)) {
                            $values[$key] = $value;
                        }
                    } else {
                        $values[$key] = $value;
                    }
                }
                fputcsv($fp,$values);
            }

            fclose($fp);
            return $path;
        } else if (isset($orders)) {
            
            $time = date("Y-m-d-h:i:s",time());
            $name = str_replace('`','',$table);
            $path = "./upload/DaoFile/export/csv/$name/$time"."_$name"."_$id.csv";
            $fp = fopen($path,"w");

            if ($filter != null) {
                fputcsv($fp,$filter);
            } else {
                fputcsv($fp,array('id','iduser','dateorder','idlocation','state','isAlive','dateLastUpdate','idproduct','idvariant','quantity'));
            }

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
                    fputcsv($fp,array_intersect_key($row,array_fill_keys($filter,'test')));
                } else {
                    fputcsv($fp,$row);
                }

            }
            fclose($fp);
            return $path;
        } else {
            return null;
        }
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
                            if ($row[$i] == "") {
                                $row[$i] = null;
                            }
                            array_push($dataRequete,$row[$i]);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";
                        
                        $err = $this->db->query($query, $dataRequete);
                        
                    } else if ($table == 'order_products') { 
                    
                        $query ="Call `order`.addProductToOrder(";
                        $dataRequete = [];
                        for ($i = 0; $i < $size; $i++) {
                            $query .= "?,";
                            array_push($dataRequete,$row[$i]);
                        }
                        $query = substr($query,0,-1);
                        $query .= ")";

                        $err = $this->db->query($query, $dataRequete);

                    } else {
                        $query ="Call $table.add".str_replace('`','',$table)."(";
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
                        $err = errorFile($this->db->error(), $table);
                        return $err;
                    }

                } catch (Error $err) {
                    $err = errorFile($err, $table);
                    return $err;
                }
            } else {
                $size = count($row);
                $header = $this->db->query("desc $table")->result_array();
                if ($size != count($header)) {
                    $err = errorFile("Nombre de colonne insuffisant", $table);
                    return $err;
                } else {
                    for ($i = 0; $i < count($row); $i++ ) {
                        if ($row[$i] != $header[$i]["Field"]) {
                            $err = errorFile("Nom de colonne invalide : (".$row[$i].") à la place de : (".$header[$i]["Field"].")", $table);
                            return $err;
                        }
                    }
                }
                $first = false;
            }
        }
        fclose($fp);
    }

}

?>

