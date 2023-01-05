<?php

class DaoModel extends CI_Model {

    public function colonnes($table) {

        $query =  $this->db->query("desc $table");

        $colonnes = $query->result_array();

        $query->next_result();
        $query->free_result();

        $res = [];

        foreach ($colonnes as $colonne) {
            array_push($res,$colonne['Field']);
        }

        return $res;
    }
    

}

?>

