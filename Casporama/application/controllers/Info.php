<?php

class Info extends CI_Controller
{

    public function __construct()
    {


    }

    public function index()
    {
        $this->LoaderView->load("Test/information/inforgpd");
    }


}