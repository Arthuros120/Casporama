<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('UserModel');
		
        $this->data = array(
			'loadView' => $this->generateLoadView()
		);
	
	}

    public function login(){

        $this->data = array(
            'loadView' => $this->generateLoadView(
                array(
                'head' => 'templates/blank',
                'header' => 'templates/blank',
                'content' => 'user/login/loginContent',
                'footer' => 'templates/blank'
                )
            )
        );

		$configRules = array(
			array(
					'field' => 'login',
					'label' => 'Login',
					'rules' => 'required|min_length[5]|max_length[255]|alpha_numeric|callback_username_check',
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

			$this-> data = array(
				'loadView' => $this->generateLoadView(
					array(
					'head' => 'templates/blank',
					'header' => 'templates/blank',
					'content' => 'user/login/loginContent',
					'footer' => 'templates/blank'
					),
					array(
						'content' => $dataContent
					)
				)
			);

			$this->load->view('templates/base', $this->data);

        } else {

			$user = $this->UserModel->getUserByLogin($this->input->post('login'));

			if($user != null){

				log_message('debug', 'user ok');

				if($this->UserModel->password_check($this->input->post('password'), $user)){

					$this->load->view('user/login/formsuccess');

					//TODO : Gérer la persistance de la connexion
					//TODO : Gérer la redirection vers la page d'accueil

				}else{

					$dataContent['error'] = "Mot de passe incorrect";

					$this-> data = array(
						'loadView' => $this->generateLoadView(
							array(
								'head' => 'templates/blank',
								'header' => 'templates/blank',
								'content' => 'user/login/loginContent',
								'footer' => 'templates/blank'
							),
							array(
								'content' => $dataContent
							)
						)
					);

					$this->load->view('templates/base', $this->data);

				}
			}

		}

	}

	public function username_check($strLogin) {
        
		if ($this->UserModel->heHaveUserByLogin($strLogin) == false) {
            
			$this->form_validation->set_message('username_check', 'Votre login n\'existe pas !');

			return FALSE;

        }

		return TRUE;

	}

    function generateLoadView(Array $var = null, Array $data = null) : Array {

		$loadView = array();
		
		if (is_array($var) && is_array($data)) {

			foreach ($var as $key => $value) {

				if (isset($data[$key])) {
					
					$loadView[$key] = $this->load->view($value, $data[$key], TRUE);

				}else{

					$loadView[$key] = $this->load->view($value, NULL, TRUE);
				}

			}

		}elseif (is_array($var) && !is_array($data)) {

			foreach ($var as $key => $value) {

				$loadView[$key] = $this->load->view($value, $data, TRUE);

			}

		}else{

			$loadView = array(
				
				'head' => $this->load->view('templates/head', NULL, TRUE),
				'header' => $this->load->view('templates/header', NULL, TRUE),
				'content' => $this->load->view('templates/content', NULL, TRUE),
				'footer' => $this->load->view('templates/footer', NULL, TRUE)

			);
		}

		return $loadView;
	}

}
