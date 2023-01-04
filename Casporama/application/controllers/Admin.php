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

    public function product()
    {
        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        $get = $this->input->get();

        $products = $this->ProductModel->getAllAsAlive();

        $res = $this->ProductModel->filtred($get, $products);

        $productsAlive = $res['products'];
        $title = $res['title'];
        $productNotFiltredByBrand = $res['productNotFiltredByBrand'];

        $products = $this->ProductModel->getAllAsNotAlive();

        $res = $this->ProductModel->filtred($get, $products);

        $productsNotAlive = $res['products'];

        $allProduct = array_merge($productNotFiltredByBrand, $productsNotAlive);

        $brands = $this->ProductModel->getAllBrandByProducts($allProduct);

        $dataContent = array(

            'title' => $title,
            'productsAlive' => $productsAlive,
            'productsNotAlive' => $productsNotAlive,
            'brands' => $brands,

        );

        $data = array(

            'content' => $dataContent

        );

        $this->LoaderView->load('Admin/Product', $data);
    }

    public function deleteProduct(int $id = -1)
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


    public function deleteProducts()
    {
        $this->UserModel->adminOnly();

        if (empty($this->input->post())) {

            redirect('Admin/Product');

        }

        $this->load->model('ProductModel');

        $products = $this->ProductModel->getAllAsAlive();

        $productsToDelete = array();

        foreach ($products as $product) {

            if ($this->input->post('product' . $product->getId()) == 'on') {

                $productsToDelete[] = $product;

            }
        }

        $listProducts = "";

        foreach ($productsToDelete as $product) {

            $listProducts .= $product->getId() . ";";

        }

        $dataContent = array(

            'products' => $productsToDelete,
            'listProducts' => $listProducts

        );

        $data = array(

            'content' => $dataContent

        );

        $this->LoaderView->load('Admin/deletes/request', $data);
    }

    public function deleteProductsComf()
    {

        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        $submitbutton = $this->input->post('switch');

        if ($submitbutton == 'on') {

            $listProducts = $this->input->post('products');

            var_dump($listProducts);

            $listProducts = explode(';', $listProducts);

            foreach ($listProducts as $id) {

                if ($id != '') {

                    $this->ProductModel->delete($id);

                }
            }

            $dataContent = array(

                'products' => $listProducts

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/deletes/success', $data);

        } else {
    
            $this->LoaderView->load('Admin/deletes/error');
    
        }
    }
}
