<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
        $this->data = array(
			'loadView' => $this->generateLoadView()
		);
	
	}

    public function home($sport){

        if(in_array($sport, array("Football", "Volleyball", "Badminton", "Art_martiaux"))){

			$dataHeader['sport'] = $sport;

            $this->data = array(
                'loadView' => $this->generateLoadView(
					array(
                    'head' => 'templates/head',
                    'header' => 'shop/global/header',
                    'content' => 'shop/'.$sport.'/homeContent',
                    'footer' => 'templates/blank'
					),
					array(
						'header' => $dataHeader
					)
				)
            );

            $this->load->view('templates/base', $this->data);

        }else{
            
            $data['heading'] = "404 Page Not Found";
            $data['message'] = "The page you requested was not found.";
            $this->load->view('errors/html/error_404', $data);

        }

	}

	public function product($sport, $catProduct){

		$this->load->model('ProductModel');

		$listProduct = $this->ProductModel->findBySportType($sport, $catProduct);

		if(in_array($sport, array("Football", "Volleyball", "Badminton", "Art_martiaux")) && in_array($catProduct, array("Equipement", "Chaussure", "Vetement"))){

			$dataHeader['sport'] = $sport;
			$dataContent['listProduct'] = $listProduct;

            $this->data = array(
                'loadView' => $this->generateLoadView(
					array(
                    'head' => 'templates/head',
                    'header' => 'shop/global/header',
                    'content' => 'shop/global/productContent',
                    'footer' => 'templates/blank'
					),
					array(
						'header' => $dataHeader,
						'content' => $dataContent
					)
				)
            );

            $this->load->view('templates/base', $this->data);

        }else{
            
            $data['heading'] = "404 Page Not Found";
            $data['message'] = "The page you requested was not found.";
            $this->load->view('errors/html/error_404', $data);

        }

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
