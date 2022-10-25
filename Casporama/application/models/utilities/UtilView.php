<?php

/*

	* Class UtilView

	* Cette classe permet de charger les vues en fonction
	* des données et des vues à charger
	* Directement sans avoir besoin du LoaderView.yml

*/
class UtilView extends CI_Model {

	// Constructeur
	function __construct() {
		parent::__construct();
	}

	/*

		* Function generateLoadView

		@param array $var
		@param array $data

		* Cette fonction permet de charger les vues en fonction
		* des données et des vues à charger
		* Directement sans avoir besoin du LoaderView.yml

	*/
    public function generateLoadView(Array $var = null, Array $data = null) : Array {

		// * On initialise le tableau de retour
		$loadView = array();
		
		// * On verifie si les vues et les données sont initialisées
		if (is_array($var) && is_array($data)) {

			// * On parcours les vues
			foreach ($var as $key => $value) {

				// * On verifie si la vue est une vue avec des données
				if (isset($data[$key])) {
					
					// * On charge la vue avec les données
					$loadView[$key] = $this->load->view($value, $data[$key], TRUE);

				}else{

					// * On charge la vue sans données
					$loadView[$key] = $this->load->view($value, NULL, TRUE);
				}
			}
		}elseif (is_array($var) && !is_array($data)) { // * On verifie si les vues sont initialisées et les données non

			// * On parcours les vues
			foreach ($var as $key => $value) {

				// * On charge la vue sans données
				$loadView[$key] = $this->load->view($value, $data, TRUE);

			}

		}else{

			// * On retourne un tableau de vue par défaut si les données ne sont pas initialisées
			$loadView = array(
				
				'head' => $this->load->view('templates/head', NULL, TRUE),
				'header' => $this->load->view('templates/header', NULL, TRUE),
				'content' => $this->load->view('templates/content', NULL, TRUE),
				'footer' => $this->load->view('templates/footer', NULL, TRUE)

			);
		}

		// * On retourne le tableau de vue
		return $loadView;
	}
}