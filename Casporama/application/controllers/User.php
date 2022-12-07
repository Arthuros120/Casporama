<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * User Controller

    @method: login
    @method: logout
    @method: register
    @mehod: home
    @mehod: CheckTheLogin

    * Ce controller permet de gérer les pages de connexion et de déconnexion
    * et tout ce qui touche à l'utilisateur.
    * Il permet aussi de gérer les pages d'accueil de l'utilisateur
    
*/
class User extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('CaptchaModel');
        $this->load->helper('captcha');
    }

    public function index()
    {

        redirect('user/home');

    }

    /*

        * Login Page

        * Cette méthode permet de générer la page de connexion
        * Elle permet aussi de gérer la connexion de l'utilisateur
        * en vérifiant que les informations de connexion sont correctes
        * et en créant une session pour l'utilisateur et un cookie si l'utilisateur le souhaite.
        * Si l'utilisateur est déjà connecté, il est redirigé vers la page d'accueil

        TODO: Verifié chaque ligne surtout la configuration du formulaire
    
    */
    public function login()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        // * Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
        // * On vérifie que l'utilisateur n'est pas déjà connecté
        if ($this->session->userdata('user') != null) {

            // * On redirige l'utilisateur vers la page d'accueil de l'utilisateur
            redirect(base_url("user/home"));

        }

        // * On configure les règles de validation du formulaire
        $configRules = array(
            // * Configuration des paramètre du champlogin
            array(
                'field' => 'login',
                'label' => 'Login',
                // * On vérifie que le login existe et que il correspond au contraite de la base de données
                'rules' => 'trim|required|min_length[5]|max_length[255]|callback_CheckTheLogin',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 5 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                ),
            ),

            // * Configuration des paramètre du champ password
            array(
                'field' => 'password',
                'label' => 'Mot de passe',
                'rules' => 'trim|required',
                'errors' => array(
                    'required' => 'Vous avez oublié le %s.',
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                ),
            ),

            // * Configuration des paramètre du champ remember
            array(
                'field' => 'conPersistance',
                'label' => 'Rester connecté :',
                'rules' => ''
            )
        );

        // * On assigne la configuration au formulaire
        $this->form_validation->set_rules($configRules);

        // * On vérifie que le formulaire est valide sinon on affiche les erreurs
        if (!$this->form_validation->run()) {

            // * On stocke les erreurs dans une variable
            $dataContent['error'] = validation_errors();

            // * On etiquette les données
            $data = array(
                'content' => $dataContent
            );

            // * On charge les erreurs dans la page de connexion
            $this->LoaderView->load('User/login/error', $data);
        } else {

            // * On récupere les données utilisateur par le login
            $user = $this->UserModel->getUserByLoginOrEmail($this->input->post('login'));

            // * On vérifie que l'utilisateur existe
            if ($user != null) {

                // * On vérifie que le mot de passe est correct
                if ($this->UserModel->passwordCheck($this->input->post('password'), $user)) {

                    // * On récupere le status de l'utilisateur
                    $user->setStatus($this->UserModel->getStatusById($user->getId()));
                    $user->setIsVerified($this->UserModel->getIsVerifiedById($user->getId()));
                    $user->setIsALive($this->UserModel->getIsALiveById($user->getId()));

                    // * On supprime si il existe le cookie de l'utilisateur
                    $this->UserModel->unsetUserCookie($user);

                    // * On supprime si il existe la session de l'utilisateur
                    $this->UserModel->unsetUserSession();

                    // * On vérifie que l'utilisateur veut rester connecté
                    if ($this->input->post('conPersistance') == 'on') {

                        // * On crée un cookie pour l'utilisateur contenant ces informations de connexion et son status
                        $this->UserModel->setUserCookie($user);
                    }

                    if (!$user->getIsALive()) {

                        $this->session->set_flashdata('id', $user->getId());

                        redirect("User/dead");

                    }

                    if (!$user->getIsVerified()) {

                        $this->session->set_flashdata('id', $user->getId());

                        redirect("User/verify");

                    }

                    // * On crée une session pour l'utilisateur contenant
                    // * ces informations d'identification et son status
                    $this->UserModel->setUserSession($user);

                    // * On stock les données de l'utilisateur dans une variable et on les etiquettes
                    $data = array(
                        'content' => array(
                            'user' => $user
                        )
                    );

                    // * On charge la page de validation de la connexion
                    $this->LoaderView->load('User/login/success', $data);

                } else {

                    // * On stocke les erreurs dans une variable
                    $dataContent['error'] = "Mot de passe incorrect";

                    // * On etiquette les données
                    $data = array(
                        'content' => $dataContent
                    );

                    // * On charge les erreurs dans la page de connexion
                    $this->LoaderView->load('User/login/error', $data);
                }
            }
        }
    }

    /*

        * Fonction Logout

        * Cette fonction permet de déconnecter l'utilisateur
        * Détruit la session de l'utilisateur et le cookie si il existe
        * Redirige l'utilisateur vers la page d'accueil

    */
    public function logout()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        // * On recupere les données de l'utilisateur
        $user = $this->UserModel->getUserBySession();

        // * On vérifie que l'utilisateur est connecté
        if ($user != null) {

            // * On supprime si il existe le session de l'utilisateur
            $this->UserModel->unsetUserSession();

            // * On supprime si il existe la cookie de l'utilisateur
            $this->UserModel->unsetUserCookie($user);
        }

        // * On redirige l'utilisateur vers la page d'accueil
        redirect(base_url());
    }

    /*

        * Fonction register

        * Cette fonction permet d'enregistrer un utilisateur dans la base de données
        * Vérifie que le formulaire est valide
        * Vérifie que le login n'existe pas déjà
        * Vérifie que l'email n'existe pas déjà
        * Vérifie que le mot de passe est valide
        * Vérifie que le mot de passe de confirmation est valide
        * Vérifie que les deux mots de passe sont identiques
        * Vérifie que le captcha est valide
        * Enregistre l'utilisateur dans la base de données
        * Redirige l'utilisateur vers la page de connexion

    */
    public function register()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        // * On recupere les données de l'utilisateur
        $user = $this->UserModel->getUserBySession();

        // * On vérifie que l'utilisateur est connecté
        if ($user != null) {

            // * On supprime si il existe le session de l'utilisateur
            $this->UserModel->unsetUserSession();

            // * On supprime si il existe la cookie de l'utilisateur
            $this->UserModel->unsetUserCookie($user);
        }

        // * On configure les règles de validation du formulaire
        $configRules = array(

            // * Configuration des paramètre du champlogin
            array(
                'field' => 'login',
                'label' => 'Login',
                'rules' => 'trim|required|min_length[5]|max_length[255]|alpha_numeric|callback_IsUniqueLogin',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 5 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'alpha_numeric' => 'Le %s ne doit contenir que des caractères alphanumériques',
                ),
            ),

            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|min_length[5]|max_length[255]|valid_email|callback_IsUniqueEmail',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 5 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'valid_email' => 'Le %s n\'est pas valide',
                ),

                array(
                    'field' => 'emailConf',
                    'label' => 'Confirmation de l\'email',
                    'rules' => 'trim|required|matches[email]',
                    'errors' => array( // * On définit les messages d'erreurs
                        'required' => 'Vous avez oublié %s.',
                        'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                        'matches' => 'Les emails ne sont pas identiques',
                    ),
                )
            ),

            // * Configuration des paramètre du champ password
            array(
                'field' => 'password',
                'label' => 'Mot de passe',
                'rules' => 'trim|required|min_length[8]|max_length[255]|callback_ComformPassword',
                'errors' => array(
                    'required' => 'Vous avez oublié %s.',
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    "min_length" => "Le %s doit faire au moins 8 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                ),
            ),

            // * Configuration des paramètre du champ password confirm
            array(
                'field' => 'passConf',
                'label' => 'Confirmation Mot de passe',
                'rules' => 'trim|required|matches[password]',
                'errors' => array(
                    'required' => 'Vous avez oublié %s.',
                    'matches' => 'Les deux Mots de passe ne sont pas identiques',
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                ),
            ),

            // * Configuration des paramètre du champ captcha
            array(
                'field' => 'not_robot',
                'label' => 'Captcha',
                'rules' => 'required|callback_checkCaptcha',
                'errors' => array(
                    'required' => 'Vous avez oublié %s.',
                ),
            )
        );

        // * On assigne la configuration au formulaire
        $this->form_validation->set_rules($configRules);

        if (!$this->form_validation->run()) {

            // * Configuration du captcha
            $captchaForm = $this->config->item('captcha_form');
            $dataContent['captcha_form'] = $captchaForm;

            // * Creation du captcha
            if ($captchaForm) {

                $dataContent['captcha_html'] = $this->create_captcha();
            }

            // * On stocke les erreurs dans une variable

            $error_array = explode("\n",validation_errors());

            $dataContent['error'] = array_slice($error_array,0,-1);

            // * On etiquette les données
            $data = array(
                'content' => $dataContent
            );

            // * On charge les erreurs dans la page de connexion
            $this->LoaderView->load('User/register/error', $data);
        } else {

            $this->session->set_flashdata('login', $this->input->post('login'));
            $this->session->set_flashdata('email', $this->input->post('email'));
            $this->session->set_flashdata('password', $this->input->post('password'));

            redirect("User/registerUserIdentity");
        }
    }

    public function registerUserIdentity()
    {

        $strLogin = $this->session->flashdata('login');
        $strEmail = $this->session->flashdata('email');
        $strPassword = $this->session->flashdata('password');


        if ($strLogin != null || $strEmail != null || $strPassword != null) {

            $dataUser = array(

                'login' => $strLogin,
                'email' => $strEmail,
                'password' => $strPassword,

            );

            // * On configure les règles de validation du formulaire
            $configRules = array(

                // * Configuration des paramètre du champlogin
                array(
                    'field' => 'prenom',
                    'label' => 'Prénom',
                    'rules' => 'trim|required|min_length[3]|max_length[255]|alpha',
                    'errors' => array( // * On définit les messages d'erreurs
                        'required' => 'Vous avez oublié %s.',
                        "min_length" => "Le %s doit faire au moins 3 caractères",
                        "max_length" => "Le %s doit faire au plus 255 caractères",
                        'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                        'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques',
                    ),
                ),

                array(
                    'field' => 'nom',
                    'label' => 'Nom',
                    'rules' => 'trim|required|min_length[3]|max_length[255]|alpha',
                    'errors' => array( // * On définit les messages d'erreurs
                        'required' => 'Vous avez oublié %s.',
                        "min_length" => "Le %s doit faire au moins 3 caractères",
                        "max_length" => "Le %s doit faire au plus 255 caractères",
                        'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                        'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques',
                    ),
                ),

                array(
                    'field' => 'mobilePhone',
                    'label' => 'Téléphone mobile',
                    'rules' => 'trim|required|min_length[10]|max_length[10]|numeric|callback_IsUniqueMobilePhone',
                    'errors' => array( // * On définit les messages d'erreurs
                        'required' => 'Vous avez oublié %s.',
                        "min_length" => "Le %s doit faire au moins 10 caractères",
                        "max_length" => "Le %s doit faire au plus 10 caractères",
                        'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                        'numeric' => 'Le %s ne doit contenir que des caractères numériques',
                    ),
                ),

                array(
                    'field' => 'fixePhone',
                    'label' => 'Téléphone fixe',
                    'rules' => 'trim|min_length[10]|max_length[10]|numeric',
                    'errors' => array( // * On définit les messages d'erreurs
                        "min_length" => "Le %s doit faire au moins 10 caractères",
                        "max_length" => "Le %s doit faire au plus 10 caractères",
                        'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                        'numeric' => 'Le %s ne doit contenir que des caractères numériques',
                    ),
                ),
            );

            // * On assigne la configuration au formulaire
            $this->form_validation->set_rules($configRules);

            if (!$this->form_validation->run()) {

                $this->session->set_flashdata('login', $strLogin);
                $this->session->set_flashdata('email', $strEmail);
                $this->session->set_flashdata('password', $strPassword);

                // * On stocke les erreurs dans une variable

                $error_array = explode("\n",validation_errors());

                $dataContent['error'] = array_slice($error_array,0,-1);

                // * On etiquette les données
                $data = array(
                    'content' => $dataContent
                );

                // * On charge les erreurs dans la page de connexion
                $this->LoaderView->load('User/registerUserIdentity', $data);

            } else {

                $dataUser['prenom'] = $this->input->post('prenom');
                $dataUser['nom'] = $this->input->post('nom');
                $dataUser['mobilePhone'] = $this->input->post('mobilePhone');
                $dataUser['fixePhone'] = $this->input->post('fixePhone');

                $this->UserModel->registerUser($dataUser);

                if ($this->UserModel->heHaveUserByLogin($dataUser['login'])) {

                    redirect("User/login");

                }

                // * Si la création a échoué
                $data['heading'] = "Erreur lors de la création de l'utilisateur";
                $data['message'] = "Il y a une erreur lors de la création de votre compte,
                veuillez nous excuser pour la gêne occasionnée.";

                $this->load->view('errors/html/error_general', $data);

            }

        } else {

            redirect("User/register");

        }
    }

    /*

        * Home page

        * Cette fonction permet d'afficher la page d'accueil de l'utilisateur
        * Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
        * Si l'utilisateur est connecté, on affiche la page d'accueil de l'utilisateur
        * On affiche les informations de l'utilisateur
        * Et les fonction disponible pour l'utilisateur

    */
    public function home(string $action = '', int $hint = -1)
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if (!in_array($action, array(
            '',
            'info',
            'modifEmail',
            'modifPass',
            'modifMobile',
            'modifFixe',
            'modifLastName',
            'modifFirstName',
            'modifAddress',
            'supprAddress',
            'addAddress',
            'supprUser'
        ))) {

            // * Si le sport ou la catégorie n'est pas disponible, on affiche une erreur 404.

            $this->load->view('errors/html/error_404');
        } else {

            if ($this->UserModel->isConnected()) {

                $id = $this->UserModel->getUserBySession()->getId();

                $user = $this->UserModel->getUserById($id);

                $dataContent['user'] = $user;

                if ($action == '') {

                    $data = array(

                        'content' => $dataContent

                    );

                    // * On charge la page d'accueil de l'utilisateur
                    $this->LoaderView->load('User/home', $data);

                } else {

                    $listLoc = $user->getLocalisation();

                    if (isset($listLoc) && !empty($listLoc)) {

                        $dataContent['listLoc'] = $listLoc;
                        $dataContent['nbrAddr'] = $this->LocationModel->countAddressByUserId($user->getId());
                        $dataContent['nbrAddr'] = $dataContent['nbrAddr'] . "/" . $this->config->item('address_MaxAdd');
                        $dataContent['addAddIsPos'] = $this->LocationModel->heHaveMaxAddress($user->getId());

                        $dataMap = [];

                        foreach ($listLoc as $loc) {

                            if ($loc->getLatitude() != null && $loc->getLongitude() != null) {

                                $dataMap[$loc->getId()] = array(

                                    'lat' => $loc->getLatitude(),
                                    'lng' => $loc->getLongitude(),

                                );
                            }
                        }

                        if (!empty($dataMap)) {

                            $dataScript['dataMap'] = $dataMap;

                        } else {

                            $dataScript['dataMap'] = null;
                        }

                    } else {

                        $dataContent['addAddIsPos'] = false;

                        $dataContent['nbrAddr'] = "0/0";

                        $dataScript['dataMap'] = null;

                    }

                    $data = array(

                        'content' => $dataContent,
                        'script' => $dataScript,

                    );

                    if ($action == 'info') {

                        $this->LoaderView->load('User/home/info', $data);

                    } elseif ($action == 'modifLastName') {

                        $dataModal['user'] = $user;

                        $this->form_validation->set_rules(
                            'newLastName',
                            'Nom de famile',
                            'trim|required|min_length[3]|max_length[255]|alpha',
                            array( // * On définit les messages d'erreurs
                                'required' => 'Vous avez oublié %s.',
                                "min_length" => "Le %s doit faire au moins 3 caractères",
                                "max_length" => "Le %s doit faire au plus 255 caractères",
                                'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques',
                            )
                        );

                        if (!$this->form_validation->run()) {

                            $dataModal['error'] = validation_errors();

                            $data['modaleContent'] = $dataModal;

                            $this->LoaderView->load('User/home/modifLastName', $data);

                        } else {

                            $newLastName = $this->input->post('newLastName');

                            $this->UserModel->updateLastName($user->getId(), $newLastName);

                            redirect("User/home/info");

                        }

                    } elseif ($action == 'modifFirstName') {

                        $dataModal['user'] = $user;

                        $this->form_validation->set_rules(
                            'newFirstName',
                            'prénom',
                            'trim|required|min_length[3]|max_length[255]|alpha',
                            array( // * On définit les messages d'erreurs
                                'required' => 'Vous avez oublié %s.',
                                "min_length" => "Le %s doit faire au moins 3 caractères",
                                "max_length" => "Le %s doit faire au plus 255 caractères",
                                'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques',
                            )
                        );

                        if (!$this->form_validation->run()) {

                            $dataModal['error'] = validation_errors();

                            $data['modaleContent'] = $dataModal;

                            $this->LoaderView->load('User/home/modifFirstName', $data);

                        } else {

                            $newFirstName = $this->input->post('newFirstName');

                            $this->UserModel->updateFirstName($user->getId(), $newFirstName);

                            redirect("User/home/info");

                        }

                    } elseif ($action == 'modifEmail') {

                        $dataModal['user'] = $user;

                        $this->form_validation->set_rules(
                            'newEmail',
                            'email',
                            'trim|required|min_length[5]|max_length[255]|valid_email|callback_IsUniqueEmail',
                            array( // * On définit les messages d'erreurs
                                'required' => 'Vous avez oublié %s.',
                                "min_length" => "Le %s doit faire au moins 5 caractères",
                                "max_length" => "Le %s doit faire au plus 255 caractères",
                                'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                'valid_email' => 'Le %s n\'est pas valide',
                            ),
                        );

                        if (!$this->form_validation->run()) {

                            $dataModal['error'] = validation_errors();

                            $data['modaleContent'] = $dataModal;

                            $this->LoaderView->load('User/home/modifEmail', $data);

                        } else {

                            $newEmail = $this->input->post('newEmail');

                            $this->UserModel->updateEmail($user->getId(), $newEmail);

                            redirect("User/home/info");
                        }
                    } elseif ($action == 'modifPass') {

                        $dataModal['user'] = $user;

                        // * On configure les règles de validation du formulaire
                        $configRules = array(

                            // * Configuration des paramètre du champ password
                            array(
                                'field' => 'pass',
                                'label' => 'Mot de passe',
                                'rules' => 'trim|required',
                                'errors' => array(
                                    'required' => 'Vous avez oublié le %s.',
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                ),
                            ),

                            // * Configuration des paramètre du champ password
                            array(
                                'field' => 'newPass',
                                'label' => 'Nouveau mot de passe',
                                'rules' => 'trim|required|min_length[8]|max_length[255]|callback_ComformPassword',
                                'errors' => array(
                                    'required' => 'Vous avez oublié %s.',
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                    "min_length" => "Le %s doit faire au moins 8 caractères",
                                    "max_length" => "Le %s doit faire au plus 255 caractères",
                                ),
                            ),

                            // * Configuration des paramètre du champ password confirm
                            array(
                                'field' => 'confNewPass',
                                'label' => 'Confirmation du nouveau mot de passe',
                                'rules' => 'trim|required|matches[newPass]',
                                'errors' => array(
                                    'required' => 'Vous avez oublié %s.',
                                    'matches' => 'Les deux Mots de passe ne sont pas identiques',
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                ),
                            )
                        );

                        $this->form_validation->set_rules($configRules);

                        if (!$this->form_validation->run()) {

                            $dataModal['error'] = validation_errors();

                            $data['modaleContent'] = $dataModal;

                            $this->LoaderView->load('User/home/modifPass', $data);
                        } else {

                            $pass = $this->input->post('pass');
                            $newPass = $this->input->post('newPass');

                            if ($this->UserModel->passwordCheck($pass, $user)) {

                                if ($this->UserModel->passwordCheck($newPass, $user)) {

                                    $dataModal['error'] = "Le nouveau mot de passe doit être différent de l'ancien";

                                    $data['modaleContent'] = $dataModal;

                                    $this->LoaderView->load('User/home/modifPass', $data);

                                } else {

                                    $this->UserModel->updatePassword($user->getId(), $newPass);

                                    redirect("User/logout");

                                }

                            } else {

                                $dataModal['error'] = "Mot de passe actuel incorrect";

                                $data['modaleContent'] = $dataModal;

                                $this->LoaderView->load('User/home/modifPass', $data);

                            }
                        }
                    } elseif ($action == 'modifMobile') {

                        $dataModal['user'] = $user;

                        $this->form_validation->set_rules(
                            'newMobile',
                            'numéro de téléphone',
                            'trim|required|min_length[10]|max_length[10]|numeric|callback_IsUniqueMobilePhone',
                            array( // * On définit les messages d'erreurs
                                'required' => 'Vous avez oublié %s.',
                                "min_length" => "Le %s doit faire au moins 10 caractères",
                                "max_length" => "Le %s doit faire au plus 10 caractères",
                                'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                'numeric' => 'Le %s ne doit contenir que des caractères numériques',
                            ),
                        );

                        if (!$this->form_validation->run()) {

                            $dataModal['error'] = validation_errors();

                            $data['modaleContent'] = $dataModal;

                            $this->LoaderView->load('User/home/modifMobile', $data);

                        } else {

                            $newMobile = $this->input->post('newMobile');

                            $this->UserModel->updateMobile($user->getId(), $newMobile);

                            redirect("User/home/info");

                        }

                    } elseif ($action == 'modifFixe') {

                        $dataModal['user'] = $user;

                        $this->form_validation->set_rules(
                            'newFixe',
                            'numéro de téléphone fixe',
                            'trim|required|min_length[10]|max_length[10]|numeric',
                            array( // * On définit les messages d'erreurs
                                'required' => 'Vous avez oublié %s.',
                                "min_length" => "Le %s doit faire au moins 10 caractères",
                                "max_length" => "Le %s doit faire au plus 10 caractères",
                                'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                'numeric' => 'Le %s ne doit contenir que des caractères numériques',
                            ),
                        );

                        if (!$this->form_validation->run()) {

                            $dataModal['error'] = validation_errors();

                            $data['modaleContent'] = $dataModal;

                            $this->LoaderView->load('User/home/modifFixe', $data);

                        } else {

                            $newFixe = $this->input->post('newFixe');

                            $this->UserModel->updateFixe($user->getId(), $newFixe);

                            redirect("User/home/info");

                        }

                    } elseif ($action == 'modifAddress') {

                        if ($hint <= 0) {

                            $this->load->view('errors/html/error_404');

                        } else {

                            $address = $this->LocationModel->getLocationByUserId($user->getId(), $hint);

                            $this->session->set_flashdata('defaultAddressName', $address->getName());

                            if ($address != null && $address->getIsAlive()) {

                                $configRules = array(

                                    // * Configuration des paramètre du champlogin
                                    array(
                                        'field' => 'name',
                                        'label' => 'Nom de l\'adresse',
'rules' => 'trim|required|min_length[3]|max_length[255]|alpha_numeric_spaces|callback_IsUniqueAddressName['.$user->getId().']',
                                        'errors' => array( // * On définit les messages d'erreurs
                                            'required' => 'Vous avez oublié %s.',
                                            "min_length" => "Le %s doit faire au moins 3 caractères",
                                            "max_length" => "Le %s doit faire au plus 255 caractères",
                                            'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                                        ),
                                    ),
                    
                                    array(
                                        'field' => 'number',
                                        'label' => 'Numéro de voie',
                                        'rules' => 'trim|required|is_natural|min_length[1]|max_length[5]',
                                        'errors' => array( // * On définit les messages d'erreurs
                                            'required' => 'Vous avez oublié %s.',
                                            'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                            "min_length" => "Le %s doit faire au moins 1 caractères",
                                            "max_length" => "Le %s doit faire au plus 5 caractères",
                                            'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                                        ),
                                    ),

                                    array(

                                        'field' => 'street',
                                        'label' => 'Nom de la voie',
                                        'rules' => 'trim|required|min_length[3]|max_length[250]|alpha_numeric_spaces',
                                        'errors' => array( // * On définit les messages d'erreurs
                                            'required' => 'Vous avez oublié %s.',
                                            "min_length" => "Le %s doit faire au moins 3 caractères",
                                            "max_length" => "Le %s doit faire au plus 250 caractères",
                                            'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                                        ),
                                    ),

                                    array (

                                        'field' => 'department',
                                        'label' => 'Département',
                                        "rules" => 'required|callback_InListDepartment',
                                        'errors' => array( // * On définit les messages d'erreurs
                                            'required' => 'Vous avez oublié %s.',
                                        ),
                                    ),

                                    array (

                                        'field' => 'city',
                                        'label' => 'Ville',
                                        "rules" => 'trim|required|min_length[3]|max_length[255]',
                                        'errors' => array( // * On définit les messages d'erreurs
                                            'required' => 'Vous avez oublié %s.',
                                            "min_length" => "Le %s doit faire au moins 3 caractères",
                                            "max_length" => "Le %s doit faire au plus 255 caractères",
                                            'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                        ),
                                    ),

                                    array (

                                        'field' => 'country',
                                        'label' => 'Pays',
                                        "rules" => 'required|callback_InListCountry',
                                        'errors' => array( // * On définit les messages d'erreurs
                                            'required' => 'Vous avez oublié %s.',
                                        )
                                    ),

                                    array(

                                        'field' => 'postalCode',
                                        'label' => 'Code postal',
                                        'rules' => 'trim|required|is_natural|min_length[5]|max_length[5]',
                                        'errors' => array( // * On définit les messages d'erreurs
                                            'required' => 'Vous avez oublié %s.',
                                            'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                            "min_length" => "Le %s doit faire 5 caractères",
                                            "max_length" => "Le %s doit faire 5 caractères",
                                            'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                                        ),
                                    )
                                );

                                $this->form_validation->set_rules($configRules);

                                if (!$this->form_validation->run()) {
                                    
                                    $dataContent['error'] = validation_errors();
                                    $dataContent['address'] = $address;
                                    $dataScript['address'] = $address;

                                    $dataHead['nameAddress'] = $address->getName();

                                    $data = array(

                                        'head' => $dataHead,
                                        'content' => $dataContent,
                                        'script' => $dataScript,

                                    );

                                    $this->LoaderView->load('User/home/modifAddress', $data);

                                } else {

                                    $depTab = explode(";", $this->input->post('department'));

                                    $dep = $this->LocationModel->getDepartment($depTab[0]);

                                    if ($dep != null) {

                                        if ($this->LocationModel->samePostalCodeByDepartment(
                                            $depTab[0],
                                            $this->input->post('postalCode')
                                            )) {

                                                $dataNewAddress = array (

                                                    'name' => $this->input->post('name'),
                                                    'number' => $this->input->post('number'),
                                                    'street' => $this->input->post('street'),
                                                    'department' => $dep,
                                                    'city' => $this->input->post('city'),
                                                    'country' => $this->input->post('country'),
                                                    'postalCode' => $this->input->post('postalCode')
            
                                                );
            
                                                if ($this->input->post('default') == 'on') {
            
                                                    $dataNewAddress['default'] = true;
                
                                                }
            
                                                $newAdresse = $this->LocationModel->newAddress($dataNewAddress);

                                                if (!$this->LocationModel->sameAddresse($user->getId(), $newAdresse)) {

                                                    $this->LocationModel->updateAddress(
                                                        $newAdresse,
                                                        $address->getId(),
                                                        $user->getId()
                                                    );
                
                                                    redirect("User/home/info");

                                                } else {

                                                    $dataContent['error'] = "Cette addresse est trop similaire a une autre";
                                                    $dataContent['address'] = $address;
                                                    $dataScript['address'] = $address;

                                                    $dataHead['nameAddress'] = $address->getName();

                                                    $data = array(

                                                        'head' => $dataHead,
                                                        'content' => $dataContent,
                                                        'script' => $dataScript,

                                                    );

                                                    $this->LoaderView->load('User/home/modifAddress', $data);
                                                    
                                                    }

                                            } else {

                                                $dataContent['error'] = "Le code postal ne correspond pas au département";
                                                $dataContent['address'] = $address;
                                                $dataScript['address'] = $address;

                                                $dataHead['nameAddress'] = $address->getName();

                                                $data = array(

                                                    'head' => $dataHead,
                                                    'content' => $dataContent,
                                                    'script' => $dataScript,

                                                );

                                                $this->LoaderView->load('User/home/modifAddress', $data);

                                            }

                                    } else {

                                        $dataContent['error'] = "Le département n'existe pas";
                                        $dataContent['address'] = $address;
                                        $dataScript['address'] = $address;

                                        $dataHead['nameAddress'] = $address->getName();

                                        $data = array(

                                            'head' => $dataHead,
                                            'content' => $dataContent,
                                            'script' => $dataScript,

                                        );

                                        $this->LoaderView->load('User/home/modifAddress', $data);

                                    }
                                }

                            } else {

                                show_404();

                            }

                        }

                    } elseif ($action == 'supprAddress') {

                        if ($hint <= 0) {

                            show_404();

                        }
                        
                        $this->form_validation->set_rules(
                            'sameName',
                            'Nom de l\'adresse',
                            'trim|required|min_length[3]|max_length[255]',
                            array( // * On définit les messages d'erreurs
                                'required' => 'Vous avez oublié %s.',
                                "min_length" => "Le %s doit faire au moins 3 caractères",
                                "max_length" => "Le %s doit faire au plus 255 caractères",
                                'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                            ),
                        );

                        $address = $this->LocationModel->getLocationByUserId($user->getId(), $hint);

                        $dataModal['address'] = $address;
                        $dataScript['hint'] = $hint;

                        if (!$this->form_validation->run()) {

                            $dataModal['error'] = validation_errors();

                            $data['modaleContent'] = $dataModal;
                            $data['script'] = $dataScript;

                            $this->LoaderView->load('User/home/supprAddress', $data);

                        } else {

                            if (strtolower($this->input->post('sameName')) == strtolower($address->getName())) {

                                $this->LocationModel->addressIsDead($address->getId());

                                redirect("User/home/info");

                            } else {

                                $dataModal['error'] = "Le nom de l'adresse n'est pas le même";

                                $data['modaleContent'] = $dataModal;
                                $data['script'] = $dataScript;

                                $this->LoaderView->load('User/home/supprAddress', $data);

                            }


                        }

                    } elseif ($action == 'addAddress') {

                        if ($this->LocationModel->heHaveMaxAddress($user->getId())) {

                            show_error("Vous avez atteint le nombre maximum d'adresse", 403, "Erreur");

                        }

                        $configRules = array(

                            // * Configuration des paramètre du champlogin
                            array(
                                'field' => 'name',
                                'label' => 'Nom de l\'adresse',
                                'rules' => 'trim|required|min_length[3]|max_length[255]|alpha_numeric_spaces',
                                'errors' => array( // * On définit les messages d'erreurs
                                    'required' => 'Vous avez oublié %s.',
                                    "min_length" => "Le %s doit faire au moins 3 caractères",
                                    "max_length" => "Le %s doit faire au plus 255 caractères",
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                                ),
                            ),
            
                            array(
                                'field' => 'number',
                                'label' => 'Numéro de voie',
                                'rules' => 'trim|required|is_natural|min_length[1]|max_length[5]',
                                'errors' => array( // * On définit les messages d'erreurs
                                    'required' => 'Vous avez oublié %s.',
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                    "min_length" => "Le %s doit faire au moins 1 caractères",
                                    "max_length" => "Le %s doit faire au plus 5 caractères",
                                    'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                                ),
                            ),

                            array(

                                'field' => 'street',
                                'label' => 'Nom de la voie',
                                'rules' => 'trim|required|min_length[3]|max_length[250]|alpha_numeric_spaces',
                                'errors' => array( // * On définit les messages d'erreurs
                                    'required' => 'Vous avez oublié %s.',
                                    "min_length" => "Le %s doit faire au moins 3 caractères",
                                    "max_length" => "Le %s doit faire au plus 250 caractères",
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                                ),
                            ),

                            array (

                                'field' => 'department',
                                'label' => 'Département',
                                "rules" => 'required|callback_InListDepartment',
                                'errors' => array( // * On définit les messages d'erreurs
                                    'required' => 'Vous avez oublié %s.',
                                ),
                            ),

                            array (

                                'field' => 'city',
                                'label' => 'Ville',
                                "rules" => 'trim|required|min_length[3]|max_length[255]',
                                'errors' => array( // * On définit les messages d'erreurs
                                    'required' => 'Vous avez oublié %s.',
                                    "min_length" => "Le %s doit faire au moins 3 caractères",
                                    "max_length" => "Le %s doit faire au plus 255 caractères",
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                ),
                            ),

                            array (

                                'field' => 'country',
                                'label' => 'Pays',
                                "rules" => 'required|callback_InListCountry',
                                'errors' => array( // * On définit les messages d'erreurs
                                    'required' => 'Vous avez oublié %s.',
                                )
                            ),

                            array(

                                'field' => 'postalCode',
                                'label' => 'Code postal',
                                'rules' => 'trim|required|is_natural|min_length[5]|max_length[5]',
                                'errors' => array( // * On définit les messages d'erreurs
                                    'required' => 'Vous avez oublié %s.',
                                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                                    "min_length" => "Le %s doit faire 5 caractères",
                                    "max_length" => "Le %s doit faire 5 caractères",
                                    'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                                ),
                            )
                        );

                        $this->form_validation->set_rules($configRules);

                        if (!$this->form_validation->run()) {

                            $dataContent['error'] = validation_errors();

                            $data = array(

                                'content' => $dataContent,

                            );

                            $this->LoaderView->load('User/home/addAddress', $data);

                        } else {

                            if (!$this->LocationModel->sameNameByUserId(
                                $user->getId(),
                                $this->input->post('name')
                                )) {

                                $depTab = explode(";", $this->input->post('department'));

                                $dep = $this->LocationModel->getDepartment($depTab[0]);

                                if ($dep != null) {

                                    if ($this->LocationModel->samePostalCodeByDepartment(
                                        $depTab[0],
                                        $this->input->post('postalCode')) ||
                                        (strtolower(
                                            $this->input->post('country')) != 'france'
                                        )
                                        ) {

                                            $dataNewAddress = array (

                                                'name' => $this->input->post('name'),
                                                'number' => $this->input->post('number'),
                                                'street' => $this->input->post('street'),
                                                'department' => $dep,
                                                'city' => $this->input->post('city'),
                                                'country' => $this->input->post('country'),
                                                'postalCode' => $this->input->post('postalCode')
        
                                            );
        
                                            if ($this->input->post('default') == 'on') {
        
                                                $dataNewAddress['default'] = true;
        
                                            }
        
                                            $newAdresse = $this->LocationModel->newAddress($dataNewAddress);

                                            if (!$this->LocationModel->sameAddresse($user->getId(), $newAdresse)) {

                                                $this->LocationModel->addAddressToUser($newAdresse, $user->getId());

                                                redirect('User/home/info');

                                            } else {

                                                $dataContent['error'] = "L'addresse est trop similaire a une autre";

                                                $data = array(

                                                    'content' => $dataContent,
    
                                                );
    
                                                $this->LoaderView->load('User/home/addAddress', $data);

                                            }

                                    } else {

                                        $dataContent['error'] = "Le code postal ne correspond pas au département";

                                        $data = array(

                                            'content' => $dataContent,
    
                                        );
    
                                        $this->LoaderView->load('User/home/addAddress', $data);

                                    }

                                } else {

                                    $dataContent['error'] = "Le département n'existe pas";

                                    $data = array(

                                        'content' => $dataContent,

                                    );

                                    $this->LoaderView->load('User/home/addAddress', $data);

                                }

                            } else {

                                $dataContent['error'] = "Vous avez déjà une adresse avec ce nom";

                                $data = array(

                                    'content' => $dataContent,

                                );

                                $this->LoaderView->load('User/home/addAddress', $data);

                            }
                        }
                    } elseif ($action == "supprUser") {

                        $this->form_validation->set_rules(
                            'sameLogin',
                            'Login',
                            'trim|required|min_length[5]|max_length[255]',
                            array( // * On définit les messages d'erreurs
                                'required' => 'Vous avez oublié %s.',
                                "min_length" => "Le %s doit faire au moins 5 caractères",
                                "max_length" => "Le %s doit faire au plus 255 caractères",
                                'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                            ),
                        );

                        if (!$this->form_validation->run()) {

                            $dataModal = array(

                                'user' => $user,
                                'error' => validation_errors()

                            );

                            $data['modaleContent'] = $dataModal;

                            $this->LoaderView->load('User/home/supprUser', $data);

                        } else {

                            if ($this->input->post('sameLogin') == $user->getLogin()) {

                                $this->UserModel->deleteUser($user->getId());

                                redirect('User/logout');

                            } else {

                                $dataModal = array(

                                    'user' => $user,
                                    'error' => "Le login n'est pas le même"

                                );

                                $data['modaleContent'] = $dataModal;

                                $this->LoaderView->load('User/home/supprUser', $data);

                            }

                        }
                    }
                }

            } else {

                // * Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
                redirect("User/login");

            }
        }
    }

    public function dead()
    {

        $id = $this->session->flashdata('id');

        if (isset($id)) {

            $date = $this->UserModel->getDateLastUpdateById($id);

            $dayRemaining = $this->UserModel->getDayRemaining($date);

            $date = strtotime($date);
            
            $date = date('Y-m-d', $date);

            $date = explode("-", $date);
            
            $month = array (

                1 => "Janvier",
                2 => "Février",
                3 => "Mars",
                4 => "Avril",
                5 => "Mai",
                6 => "Juin",
                7 => "Juillet",
                8 => "Août",
                9 => "Septembre",
                10 => "Octobre",
                11 => "Novembre",
                12 => "Décembre"

            );

            $date = array(

                'day' => $date[2],
                'month' => $month[$date[1]],
                'year' => $date[0]

            );

            $dayRemaining = explode(",",$dayRemaining);

            $dataContent = array(

                'date' => $date,
                'dayRemaining' => $dayRemaining

            );

            $data = array(

                'content' => $dataContent,

            );

            $this->LoaderView->load('User/dead', $data);

        } else {

            redirect('User/login');

        }

    }

    public function verify()
    {

        $id = $this->session->flashdata('id');
        $getData = $this->input->get(null, true);

        if (isset($id)) {

            $this->session->set_flashdata('id', $id);

            $user = $this->UserModel->getUserById($id);

            $dataContent = array(

                'user' => $user

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('User/verify/errNotVerif', $data);

        } elseif (!empty($getData) && isset($getData['id'])) {

            var_dump($getData);

            echo "verifykey";

        } else {

            redirect("User/login");

        }

    }

    public function sendVerify()
    {

        $id = $this->session->flashdata('id');

        if (isset($id)) {

            $this->session->set_flashdata('id', $id);

            $user = $this->UserModel->getUserById($id);

            $this->VerifModel->sendVerifCode($id);

            $dataContent = array(

                'user' => $user

            );

            $data = array(

                'content' => $dataContent

            );

            $this->load->view('User/verify/sendVerify', $data);

        } else {

            show_404();

        }
    }

    // --------------------------------------------------------------------

    // * Casual function

    // --------------------------------------------------------------------

    /*

        * CheckTheLogin

        * Fonction de verification de l'existence d'un utilisateur
        * Cette fonction permet de vérifier si un utilisateur existe
        * en fonction de son login ou de son email

        @param string $strLogin
        @returns boolean

        ! Cette fonction ne peut pas être mis en privé car elle
        ! est utilisé par le formulaire de connexion
        ! L'utilisateur ne pas y accéder car le routeur ne le permet pas

    */
    public function CheckTheLogin(string $strLogin): bool
    {

        // * On regarde si dans la variable string il y a un @ et un .
        if (stristr($strLogin, '@') && stristr($strLogin, '.')) {

            // * On vérifie que l'email existe
            $userExist = $this->UserModel->heHaveUserByEmail($strLogin);
        } else {

            // * On vérifie que le login existe
            $userExist = $this->UserModel->heHaveUserByLogin($strLogin);
        }

        // * On vérifie que le login de l'utilisteur existe
        if (!$userExist) {

            // * On retourne une erreur
            $this->form_validation->set_message('CheckTheLogin', 'Votre login n\'existe pas !');

            return false;
        }

        return true;
    }

    /*

        * IsUniqueLogin

        * Cette fonction permet de vérifier si le login est unique

        @param string $strLogin
        @returns boolean

        ! Cette fonction ne peut pas être mis en privé car elle
        ! est utilisé par le formulaire de connexion
        ! L'utilisateur ne pas y accéder car le routeur ne le permet pas

    */
    public function IsUniqueLogin(string $strLogin): bool
    {

        // * On vérifie que le login n'existe pas
        if ($this->UserModel->heHaveUserByLogin($strLogin)) {

            // * On retourne une erreur
            $this->form_validation->set_message('IsUniqueLogin', 'Ce login existe déjà !');

            return false;
        }

        return true;
    }

    /*

        * IsUniqueEmail

        * Cette fonction permet de vérifier si l'email est unique

        @param string $strEmail
        @returns boolean

        ! Cette fonction ne peut pas être mis en privé car elle
        ! est utilisé par le formulaire de connexion
        ! L'utilisateur ne pas y accéder car le routeur ne le permet pas

    */
    public function IsUniqueEmail(string $strEmail): bool
    {

        // * On vérifie que l'email n'existe pas
        if ($this->UserModel->heHaveUserByEmail($strEmail)) {

            // * On retourne une erreur
            $this->form_validation->set_message('IsUniqueEmail', 'Cet email existe déjà !');

            return false;
        }

        return true;
    }

    public function IsUniqueMobilePhone(string $strPhone): bool
    {

        // * On vérifie que le mobile n'existe pas
        if ($this->UserModel->heHaveUserByMobilePhone($strPhone)) {

            // * On retourne une erreur
            $this->form_validation->set_message('IsUniqueMobilePhone', 'Ce numéro de téléphone est déja utilisé !');

            return false;
        }

        return true;
    }

    // TODO : ! Bloquer l'accès à cette fonction via le routeur
    public function IsUniqueAddressName(string $strName = "", int $id = -1): bool
    {

        $defaultName = $this->session->flashdata('defaultAddressName');

        if ($strName == "" && $id == -1 && $defaultName != null) {

            $this->form_validation->set_message('IsUniqueAddressName', 'Le nom de l\'adresse est vide !');

            return false;
        }

        $count = $this->LocationModel->IsUniqueModifAddressName($strName, $id);

        $defaultName = strtolower($defaultName);

        // * On vérifie que le mobile n'existe pas
        if ($count == 0 || ($count == 1 && strtolower($strName) == $defaultName)) {

            return true;
        }

        // * On retourne une erreur
        $this->form_validation->set_message('IsUniqueAddressName', 'Vous avez déja utilisé ce nom d\'adresse !');

        return false;
    }

    // TODO : ! Bloquer l'accès à cette fonction via le routeur
    public function InListCountry(string $strCountry = ""): bool
    {

        if ($strCountry == "") {

            $this->form_validation->set_message('InListCountry', 'Le pays est vide !');

            return false;
        }

        // * On vérifie que le mobile n'existe pas
        if ($this->LocationModel->IsCountry($strCountry)) {

            return true;

        }

        // * On retourne une erreur
        $this->form_validation->set_message('InListCountry', 'Ce pays n\'existe pas !');

        return false;
    }

    // TODO : ! Bloquer l'accès à cette fonction via le routeur
    public function InListDepartment(string $strDep = ""): bool
    {

        if ($strDep == "") {

            $this->form_validation->set_message('InListDepartment', 'Le département est vide !');

            return false;
        }

        $strDep = explode(";", $strDep)[1];

        // * On vérifie que le mobile n'existe pas
        if ($this->LocationModel->IsDepartment($strDep)) {

            return true;

        }

        // * On retourne une erreur
        $this->form_validation->set_message('InListDepartment', 'Ce département n\'existe pas !');

        return false;
    }


    /*

        * ComformPassword

        * Cette fonction permet de vérifier le password est comforme

        @param string $strPassword
        @returns boolean

        ! Cette fonction ne peut pas être mis en privé car elle
        ! est utilisé par le formulaire de connexion
        ! L'utilisateur ne pas y accéder car le routeur ne le permet pas

    */
    public function ComformPassword(string $strPassword): bool
    {

        // * On vérifie que le mot de passe est valide
        if (!$this->UserModel->isPasswordValid($strPassword)) {

            // * On retourne une erreur
            $this->form_validation->set_message(
                'ComformPassword','Le mot de passe n\'est pas valide ! Il doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial'
            );

            return false;
        }

        return true;
    }

    /*

        * create_captcha

        * Cette fonction permet de créer un captcha

        @returns string

        ! Cette fonction ne peut pas être mis en privé car elle
        ! est utilisé par le formulaire de connexion
        ! L'utilisateur ne pas y accéder car le routeur ne le permet pas

    */
    public function create_captcha(): string
    {
        // * On charge les données du captcha dans une variable
        $capConfig = array(
            'img_path' => './' . $this->config->item('captcha_path'),
            'img_url' => base_url() . $this->config->item('captcha_path'),
            'font_size' => $this->config->item('captcha_font_size'),
            'img_width' => $this->config->item('captcha_width'),
            'img_height' => $this->config->item('captcha_height'),
            'show_grid' => $this->config->item('captcha_grid'),
            'ip_address' => $this->input->ip_address(),
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        // * On crée le captcha avec les données
        $cap = create_captcha($capConfig);

        // * On créer le captcha dans la base de données et on retourne l'url de l'image du captcha
        return $this->CaptchaModel->_create_captcha($cap);
    }

    /*

        * check_captcha

        * Cette fonction permet de vérifier le captcha

        @param string $strCaptcha
        @returns boolean

        ! Cette fonction ne peut pas être mis en privé car elle
        ! est utilisé par le formulaire de connexion
        ! L'utilisateur ne pas y accéder car le routeur ne le permet pas

    */
    public function checkCaptcha($code): bool
    {

        // * On vérifie que le captcha est valide
        if ($code == '' || strlen($code)  != 8 || $this->CaptchaModel->check_captcha($code) == 0) {

            // * On retourne une erreur
            $this->form_validation->set_message('checkCaptcha', 'Le Captcha est incorrect !');

            return false;
        }

        return true;
    }
}
