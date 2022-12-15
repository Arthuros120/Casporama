<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Info extends CI_Controller
{

    public function index()
    {
        $this->LoaderView->load("Information/rgpd");
    }

    public function cgv()
    {
        $this->LoaderView->load("Information/cgv");
    }


}
