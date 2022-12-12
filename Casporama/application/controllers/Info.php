<?php

class Info extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->output->enable_profiler(true);
        $this->LoaderView->load("Test/information/inforgpd");
    }


}