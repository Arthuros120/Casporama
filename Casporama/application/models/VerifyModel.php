<?php

// * On importe les classes nécessaire
require_once APPPATH . 'models/entity/UserEntity.php';

/*

    * Class UserModel

    * Cette classe permet de gérer les utilisateurs

*/
class VerifyModel extends CI_Model
{

    /*
    
        Cette fonction permet d'envoyer un mail de réinitialisation de mot de passe à l'utilisateur

    */
    public function sendRecoverPass(string $email)
    {

        $this->load->model('UserModel');

        if (!$this->UserModel->heHaveUserByEmail($email)) {

            show_error(
                "Cette adresse mail n'est pas enregistrée sur Casporama",
                500,
                "Erreur 500 - Compte introuvable"
            );

            die();
        }

        $id = $this->UserModel->getUserByEmail($email)->getId();

        $user = $this->UserModel->getUserById($id);

        if ($user != null) {

            $idKey = $this->generateIdKey();
            $key = $this->generateKey();

            $dateExpiration = date('Y-m-d H:i:s', strtotime('+1 hours'));
            $dateNow = date('Y-m-d H:i:s');

            $queryMsg = "Call verifKey.createKey(?, ?, ?, ?, ?)";

            $this->db->query($queryMsg, array($idKey, $key, $dateNow, $dateExpiration, $user->getId()));

            $this->load->model('EmailModel');

            $fromEmail = array(

                'email' => 'no_reply@casporama.live',
                'name' => 'Casporama - No Reply'

            );

            $this->EmailModel->sendEmail(

                $fromEmail,
                $user->getCoordonnees()->getEmail(),
                'Casporama - Reinisialisation de votre mot de passe',
                'email/recoverPassEmail',
                array(

                    'user' => $user,
                    'idKey' => $idKey,
                    'key' => $key,
                    'dateExpiration' => $dateExpiration

                )
            );
        }
    }

    /*
    
        Cette fonction permet d'avoir la liste des id des clés

    */
    public function getListIdKey(): array
    {
        $resArray = array();

        $query = $this->db->query("Call verifKey.allIdKey()");

        $listIdKey = $query->result();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        foreach ($listIdKey as $value) {

            array_push($resArray, $value->id);
        }

        return $resArray;
    }

    /*
    
        Cette fonction permet d'envoyer un mail avec un code de vérification à l'utilisateur

    */
    public function sendVerifyCode(UserEntity $user)
    {

        $idKey = $this->generateIdKey();
        $key = $this->generateKey();

        $dateExpiration = date('Y-m-d H:i:s', strtotime('+6 hours'));
        $dateNow = date('Y-m-d H:i:s');

        $queryMsg = "Call verifKey.createKey(?, ?, ?, ?, ?)";

        $this->db->query($queryMsg, array($idKey, $key, $dateNow, $dateExpiration, $user->getId()));

        $this->load->model('EmailModel');

        $fromEmail = array(

            'email' => 'no_reply@casporama.live',
            'name' => 'Casporama - No Reply'

        );

        $this->EmailModel->sendEmail(

            $fromEmail,
            $user->getCoordonnees()->getEmail(),
            'Casporama - Vérification de votre adresse mail',
            'email/verifMail',
            array(

                'user' => $user,
                'idKey' => $idKey,
                'key' => $key,
                'dateExpiration' => $dateExpiration

            )
        );
    }

    /*
    
        Cette fonction permet de vérifier si le code en paramètre est existant et valide

    */
    public function checkCode(string $idKey, string $code): ?int
    {

        $query = $this->db->query("Call verifKey.checkCode('" . $idKey . "', '" . $code . "')");

        $keyGroup = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if (isset($keyGroup->idUser)) {

            if (!$this->verifDateExpiration($keyGroup->dateExpiration)) {

                $this->deleteKey($idKey);

                return -1;
            }

            $this->deleteKey($idKey);

            return $keyGroup->idUser;
        } else {

            return null;
        }
    }

    /* 
    
        Cette fonction permet de supprimer une clé

    */
    public function deleteKey(string $idKey)
    {

        $this->db->query("Call verifKey.deleteKey('" . $idKey . "')");
    }

    /* 
    
        Cette fonction permet de vérifier si la date d'expiration est dépassée

    */
    public function verifDateExpiration(string $dateExpiration): bool
    {

        return date('Y-m-d H:i:s') < date($dateExpiration);
    }

    /* 
        
        Cette fonction permet de générer une clé
    
    */
    public function generateKey(): string
    {

        $key = bin2hex(random_bytes(3));

        if ($this->heHaveKey($key)) {

            $key = $this->generateKey();
        }

        return $key;
    }

    /*
        
            Cette fonction permet de générer un id de clé
    
    */
    public function generateIdKey(): string
    {

        $id = bin2hex(random_bytes(32));

        if ($this->heHaveKeyById($id)) {

            $id = $this->generateIdKey();
        }

        return $id;
    }

    /* 
    
        Cette fonction permet d'obtenir l'iduser avec l'id de la clé

    */
    public function getIdByIdKey(string $idKey): ?int
    {

        $query = $this->db->query("Call verifKey.getIdByIdKey('" . $idKey . "')");

        $keyGroup = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if (isset($keyGroup->idUser)) {

            return $keyGroup->idUser;

        } else {

            return null;
        }
    }

    /* 
    
        Cette fonction permet de vérifier si la clé existe

    */
    public function heHaveKey(string $key): bool
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

    /* 
        
            Cette fonction permet de vérifier si l'id de la clé existe
    
    */
    public function heHaveKeyById(string $id): bool
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
