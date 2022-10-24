<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('UserModel');
	
	}

    public function login(){

		$configRules = array(
			array(
					'field' => 'login',
					'label' => 'Login',
					'rules' => 'required|min_length[5]|max_length[255]|alpha_numeric|callback_usernameCheckByLogin',
					'errors' => array(
						'required' => 'Vous avez oublié %s.',
						"min_length[5]" => "Le %s doit faire au moins 5 caractères",
						"max_length[255]" => "Le %s doit faire au plus 255 caractères",
						"alpha_numeric" => "Le %s doit être alphanumérique"
					),
			),
			array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Vous avez oublié %s.',
					),
			),
			array(
					'field' => 'conPersistance',
					'label' => 'Rester connecté :',
					'rules' => ''
			)
		);

		$this->form_validation->set_rules($configRules);

		if ($this->form_validation->run() == FALSE) {

			$dataContent['error'] = validation_errors();

			$data = array(
				'content' => $dataContent
			);

			$this->LoaderView->load('User/login/error', $data);

        } else {

			$user = $this->UserModel->getUserByLogin($this->input->post('login'));

			if($user != null){

				if($this->UserModel->password_check($this->input->post('password'), $user)){

					$user->set_status($this->UserModel->getStatusById($user->get_id()));

					if($this->input->post('conPersistance') == 'on'){

						$this->UserModel->setUserCookie($user);

					}

					$this->UserModel->setUserSession($user);

					$data = array(
						'content' => array(
							'user' => $user
						)
						);

					$this->LoaderView->load('User/login/success', $data);

				}else{

					$dataContent['error'] = "Mot de passe incorrect";

					$data = array(
						'content' => $dataContent
					);
		
					$this->LoaderView->load('User/login/error', $data);

				}
			}

		}

	}

	public function logout(){

		//TODO: Créer les fonction suivante :

		$this->UserModel->unsetUserSession();

		$this->UserModel->unsetUserCookie();

		redirect(base_url());

	}

	public function home(){

		//TODO: faire la différence entre chaque panel en fonction du status de l'utilisateur
		//TODO: Créer getCookie

		$this->LoaderView->load('User/home');

	}

	// --------------------------------------------------------------------

	// * Casual function

	// --------------------------------------------------------------------

	public function usernameCheckByLogin($strLogin) : bool {
        
		if ($this->UserModel->heHaveUserByLogin($strLogin) == false) {
            
			$this->form_validation->set_message('usernameCheckByLogin', 'Votre login n\'existe pas !');

			return FALSE;

        }

		return TRUE;

	}

}
