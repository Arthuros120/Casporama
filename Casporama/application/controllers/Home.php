<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*

	* Home Controller
	
	@methode index

*/

class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();
	
	}
	
	/*

		* Methode index
		@return void

		* Affiche la page d'accueil
		

	*/
	public function index(){

		$this->LoaderView->load('Home/index');

	}
}
