<?php

// * On importe les classes nécessaire
require_once APPPATH . 'models/entity/UserEntity.php';

/*

    * Class UserModel

    * Cette classe permet de gérer les utilisateurs

*/
class VerifyModel extends CI_Model
{

    public function sendVerifyCode(UserEntity $user)
    {

        $idKey = $this->generateIdKey();
        $key = $this->generateKey();

        $dateExpiration = date('Y-m-d H:i:s', strtotime('+6 hours'));
        $dateNow = date('Y-m-d H:i:s');

        $queryMsg = "Call verifKey.createKey(?, ?, ?, ?, ?)";

        $this->db->query($queryMsg, array($idKey, $key, $dateNow, $dateExpiration, $user->getId()));

        var_dump($idKey);
        var_dump($key);
        var_dump($dateExpiration);
        var_dump($dateNow);
        var_dump($user->getId());

    }

    public function generateKey() : string
    {

        $key = bin2hex(random_bytes(3));

        if ($this->heHaveKey($key)) {

            $key = $this->generateKey();
        }

        return $key;

    }

    public function generateIdKey() : string
    {

        $id = bin2hex(random_bytes(32));

        if ($this->heHaveKeyById($id)) {

            $id = $this->generateIdKey();
        }

        return $id;

    }

    public function heHaveKey(string $key) : bool
    {

        $query = $this->db->query("Call verifKey.verifyKey('" . $key . "')");

        $keyGroup = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if (isset($keyGroup->keyValue)) {

            return true;
        }

        return false;

    }

    public function heHaveKeyById(string $id) : bool
    {

        $query = $this->db->query("Call verifKey.verifyId('" . $id . "')");

        $keyGroup = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if (isset($keyGroup->id)) {

            return true;
        }

        return false;

    }

}
