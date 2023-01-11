<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Order Controller

    
*/
class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('ProductModel');
        $this->load->model('LocationModel');
        $this->load->model('CartModel');
        $this->load->model('EmailModel');
        $this->load->model('InvoicePDFModel');
    }

    public function index()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $orders = $this->OrderModel->getOrderByUser($user);

            $data = array();

            $succes = $this->session->flashdata('succes');

            if (isset($succes)) {
                if ($succes == 'true') {
                    $dataContent['resultat'] = 'La commande a bien été annulé';
                } else {
                    $dataContent['resultat'] = "Une erreur est survenue lors de l'annulation de la commande";
                }
            }

            if ($orders != null) {
                $dataContent['orders'] = $orders;

                $colors = array (
                    'Football' => '#D3E2D3',
                    'Badminton' => '#D9E6F4',
                    'Volleyball' => '#FBFBC3',
                    'Arts-martiaux' => '#FFB4B0'
                );
        
                $dataContent['colors'] = $colors;

                $data = array(
                    'content' => $dataContent
                );
            }

            $this->LoaderView->load('Order/index', $data);
        } else {

            redirect('User/login');
        }
    }

    public function chooseLocation()
    {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $idcart = $this->input->get('idcart');
            $price = $this->input->get('price');

            if ($idcart == 0) {
                $cart = $this->CartModel->getCart();
                if ($cart == null) {
                    redirect('Cart');
                }
            }

            $user = $this->UserModel->getUserBySession();

            $listLoc = $this->LocationModel->getLocationsByUserId($user->getId(), true);

            if (isset($listLoc) && !empty($listLoc)) {

                $dataContent['listLoc'] = $listLoc;
                $dataContent['nbrAddr'] = $this->LocationModel->countAddressByUserId($user->getId());
                $dataContent['nbrAddr'] = $dataContent['nbrAddr'] . "/" . $this->config->item('address_MaxAdd');
                $dataContent['addAddIsPos'] = $this->LocationModel->heHaveMaxAddress($user->getId());

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

                $dataContent['addAddIsPos'] = false;
                $dataContent['nbrAddr'] = "0/0";
                $dataScript['dataMap'] = null;
            }

            $dataContent['price'] = $price;
            $dataContent['idcart'] = $idcart;

            $data = array(
                'content' => $dataContent,
                'script' => $dataScript,
            );


            $this->LoaderView->load('Order/chooseLocation', $data);
        } else {

            redirect('User/login');
        }
    }

    public function addOrder()
    {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {


            
            $idcart = $this->input->get('idcart');
            $idlocation = $this->input->get('idlocation');
            $price = $this->input->get('price');

            $user = $this->UserModel->getUserBySession();

            $user = $this->UserModel->getUserById($user->getId());

            if ($idcart == 0) {
                $carts = $this->CartModel->getCart();
            } else {
                $carts = $this->CartModel->getCartDBbyID($user->getId(), $idcart);
            }

            $bool = $this->OrderModel->haveStock($carts);

            $errStock = array();

            foreach ($bool as $key => $value) {
                if (!$value) {
                    array_push($errStock,$key);
                }
            }

            if (empty($errStock)) {
                $idorder = $this->OrderModel->addOrder($carts, $user, $idlocation, $price);

                $fromEmail = array(

                    'email' => 'no_reply@casporama.live',
                    'name' => 'Casporama - No Reply'

                );

                $file = $this->InvoicePDFModel->saveInvoice($idorder,$user->getId());

                $this->EmailModel->sendEmailWithAttachement(
                    $fromEmail,
                    $user->getCoordonnees()->getEmail(),
                    'Casporama - Facture n°'.$idorder,
                    "email/factureMail",
                    array(
                    'user' => $user,
                    'idorder' => $idorder,
                    ),
                    $file, 
                );

                redirect("Order");
            } else {

                $errProduct = array();

                foreach ($errStock as $idVariant) {
                    foreach ($carts as $cart) {
                        if ($cart->getVariant()->getId() == $idVariant) {
                            array_push($errProduct,$cart->getProduct()->getName(). " " .$cart->getProduct()->getBrand(). " " .$cart->getVariant()->getSize(). " " .$cart->getVariant()->getColor());
                        }
                    } 
                } 

                $this->LoaderView->load("Cart/error", array('content' => array('err' => $errProduct, 'idcart' => $idcart)));

            }


        } else {

            redirect('User/login');
        }
    }

    public function cancelOrderConfirm()
    {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $idorder = $this->input->get('idorder');

            $data = array(
                'content' => array('idorder' => $idorder),
            );

            $this->LoaderView->load('Order/confirm', $data);
        } else {

            redirect('User/login');
        }
    }

    public function cancelOrder()
    {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $idorder = $this->input->get('idorder');

            $err = $this->OrderModel->delOrder($idorder);

            if ($err) {
                $this->session->set_flashdata('succes',true);
            } else {
                $this->session->set_flashdata('succes',false);
            }

            redirect('Order');

        } else {

            redirect('User/login');
        }
    }
}
