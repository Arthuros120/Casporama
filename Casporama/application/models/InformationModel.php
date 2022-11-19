<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/InformationEntity.php';

/*

    * Class InformationModel

    * Cette classe permet de gérer les informations

*/
class InformationModel extends CI_Model
{

    public function getInformationByUserId(int $id) : ?InformationEntity
    {

        // * On cherche les coordonnées de l'utilisateur si il existe
        // * On récupère les coordonnées de l'utilisateur en fonction de son id
        $query = $this->db->query("Call getUserInfoById('" . $id . "')");

        if (isset($query -> result()[0])) {

            // * On récupère les coordonnées
            $coordId = $query->row()->id;
            $firstname = $query->row()->firstname;
            $name = $query->row()->name;
            $email = $query->row()->mail;
            $mobile = $query->row()->mobile;
            $fix = $query->row()->fix;

        } else {

            return null;

        }

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        $information = new InformationEntity();

        $information->setId($coordId);
        $information->setPrenom($firstname);
        $information->setNom($name);
        $information->setEmail($email);
        $information->setTelephone($mobile);
        
        if (isset($fix)) {

            $information->setFixe($fix);

        } else {

            $information->setFixe("");
        }

        return $information;

    }
}
