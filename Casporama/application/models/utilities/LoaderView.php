<?php

class LoaderView extends CI_Model {

    private ?array $views;
    private ?array $data;

	private ?string $baseView;

	function __construct() {

		parent::__construct();

	}

	public function load(string $nameConfig = null){

		if(isset($nameConfig)){

			$yamlData = yaml_parse_file($this->config->item('LoaderView_url'))[$nameConfig];
		
			$this->views = $yamlData['views'];
			$this->baseView = $yamlData['baseView'];

			if(isset($yamlData['data'])){

				$this->data = $yamlData['data'];

			}else{

				$this->data = null;

			}

		}else{

			$this->views = null;
			$this->data = null;
			$this->baseView = null;

		}

		$load['loadView'] = $this->generateLoadView();

		$this->load->view($this->baseView, $load);

	}

	private function generateLoadView() : Array {

		$loadView = array();
		
		if (is_array($this->views) && is_array($this->data)) {

			foreach ($this->views as $key => $value) {

				if (isset($data[$key])) {
					
					$loadView[$key] = $this->load->view($value, $data[$key], TRUE);

				}else{

					$loadView[$key] = $this->load->view($value, NULL, TRUE);
				}

			}

		}elseif (is_array($this->views) && !is_array($this->data)) {

			foreach ($this->views as $key => $value) {

				$loadView[$key] = $this->load->view($value, $this->data, TRUE);

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