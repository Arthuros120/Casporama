<?php

// * Importe les entités nécessaires
require_once APPPATH . 'models/entity/InformationEntity.php';
require_once APPPATH . 'models/entity/LocationEntity.php';
require_once APPPATH . 'models/entity/CartEntity.php';


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

    private bool $isVerified;
    private bool $isAlive;

    private array $localisation;
    private InformationEntity $coordonnees;

    private array $cart;

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

        $this->login = strtolower($login);

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
    
        * Function getIsVerified
    
        @return bool
    
        * Cette fonction retourne si l'entité est vérifiée
    
    */
    public function getIsVerified() : bool
    {

        return $this->isVerified;

    }

    /*
    
        * Function setIsVerified
    
        @param bool $isVerified
    
        * Cette fonction modifie si l'entité est vérifiée
    
    */
    public function setIsVerified(bool $isVerified)
    {

        $this->isVerified = $isVerified;

    }

    /*
    
        * Function getIsAlive
    
        @return bool
    
        * Cette fonction retourne si l'entité est en vie
    
    */
    public function getIsAlive() : bool
    {

        return $this->isAlive;

    }

    /*
    
        * Function setIsAlive
    
        @param bool $isAlive
    
        * Cette fonction modifie si l'entité est en vie
    
    */
    public function setIsAlive(bool $isAlive)
    {

        $this->isAlive = $isAlive;

    }

    /*
    
        * Function getLocalisation
    
        @return array
    
        * Cette fonction retourne la localisation de l'entité
    
    */
    public function getLocalisation() : ?array
    {

        return $this->localisation;

    }

    /*
    
        * Function setLocalisation
    
        @param array $Localisation
    
        * Cette fonction modifie la localisation de l'entité
    
    */
    public function setLocalisation(array $localisation)
    {

        $this->localisation = $localisation;

    }

    /*
    
        * Function getCoordonnees
    
        @return array
    
        * Cette fonction retourne les coordonnées de l'entité
    
    */
    public function getCoordonnees() : InformationEntity
    {

        return $this->coordonnees;

    }

    /*
    
        * Function setCoordonnees
    
        @param array $coordonnees
    
        * Cette fonction modifie les coordonnées de l'entité
    
    */
    public function setCoordonnees(InformationEntity $coordonnees)
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

    /*
    
        * Function getCart
    
        @return CartEntity
    
        * Cette fonction renvoie le panier de l'entité
    
    */
    public function getCart() : ?array
    {

        if (isset($this->cart)) {
            return $this->cart;
        }

        return null;

    }

    /*
    
        * Function setCart
    
        @param CartEntity
    
        * Cette fonction modifie le panier de l'entité
    
    */
    public function setCart(array $cart)
    {

        if (!isset($this->cart)) {
            $this->cart = array();
        }
        
        array_push($this->cart,$cart);

    }
}
