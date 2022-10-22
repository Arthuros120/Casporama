<?php

class UtilView extends CI_Model {

	function __construct() {
		parent::__construct();
	}

    public function generateLoadView(Array $var = null, Array $data = null) : Array {

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