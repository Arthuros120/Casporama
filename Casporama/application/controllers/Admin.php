<?php
defined('BASEPATH') || exit('No direct script access allowed');

/**
 * @property UserModel $UserModel
 * @property LoaderView $LoaderView
 * @property ProductModel $ProductModel
 * @property LocationModel $LocationModel
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

            $errors = explode('.', validation_errors());
            $errors = array_slice($errors, 0, count($errors) - 1);

            $dataContent = array(

                'types' => $this->ProductModel->getAllCategory(),
                'sports' => $this->ProductModel->getAllSport(),
                'brands' => $this->ProductModel->getAllBrand(),
                'post' => $post,
                'errors' => $errors

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

                redirect('admin/stock/' . $id);
            }
        }
    }

    public function editProduct(int $id = -1)
    {

        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        $this->load->library('upload');

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

        $imagesNotFormated = $product->getImagesWithoutCover();
        $imageCoverNotFormated = $product->getCoverName();

        $images = array();
        $imageCover = str_replace(base_url(), '', str_replace('/', '+', $imageCoverNotFormated));

        foreach ($imagesNotFormated as $image) {

            array_push($images, str_replace('/', '+', str_replace(base_url(), '', $image)));
        }

        $configRules = array(

            array(

                'field' => 'name',
                'label' => 'Nom du produit',
                'rules' => 'trim|required|min_length[3]|max_length[255]|callback_checkNameProductWithoutSelf[' . $id . ']',
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

        if (!$this->form_validation->run()) {

            $dataContent = array(

                'product' => $product,
                'images' => $images,
                'imageCover' => $imageCover,
                'countImages' => count($product->getImages()),
                'types' => $this->ProductModel->getAllCategory(),
                'sports' => $this->ProductModel->getAllSport(),
                'brands' => $this->ProductModel->getAllBrand(),
                'error' => validation_errors()
            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/editProduct', $data);
        } else {

            $post = $this->input->post();

            $this->ProductModel->editProduct($post, $id);

            redirect('shop/product/' . $id);

            var_dump($this->input->post());
        }
    }

    public function addImage(int $id = -1)
    {

        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            redirect('admin/editProduct');
        }

        $product = $this->ProductModel->findById($id);

        $this->load->library('upload');

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

        $counterImages = count($product->getImages());

        if ($counterImages == 5) {

            show_error('Vous ne pouvez pas ajouter plus de 5 images à un produit.', '500', 'Erreur 500');
        }

        for ($i = $counterImages + 1; $i <= 5; $i++) {

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

        $errorFilePostTraitement = $errorFile;
        $countErrorFileSelect = 0;

        foreach ($errorFile as $error) {

            if ($error['error'] == 'You did not select a file to upload.') {

                unset($errorFile[$error['id']]);
                $countErrorFileSelect++;
            }
        }

        if ($countErrorFileSelect == 5 - $counterImages) {

            $errorFile = $errorFilePostTraitement;
        }

        if (!empty($errorFile)) {

            $dataContent = array(

                'errors' => $errorFile,

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/error/errorImage', $data);
        } else {

            $this->ProductModel->addImages($imageFile, $id);

            redirect('admin/editProduct/' . $id);
        }
    }

    public function EditCoverImage(int $id = -1)
    {

        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            redirect('admin/editProduct');
        }

        $this->load->library('upload');

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

        $this->upload->initialize($configFile);

        $image = $this->upload->do_upload('imageCover');

        if ($image) {

            $imageFile = $this->upload->data()['file_name'];

            $this->ProductModel->editCoverImage($imageFile, $id);

            redirect('admin/editProduct/' . $id);
        } else {

            $dataContent = array(

                'errors' => $this->upload->display_errors("", ""),

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/error/errorImage', $data);
        }
    }

    public function deleteImage(int $id = -1, string $image = ""): void
    {

        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        $image = str_replace("..", "", $image);

        if ($id == -1 || $image == "" || $image[strlen($image) - 1] == '/') {

            redirect('admin/editProduct/' . $id);
        }

        $image = str_replace("+", "/", $image);
        $image = str_replace("upload/images/", "", $image);

        $this->ProductModel->deleteImage($id, $image);

        redirect('admin/editProduct/' . $id);
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

    public function reviveProduct(int $id = -1): void
    {

        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            redirect('admin/product');
        }

        $this->ProductModel->revive($id);

        redirect('admin/product');
    }

    public function stock(int $id = -1)
    {

        $this->UserModel->AdminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            $get = $this->input->get();

            if (
                !empty($get) &&
                in_array($get['sport'], $this->ProductModel->getAllSportId()) &&
                in_array($get['type'], $this->ProductModel->getAllCategory()) &&
                $this->ProductModel->verifRange($get['range'])
            ) {

                $range = explode(";", $get['range']);

                $countMaxProduct = $this->ProductModel->countByTypeAndSport($get['type'], $get['sport']);

                if ($range[0] > $countMaxProduct) {

                    $range[0] = $countMaxProduct - 1;

                    redirect(
                        'Admin/Stock?range=' . $range[0] . ';' . $range[1] . '&sport=' . $get['sport'] . '&type=' . $get['type']
                    );
                }

                $products = $this->ProductModel->getProductByRangeAndSportAndType($range, $get['sport'], $get['type']);

                $catalog = $this->ProductModel->getCatalogsByProducts($products);

                $minRange = $range[0];
                $maxRange = $range[0] + $range[1];

                if ($maxRange > $countMaxProduct) {

                    $maxRange = $countMaxProduct;
                }

                $sportName = $this->ProductModel->findNameSportbyId($get['sport']);

                $dataContent = array(

                    'products' => $products,
                    'catalogs' => $catalog,
                    'type' => $get['type'],
                    'sport' => $sportName,
                    'minRange' => $minRange,
                    'maxRange' => $maxRange,
                    'nextIsPosible' => $maxRange < $countMaxProduct,

                );

                $data = array(

                    'content' => $dataContent

                );

                $this->LoaderView->load('Admin/stock/all', $data);
            } else {

                $dataContent = array(

                    'sports' => $this->ProductModel->getAllSport(),
                    'types' => $this->ProductModel->getAllCategory(),

                );

                $data = array(

                    'content' => $dataContent

                );

                $this->LoaderView->load('Admin/stock/filter', $data);
            }
        } else {

            $product = $this->ProductModel->findById($id);

            if ($product == null) {

                redirect('admin/product');
            }

            $catalogs = $this->ProductModel->getCatalogsByProducts(array($product))[$product->getId()];

            $dataContent = array(

                'product' => $product,
                'catalogs' => $catalogs

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/stock/product', $data);
        }
    }

    public function addStock(int $id = -1): void
    {

        $this->UserModel->AdminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            redirect('admin/product');
        }

        $product = $this->ProductModel->findById($id);

        if ($product == null) {

            redirect('admin/product');
        }

        $sizes = $this->ProductModel->getAllSizeByType($product->getType());

        $configRules = array(

            array(

                'field' => 'reference',
                'label' => 'Référence',
                'rules' => 'trim|required|is_natural',
                'errors' => array(

                    'required' => 'La référence est obligatoire,',
                    'is_natural' => 'La référence doit être un nombre entier,'

                )
            ),

            array(

                'field' => 'color',
                'label' => 'Couleur',
                'rules' => 'trim|required|alpha',
                'errors' => array(

                    'required' => 'La couleur est obligatoire,',
                    'alpha' => 'La couleur doit être composé de lettre,'

                )
            ),

            array(

                'field' => 'size',
                'label' => 'Taille',
                'rules' => 'trim|required|in_list[' . implode(',', $sizes) . ']',
                'errors' => array(

                    'required' => 'La taille est obligatoire,',
                    'in_list' => 'La taille n\'est pas valide,'

                )
            ),

            array(

                'field' => 'quantity',
                'label' => 'Quantité',
                'rules' => 'trim|required|is_natural',
                'errors' => array(

                    'required' => 'La quantité est obligatoire,',
                    'is_natural' => 'La quantité doit être un nombre entier,'

                )
            )

        );

        $this->form_validation->set_rules($configRules);

        if (!$this->form_validation->run()) {

            $error = explode(',', validation_errors());


            $dataContent = array(

                'product' => $product,
                'sizes' => $sizes,
                'error' => $error

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/stock/addStock', $data);
        } else {

            $post = $this->input->post();

            $newCatalog = new CatalogEntity();

            $newCatalog->setNuProduct($product->getId());
            $newCatalog->setReference($post['reference']);
            $newCatalog->setColor($post['color']);
            $newCatalog->setSize($post['size']);
            $newCatalog->setQuantity($post['quantity']);

            if (!$this->ProductModel->heHaveCatalog($newCatalog)) {

                $this->ProductModel->addCatalog($newCatalog);

                redirect('admin/stock/' . $product->getId());
            } else {

                show_error('Une référence pour ce produit avec ces paramètres existe déjà', '500');
            }
        }
    }

    public function editQuantite(int $id = -1): void
    {

        $this->UserModel->AdminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            redirect('admin/product');
        }

        $catalog = $this->ProductModel->findCatalogById($id);

        if ($catalog == null) {

            redirect('admin/product');
        }

        $product = $this->ProductModel->findById($catalog->getNuProduct());

        if ($product == null) {

            redirect('admin/product');
        }

        $this->form_validation->set_rules(
            'quantite',
            'Quantité',
            'required|numeric|greater_than[-1]|less_than[1000000]|trim|is_natural',
            array(

                'required' => 'Vous devez renseigner une quantité',
                'numeric' => 'La quantité doit être un nombre',
                'greater_than' => 'La quantité doit être supérieur à 0',
                'less_than' => 'La quantité doit être inférieur à 100000',
                'is_natural' => 'La quantité doit être un nombre entier',

            )
        );

        if (!$this->form_validation->run()) {

            $dataContent = array(

                'product' => $product,
                'catalog' => $catalog,
                'error' => validation_errors()

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/stock/editQuantite', $data);
        } else {

            $catalog->setQuantity($this->input->post('quantite'));

            $this->ProductModel->updateCatalogQuantity($catalog);

            redirect('Admin/Stock/' . $product->getId());
        }
    }

    public function suppStock(int $id = -1): void
    {

        $this->UserModel->AdminOnly();

        $this->load->model('ProductModel');

        if ($id == -1) {

            redirect('admin/product');
        }

        $catalog = $this->ProductModel->findCatalogById($id);

        if ($catalog == null) {

            redirect('admin/product');
        }

        if (!$catalog->getIsALive()) {

            redirect('Admin/Stock/' . $catalog->getNuProduct());
        }

        $product = $this->ProductModel->findById($catalog->getNuProduct());

        if ($product == null) {

            redirect('admin/product');
        }

        $status = $this->session->flashdata('status');

        $dataContent = array(

            'product' => $product,
            'catalog' => $catalog,

        );

        $dataScript = array(

            'id' => $product->getId()

        );

        $data = array(

            'content' => $dataContent,
            'script' => $dataScript

        );

        if ($status == 'success') {

            $this->ProductModel->deleteCatalog($id);

            $this->LoaderView->load('Admin/stock/suppStock/success', $data);
        } elseif ($status == 'error') {

            $this->LoaderView->load('Admin/stock/suppStock/error', $data);
        } else {

            $charge = $this->session->flashdata('charge');

            if ($this->input->post('switch') == 'on') {

                $this->session->set_flashdata('status', 'success');

                redirect('Admin/suppStock/' . $id);
            } else {

                if ($charge == 'on') {

                    if ($this->input->post('switch') == 'on') {

                        $this->session->set_flashdata('status', 'success');

                        redirect('Admin/suppStock/' . $id);
                    } else {

                        $this->session->set_flashdata('status', 'error');

                        redirect('Admin/suppStock/' . $id);
                    }
                } else {

                    $this->session->set_flashdata('charge', 'on');
                    $this->LoaderView->load('Admin/stock/suppStock/request', $data);
                }
            }
        }
    }

    public function suppStocks(): void
    {

        $this->UserModel->adminOnly();

        if (empty($this->input->post())) {

            redirect('Admin/Product');
        }

        $this->load->model('ProductModel');

        $catalogsToDelete = array();

        $post = $this->input->post();

        foreach ($post as $key => $value) {

            $idCat = explode('-', $key)[1];

            $catalogsToDelete[] = $this->ProductModel->findCatalogById($idCat);
        }

        $listCatalogs = "";

        foreach ($catalogsToDelete as $catalog) {

            $listCatalogs .= $catalog->getId() . ";";
        }

        $product = $this->ProductModel->findById($catalogsToDelete[0]->getNuProduct());

        $dataContent = array(

            'catalogs' => $catalogsToDelete,
            'product' => $product,
            'listCatalogs' => $listCatalogs

        );

        $data = array(

            'content' => $dataContent

        );

        $this->LoaderView->load('Admin/stock/suppStocks/request', $data);
    }

    public function suppStocksComf(): void
    {

        $this->UserModel->adminOnly();

        $this->load->model('ProductModel');

        $submitbutton = $this->input->post('switch');

        $productId = $this->input->post('product');

        $dataScript = array(

            'id' => $productId

        );

        if ($submitbutton == 'on') {

            $listCatalogs = $this->input->post('catalogs');

            $listCatalogs = explode(';', $listCatalogs);

            foreach ($listCatalogs as $catalog) {

                if ($catalog != "") {

                    $this->ProductModel->deleteCatalog($catalog);
                }
            }

            $dataContent = array(

                'listCatalogs' => $listCatalogs

            );

            $data = array(

                'content' => $dataContent,
                'script' => $dataScript

            );

            $this->LoaderView->load('Admin/stock/suppStocks/success', $data);
        } else {

            $data = array(

                'script' => $dataScript

            );

            $this->LoaderView->load('Admin/stock/suppStocks/error', $data);
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

            $listProducts = explode(';', $listProducts);
            $filtredProduct = array();

            foreach ($listProducts as $id) {

                if ($id != '') {

                    $this->ProductModel->delete($id);
                    $filtredProduct[] = $id;
                }
            }

            $dataContent = array(

                'products' => $filtredProduct

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('Admin/deletes/success', $data);
        } else {

            $this->LoaderView->load('Admin/deletes/error');
        }
    }

    public function order()
    {

        $this->UserModel->adminOnly();

        $this->load->model('OrderModel');

        $succes = $this->session->flashdata('succes');

        if (isset($succes)) {
            if ($succes == 'true') {
                $dataContent['resultat'] = 'La commande a bien été annulé';
            } else {
                $dataContent['resultat'] = "Une erreur est survenue lors de l'annulation de la commande";
            }
        }

        $filtre = $this->input->post('filtre');

        $orders = $this->OrderModel->getAllOrderWithInfo();

        if ($filtre != null) {

            if (in_array($filtre,array_keys($orders))) {
                $orders = array($orders[$filtre]);
            } else {
                $orders = null;
            }
            
        } 

        if ($orders != null) {
            $dataContent = array('orders' => $orders);
        }

        if (isset($dataContent)) {
            $this->LoaderView->load('Admin/order', array('content' => $dataContent));
        } else {
            $this->LoaderView->load('Admin/order');
        }
    }

    public function changeStatusOrder()
    {

        $this->UserModel->adminOnly();

        $this->load->model('OrderModel');

        $array = $this->input->post();

        $key = array_keys($array)[0];
        $value = $array[$key];

        $this->OrderModel->updateStatus($key, $value);

        redirect('Admin/viewOrder?idorder=' . $key);
    }

    public function cancelOrderConfirm()
    {

        $this->UserModel->adminOnly();

        $idorder = $this->input->get('idorder');

        $data = array(
            'content' => array('idorder' => $idorder),
        );

        $this->LoaderView->load('Admin/confirmCancel', $data);
    }

    public function cancelOrder()
    {

        $this->UserModel->adminOnly();

        $this->load->model('OrderModel');


        $idorder = $this->input->get('idorder');

        $err = $this->OrderModel->delOrder($idorder);

        if ($err) {
            $this->session->set_flashdata('succes', true);
        } else {
            $this->session->set_flashdata('succes', false);
        }

        redirect('Admin/order');
    }

    public function deleteOrdersConfirm()
    {

        $this->UserModel->adminOnly();

        $idorders = $this->input->post();

        if ($idorders != null) {
            $idorders = array_keys($idorders);

            $data = array(
                'content' => array('idorders' => $idorders),
            );

            $this->LoaderView->load('Admin/confirmDeleteOrders', $data);
        } else {
            redirect('Admin/order');
        }
    }

    public function deleteOrders()
    {
        $this->UserModel->adminOnly();

        $idorders = $this->input->post();

        $this->load->model('OrderModel');


        if ($idorders != null) {

            $idorders = array_keys($idorders);
            $err = false;

            foreach ($idorders as $idorder) {

                $newerr = $this->OrderModel->delOrder($idorder);

                $err = $err || $newerr;
            }

            if ($err) {
                $this->session->set_flashdata('succes', true);
            } else {
                $this->session->set_flashdata('succes', false);
            }
        }

        redirect("Admin/order");
    }

    public function viewOrder()
    {

        $this->UserModel->adminOnly();

        $idorder = $this->input->get('idorder');

        $this->load->model('OrderModel');
        $this->load->model('LocationModel');

        if ($idorder != null) {
            $orders = $this->OrderModel->getOrderById($idorder);

            if ($orders != null) {
                $order = $orders[0];

                $dataContent['order'] = $order;

                $colors = array(
                    'Football' => '#D3E2D3',
                    'Badminton' => '#D9E6F4',
                    'Volleyball' => '#FBFBC3',
                    'Arts-martiaux' => '#FFB4B0'
                );

                $options = array(
                    'Non preparer' => 'Non preparer',
                    'En preparation' => 'En preparation',
                    'Preparer' => 'Preparer',
                    'Expedier' => 'Expedier'
                );

                $user = $this->UserModel->getUserById($order->getIduser())->getCoordonnees();

                $dataContent['options'] = $options;

                $dataContent['colors'] = $colors;

                $dataContent['user'] = $user;

                $this->LoaderView->load('Admin/viewOrder', array('content' => $dataContent));
            }
        } else {

            redirect("Admin/order");
        }
    }

    public function User(int $id = -1): void
    {

        $this->UserModel->adminOnly();

        if ($id == -1) {

            $get = $this->input->get();

            if (
                !empty($get['range']) &&
                $this->UserModel->verifRange($get['range'])
            ) {

                $range = explode(";", $get['range']);

                $countMaxUser = $this->UserModel->countUser();

                if ($range[0] > $countMaxUser) {

                    $range[0] = $countMaxUser - 1;

                    redirect(
                        'Admin/User?range=' . $range[0] . ';' . $range[1]
                    );
                }

                $users = $this->UserModel->getUsers($range);

                $minRange = $range[0];
                $maxRange = $range[0] + $range[1];

                if ($maxRange > $countMaxUser) {

                    $maxRange = $countMaxUser;
                }

                $dataContent = array(

                    'users' => $users,
                    'minRange' => $minRange,
                    'maxRange' => $maxRange,
                    'nextIsPosible' => $maxRange < $countMaxUser,

                );

                $data = array(

                    'content' => $dataContent

                );

                $this->LoaderView->load('Admin/User', $data);
            } else {

                $this->LoaderView->load('Admin/user/filter');
            }
        } else {

            $user = $this->UserModel->getUserById($id);
            $this->load->model('OrderModel');

            if ($user != null) {

                $listLoc = $user->getLocalisation();

                if (!empty($listLoc)) {

                    $nbrAddr = $this->LocationModel->countAddressByUserId($user->getId());

                    $nbrAddr = $nbrAddr . "/" . $this->config->item('address_MaxAdd');

                    $addAddIsPos = $this->LocationModel->heHaveMaxAddress($user->getId());

                    $dataMap = [];

                    foreach ($listLoc as $loc) {

                        if ($loc->getLatitude() != null && $loc->getLongitude() != null) {

                            $dataMap[$loc->getId()] = array(

                                'lat' => $loc->getLatitude(),
                                'lng' => $loc->getLongitude(),

                            );
                        }
                    }
                    if (!empty($dataMap)) {

                        $dataScript['dataMap'] = $dataMap;
                    } else {

                        $dataScript['dataMap'] = null;
                    }
                } else {

                    $nbrAddr = "0/0";
                    $addAddIsPos = false;
                    $dataMap = null;
                }

                $commands = $this->OrderModel->getOrderByUser($user);

                $dataScript = array(

                    'dataMap' => $dataMap

                );

                $dataContent = array(

                    'user' => $user,
                    'addAddIsPos' => $addAddIsPos,
                    'nbrAddr' => $nbrAddr,
                    'commands' => $commands

                );

                $data = array(

                    'content' => $dataContent,
                    'script' => $dataScript

                );

                $this->LoaderView->load('Admin/user/view', $data);
            } else {

                redirect('Admin/User');
            }
        }
    }

    public function resetPass(int $id = -1) : void
    {

        $this->UserModel->adminOnly();
        
        if ($id == -1) {

            redirect('Admin/User');

        }

        $user = $this->UserModel->getUserById($id);

        if ($user == null) {

            redirect('Admin/User');
        }

        $status = $this->session->flashdata('status');

        $dataContent = array(

            'user' => $user,

        );

        $dataScript = array(

            'user' => $user,

        );

        $data = array(

            'content' => $dataContent,
            'script' => $dataScript

        );

        if ($status == 'success') {

            $this->UserModel->resetPass($user);

            $this->LoaderView->load('Admin/user/resetPass/success', $data);
        } elseif ($status == 'error') {

            $this->LoaderView->load('Admin/user/resetPass/error', $data);
        } else {

            $charge = $this->session->flashdata('charge');

            if ($this->input->post('switch') == 'on') {

                $this->session->set_flashdata('status', 'success');

                redirect('Admin/resetPass/' . $id);
            } else {

                if ($charge == 'on') {

                    if ($this->input->post('switch') == 'on') {

                        $this->session->set_flashdata('status', 'success');

                        redirect('Admin/resetPass/' . $id);
                    } else {

                        $this->session->set_flashdata('status', 'error');

                        redirect('Admin/resetPass/' . $id);
                    }
                } else {

                    $this->session->set_flashdata('charge', 'on');
                    $this->LoaderView->load('Admin/user/resetPass/request', $data);
                }
            }
        }

    }

    public function editUser(int $id = -1): void
    {

        $this->UserModel->adminOnly();

        if ($id == -1) {

            redirect('Admin/User');
        }

        $configRules = array(

            // * Configuration des paramètre du champlogin
            array(
                'field' => 'prenom',
                'label' => 'Prénom',
                'rules' => 'trim|required|min_length[3]|max_length[255]|alpha',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques',
                ),
            ),

            array(
                'field' => 'nom',
                'label' => 'Nom',
                'rules' => 'trim|required|min_length[3]|max_length[255]|alpha',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques',
                ),
            ),

            array(
                'field' => 'mobilePhone',
                'label' => 'Téléphone mobile',
                'rules' => 'trim|required|min_length[10]|max_length[10]|numeric|callback_IsUniqueMobilePhone[' . $id . ']',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 10 caractères",
                    "max_length" => "Le %s doit faire au plus 10 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'numeric' => 'Le %s ne doit contenir que des caractères numériques',
                ),
            ),

            array(
                'field' => 'fixePhone',
                'label' => 'Téléphone fixe',
                'rules' => 'trim|min_length[10]|max_length[10]|numeric',
                'errors' => array( // * On définit les messages d'erreurs
                    "min_length" => "Le %s doit faire au moins 10 caractères",
                    "max_length" => "Le %s doit faire au plus 10 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'numeric' => 'Le %s ne doit contenir que des caractères numériques',
                ),
            ),

            array(
                'field' => 'newEmail',
                'label' => 'email',
                'rules' => 'trim|required|min_length[5]|max_length[255]|valid_email|callback_IsUniqueEmail[' . $id . ']',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 5 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'valid_email' => 'Le %s n\'est pas valide',
                ),
            )
        );

        $this->form_validation->set_rules($configRules);

        if (!$this->form_validation->run()) {

            $error = validation_errors();

            $this->load->model('OrderModel');

            $user = $this->UserModel->getUserById($id);

            if ($user != null) {

                $listLoc = $user->getLocalisation();

                if (!empty($listLoc)) {

                    $nbrAddr = $this->LocationModel->countAddressByUserId($user->getId());

                    $nbrAddr = $nbrAddr . "/" . $this->config->item('address_MaxAdd');

                    $addAddIsPos = $this->LocationModel->heHaveMaxAddress($user->getId());

                    $dataMap = [];

                    foreach ($listLoc as $loc) {

                        if ($loc->getLatitude() != null && $loc->getLongitude() != null) {

                            $dataMap[$loc->getId()] = array(

                                'lat' => $loc->getLatitude(),
                                'lng' => $loc->getLongitude(),

                            );
                        }
                    }
                    if (!empty($dataMap)) {

                        $dataScript['dataMap'] = $dataMap;
                    } else {

                        $dataScript['dataMap'] = null;
                    }
                } else {

                    $nbrAddr = "0/0";
                    $addAddIsPos = false;
                    $dataMap = null;
                }

                $commands = $this->OrderModel->getOrderByUser($user);

                $dataScript = array(

                    'dataMap' => $dataMap

                );

                $dataContent = array(

                    'user' => $user,
                    'addAddIsPos' => $addAddIsPos,
                    'nbrAddr' => $nbrAddr,
                    'commands' => $commands,
                    'error' => $error

                );

                $data = array(

                    'content' => $dataContent,
                    'script' => $dataScript

                );

                $this->LoaderView->load('Admin/user/editUser', $data);
            } else {

                redirect('Admin/User');
            }
        } else {

            $user = $this->UserModel->getUserById($id);

            if ($user == null) {

                redirect('Admin/User');
            }

            $lastEmail = $user->getCoordonnees()->getEmail();

            $post = $this->input->post();

            $user->getCoordonnees()->setNom($post['nom']);
            $user->getCoordonnees()->setPrenom($post['prenom']);
            $user->getCoordonnees()->setEmail($post['newEmail']);
            $user->getCoordonnees()->setTelephone($post['mobilePhone']);
            $user->getCoordonnees()->setFixe($post['fixePhone']);

            $this->UserModel->updateUser($user, $lastEmail);

            redirect('Admin/User/' . $id);
        }
    }

    public function addAddress(int $id = -1)
    {

        $this->UserModel->adminOnly();

        if ($id == -1) {

            redirect('Admin/User');
        }

        $user = $this->UserModel->getUserById($id);

        if ($this->LocationModel->heHaveMaxAddress($user->getId())) {

            show_error("Vous avez atteint le nombre maximum d'adresse", 403, "Erreur");
        }

        $configRules = array(

            // * Configuration des paramètre du champlogin
            array(
                'field' => 'name',
                'label' => 'Nom de l\'adresse',
                'rules' => 'trim|required|min_length[3]|max_length[255]|alpha_numeric_spaces',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                ),
            ),

            array(
                'field' => 'number',
                'label' => 'Numéro de voie',
                'rules' => 'trim|required|is_natural|min_length[1]|max_length[5]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    "min_length" => "Le %s doit faire au moins 1 caractères",
                    "max_length" => "Le %s doit faire au plus 5 caractères",
                    'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                ),
            ),

            array(

                'field' => 'street',
                'label' => 'Nom de la voie',
                'rules' => 'trim|required|min_length[3]|max_length[250]|alpha_numeric_spaces',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 250 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                ),
            ),

            array(

                'field' => 'department',
                'label' => 'Département',
                "rules" => 'required|callback_InListDepartment',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                ),
            ),

            array(

                'field' => 'city',
                'label' => 'Ville',
                "rules" => 'trim|required|min_length[3]|max_length[255]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                ),
            ),

            array(

                'field' => 'country',
                'label' => 'Pays',
                "rules" => 'required|callback_InListCountry',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                )
            ),

            array(

                'field' => 'postalCode',
                'label' => 'Code postal',
                'rules' => 'trim|required|is_natural|min_length[5]|max_length[5]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    "min_length" => "Le %s doit faire 5 caractères",
                    "max_length" => "Le %s doit faire 5 caractères",
                    'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                ),
            )
        );

        $this->form_validation->set_rules($configRules);

        $dataContent['id'] = $user->getId();

        if (!$this->form_validation->run()) {

            $dataContent['error'] = validation_errors();

            $data = array(

                'content' => $dataContent,

            );

            $this->LoaderView->load('admin/addAddress', $data);
        } else {

            if (!$this->LocationModel->sameNameByUserId(
                $user->getId(),
                $this->input->post('name')
            )) {

                $depTab = explode(";", $this->input->post('department'));

                $dep = $this->LocationModel->getDepartment($depTab[0]);

                if ($dep != null) {

                    if (
                        $this->LocationModel->samePostalCodeByDepartment(
                            $depTab[0],
                            $this->input->post('postalCode')
                        ) ||
                        (strtolower(
                            $this->input->post('country')
                        ) != 'france'
                        )
                    ) {

                        $dataNewAddress = array(

                            'name' => $this->input->post('name'),
                            'number' => $this->input->post('number'),
                            'street' => $this->input->post('street'),
                            'department' => $dep,
                            'city' => $this->input->post('city'),
                            'country' => $this->input->post('country'),
                            'postalCode' => $this->input->post('postalCode')

                        );

                        if ($this->input->post('default') == 'on') {

                            $dataNewAddress['default'] = true;
                        }

                        $newAdresse = $this->LocationModel->newAddress($dataNewAddress);

                        if (!$this->LocationModel->sameAddresse($user->getId(), $newAdresse)) {

                            $this->LocationModel->addAddressToUser($newAdresse, $user->getId());

                            redirect('admin/user/' . $user->getId());
                        } else {

                            $dataContent['error'] = "L'addresse est trop similaire a une autre";

                            $data = array(

                                'content' => $dataContent,

                            );

                            $this->LoaderView->load('admin/addAddress', $data);
                        }
                    } else {

                        $dataContent['error'] = "Le code postal ne correspond pas au département";

                        $data = array(

                            'content' => $dataContent,

                        );

                        $this->LoaderView->load('admin/addAddress', $data);
                    }
                } else {

                    $dataContent['error'] = "Le département n'existe pas";

                    $data = array(

                        'content' => $dataContent,

                    );

                    $this->LoaderView->load('admin/addAddress', $data);
                }
            } else {

                $dataContent['error'] = "Vous avez déjà une adresse avec ce nom";

                $data = array(

                    'content' => $dataContent,

                );

                $this->LoaderView->load('admin/addAddress', $data);
            }
        }
    }

    public function modifAddress(int $id = -1): void
    {
        $this->UserModel->adminOnly();

        if ($id == -1) {

            redirect('Admin/User');
        }

        $location = $this->LocationModel->getLocationById($id);

        if ($location == null) {

            redirect('Admin/User');
        }

        $user = $this->UserModel->getUserByLocationId($location->getId());
        $user = $this->UserModel->getUserById($user->getId());

        if ($user == null) {

            redirect('Admin/User');
        }

        $this->session->set_flashdata('defaultAddressName', $location->getName());

        $configRules = array(

            // * Configuration des paramètre du champlogin
            array(
                'field' => 'name',
                'label' => 'Nom de l\'adresse',
                'rules' => 'trim|required|min_length[3]|max_length[255]|alpha_numeric_spaces|callback_IsUniqueAddressName[' . $user->getId() . ']',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                ),
            ),

            array(
                'field' => 'number',
                'label' => 'Numéro de voie',
                'rules' => 'trim|required|is_natural|min_length[1]|max_length[5]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    "min_length" => "Le %s doit faire au moins 1 caractères",
                    "max_length" => "Le %s doit faire au plus 5 caractères",
                    'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                ),
            ),

            array(

                'field' => 'street',
                'label' => 'Nom de la voie',
                'rules' => 'trim|required|min_length[3]|max_length[250]|alpha_numeric_spaces',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 250 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    'alpha_numeric_spaces' => 'Le %s ne doit contenir que des caractères alphanumeriques et/ou des espaces',
                ),
            ),

            array(

                'field' => 'department',
                'label' => 'Département',
                "rules" => 'required|callback_InListDepartment',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                ),
            ),

            array(

                'field' => 'city',
                'label' => 'Ville',
                "rules" => 'trim|required|min_length[3]|max_length[255]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    "min_length" => "Le %s doit faire au moins 3 caractères",
                    "max_length" => "Le %s doit faire au plus 255 caractères",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                ),
            ),

            array(

                'field' => 'country',
                'label' => 'Pays',
                "rules" => 'required|callback_InListCountry',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                )
            ),

            array(

                'field' => 'postalCode',
                'label' => 'Code postal',
                'rules' => 'trim|required|is_natural|min_length[5]|max_length[5]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.',
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin',
                    "min_length" => "Le %s doit faire 5 caractères",
                    "max_length" => "Le %s doit faire 5 caractères",
                    'is_natural' => 'Le %s ne doit contenir que des caractères numériques',
                ),
            )
        );

        $this->form_validation->set_rules($configRules);

        if (!$this->form_validation->run()) {

            $dataContent = array(

                'location' => $location,
                'iduser' => $user->getId(),
                'error' => validation_errors()
            );

            $dataScript = array(

                'location' => $location,

            );

            $data = array(

                'content' => $dataContent,
                'script' => $dataScript

            );

            $this->LoaderView->load('Admin/user/modifAddress', $data);
        } else {

            $depTab = explode(";", $this->input->post('department'));

            $dep = $this->LocationModel->getDepartment($depTab[0]);

            if ($dep != null) {

                if ($this->LocationModel->samePostalCodeByDepartment(
                    $depTab[0],
                    $this->input->post('postalCode')
                )) {

                    $dataNewAddress = array(

                        'name' => $this->input->post('name'),
                        'number' => $this->input->post('number'),
                        'street' => $this->input->post('street'),
                        'department' => $dep,
                        'city' => $this->input->post('city'),
                        'country' => $this->input->post('country'),
                        'postalCode' => $this->input->post('postalCode')

                    );

                    if ($this->input->post('default') == 'on') {

                        $dataNewAddress['default'] = true;
                    }

                    $newAdresse = $this->LocationModel->newAddress($dataNewAddress);

                    if (
                        !$this->LocationModel->sameAddresseModif(
                            $user->getId(),
                            $newAdresse,
                            $location->getId()
                        )
                    ) {

                        $this->LocationModel->updateAddress(
                            $newAdresse,
                            $location->getId(),
                            $user->getId()
                        );

                        redirect("admin/user/" . $user->getId());
                    } else {

                        $dataContent = array(

                            'location' => $location,
                            'iduser' => $user->getId(),
                            'error' => "Cette addresse est trop similaire a une autre"
                        );

                        $dataScript = array(

                            'location' => $location,

                        );

                        $data = array(

                            'content' => $dataContent,
                            'script' => $dataScript

                        );

                        $this->LoaderView->load('Admin/user/modifAddress', $data);
                    }
                } else {

                    $dataContent = array(

                        'location' => $location,
                        'iduser' => $user->getId(),
                        'error' => "Le code postal ne correspond pas au département"
                    );

                    $dataScript = array(

                        'location' => $location,

                    );

                    $data = array(

                        'content' => $dataContent,
                        'script' => $dataScript

                    );

                    $this->LoaderView->load('Admin/user/modifAddress', $data);
                }
            } else {

                $dataContent = array(

                    'location' => $location,
                    'iduser' => $user->getId(),
                    'error' => "Le département n'existe pas"
                );

                $dataScript = array(

                    'location' => $location,

                );

                $data = array(

                    'content' => $dataContent,
                    'script' => $dataScript

                );

                $this->LoaderView->load('Admin/user/modifAddress', $data);
            }
        }
    }

    public function supprAddress(int $id = -1)
    {

        $this->UserModel->adminOnly();

        if ($id == -1) {

            redirect('Admin/User');
        }

        $location = $this->LocationModel->getLocationById($id);

        if ($location == null) {

            redirect('Admin/User');
        }

        $user = $this->UserModel->getUserByLocationId($location->getId());
        $user = $this->UserModel->getUserById($user->getId());

        if ($user == null) {

            redirect('Admin/User');
        }

        $status = $this->session->flashdata('status');

        $dataContent = array(

            'location' => $location,
            'user' => $user,
        );

        $dataScript = array(

            'user' => $user,

        );

        $data = array(

            'content' => $dataContent,
            'script' => $dataScript

        );

        if ($status == 'success') {

            $this->LocationModel->addressIsDead($location->getId());

            $this->LoaderView->load('Admin/user/supprAddress/success', $data);
        } elseif ($status == 'error') {

            $this->LoaderView->load('Admin/user/supprAddress/error', $data);
        } else {

            $charge = $this->session->flashdata('charge');

            if ($this->input->post('switch') == 'on') {

                $this->session->set_flashdata('status', 'success');

                redirect('Admin/supprAddress/' . $id);
            } else {

                if ($charge == 'on') {

                    if ($this->input->post('switch') == 'on') {

                        $this->session->set_flashdata('status', 'success');

                        redirect('Admin/supprAddress/' . $id);
                    } else {

                        $this->session->set_flashdata('status', 'error');

                        redirect('Admin/supprAddress/' . $id);
                    }
                } else {

                    $this->session->set_flashdata('charge', 'on');
                    $this->LoaderView->load('Admin/user/supprAddress/request', $data);
                }
            }
        }
    }

    public function InListCountry(string $strCountry = ""): bool
    {

        if ($strCountry == "") {

            $this->form_validation->set_message('InListCountry', 'Le pays est vide !');

            return false;
        }

        // * On vérifie que le mobile n'existe pas
        if ($this->LocationModel->IsCountry($strCountry)) {

            return true;
        }

        // * On retourne une erreur
        $this->form_validation->set_message('InListCountry', 'Ce pays n\'existe pas !');

        return false;
    }

    public function InListDepartment(string $strDep = ""): bool
    {

        if ($strDep == "") {

            $this->form_validation->set_message('InListDepartment', 'Le département est vide !');

            return false;
        }

        $strDep = explode(";", $strDep)[1];

        // * On vérifie que le mobile n'existe pas
        if ($this->LocationModel->IsDepartment($strDep)) {

            return true;
        }

        // * On retourne une erreur
        $this->form_validation->set_message('InListDepartment', 'Ce département n\'existe pas !');

        return false;
    }

    public function IsUniqueAddressName(string $strName = "", int $id = -1): bool
    {

        $defaultName = $this->session->flashdata('defaultAddressName');

        if ($strName == "" && $id == -1 && $defaultName != null) {

            $this->form_validation->set_message('IsUniqueAddressName', 'Le nom de l\'adresse est vide !');

            return false;
        }

        $count = $this->LocationModel->IsUniqueModifAddressName($strName, $id);

        $defaultName = strtolower($defaultName);

        // * On vérifie que le mobile n'existe pas
        if ($count == 0 || ($count == 1 && strtolower($strName) == $defaultName)) {

            return true;
        }

        // * On retourne une erreur
        $this->form_validation->set_message('IsUniqueAddressName', 'Vous avez déja utilisé ce nom d\'adresse !');

        return false;
    }

    public function IsUniqueEmail(string $strEmail, int $id): bool
    {

        $user = $this->UserModel->getUserById($id);

        $actualEmail = $user->getCoordonnees()->getEmail();

        // * On vérifie que l'email n'existe pas
        if ($this->UserModel->heHaveUserByEmail($strEmail) && $strEmail != $actualEmail) {

            // * On retourne une erreur
            $this->form_validation->set_message('IsUniqueEmail', 'Cet email existe déjà !');

            return false;
        }

        return true;
    }

    public function IsUniqueMobilePhone(string $strPhone, int $id): bool
    {

        $user = $this->UserModel->getUserById($id);

        $actualPhone = $user->getCoordonnees()->getTelephone();

        // * On vérifie que le mobile n'existe pas
        if ($this->UserModel->heHaveUserByMobilePhone($strPhone) && $strPhone != $actualPhone) {

            // * On retourne une erreur
            $this->form_validation->set_message('IsUniqueMobilePhone', 'Ce numéro de téléphone est déja utilisé !');

            return false;
        }

        return true;
    }


    public function checkNameProduct(string $name): bool
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

    public function checkNameProductWithoutSelf(string $name, int $id): bool
    {

        $this->load->model('ProductModel');

        $trigger = $this->ProductModel->findByNameWithoutSelf($name, $id);

        if ($trigger) {

            return true;
        } else {

            $this->form_validation->set_message('checkNameProductWithoutSelf', 'Le nom du produit existe déjà');

            return false;
        }
    }

    public function checkSport(int $sport): bool
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

    public function checkType(string $type): bool
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
}
