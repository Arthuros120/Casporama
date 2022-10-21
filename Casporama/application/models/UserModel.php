<?php

use PhpParser\Node\Expr\Cast\Bool_;

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

        if(isset($salt) && isset($password)){

            $user = new UserEntity();
            $user->set_login($login);
            $user->set_id($id);

            return $user;

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

}