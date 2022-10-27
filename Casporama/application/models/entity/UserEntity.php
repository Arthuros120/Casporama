<?php

// * Importe les entités nécessaires
require_once APPPATH . 'models/entity/CoordonneesEntity.php';
require_once APPPATH . 'models/entity/LocalisationEntity.php';

/*

    * UserEntity

    * Cette classe représente une entité de la table user

*/
class UserEntity
{

    private int $id;

    private string $login;
    private string $cookieCheck;
    
    private string $status;

    private LocalisationEntity $localisation;
    private CoordonneesEntity $coordonnees;

    /*
    
        * Function getId
    
        @return int
    
        * Cette fonction retourne l'id de l'entité
    
    */
    public function getId() : int
    {

        return $this->id;

    }

    /*
    
        * Function setId
    
        @param int $id
    
        * Cette fonction modifie l'id de l'entité
    
    */
    public function setId(int $id)
    {

        $this->id = $id;

    }

    /*
    
        * Function getLogin
    
        @return string
    
        * Cette fonction retourne le login de l'entité
    
    */
    public function getLogin() : string
    {

        return $this->login;

    }

    /*
    
        * Function setLogin
    
        @param string $login
    
        * Cette fonction modifie le login de l'entité
    
    */
    public function setLogin(string $login)
    {

        $this->login = $login;

    }

    /*
    
        * Function getCookieCheck
    
        @return string
    
        * Cette fonction retourne le cookieCheck de l'entité
    
    */
    public function getCookieCheck() : string
    {

        return $this->cookieCheck;

    }

    /*
    
        * Function setCookieCheck
    
        @param string $cookieCheck
    
        * Cette fonction modifie le cookieCheck de l'entité
    
    */
    public function setCookieCheck()
    {

        $this->cookieCheck = $this->generateCookieCheck();
    
    }

    /*
    
        * Function getStatus
    
        @return string
    
        * Cette fonction retourne le status de l'entité
    
    */
    public function getStatus() : string
    {

        return $this->status;

    }

    /*
    
        * Function setStatus
    
        @param string $status
    
        * Cette fonction modifie le status de l'entité
    
    */
    public function setStatus(string $status)
    {

        $this->status = $status;

    }

    /*
    
        * Function getLocalisation
    
        @return LocalisationEntity
    
        * Cette fonction retourne la localisation de l'entité
    
    */
    public function getLocalisation() : LocalisationEntity
    {

        return $this->localisation;

    }

    /*
    
        * Function setLocalisation
    
        @param LocalisationEntity $Localisation
    
        * Cette fonction modifie la localisation de l'entité
    
    */
    public function setLocalisation(LocalisationEntity $localisation)
    {

        $this->localisation = $localisation;

    }

    /*
    
        * Function getCoordonnees
    
        @return CoordonneesEntity
    
        * Cette fonction retourne les coordonnées de l'entité
    
    */
    public function getCoordonnees() : CoordonneesEntity
    {

        return $this->coordonnees;

    }

    /*
    
        * Function setCoordonnees
    
        @param CoordonneesEntity $coordonnees
    
        * Cette fonction modifie les coordonnées de l'entité
    
    */
    public function setCoordonnees(CoordonneesEntity $coordonnees)
    {

        $this->coordonnees = $coordonnees;

    }

    /*
    
        * Function generateCookieCheck
    
        @return string
    
        * Cette fonction génère un cookieCheck (CookieId)
    
    */
    public function generateCookieCheck() : string
    {

        $cookieCheck = uniqid(mt_rand(), true);

        return (string) $cookieCheck;

    }
}
