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
    }

    public function index() {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $user = $this->UserModel->getUserBySession();

            $orders = $this->OrderModel->getOrderByUser($user);

            $data = array();

            $succes = $this->input->get('succes');

            if (isset($succes)) {
                if ($succes == 'true') {
                    $dataContent['resultat'] = 'La commande a bien été annulé';
                } else {
                    $dataContent['resultat'] = "Une erreur est survenue lors de l'annulation de la commande";
                }
            }

            if ($orders != null) {
                $dataContent['orders'] = $orders;

                foreach ($orders as $order) {
                    $total[$order->getId()] = $this->OrderModel->totalOrder($order);
                }
                
                $dataContent['total'] = $total;

                $data = array(
                    'content' => $dataContent
                );
            }

            $this->LoaderView->load('Order/index',$data);
            
            
        } else {

            redirect('User/login');

        }     
    }

    public function chooseLocation() {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $idcart = $this->input->get('idcart');

            if ($idcart == 0) {
                $cart = $this->CartModel->getCart();
                if ($cart == null) {
                    redirect('Cart');
                }
            }

            $user = $this->UserModel->getUserBySession();

            $listLoc = $this->LocationModel->getLocationsByUserId($user->getId(),true);

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


            $dataContent['idcart'] = $idcart;

            $data = array(
                'content' => $dataContent,
                'script' => $dataScript,
            );

    
            $this->LoaderView->load('Order/chooseLocation',$data);
            
            
        } else {

            redirect('User/login');

        } 
        
    }

    public function addOrder() {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $idcart = $this->input->get('idcart');
            $idlocation = $this->input->get('idlocation');

            $user = $this->UserModel->getUserBySession();

            $this->OrderModel->addOrder($idcart,$user,$idlocation);


            redirect("Order");
            
            
        } else {

            redirect('User/login');

        } 

    }

    public function cancelOrder() {

        $idorder = $this->input->get('idorder');

        $err = $this->OrderModel->delOrder($idorder);

        if ($err) {
            redirect('Order?succes=true');
        } else {
            redirect('Order?succes=false');
        }

    }

    public function savePDF() {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $iduser = $this->UserModel->getUserBySession()->getId();

            $this->InvoicePDF->saveInvoice($this->input->get('idorder'),$iduser);

        } else {
            redirect('User/login')
        }

    }

}