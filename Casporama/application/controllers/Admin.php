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

        $res = $this->ProductModel->filtred($get, $products);

        $products = $res['products'];
        $title = $res['title'];
        $productNotFiltredByBrand = $res['productNotFiltredByBrand'];
        
        $brands = $this->ProductModel->getAllBrandByProducts($productNotFiltredByBrand);

        $dataContent = array(

            'title' => $title,
            'products' => $products,
            'brands' => $brands,

        );

        $data = array(

            'content' => $dataContent

        );

        $this->LoaderView->load('Admin/Product', $data);
    }

    public function DeleteProduct(int $id = -1)
    {
        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            redirect('admin/product');

        }

        $product = $this->ProductModel->findById($id);

        if ($product == null) {

            redirect('admin/product');

        }

        if (!$product->getIsAlive()) {

            redirect('admin/product');

        }

        $status = $this->session->flashdata('status');

        $dataContent = array(

            'product' => $product

        );

        $data = array(

            'content' => $dataContent

        );

        if ($status == 'success') {

            $this->ProductModel->delete($id);

            $this->LoaderView->load('Admin/delete/success', $data);

        } elseif ($status == 'error') {

            $this->LoaderView->load('Admin/delete/error', $data);

        } else {

            $charge = $this->session->flashdata('charge');

            if ($this->input->post('switch') == 'on') {

                $this->session->set_flashdata('status', 'success');

                redirect('Admin/DeleteProduct/' . $id);

            } else {

                if ($charge == 'on') {

                    if ($this->input->post('switch') == 'on') {

                        $this->session->set_flashdata('status', 'success');

                        redirect('Admin/DeleteProduct/' . $id);

                    } else {

                        $this->session->set_flashdata('status', 'error');

                        redirect('Admin/DeleteProduct/' . $id);

                    }

                } else {

                    $this->session->set_flashdata('charge', 'on');
                    $this->LoaderView->load('Admin/delete/request', $data);

                }
            }
        }
    }

}
