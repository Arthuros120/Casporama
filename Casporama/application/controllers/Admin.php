<?php
defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @property UserModel $UserModel
 * @property LoaderView $LoaderView
 * @property ProductModel $ProductModel
 */
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



    public function addProduct()
    {

        $this->UserModel->adminOnly();

        $this->load->library('upload');

        $this->load->model('ProductModel');

        $configFile['upload_path']          = 'upload/images/import/';
        $configFile['allowed_types']        = 'jpg|png|jpeg|svg';
        $configFile['max_size']             = 0;
        $configFile['max_width']            = 0;
        $configFile['max_height']           = 0;
        $configFile['min_width']            = 0;
        $configFile['min_height']           = 0;
        $configFile['max_filename']         = 0;
        $configFile['encrypt_name']         = true;
        $configFile['remove_spaces']        = true;
        $configFile['overwrite']            = false;
        $configFile['detect_mime']          = true;
        $configFile['mod_mime_fix']         = false;
        $configFile['file_ext_tolower']     = true;
        $configFile['create_thumb']         = false;
        $configFile['maintain_ratio']       = true;

        $imageFile = array();
        $errorFile = array();

        $configRules = array(

            array(

                'field' => 'name',
                'label' => 'Nom du produit',
                'rules' => 'required|max_length[255]',

            ),

            array(

                'field' => 'description',
                'label' => 'Description du produit',
                'rules' => 'required|max_length[255]',

            ),

            array(

                'field' => 'price',
                'label' => 'Prix du produit',
                'rules' => 'required|numeric',

            ),

            array(

                'field' => 'sport',
                'label' => 'Sport du produit',
                'rules' => 'required',

            ),

            array(

                'field' => 'type',
                'label' => 'Type du produit',
                'rules' => 'required',

            ),

            array(

                'field' => 'brand',
                'label' => 'Marque du produit',
                'rules' => 'required|max_length[255]',

            ),

        );

        $this->form_validation->set_rules($configRules);

        if (!$this->form_validation->run()) {

            $dataContent = array(

                'types' => $this->ProductModel->getAllCategory(),
                'sports' => $this->ProductModel->getAllSport(),
                'brands' => $this->ProductModel->getAllBrand(),
    
            );
    
            $data = array(
    
                'content' => $dataContent
    
            );
    
            $this->LoaderView->load('Admin/addProduct', $data);

        } else {

            $this->upload->initialize($configFile);

            $imageCover = $this->upload->do_upload('imageCover');

            if ($imageCover) {

                $imageFile[] = $this->upload->data()['file_name'];

            } else {

                $errorFile[] = array(

                    'id' => 0,
                    'error' => $this->upload->display_errors()

                );

            }

            for ($i = 1; $i <= 4; $i++) {

                $this->upload->initialize($configFile);

                $image = $this->upload->do_upload('image' . $i);

                if ($image) {

                    $imageFile[] = $this->upload->data()['file_name'];

                } else {

                    $errorFile[] = array(

                        'id' => $i,
                        'error' => $this->upload->display_errors()

                    );

                }

            }
        }
    }

    public function editProduct(int $id = -1)
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

    public function User(){

        $this->UserModel->adminOnly();

        $users = $this->UserModel->getUsers();
        $dataContent['users'] = $users;
        $data = array ('content' => $dataContent);
        $this->LoaderView->load('Admin/User', $data);



    }

    public function addUser(){

    }

    public function editUser(int $id) {
        $this->UserModel->adminOnly();

        $user = $this->UserModel->getUserById($id);
        $dataContent['user'] = $user;
        $data = array('content' => $dataContent);
        $this->LoaderView->load('Admin/EditUser', $data);

    }
}
