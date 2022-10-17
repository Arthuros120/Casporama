<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->data = array(
			'loadView' => $this->generateLoadView()
		);
	
	}

	public function index(){

		$this->data = array(
			'loadView' => $this->generateLoadView(array(
				'head' => 'templates/head',
				'header' => 'templates/blank',
				'content' => 'home',
				'footer' => 'templates/blank'
			))
		);

		$this->load->view('templates/base', $this->data);
	}

	function generateLoadView(Array $var = null) : Array {

		$loadView = array();
		
		if (is_array($var)) {

			

			foreach ($var as $key => $value) {

				$loadView[$key] = $this->load->view($value, NULL, TRUE);

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
