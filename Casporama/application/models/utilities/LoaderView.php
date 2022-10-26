<?php

/*
	
	* Class LoaderView
	
	* Cette classe permet de charger les vues en fonction
	* d'un fichier YAML, et de les afficher
	* Cela permet de ne pas avoir à écrire du code PHP pour charger les vues
	* et de les afficher
	* Cela evite au programmer frontend de devoir chercher dans le code PHP
	* ou modifier le code PHP pour ajouter une vue ou la modifier.
	* Ce qui permet de garder une séparation entre le code PHP et le code HTML
	* Cette outil nous permet de gagner du temps et d'eviter des erreurs

	@Author : Hamelin Arthur
	@lastUpdate : 2020-05-20
	@version : 1.0

*/
class LoaderView extends CI_Model {

	// * Attributs
    private ?array $views;
    private ?array $data;

	private ?string $baseView;

	// * Constructeur
	function __construct() {

		parent::__construct();

	}

	/*

		* Function loadViews

		@param string $nameConfig
		@param array $data

		* Cette fonction permet de charger les vues en fonction
		* d'un fichier YAML, et de les afficher
		* Cela permet de ne pas avoir à écrire du code PHP pour charger les vues
		* et de les afficher
		* Cela evite au programmeur frontend de devoir chercher dans le code PHP
		* ou modifier le code PHP pour ajouter une vue ou la modifier.
		* Ce qui permet de garder une séparation entre le code PHP et le code HTML
		* Cette outil nous permet de gagner du temps et d'eviter des erreurs

	*/
	public function load(string $nameConfig = null, array $data = null){

		// * On verifie si l'etiquette de la configuration est initialisé
		if(isset($nameConfig)){

			// * Parsage du fichier YAML
			$yamlData = yaml_parse_file($this->config->item('LoaderView_url'))[$nameConfig];
		
			// * On stocke les données
			$this->views = $yamlData['views'];
			$this->baseView = $yamlData['baseView'];

			// * On verifie si les données sont initialisées
			if(isset($data)){

				// * On stocke les données
				$this->data = $data;

			}else{

				// * On initialise les données
				$this->data = null;

			}

		}else{

			// * On initialise les données dans les cas ou elles ne sont pas initialisées
			$this->views = null;
			$this->data = null;
			$this->baseView = null;

		}

		// * On charge les sous-vue
		$load['loadView'] = $this->generateLoadView();

		// * On charge la vue principale
		$this->load->view($this->baseView, $load);

	}

	/*

		* Function generateLoadView

		@return Array

		* Cette fonction permet de générer le code HTML
		* pour charger les vues

	*/
	private function generateLoadView() : Array {

		// * On initialise le tableau de retour
		$loadView = array();
		
		// * On verifie si les vues et les données sont initialisées
		if (is_array($this->views) && is_array($this->data)) {

			// * On parcours les vues
			foreach ($this->views as $key => $value) {

				// * On verifie si la vue est une vue avec des données
				if (isset($this->data[$key])) {
					
					// * On charge la vue avec les données
					$loadView[$key] = $this->load->view($value, $this->data[$key], TRUE);

				}else{

					// * On charge la vue sans données
					$loadView[$key] = $this->load->view($value, NULL, TRUE);
				}
			}
		// * On verifie si les vues sont initialisées et les données non
		}elseif (is_array($this->views) && !is_array($this->data)) {

			// * On parcours les vues
			foreach ($this->views as $key => $value) {

				// * On charge la vue sans données
				$loadView[$key] = $this->load->view($value, $this->data, TRUE);

			}

		}else{

			// * On initialise le tableau de retour par défault
			$loadView = array(
				
				'head' => $this->load->view('templates/head', NULL, TRUE),
				'header' => $this->load->view('templates/header', NULL, TRUE),
				'content' => $this->load->view('templates/content', NULL, TRUE),
				'footer' => $this->load->view('templates/footer', NULL, TRUE)

			);
		}

		// * On retourne le tableau de retour
		return $loadView;
	}
}