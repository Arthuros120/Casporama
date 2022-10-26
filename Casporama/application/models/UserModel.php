<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/UserEntity.php';

/*

    * Class UserModel

    * Cette classe permet de gérer les utilisateurs

*/
class UserModel extends CI_Model {

    // * Initialisation de la Class UserModel
    function __construct() {
        parent::__construct();
    }

    /*
    
        * heHaveUserByLogin
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son login
    
        @param: $login
    
        @return: boolean
    
    */
    public function heHaveUserByLogin(string $login) : Bool {

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
        
        } else {

            return false;

        }
    }

    /*
    
        * getUserByLogin
    
        * Cette méthode permet de récupérer un utilisateur en fonction de son login
    
        @param: $login

        @return: ?UserEntity
    
    */
    public function getUserByLogin(string $login) : ?UserEntity {

        // * On récupère l'utilisateur en fonction de son login
        $query = $this->db->query("Call getUserByLogin('".$login."')");

        // * On vérifie si l'utilisateur existe
        $id = $query->row()->id;

        // * On atternd un résultat
        $query->next_result(); 
        $query->free_result();

        // * On retourne l'utilisateur
        if(isset($id)){

            $user = new UserEntity();
            $user->set_login($login);
            $user->set_id($id);

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
    public function getStatusById(int $id) : ?string {

        // * On récupère le status de l'utilisateur en fonction de son id
        $query = $this->db->query("Call getStatusById('".$id."')");

        // * On récupère le status
        $status = $query->row()->status;

        // * On attend un résultat
        $query->next_result(); 
        $query->free_result();

        // * On retourne le résultat
        if(isset($status)){

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
    public function password_check(string $password, UserEntity $user) : Bool {

        // * On récupère le mot de passe hasher de l'utilisateur en fonction de son login
        $query = $this->db->query("Call getPasswordById('".$user->get_id()."')");

        // * On récupère le mot de passe hasher et le salt
        $salt = $query->row()->salt;
        $hash = $query->row()->password;

        // * On attend un résultat
        $query->next_result(); 
        $query->free_result();

        // * On vérifie si le mot de passe et le salt existe
        if(isset($salt) && isset($password)){

            // * On vérifie si le mot de passe est correct
            if(password_verify($password . $salt, $hash)){

                return true;
            }

        }

        return false;

    }

    /*
        
        * setUserCookie
        
        * Cette methode permet de créer un cookie pour l'utilisateur de façon sécurisé
        
        @param: $UserEntity
    
        @return: void
        
    */
    public function setUserCookie(UserEntity $user) {

        // * On initialise le cookieId
        $user->set_cookieCheck();

        // * On récupère le cookieId
        $query = $this->db->query("Call setCookieId('" . $user->get_cookieCheck() . "', '" . $user->get_id() . "')");

        // * On attend un résultat
        $query->next_result(); 
        $query->free_result();

        // * On crée la donné pour le cookie
        $cookieValueString = $user->get_id() . '|' . $user->get_cookieCheck() . '|' . $user->get_status();

        /*
    
            TODO: Changer la sécurité du cookie dès que on a configuer le https sur le distant
            ! WARNING ! ERREUR DE SÉCURITÉ ! WARNING !

        */

        // * On crée le cookie
        $cookieSettings = array(
            'name'   => 'user',
            'value'  => $cookieValueString,
            'expire' => 3600 * 24 * 30,
            'secure' => false,
            'httponly' => false
        );

        // * On envoie le cookie
        $this->input->set_cookie($cookieSettings);

    }

    /*
    
        * setUserSession
    
        * Cette méthode permet de créer une session pour l'utilisateur
    
        @param: $cookie
    
    */
    public function setUserSession(UserEntity $user) {

        // * On crée la donné pour la session
        $sessionValueString = $user->get_id() . '|' . $user->get_status();

        // * On crée la session
        $this->session->set_userdata('user', $sessionValueString);

    }
}