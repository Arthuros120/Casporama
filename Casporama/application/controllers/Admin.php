<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {

        redirect('admin/home');

    }

    public function home()
    {

        $user = $this->UserModel->adminOnly();

        $dataContent = array(

            'user' => $user,

        );

        $data = array(

            'content' => $dataContent,

        );

        $this->LoaderView->load('Admin/home', $data);

    }
}
