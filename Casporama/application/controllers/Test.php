<?php

class Test extends CI_Controller {

    public function __construct(){

        parent::__construct();
        
    }

    public function index(){

        $this->LoaderView->load('Test/index');

    }

}