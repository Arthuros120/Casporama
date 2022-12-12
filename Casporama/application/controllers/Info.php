<?php
defined('BASEPATH') || exit('No direct script access allowed');
class Info extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->LoaderView->load("Information/rgpd");
    }


}