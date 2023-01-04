<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Shop Controller

    @var private $data
    
    @method: home
    @method: view
    @method: product

    * Ce controller permet de gérer les pages du shop
    * Il permet de gérer les pages d'accueil, de produits et de catégories
    * Il permet aussi de gérer les pages de recherche et de panier

*/
class Shop extends CI_Controller
{

    // * Initialisation de la Class Home
    // * Creation de la variable $data
    public function __construct()
    {

        parent::__construct();
        
        // * Creation de la variable $data qui contiendra les vues, initialement programé par défaut
        $this->data = array(
            'loadView' => $this->UtilView->generateLoadView()
        );

        // * On charge le model des produits
        $this->load->model('ProductModel');
    
    }

    /*

        * Home Page

        @param $sport Cette variable permet de définir le sport à afficher

        @var $data['products'] = array() : Tableau des produits
        @var $data['categories'] = array() : Tableau des catégories

        * Cette méthode permet de générer la page d'accueil du shop
        * en fonction du sport passé en paramètre sachant que seulement
        * 4 sport sont disponibles : football, volleyball, badminton et arts martiaux
        * Si aucun sport n'est passé en paramètre, la page d'accueil du shop
        * affiche une erreur 404

        ! Cette fonction ne peut pas être dans le fichier loadView car
        ! elle a un string contenant une variable cela créer un problème
        ! de syntaxe, possiblement corigaible avec l'aide d'un professeur.
    
    */
    public function home(string $sport = "")
    {
        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        // * On vérifie que le sport passé en paramètre est bien un sport disponible.
        if (in_array($sport, array("Football", "Volleyball", "Badminton", "Arts-martiaux"))) {

            // * On selectionne l'icon de la fonction user en fonction de la connection de l'utilisateur
            $dataHeader['userIcon'] = $this->UtilView->chooseUserIcon();

            // * On récupère le sport et on le stock dans des variable qui seront utilisé dans les vues.
            $dataHeader['sport'] = $sport;
            $dataHead['sport'] = $sport;
            
            // * On récupere les sous-vues et on affilie les données aux sous-vues et on les stock dans une variable.
            $this->data = array(
                'loadView' => $this->UtilView->generateLoadView(
                    array(
                    'head' => 'shop/home/head',
                    'headSport' => "shop/{$sport}/homeHead",
                    'header' => 'shop/global/header',
                    'content' => "shop/{$sport}/homeContent",
                    'footer' => 'templates/blank'
                    ),
                    array(
                        'head' => $dataHead,
                        'header' => $dataHeader
                    )
                )
            );


            // * On charges les sous-vues dans la vue principale avec les données affilie.
            $this->load->view('shop/global/homeTemplate', $this->data);

        } else {
            
            // * Si le sport n'est pas disponible, on affiche une erreur 404
            $this->load->view('errors/html/error_404');

        }

    }

    /*

        * View Page

        @param $sport Cette variable permet de définir le sport du produit à afficher
        @param $category Cette variable permet de définir la catégorie du produit à afficher

        @var $data['products'] = array() : Tableau des produits
        @var $data['categories'] = array() : Tableau des catégories

        * Cette méthode permet d'afficher une liste de produits en fonction du sport et de la catégorie
        * passés en paramètre. Si aucun sport ou catégorie n'est passé en paramètre, une erreur 404 est affichée.

    */
    public function view(string $sport = "", string $catProduct = "")
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        // * On vérifie que le sport et la catégorie passé en paramètre sont bien un sport et une catégorie disponible.
        if (
            in_array($sport, array("Football", "Volleyball", "Badminton", "Arts-martiaux"))
            && in_array($catProduct, array("Equipement", "Chaussure", "Vetement"))) {

            // * On recupére tout les produit du sport et de la catégorie passé en paramètre
            // * et on les stock dans une variable
            $listProduct = $this->ProductModel->findBySportType($sport, $catProduct);

            // * On selectionne l'icon de la fonction user en fonction de la connection de l'utilisateur
            $dataHeader['userIcon'] = $this->UtilView->chooseUserIcon();

            // * On récupère les donnée affilié au vues et on le stock
            // * dans des variable qui seront utilisé dans les vues.
            $dataHead['sport'] = $sport;
            $dataHead['category'] = $catProduct;
            $dataHeader['sport'] = $sport;
            $dataContent['listProduct'] = $listProduct;

            // * On fait correspondre les données au bonne vues et on les stock dans une variable.
            $data = array(
                'head' => $dataHead,
                'header' => $dataHeader,
                'content' => $dataContent
            );

            // * On charges les sous-vues dans la vue principale avec les données affilie.
            $this->LoaderView->load('Shop/view', $data);

        } else {

            // * Si le sport ou la catégorie n'est pas disponible, on affiche une erreur 404.

            $this->load->view('errors/html/error_404');

        }

    }

    /*

        * Product Page

        @param $idProduct Cette variable permet de définir l'id du produit à afficher

        @var $data['products'] = array() : Tableau des produits
        @var $data['categories'] = array() : Tableau des catégories

        * Cette méthode permet d'afficher un produit de l'id passés en paramètre.
        * Si aucun id n'est passé en paramètre, une erreur 404 est affichée.

    */
    public function product(int $idProduct = -1)
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        // * On vérifie que l'id passé en paramètre est bien un id disponible.
        $product = $this->ProductModel->findById($idProduct);

        // * Verification que le produit existe
        if ($product != null) {

            // * On récupère le sport du produit et on le stock dans dans une variable pour la vue.
            $sport = $this->ProductModel->findNameSportbyId($product->getSport());

            // $stock = $this->ProductModel->getStock($idProduct);

            // var_dump($stock);

            // * On selectionne l'icon de la fonction user en fonction de la connection de l'utilisateur
            $dataHeader['userIcon'] = $this->UtilView->chooseUserIcon();

            // * On récupère les donnée affilié au vues et on le stock
            // * dans des variable qui seront utilisé dans les vues.
            $dataHead['sport'] = $sport;
            $dataHead['product'] = $product;
            $dataHeader['sport'] = $sport;
            $dataContent['product'] = $product;

            $dataContent['taille'] = $this->ProductModel->getSize($product);
            
            $get = $this->input->get();

            $avalaibleColors = $this->ProductModel->avalaibleColor($product);

            $dataContent['avalaibleColors'] = $avalaibleColors;


            if (!empty($get) && isset($get['color']) && in_array(str_replace(' ', '+', $get['color']), $avalaibleColors)) {

                $dataContent['avalaibleSize'] = $this->ProductModel->avalaibleSize($product,$get['color']);

                $dataContent['choosenColor'] = str_replace(' ', '+', $get['color']);
            }

            // * On fait correspondre les données au bonne vues et on les stock dans une variable.
            $data = array(
                'head' => $dataHead,
                'header' => $dataHeader,
                'content' => $dataContent
            );


            // * On charges les sous-vues dans la vue principale avec les données affilie.
            $this->LoaderView->load('Shop/product', $data);

        } else {

            // * Si le produit n'est pas la base de donnée, on affiche une erreur 404.
            
            $this->load->view('errors/html/error_404');

        }
    }
}
