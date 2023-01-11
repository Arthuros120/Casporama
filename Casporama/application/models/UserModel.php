<?php

// * On importe les classes nécessaire
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
    captcha
    
    */
    public function heHaveUserByLogin(string $login): Bool
    {

        // * on transforme le login en minuscule
        $login = strtolower($login);

        // * On récupère l'utilisateur en fonction de son login
        $query = $this->db->query("Call user.verifyLogin('" . $login . "')");

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
    
        * heHaveUserById
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son Id
    
        @param: $login
    
        @return: boolean
    
    */
    public function heHaveUserById(int $id): Bool
    {

        // * On récupère l'utilisateur en fonction de son id
        $query = $this->db->query("Call user.verifyId('" . $id . "')");

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
    
        * heHaveUserBySalt
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son salt
    
        @param: $salt
    
        @return: boolean
    
    */
    public function heHaveUserBySalt(string $salt): Bool
    {

        // * On récupère l'utilisateur en fonction de son salt
        $query = $this->db->query("Call user.verifySalt('" . $salt . "')");

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
    
        * heHaveUserByEmail
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son email
    
        @param: $login
    
        @return: boolean
    
    */
    public function heHaveUserByEmail(string $email): Bool
    {

        // * on transforme l'email en minuscule
        $email = strtolower($email);

        // * On récupère l'utilisateur en fonction de son email
        $query = $this->db->query("Call user.verifyEmail('" . $email . "')");

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
    
        * heHaveUserByMobilePhone
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son email
    
        @param: $login
    
        @return: boolean
    
    */
    public function heHaveUserByMobilePhone(string $phone): Bool
    {

        // * On enleve le 0 du numéro de téléphone si il existe
        if (strlen($phone) == 10 && $phone[0] == 0) {

            $phone = substr($phone, 1);
        }

        // * On récupère l'utilisateur en fonction de son phone
        $query = $this->db->query("Call user.verifyPhone('" . $phone . "')");

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


    public function getUsers(array $range): array
    {

        $query = $this->db->query(
            'call user.getAllUserWithStep(?, ?)',
            array(
                $range[0],
                $range[1]
            )
        );
        
        $usersarray = $query->result_array();

        $users = array();

        $query->next_result();
        $query->free_result();

        foreach ($usersarray as $userarray) {

            $newuser = new UserEntity();

            $newuser->setId($userarray['id']);
            $newuser->setLogin($userarray['login']);
            $newuser->setStatus($userarray['status']);
            $newuser->setIsVerified($userarray['isVerified']);
            $newuser->setIsAlive($userarray['isALive']);

            $newInfo = new InformationEntity();

            $newInfo->setPrenom($userarray['firstname']);
            $newInfo->setNom($userarray['name']);
            $newInfo->setEmail($userarray['mail']);

            $newuser->setCoordonnees($newInfo);

            $users[] = $newuser;

        }

        return $users;

    }

    public function search(string $title, array $users, string $search) : array
    {

        $title .= " Recherche -> " . $search . ", ";

        // * Initialisation du tableau de retour
        $listUsersBySearch = array();

        $search = $this->formatStr($search);

        $search = explode(' ', $search);
        $countSearch = count($search);

        // * On parcours le tableau des utilisateur
        foreach ($users as &$user) {

            $count = 0;

            foreach ($search as $word) {

                if (
                    stristr($this->formatStr($users->getCoordonnees()->getNom()), $word) ||
                    stristr($this->formatStr($users->getCoordonnees()->getPrenom()), $word) ||
                    stristr($this->formatStr($users->getLogin()), $word)
                    ) {

                    $count++;

                }
            }

            if ($countSearch == $count) {

                // * On ajoute l'objet au tableau de retour
                array_push($listUsersBySearch, $user);
            }

        }

                // * On retourne le tableau de retour
        return array(
            'title' => $title,
            'users' => $listUsersBySearch
        );
    }

    public function filtred(array $get, array $users) : array
    {

        if (empty($get['search'])) {

            return array(
                'title' => "Tous les utilisateurs",
                'users' => $users
            );
        }

        $title = "Utilisateur filtrés par :";

        $res = $this->search($title, $users, $get['search']);
        $title = $res['title'];
        $users = $res['users'];

        return array(
            'title' => $title,
            'products' => $users,
        );

    }

    /*
    
        * getUserByLoginOrEmail
    
        * Cette méthode choisie la bonne requête en fonction du paramètre
    
        @param: $strLogin
    
        @return: ?UserEntity
    
    */
    public function getUserByLoginOrEmail(string $strLogin): ?UserEntity
    {

        // * on transforme strLogin en minuscule
        $strLogin = strtolower($strLogin);

        if (stristr($strLogin, '@') && stristr($strLogin, '.')) {

            $user = $this->getUserByEmail($strLogin);
        } else {

            $user = $this->getUserByLogin($strLogin);
        }

        return $user;
    }

    /*
    
        * getUserByLogin
    
        * Cette méthode permet de récupérer un utilisateur en fonction de son login
    
        @param: $login

        @return: ?UserEntity
    
    */
    public function getUserByLogin(string $login): ?UserEntity
    {
        
        // * on transforme le login en minuscule
        $login = strtolower($login);

        // * On récupère l'utilisateur en fonction de son login
        $query = $this->db->query("Call user.getUserByLogin('" . $login . "')");

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
    
        * getUserByEmail
    
        * Cette méthode permet de récupérer un utilisateur en fonction de son email
    
        @param: $login

        @return: ?UserEntity
    
    */
    public function getUserByEmail(string $email): ?UserEntity
    {

        // * on transforme l'email en minuscule
        $email = strtolower($email);

        // * On récupère l'utilisateur en fonction de son login
        $query = $this->db->query("Call user.getUserByEmail('" . $email . "')");

        // * On vérifie si l'utilisateur existe
        $id = $query->row()->id;
        $login = $query->row()->login;

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
    
        * getLocationById
    
        * Cette méthode permet de récupérer un utilisateur en fonction d'une location
    
        @param: $id

        @return: ?UserEntity
    
    */
    public function getUserByLocationId(int $id): ?UserEntity
    {

        // * On récupère l'utilisateur en fonction de son login
        $query = $this->db->query("Call user.getUserByLocationId('" . $id . "')");

        // * On vérifie si l'utilisateur existe
        $id = $query->row()->id;

        // * On atternd un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne l'utilisateur
        if (isset($id)) {

            $user = new UserEntity();
            $user->setId($id);

            return $user;
        }

        return null;
    }

    /*
    
        * getUserById
    
        * Cette méthode permet de récupérer un utilisateur en fonction de son id sans mot de passe

        @param: $id
    
        @return: ?UserEntity
    
    */
    public function getUserById(int $id): ?UserEntity
    {

        $this->load->model('LocationModel');
        $this->load->model('InformationModel');

        // * On récupère le status de l'utilisateur en fonction de son id
        $query = $this->db->query("Call user.getUserById('" . $id . "')");

        // * On récupère le status et le login
        $login = $query->row()->login;
        $status = $query->row()->status;
        $isVerified = $query->row()->isVerified;
        $isAlive = $query->row()->isALive;

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if (!isset($status) || !isset($login) || !isset($isVerified) || !isset($isAlive)) {

            return null;

        }

        $information = $this->InformationModel->getInformationByUserId($id);

        if ($information == null) {

            return null;

        }

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        $addressList = $this->LocationModel->getLocationsByUserId($id, true);

        $user = new UserEntity();

        $user->setId($id);
        $user->setLogin($login);
        $user->setStatus($status);
        $user->setIsVerified($isVerified);
        $user->setIsAlive($isAlive);
        $user->setLocalisation($addressList);
        $user->setCoordonnees($information);


        return $user;

    }

    /*
    
        * getStatusById
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son login et de son mot de passe
    
        @param: $id
    
        @return: ?string
    
    */
    public function getStatusById(int $id): ?string
    {

        // * On récupère le status de l'utilisateur en fonction de son id
        $query = $this->db->query("Call user.getStatusById('" . $id . "')");

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
    
        * getIsVerifiedById
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son login et de son mot de passe
    
        @param: $id
    
        @return: ?string
    
    */
    public function getIsVerifiedById(int $id): ?bool
    {

        $query = $this->db->query("Call user.getIsVerifiedById('" . $id . "')");

        $isVerified = $query->row()->isVerified;

        $query->next_result();
        $query->free_result();

        if (isset($isVerified)) {

            return $isVerified;
        }

        return null;

    }

    /*
    
        * getIsAliveById
    
        * Cette méthode permet de vérifier si un utilisateur existe dans la base de données
        * en fonction de son login et de son mot de passe
    
        @param: $id
    
        @return: ?string
    
    */
    public function getIsAliveById(int $id): ?bool
    {

        $query = $this->db->query("Call user.getIsAliveById('" . $id . "')");

        $isAlive = $query->row()->isALive;

        $query->next_result();
        $query->free_result();

        if (isset($isAlive)) {

            return $isAlive;
        }

        return null;

    }

    /*

        * getDateLastUpdateById

        * Cette méthode permet de récupérer la date de la dernière mise à jour de l'utilisateur

        @param: $id
        @return: ?string

    */
    public function getDateLastUpdateById(int $id): ?string
    {

        $query = $this->db->query("Call user.getDateLastUpdateById('" . $id . "')");

        $dateLastUpdate = $query->row()->dateLastUpdate;

        $query->next_result();
        $query->free_result();

        if (isset($dateLastUpdate)) {

            return $dateLastUpdate;
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
    public function passwordCheck(string $password, UserEntity $user): Bool
    {

        // * On récupère le mot de passe hasher de l'utilisateur en fonction de son login
        $query = $this->db->query("Call user.getPasswordById('" . $user->getId() . "')");

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

        if (isset($_COOKIE["user"])) {
            // * On supprime si il existe le cookie de l'utilisateur
            $this->unsetUserCookie($user);
        }

        // * On initialise le cookieId
        $user->setCookieCheck();

        // * On récupère le cookieId
        $query = $this->db->query("Call user.setCookieId('" . $user->getCookieCheck() . "', '" . $user->getId() . "')");

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

    public function getUserByCookie(): ?UserEntity
    {

        // * On récupère le cookie
        $cookie = $this->input->cookie('user', true);

        // * On vérifie si le cookie existe
        if (isset($cookie)) {

            // * On récupère les données du cookie
            $cookieData = explode('|', $cookie);

            // * On vérifie si les données du cookie sont correct
            if (isset($cookieData[0]) && isset($cookieData[1]) && isset($cookieData[2])) {

                $cookieUserId = (int) $cookieData[0];
                $cookieId = $cookieData[1];

                // * On récupère l'utilisateur en fonction de son id
                $query = $this->db->query("Call user.getUserById('" . $cookieUserId . "')");
                // * On récupère le cookieId
                $cookieUserIdDb = $query->row()->id;
                $cookieCookieIdDb = $query->row()->cookieId;
                $cookieStatusDb = $query->row()->status;

                // * On attend un résultat
                $query->next_result();
                $query->free_result();

                // * On vérifie si le cookieId est correct
                if (isset($cookieCookieIdDb) && $cookieCookieIdDb == $cookieId) {

                    // * On crée l'utilisateur
                    $user = new UserEntity();
                    $user->setId($cookieUserIdDb);
                    $user->setStatus($cookieStatusDb);

                    return $user;
                }
            }
        }

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

            $query = $this->db->query("Call user.delCookieId('" . $user->getId() . "')");
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

        if (isset($_SESSION['user'])) {
            // * On supprime si il existe la session de l'utilisateur
            $this->unsetUserSession();
        }

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
    public function getUserBySession(): ?UserEntity
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
    
        * getStatus
    
        * Cette méthode retourne le status de l'utilisateur
    
        @return: ?String
    
    */
    public function getStatus(): ?string
    {
        // * On récupère l'utilisateur
        $user = $this->getUserBySession();

        // * On vérifie si l'utilisateur existe
        if (isset($user)) {

            // * On retourne le status de l'utilisateur
            return $user->getStatus();
        }

        // * On retourne null si l'utilisateur n'existe pas
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

    /*
    
        * isConnected
    
        * Cette méthode savoir si l'utilisateur est connecté
    
        @return: Boolean
    
    */
    public function isConnected(): Bool
    {

        // * On récupère l'utilisateur
        $user = $this->getUserBySession();

        // * On vérifie si l'utilisateur existe
        if (isset($user)) {

            // * On retourne true
            return true;

        }

        return false;
    }

    /*
    
        * durabilityConnection
    
        * Cette méthode permet de savoir si l'utilisateur est connecté
        * de façon durable et si il l'est de le connecter grâce à son cookie

    
    */
    public function durabilityConnection()
    {

        // * On récupère l'utilisateur
        $user = $this->getUserByCookie();

        // * On vérifie si l'utilisateur existe
        if (isset($user)) {

            // * On connecte l'utilisateur
            $this->setUserSession($user);
        }
    }

    /*
    
        * isPasswordValid
    
        * Cette méthode permet de vérifier si le mot de passe est valide
    
        @param: $password (String)
    
        @return: bool
    
    */
    public function isPasswordValid(String $password): Bool
    {

        // * On vérifie si le mot de passe est valide il doit contenir au moins 8 caractères
        // * dont 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial
        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $password)) {

            return true;
        }

        return false;
    }

    public function registerUser(array $data)
    {

        if (
            isset($data['login']) &&
            isset($data['email']) &&
            isset($data['password']) &&
            isset($data['prenom']) &&
            isset($data['nom']) &&
            isset($data['mobilePhone'])
        ) {

            if (!isset($data['fixePhone']) || $data['fixePhone'] == 0) {

                $data['fixePhone'] = null;

            }

            $data['id'] = $this->generateId();

            $data['login'] = strtolower($data['login']);

            $identifyValue = $this->generateHashPassword($data['password']);
    
            $data['password'] = $identifyValue['password'];
            $data['salt'] = $identifyValue['salt'];

            $data['dateLastUpdate'] = date('Y-m-d H:i:s');

            $requeteSql = "Call user.createUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $dataRequete = array(
                $data['id'],
                $data['login'],
                $data['password'],
                $data['salt'],
                $data['prenom'],
                $data['nom'],
                $data['email'],
                $data['mobilePhone'],
                $data['fixePhone'],
                $data['dateLastUpdate']
            );

            $this->db->query($requeteSql, $dataRequete);
        }
    }

    public function setUserVerified(int $id)
    {

        $this->db->query("Call user.setUserVerified('" . $id ."', '" . date('Y-m-d H:i:s') . "')");

    }

    public function updateLastName(int $id, string $newLastName)
    {

        $this->db->query("Call user.updateLastName(" . $id . ",'"  . $newLastName . "')");

    }

    public function updateFirstName(int $id, string $newFirstName)
    {

        $this->db->query("Call user.updateFirstName(" . $id . ",'" . $newFirstName . "')");

    }

    public function updateEmail(UserEntity $user, string $newEmail, $author = "user")
    {

        $this->db->query("Call user.updateEmail(" . $user->getId() . ", '" . $newEmail . "')");

        $lastEmail = $user->getCoordonnees()->getEmail();

        $user->getCoordonnees()->setEmail($newEmail);

        $this->sendInfoModifEmail($user, $lastEmail, $author);

    }
    
    public function updateMobile(int $id, string $newMobile)
    {

        $this->db->query("Call user.updateMobile(" . $id . ", '" . $newMobile . "')");

    }

    public function updateFixe(int $id, string $newFixe)
    {

        $this->db->query("Call user.updateFixe(" . $id . ", '" . $newFixe . "')");

    }

    public function updatePassword(int $id, string $newPassword)
    {

        $identifyValue = $this->generateHashPassword($newPassword);

        $newSalt = $identifyValue['salt'];

        $newPassword = $identifyValue['password'];

        $this->db->query("Call user.updatePassword(" . $id . ", '" . $newPassword . "', '" . $newSalt . "')");

    }

    private function generateId(): Int
    {

        $id = rand(10000, 999999999);

        if ($this->heHaveUserById($id)) {

            $id = $this->generateId();
        }

        return $id;
    }
    
    private function generateHashPassword(string $password): array
    {
        $genSalt = uniqid(rand(10000, 999999999), true);
        $salt = null;

        while ($salt == null) {

            if ($this->heHaveUserBySalt($genSalt)) {

                $genSalt = uniqid(rand(10000, 999999999), true);

            } else {

                $salt = $genSalt;
            }

        }

        $password = $password . $salt;

        $password = password_hash($password, PASSWORD_DEFAULT);

        return array(
            'password' => $password,
            'salt' => $salt,
        );
    }

    public function getDayRemaining(string $date)
    {

        $date = new DateTime($date);

        $date = $date->add(new DateInterval('P' . $this->config->item('nbrDaysRemaining') .  'D'));

        $now = new DateTime();

        $interval = $date->diff($now);

        return $interval->format('%a,%h,%i,%s');

    }
    
    public function deleteUser(int $id)
    {
        $dateLastUpdate = date('Y-m-d H:i:s');

        $this->db->query("Call user.userIsDead('" . $id . "', '" . $dateLastUpdate . "')");

    }

    public function adminOnly() : UserEntity
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if (!$this->UserModel->isConnected()) {

            redirect('user/login');

        }

        $id = $this->UserModel->getUserBySession()->getId();

        $user = $this->UserModel->getUserById($id);

        if ($user->getStatus() != "Administrateur") {

            show_404();

        }

        return $user;

    }

    public function verifRange(string $range) : Bool
    {

        $range = explode(";", $range);

        if (
            count($range) == 2 &&
            is_numeric($range[0]) &&
            is_numeric($range[1]) &&
            $range[0] >= 0 &&
            $range[1] >= 1

        ) {

            return true;

        }
        
        return false;

    }

    public function countUser() : int
    {

        $query = $this->db->query("Call user.countUser()");

        $count = $query->result();

        $query->next_result();
        $query->free_result();

        return $count[0]->count;

    }

    public function changeStatus(int $id, string $newStatus)
    {
        $this->db->query("Call user.changeStatus('" . $id . "', '" . $newStatus . "')");
    }


    public function updateUser(UserEntity $user, string $lastEmail)
    {

        $newEmail = $user->getCoordonnees()->getEmail();

        $user->getCoordonnees()->setEmail($lastEmail);

        $this->updateFirstName($user->getId(), $user->getCoordonnees()->getPrenom());
        $this->updateLastName($user->getId(), $user->getCoordonnees()->getNom());
        $this->updateEmail($user, $newEmail, "admin");
        $this->updateMobile($user->getId(), $user->getCoordonnees()->getTelephone());
        $this->updateFixe($user->getId(), $user->getCoordonnees()->getFixe());
        $this->changeStatus($user->getId(), $user->getStatus());

    }

    public function resetPass(UserEntity $user)
    {

        $newPass = $this->genRandomPass();

        $this->updatePassword($user->getId(), $newPass);

        $this->sendResetPassEmail($user, $newPass);

    }

    private function genRandomPass($length = 20)
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$!';
        $string = '';

        for ($i=0; $i<$length; $i++) {

            $string .= $chars[rand(0, strlen($chars)-1)];

        }

        return $string;
    }

    private function sendResetPassEmail(UserEntity $user, string $newPass)
    {

        $this->load->model('EmailModel');

        $fromEmail = array(

            'email' => 'no_reply@casporama.live',
            'name' => 'Casporama - No Reply'

        );

        $this->EmailModel->sendEmail(

            $fromEmail,
            $user->getCoordonnees()->getEmail(),
            'Casporama - Reset de votre password',
            'email/resetPass/mail',
            array(

                'user' => $user,
                'newPass' => $newPass

            )
        );

    }

    private function sendInfoModifEmail(UserEntity $user, string $lastEmail, string $author = "admin") : void
    {
        if ($author == "admin") {

            $author = "un administrateur";

        } else {

            $author = "vous-même via votre compte";

        }

        if ($lastEmail != $user->getCoordonnees()->getEmail()) {
            $this->load->model('EmailModel');

            $fromEmail = array(

                'email' => 'no_reply@casporama.live',
                'name' => 'Casporama - No Reply'

            );

            $this->EmailModel->sendEmail(

                $fromEmail,
                $lastEmail,
                'Casporama - Changement d\'email - Ancienne adresse',
                'email/modifEmail/toLastEmail',
                array(

                    'user' => $user,
                    'author' => $author

                )
            );

            $this->EmailModel->sendEmail(

                $fromEmail,
                $user->getCoordonnees()->getEmail(),
                'Casporama - Changement d\'email - Nouvelle adresse',
                'email/modifEmail/toNewEmail',
                array(

                    'user' => $user,
                    'author' => $author

                )
            );
        }
    }
}
