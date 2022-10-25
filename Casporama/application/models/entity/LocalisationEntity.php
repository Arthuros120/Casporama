<?php

/*
    
        * LocalisationEntity
    
        * Cette classe représente une entité de la table localisation
    
*/
class LocalisationEntity {

    private int $id;

    private string $adresse;
    private string $codePostal;
    private string $ville;
    private string $pays;
    private string $departement;

    /*
    
        * Function get_id
    
        @return int
    
        * Cette fonction retourne l'id de l'entité
    
    */
    public function get_id() : int {

        return $this->id;

    }

    /*
    
        * Function set_id
    
        @param int $id
    
        * Cette fonction modifie l'id de l'entité
    
    */
    public function set_id(int $id){

        $this->id = $id;

    }

    /*
    
        * Function get_adresse
    
        @return string
    
        * Cette fonction retourne l'adresse de l'entité
    
    */
    public function get_adresse() : string {

        return $this->adresse;

    }

    /*
    
        * Function set_adresse
    
        @param string $adresse
    
        * Cette fonction modifie l'adresse de l'entité
    
    */
    public function set_adresse(string $adresse){

        $this->adresse = $adresse;

    }

    /*
    
        * Function get_codePostal
    
        @return int
    
        * Cette fonction retourne le code postal de l'entité
    
    */
    public function get_codePostal() : string {

        return $this->codePostal;

    }

    /*
    
        * Function set_codePostal
    
        @param int $codePostal
    
        * Cette fonction modifie le code postal de l'entité
        * rajout un 0 si le codePostal est inférieur à 10000
    
    */
    public function set_codePostal(int $codePostal){

        $codePostal = (string) $codePostal;

        if (strlen($codePostal) < 5){

            $this->codePostal = "0" . $codePostal;

        }else{

            $this->codePostal = $codePostal;

        }

        $this->codePostal = $codePostal;

    }

    /*
    
        * Function get_ville
    
        @return string
    
        * Cette fonction retourne la ville de l'entité
    
    */
    public function get_ville() : string {

        return $this->ville;

    }

    /*
    
        * Function set_ville
    
        @param string $ville
    
        * Cette fonction modifie la ville de l'entité
    
    */
    public function set_ville(string $ville){

        $this->ville = $ville;

    }

    /*
    
        * Function get_pays
    
        @return string
    
        * Cette fonction retourne le pays de l'entité
    
    */
    public function get_pays() : string {

        return $this->pays;

    }

    /*
    
        * Function set_pays
    
        @param string $pays
    
        * Cette fonction modifie le pays de l'entité
    
    */
    public function set_pays(string $pays){

        $this->pays = $pays;

    }

    /*
    
        * Function get_departement
    
        @return string
    
        * Cette fonction retourne le département de l'entité
    
    */
    public function get_departement() : string {

        return $this->departement;

    }

    /*
    
        * Function set_departement
    
        @param string $departement
    
        * Cette fonction modifie le département de l'entité
    
        TODO: Rajouter l'autocomplétion des départements
    
    */
    public function set_departement(string $departement){

        $this->departement = $departement;

    }
}