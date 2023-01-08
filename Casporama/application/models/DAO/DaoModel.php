<?php

class DaoModel extends CI_Model {

    public function colonnes($table) {

        if ($table == '`order`') {
            $query =  $this->db->query("desc $table");

            $colonnes = $query->result_array();

            $query->next_result();
            $query->free_result();

            $query =  $this->db->query("desc order_products");

            $colonnes2 = $query->result_array();

            foreach ($colonnes2 as $row) {
                if ($row['Field'] != 'idorder') {
                    array_push($colonnes,$row);
                }
            }

            $query->next_result();
            $query->free_result();

        } else {
            $query =  $this->db->query("desc $table");

            $colonnes = $query->result_array();

            $query->next_result();
            $query->free_result();
        }

        $res = [];

        foreach ($colonnes as $colonne) {
            array_push($res,$colonne['Field']);
        }

        return $res;
    }
    

}

?>

