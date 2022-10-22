<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct(){

		parent::__construct();
		
        $this->data = array(
			'loadView' => $this->UtilView->generateLoadView()
		);
	
	}

    public function home($sport){

        if(in_array($sport, array("Football", "Volleyball", "Badminton", "Art_martiaux"))){

			$dataHeader['sport'] = $sport;
			$dataHead['sport'] = $sport;

            $this->data = array(
                'loadView' => $this->UtilView->generateLoadView(
					array(
                    'head' => 'shop/home/head',
					'headSport' => "shop/{$sport}/homeHead",
                    'header' => 'shop/global/header',
                    'content' => "shop/{$sport}/homeContent",
					'footer' => 'templates/blank'
					),
					array(
						'head' => $dataHead,
						'header' => $dataHeader
					)
				)
            );

            $this->load->view('shop/global/homeTemplate', $this->data);

        }else{
            
            $data['heading'] = "404 Page Not Found";
            $data['message'] = "The page you requested was not found.";
            $this->load->view('errors/html/error_404', $data);

        }

	}

	public function view($sport, $catProduct){

		$this->load->model('ProductModel');

		$listProduct = $this->ProductModel->findBySportType($sport, $catProduct);

		if(in_array($sport, array("Football", "Volleyball", "Badminton", "Art_martiaux")) && in_array($catProduct, array("Equipement", "Chaussure", "Vetement"))){

			$dataHead['sport'] = $sport;
			$dataHeader['sport'] = $sport;
			$dataContent['listProduct'] = $listProduct;

            $this->data = array(
                'loadView' => $this->UtilView->generateLoadView(
					array(
                    'head' => 'shop/view/head',
                    'header' => 'shop/global/header',
                    'content' => 'shop/global/viewContent',
                    'footer' => 'templates/blank'
					),
					array(
						'head' => $dataHead,
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

	public function product($idProduct){

		$this->load->model('ProductModel');

		$product = $this->ProductModel->findById($idProduct);

		if($product != null){

			$sport = $this->ProductModel->findNameSportbyId($product->get_Sport());

			// $stock = $this->ProductModel->getStock($idProduct);

			// var_dump($stock);

			$dataHead['sport'] = $sport;
			$dataHeader['sport'] = $sport;
			$dataContent['product'] = $product;

			$this->data = array(
				'loadView' => $this->UtilView->generateLoadView(
					array(
					'head' => 'shop/view/head',
					'header' => 'shop/global/header',
					'content' => 'shop/global/productContent',
					'footer' => 'templates/blank'
					),
					array(
						'head' => $dataHead,
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

}
