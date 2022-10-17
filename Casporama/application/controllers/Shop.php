<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
	
	}

    public function index($arg){

        if($arg == "foot" || $arg == "volley" || $arg == "bad" || $arg == "mma"){

            $data['sport'] = $arg;
            $this->load->view('shop/index', $data);

        }else{
            
            $data['heading'] = "404 Page Not Found";
            $data['message'] = "The page you requested was not found.";
            $this->load->view('errors/html/error_404', $data);

        }

        

	}

}
