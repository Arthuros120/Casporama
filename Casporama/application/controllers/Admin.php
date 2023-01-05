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
        $configFile['max_size']             = 100000;
        $configFile['max_width']            = 1000;
        $configFile['max_height']           = 1000;
        $configFile['min_width']            = 200;
        $configFile['min_height']           = 200;
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
                'rules' => 'trim|required|min_length[3]|max_length[255]|callback_checkNameProduct',
                'errors' => array(

                    'required' => 'Le champ %s est requis.',
                    'min_length' => 'Le champ %s doit contenir au moins 3 caractères.',
                    'max_length' => 'Le champ %s doit contenir au maximum 255 caractères.',
                    'checkNameProduct' => 'Le champ %s existe déjà.'

                )
            ),

            array(

                'field' => 'description',
                'label' => 'Description du produit',
                'rules' => 'trim|required|min_length[3]',
                'errors' => array(

                    'required' => 'Le champ %s est requis.',
                    'min_length' => 'Le champ %s doit contenir au moins 3 caractères.'

                )
            ),

            array(

                'field' => 'price',
                'label' => 'Prix du produit',
                'rules' => 'trim|required|numeric',
                'errors' => array(

                    'required' => 'Le champ %s est requis.',
                    'numeric' => 'Le champ %s doit être un nombre.'

                )
            ),

            array(

                'field' => 'sport',
                'label' => 'Sport du produit',
                'rules' => 'required|numeric|callback_checkSport',
                'errors' => array(

                    'required' => 'Le champ %s est requis.',
                    'numeric' => 'Le champ %s doit être un nombre.',
                    'checkSport' => 'Le champ %s n\'existe pas.'

                )
            ),

            array(

                'field' => 'type',
                'label' => 'Type du produit',
                'rules' => 'required|callback_checkType',
                'errors' => array(

                    'required' => 'Le champ %s est requis.',
                    'checkType' => 'Le champ %s n\'existe pas.'

                )
            ),

            array(

                'field' => 'brand',
                'label' => 'Marque du produit',
                'rules' => 'trim|required|min_length[3]|max_length[255]',
                'errors' => array(

                    'required' => 'Le champ %s est requis.',
                    'min_length' => 'Le champ %s doit contenir au moins 3 caractères.',
                    'max_length' => 'Le champ %s doit contenir au maximum 255 caractères.'

                )
            ),
        );

        $this->form_validation->set_rules($configRules);

        $post = $this->input->post();

        if (!$this->form_validation->run()) {

            $dataContent = array(

                'types' => $this->ProductModel->getAllCategory(),
                'sports' => $this->ProductModel->getAllSport(),
                'brands' => $this->ProductModel->getAllBrand(),
                'post' => $post,
                'error' => validation_errors()

            );
    
            $data = array(
    
                'content' => $dataContent
    
            );
    
            $this->LoaderView->load('Admin/addProduct', $data);

        } else {

            $this->upload->initialize($configFile);

            $imageCover = $this->upload->do_upload('imageCover');

            if ($imageCover) {

                $imageFile['imageCover'] = $this->upload->data()['file_name'];

            } else {

                $errorFile[0] = array(

                    'id' => 0,
                    'error' => $this->upload->display_errors("", "")

                );

            }

            for ($i = 1; $i <= 4; $i++) {

                $this->upload->initialize($configFile);

                $image = $this->upload->do_upload('image' . $i);

                if ($image) {

                    $imageFile['image' . $i] = $this->upload->data()['file_name'];

                } else {

                    $errorFile[$i] = array(

                        'id' => $i,
                        'error' => $this->upload->display_errors("", "")

                    );

                }
            }

            foreach ($errorFile as $error) {

                if ($error['error'] == 'You did not select a file to upload.') {

                    unset($errorFile[$error['id']]);

                }

            }

            if (!empty($errorFile)) {

                $dataContent = array(

                    'types' => $this->ProductModel->getAllCategory(),
                    'sports' => $this->ProductModel->getAllSport(),
                    'brands' => $this->ProductModel->getAllBrand(),
                    'errorFile' => $errorFile,
                    'post' => $this->input->post(),

                );

                $data = array(

                    'content' => $dataContent

                );

                $this->LoaderView->load('Admin/addProduct', $data);

            } else {

                if (!isset($imageFile['imageCover'])) {

                    $imageFile['imageCover'] = 'default.png';

                }

                $id = $this->ProductModel->addProduct($post, $imageFile);

                redirect('admin/stock/newCatalogue/' . $id);

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

    public function checkNameProduct(string $name)
    {

        $this->load->model('ProductModel');

        $product = $this->ProductModel->findByName($name);

        if ($product == null) {

            return true;

        } else {

            $this->form_validation->set_message('checkNameProduct', 'Le nom du produit existe déjà');

            return false;

        }
    }

    public function checkSport(int $sport)
    {

        $this->load->model('ProductModel');

        $sport = $this->ProductModel->findNameSportbyId($sport);

        if ($sport == null) {

            $this->form_validation->set_message('checkSport', 'Le sport n\'existe pas');

            return false;

        } else {

            return true;

        }
    }

    public function checkType(string $type)
    {

        $this->load->model('ProductModel');

        $types = $this->ProductModel->getAllCategory();

        if (in_array($type, $types)) {

            return true;

        } else {

            $this->form_validation->set_message('checkType', 'Le type n\'existe pas');

            return false;

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
