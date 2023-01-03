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

        $this->load->model('ProductModel');

        $get = $this->input->get();

        $products = $this->ProductModel->getAllAsAlive();

        $title = "Produits filtrés par :";

        //---------------------------------------------

        $res = $this->ProductModel->filterByCategory($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        $res = $this->ProductModel->filterByBrand($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        $res = $this->ProductModel->filterBySport($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        $res = $this->ProductModel->filterByPrice($title, $products, $get);

        $title = $res['title'];
        $products = $res['products'];

        echo $title;

        if (!empty($get['search'])) {

            $title = "Recherche de : " . $get['search'];
            $products = $this->ProductModel->search($get['search']);
        } elseif (empty($get)) {

            $title = "Tout les produits";
        }

        //---------------------------------------------


        $dataContent = array(

            'title' => $title,
            'products' => $products,

        );

        $data = array(

            'content' => $dataContent

        );

        $this->LoaderView->load('Admin/Product', $data);
    }
}
