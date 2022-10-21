<?php

class LocalisationEntity {

    private int $id;

    private string $adresse;
    private int $codePostal;
    private string $ville;
    private string $pays;
    private string $departement;

    public function get_id(){

        return $this->id;

    }

    public function set_id(int $id){

        $this->id = $id;

    }

    public function get_adresse(){

        return $this->adresse;

    }

    public function set_adresse(string $adresse){

        $this->adresse = $adresse;

    }

    public function get_codePostal(){

        return $this->codePostal;

    }

    public function set_codePostal(int $codePostal){

        $codePostal = (string) $codePostal;

        if (strlen($codePostal) < 5){

            $this->codePostal = "0" . $codePostal;

        }else{

            $this->codePostal = $codePostal;

        }

        $this->codePostal = $codePostal;

    }

    public function get_ville(){

        return $this->ville;

    }

    public function set_ville(string $ville){

        $this->ville = $ville;

    }

    public function get_pays(){

        return $this->pays;

    }

    public function set_pays(string $pays){

        $this->pays = $pays;

    }

    public function get_departement(){

        return $this->departement;

    }

    public function set_departement(string $departement){

        $this->departement = $departement;

    }

}