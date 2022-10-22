<?php

require_once APPPATH . 'models/entity/CoordonneesEntity.php';
require_once APPPATH . 'models/entity/LocalisationEntity.php';

class UserEntity {

    private int $id;

    private string $login;
    private string $cookieCheck;
    
    private string $status;

    private LocalisationEntity $Localisation;
    private CoordonneesEntity $coordonnees;

    public function get_id(){

        return $this->id;

    }

    public function set_id(int $id){

        $this->id = $id;

    }

    public function get_login(){

        return $this->login;

    }

    public function set_login(string $login){

        $this->login = $login;

    }

    public function get_cookieCheck(){

        return $this->cookieCheck;

    }

    public function set_cookieCheck(){

        $this->cookieCheck = $this->generateCookieCheck();
    
    }

    public function get_status(){

        return $this->status;

    }

    public function set_status(string $status){

        $this->status = $status;

    }

    public function get_Localisation(){

        return $this->Localisation;

    }

    public function set_Localisation(LocalisationEntity $Localisation){

        $this->Localisation = $Localisation;

    }

    public function get_coordonnees(){

        return $this->coordonnees;

    }

    public function set_coordonnees(CoordonneesEntity $coordonnees){

        $this->coordonnees = $coordonnees;

    }

    public function generateCookieCheck() : string {

        $cookieCheck = uniqid(mt_rand(), true);

        return (string) $cookieCheck;

    }
}