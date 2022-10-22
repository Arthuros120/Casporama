<?php

require_once APPPATH . 'models/entity/UserEntity.php';

class UserModel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function heHaveUserByLogin(string $login) : Bool {

        $query = $this->db->query("Call verifyLogin('".$login."')");

        $user = $query->row();

        $query->next_result(); 
        $query->free_result();

        if (isset($user->login)) {

            return true;
        
        } else {

            return false;

        }
    }

    public function getUserByLogin(string $login) : ?UserEntity {

        $query = $this->db->query("Call getUserByLogin('".$login."')");
        $id = $query->row()->id;

        $query->next_result(); 
        $query->free_result();

        if(isset($id)){

            $user = new UserEntity();
            $user->set_login($login);
            $user->set_id($id);

            return $user;

        }

        return null;

    }

    public function getStatusById(int $id) : ?string {

        $query = $this->db->query("Call getStatusById('".$id."')");
        $status = $query->row()->status;

        $query->next_result(); 
        $query->free_result();

        if(isset($status)){

            return $status;

        }

        return null;

    }

    public function password_check(string $password, UserEntity $user) : Bool {

        $query = $this->db->query("Call getPasswordById('".$user->get_id()."')");

        $salt = $query->row()->salt;
        $hash = $query->row()->password;

        $query->next_result(); 
        $query->free_result();

        if(isset($salt) && isset($password)){

            if(password_verify($password . $salt, $hash)){

                return true;
            }

        }

        return false;

    }

    public function setUserCookie(UserEntity $user) {

        $user->set_cookieCheck();

        $query = $this->db->query("Call setCookieId('" . $user->get_cookieCheck() . "', '" . $user->get_id() . "')");

        $query->next_result(); 
        $query->free_result();

        $cookieValueString = $user->get_id() . '|' . $user->get_cookieCheck() . '|' . $user->get_status();

        /*
    
            TODO: Changer la sécurité du cookie dès que on a configuer le https sur le distant
            ! WARNING ! ERREUR DE SÉCURITÉ ! WARNING !

        */

        $cookieSettings = array(
            'name'   => 'user',
            'value'  => $cookieValueString,
            'expire' => 3600 * 24 * 30,
            'secure' => false,
            'httponly' => false
        );

        $this->input->set_cookie($cookieSettings);

    }

    public function setUserSession(UserEntity $user) {

        $this->session->set_userdata('user', $user);

    }

}