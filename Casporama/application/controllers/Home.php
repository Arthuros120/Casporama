<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->data = array(
			'loadView' => $this->UtilView->generateLoadView()
		);
	
	}

	public function index(){

		$this->data = array(
			'loadView' => $this->UtilView->generateLoadView(array(
				'head' => 'home/head',
				'header' => 'templates/blank',
				'content' => 'home/home.php',
				'footer' => 'templates/blank'
			))
		);

		$this->load->view('templates/base', $this->data);
	}
}
