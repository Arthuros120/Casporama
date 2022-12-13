<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {

        $this->UserModel->adminOnly();

        redirect('admin/home');

    }

    public function home()
    {

        $this->UserModel->adminOnly();

        $this->LoaderView->load('Admin/home');

    }

    public function Product()
    {

        $this->UserModel->adminOnly();

        $this->LoaderView->load('Admin/Product');

    }
}
