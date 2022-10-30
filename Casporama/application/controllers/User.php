<?php
defined('BASEPATH') || exit('No direct script access allowed');


/*

    * User Controller

    @method: login
    @method: logout
    TODO: @method: register
    @mehod: home
    @mehod: CheckTheLogin

    * Ce controller permet de gérer les pages de connexion et de déconnexion
    * et tout ce qui touche à l'utilisateur.
    * Il permet aussi de gérer les pages d'accueil de l'utilisateur
    
*/
class User extends CI_Controller
{

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

        /*

            TODO: Decomenté cette ligne une fois la page de connexion terminée

            * Si l'utilisateur est déjà connecté, on le redirige vers la page d'accueil
            * On vérifie que l'utilisateur n'est pas déjà connecté
            if($this->session->userdata('user') != null){

                * On redirige l'utilisateur vers la page d'accueil de l'utilisateur
                redirect(base_url("user/home"));

            }

        */

        // * On configure les règles de validation du formulaire
        $configRules = array(

            // * Configuration des paramètre du champlogin
            array(
                    'field' => 'login',
                    'label' => 'Login',
                    // * On vérifie que le login existe et que il correspond au contraite de la base de données
                    'rules' => 'required|min_length[5]|max_length[255]|callback_CheckTheLogin',
                    'errors' => array( // * On définit les messages d'erreurs
                        'required' => 'Vous avez oublié %s.',
                        "min_length[5]" => "Le %s doit faire au moins 5 caractères",
                        "max_length[255]" => "Le %s doit faire au plus 255 caractères",
                    ),
            ),

            // * Configuration des paramètre du champ password
            array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Vous avez oublié %s.',
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

                    // * On supprime si il existe le cookie de l'utilisateur
                    $this->UserModel->unsetUserCookie($user);

                    // * On supprime si il existe la session de l'utilisateur
                    $this->UserModel->unsetUserSession();

                    // * On vérifie que l'utilisateur veut rester connecté
                    if ($this->input->post('conPersistance') == 'on') {
                    
                        // * On crée un cookie pour l'utilisateur contenant ces informations de connexion et son status
                        $this->UserModel->setUserCookie($user);

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

        // * On vérifie que l'utilisateur est connecté

        $user = $this->UserModel->getUserBySession();

        if ($user != null) {

            $this->UserModel->unsetUserSession();

            $this->UserModel->unsetUserCookie($user);
            
        }

        // * On redirige l'utilisateur vers la page d'accueil
        redirect(base_url());

    }

    /*

        * Home page

        * Cette fonction permet d'afficher la page d'accueil de l'utilisateur
        * Si l'utilisateur n'est pas connecté, on le redirige vers la page de connexion
        * Si l'utilisateur est connecté, on affiche la page d'accueil de l'utilisateur
        * On affiche les informations de l'utilisateur
        * Et les fonction disponible pour l'utilisateur

    */
    public function home()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        //TODO: faire la différence entre chaque panel en fonction du status de l'utilisateur

        $this->LoaderView->load('User/home');

    }

    // --------------------------------------------------------------------

    // * Casual function

    // --------------------------------------------------------------------

    /*

        * CheckTheLogin

        * Fonction de verification de l'existence d'un utilisateur
        * Cette fonction permet de vérifier si un utilisateur existe
        * en fonction de son login ou de son email

        @returns boolean

        ! Cette fonction ne peut pas être mis en privé car elle
        ! est utilisé par le formulaire de connexion
        ! L'utilisateur ne pas y accéder car le routeur ne le permet pas

    */
    public function CheckTheLogin(string $strLogin) : bool
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
}
