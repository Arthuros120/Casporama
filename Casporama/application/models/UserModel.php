<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/UserEntity.php';

/*

    * Class UserModel

    * Cette classe permet de gérer les utilisateurs

*/
class UserModel extends CI_Model
{

    /*
    
        * heHaveUserByLogin
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son login
    
        @param: $login
    
        @return: boolean
    
    */
    public function heHaveUserByLogin(string $login) : Bool
    {

        // * On récupère l'utilisateur en fonction de son login
        $query = $this->db->query("Call verifyLogin('".$login."')");

        // * On vérifie si l'utilisateur existe
        $user = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne le résultat
        if (isset($user->login)) {

            return true;
        
        }

        return false;
    }

    /*
    
        * getUserByLogin
    
        * Cette méthode permet de récupérer un utilisateur en fonction de son login
    
        @param: $login

        @return: ?UserEntity
    
    */
    public function getUserByLogin(string $login) : ?UserEntity
    {

        // * On récupère l'utilisateur en fonction de son login
        $query = $this->db->query("Call getUserByLogin('".$login."')");

        // * On vérifie si l'utilisateur existe
        $id = $query->row()->id;

        // * On atternd un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne l'utilisateur
        if (isset($id)) {

            $user = new UserEntity();
            $user->setLogin($login);
            $user->setId($id);

            return $user;

        }

        return null;

    }

    /*
    
        * getStatusById
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son login et de son mot de passe
    
        @param: $id
    
        @return: ?string
    
    */
    public function getStatusById(int $id) : ?string
    {

        // * On récupère le status de l'utilisateur en fonction de son id
        $query = $this->db->query("Call getStatusById('".$id."')");

        // * On récupère le status
        $status = $query->row()->status;

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne le résultat
        if (isset($status)) {

            return $status;

        }

        return null;

    }

    /*
    
        * password_check
    
        * Cette méthode permet de récupérer un utilisateur en fonction de la classe
        * UserEntity et de vérifier si le mot de passe qui est donné en parametre est correct
    
        @param: $password
        @param: $UserEntity

        @return: boolean
    
    */
    public function passwordCheck(string $password, UserEntity $user) : Bool
    {

        // * On récupère le mot de passe hasher de l'utilisateur en fonction de son login
        $query = $this->db->query("Call getPasswordById('".$user->getId()."')");

        // * On récupère le mot de passe hasher et le salt
        $salt = $query->row()->salt;
        $hash = $query->row()->password;

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On vérifie si le mot de passe et le salt existe et
        // * on vérifie si le mot de passe est correct
        if (isset($salt) && isset($password) && (password_verify($password . $salt, $hash))) {

            return true;

        }

        return false;

    }

    /*
        
        * setUserCookie
        
        * Cette methode permet de créer un cookie pour l'utilisateur de façon sécurisé
        
        @param: $UserEntity
    
        @return: void
        
    */
    public function setUserCookie(UserEntity $user)
    {

        // * On initialise le cookieId
        $user->setCookieCheck();

        // * On récupère le cookieId
        $query = $this->db->query("Call setCookieId('" . $user->getCookieCheck() . "', '" . $user->getId() . "')");

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On crée la donné pour le cookie
        $cookieValueString = $user->getId() . '|' . $user->getCookieCheck() . '|' . $user->getStatus();

        // * On crée le cookie
        $cookieSettings = array(
            'name'   => 'user',
            'value'  => $cookieValueString,
            'expire' => 3600 * 24 * 30,
            'secure' => true,
            'httponly' => true
        );

        // * On envoie le cookie
        $this->input->set_cookie($cookieSettings);

    }

    /*
    
        * getUserByCookie
    
        * Cette méthode permet de récupérer un utilisateur en fonction de son cookie

        @return: ?UserEntity
    
    */

    public function getUserByCookie() : ?UserEntity
    {

        //TODO: A faire

        return null;

    }

    /*
    
        * unsetUserCookie
    
        * Cette méthode permet de supprimer le cookie de l'utilisateur
    
        @param: $UserEntity
    
    */
    public function unsetUserCookie(UserEntity $user)
    {

        if ($this->input->cookie('user') != null) {

            $query = $this->db->query("Call delCookieId('" . $user->getId() . "')");
            $query->next_result();
            
            // * On supprime le cookie
            delete_cookie('user');
    
        }
    }

    /*
    
        * setUserSession
    
        * Cette méthode permet de créer une session pour l'utilisateur
    
        @param: $cookie
    
    */
    public function setUserSession(UserEntity $user)
    {

        // * On crée la donné pour la session
        $sessionValueString = $user->getId() . '|' . $user->getStatus();

        // * On crée la session
        $this->session->set_userdata('user', $sessionValueString);

    }

    /*
    
        * getUserBySession
    
        * Cette méthode permet de récupérer un utilisateur en fonction de sa session
    
        @return: ?UserEntity
    
    */
    public function getUserBySession() : ?UserEntity
    {

        // * On récupère la session
        $session = $this->session->userdata('user');

        // * On vérifie si la session existe
        if (isset($session)) {

            // * On récupère les données de la session
            $sessionData = explode('|', $session);

            // * On vérifie si les données de la session sont correct
            if (isset($sessionData[0]) && isset($sessionData[1])) {

                // * On crée l'utilisateur
                $user = new UserEntity();
                $user->setId($sessionData[0]);
                $user->setStatus($sessionData[1]);

                // * On retourne l'utilisateur
                return $user;

            }
        }

        // * On retourne null si la session n'existe pas
        return null;

    }

    /*
    
        * unsetUserSession
    
        * Cette méthode permet de supprimer la session de l'utilisateur
    
    */
    public function unsetUserSession()
    {

        // * On supprime la session
        $this->session->unset_userdata('user');

    }
}
