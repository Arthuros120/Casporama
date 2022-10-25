<?php

// * Importe les entités nécessaires
require_once APPPATH . 'models/entity/CoordonneesEntity.php';
require_once APPPATH . 'models/entity/LocalisationEntity.php';

/*

    * UserEntity

    * Cette classe représente une entité de la table user

*/
class UserEntity {

    private int $id;

    private string $login;
    private string $cookieCheck;
    
    private string $status;

    private LocalisationEntity $Localisation;
    private CoordonneesEntity $coordonnees;

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
    
        * Function get_login
    
        @return string
    
        * Cette fonction retourne le login de l'entité
    
    */
    public function get_login() : string {

        return $this->login;

    }

    /*
    
        * Function set_login
    
        @param string $login
    
        * Cette fonction modifie le login de l'entité
    
    */
    public function set_login(string $login){

        $this->login = $login;

    }

    /*
    
        * Function get_cookieCheck
    
        @return string
    
        * Cette fonction retourne le cookieCheck de l'entité
    
    */
    public function get_cookieCheck() : string {

        return $this->cookieCheck;

    }

    /*
    
        * Function set_cookieCheck
    
        @param string $cookieCheck
    
        * Cette fonction modifie le cookieCheck de l'entité
    
    */
    public function set_cookieCheck() {

        $this->cookieCheck = $this->generateCookieCheck();
    
    }

    /*
    
        * Function get_status
    
        @return string
    
        * Cette fonction retourne le status de l'entité
    
    */
    public function get_status() : string {

        return $this->status;

    }

    /*
    
        * Function set_status
    
        @param string $status
    
        * Cette fonction modifie le status de l'entité
    
    */
    public function set_status(string $status){

        $this->status = $status;

    }

    /*
    
        * Function get_Localisation
    
        @return LocalisationEntity
    
        * Cette fonction retourne la localisation de l'entité
    
    */
    public function get_Localisation() : LocalisationEntity {

        return $this->Localisation;

    }

    /*
    
        * Function set_Localisation
    
        @param LocalisationEntity $Localisation
    
        * Cette fonction modifie la localisation de l'entité
    
    */
    public function set_Localisation(LocalisationEntity $Localisation){

        $this->Localisation = $Localisation;

    }

    /*
    
        * Function get_coordonnees
    
        @return CoordonneesEntity
    
        * Cette fonction retourne les coordonnées de l'entité
    
    */
    public function get_coordonnees() : CoordonneesEntity {

        return $this->coordonnees;

    }

    /*
    
        * Function set_coordonnees
    
        @param CoordonneesEntity $coordonnees
    
        * Cette fonction modifie les coordonnées de l'entité
    
    */
    public function set_coordonnees(CoordonneesEntity $coordonnees){

        $this->coordonnees = $coordonnees;

    }

    /*
    
        * Function generateCookieCheck
    
        @return string
    
        * Cette fonction génère un cookieCheck (CookieId)
    
    */
    public function generateCookieCheck() : string {

        $cookieCheck = uniqid(mt_rand(), true);

        return (string) $cookieCheck;

    }
}