<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*

	* User Controller

	@method: login
	@method: logout
	TODO: @method: register
	@mehod: home
	@mehod: usernameCheckByLogin

	* Ce controller permet de gérer les pages de connexion et de déconnexion 
	* et tout ce qui touche à l'utilisateur.
	* Il permet aussi de gérer les pages d'accueil de l'utilisateur

*/
class User extends CI_Controller {

	// * Initialisation de la Class User
	public function __construct(){

		parent::__construct();

		// * On charge le model des utilisateurs
		$this->load->model('UserModel');
	
	}

	/*

		* Login Page

		* Cette méthode permet de générer la page de connexion
		* Elle permet aussi de gérer la connexion de l'utilisateur
		* en vérifiant que les informations de connexion sont correctes
		* et en créant une session pour l'utilisateur et un cookie si l'utilisateur le souhaite.
		* Si l'utilisateur est déjà connecté, il est redirigé vers la page d'accueil

		TODO: Ajouter la possiblitée de se connecter avec son email
		TODO: Verifié chaque ligne surtout la configuration du formulaire
	
	*/
    public function login(){

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
					'rules' => 'required|min_length[5]|max_length[255]|callback_usernameCheckByLogin', // * On vérifie que le login existe et que il correspond au contraite de la base de données
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
		if ($this->form_validation->run() == FALSE) {

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
			$user = $this->UserModel->getUserByLogin($this->input->post('login'));

			// * On vérifie que l'utilisateur existe
			if($user != null){

				// * On vérifie que le mot de passe est correct
				if($this->UserModel->password_check($this->input->post('password'), $user)){

					// * On récupere le status de l'utilisateur
					$user->set_status($this->UserModel->getStatusById($user->get_id()));

					// * On vérifie que l'utilisateur veut rester connecté
					if($this->input->post('conPersistance') == 'on'){

						// * On crée un cookie pour l'utilisateur contenant ces informations de connexion et son status
						$this->UserModel->setUserCookie($user);

					}

					// * On crée une session pour l'utilisateur contenant ces informations d'identification et son status
					$this->UserModel->setUserSession($user);

					// * On stock les données de l'utilisateur dans une variable et on les etiquettes
					$data = array(
						'content' => array(
							'user' => $user
						)
					);

					// * On charge la page de validation de la connexion
					$this->LoaderView->load('User/login/success', $data);

				}else{

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

		TODO: A faire

	*/
	public function logout(){

		//TODO: Créer les fonction suivante :

		$this->UserModel->unsetUserSession();

		$this->UserModel->unsetUserCookie();

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
	public function home(){

		//TODO: faire la différence entre chaque panel en fonction du status de l'utilisateur
		//TODO: Créer getCookie

		$this->LoaderView->load('User/home');

	}

	// --------------------------------------------------------------------

	// * Casual function

	// --------------------------------------------------------------------

	/*

		* usernameCheckByLogin

		* Fonction de verification de l'existence d'un utilisateur
		* Cette fonction permet de vérifier si un utilisateur existe

		@returns boolean

		! Cette fonction ne peut pas être mis en privé car elle 
		! est utilisé par le formulaire de connexion
		! L'utilisateur ne pas y accéder car le routeur ne le permet pas

	*/
	public function usernameCheckByLogin(string $strLogin) : bool {
        
		// * On vérifie que le login de l'utilisteur existe
		if ($this->UserModel->heHaveUserByLogin($strLogin) == false) {
            
			// * On retourne une erreur
			$this->form_validation->set_message('usernameCheckByLogin', 'Votre login n\'existe pas !');

			return FALSE;

        }

		return TRUE;

	}
}
