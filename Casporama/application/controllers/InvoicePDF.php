<?php

require_once (APPPATH."libraries/pdf-invoice/src/InvoicePrinter.php");
class InvoicePDF extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();

        $this->load->model('UserModel');
        $this->load->model('InformationModel');
        $this->load->model('LocationModel');
        $this->load->model('ProductModel');
        $this->load->model('OrderModel');
    }


    /**
     * @param $idOrder
     * @return void
     */
    public function getInvoice($idOrder) {
        $invoice = new Konekt\PdfInvoice\InvoicePrinter("A4","€","en");

        $this->UserModel->durabilityConnection();

        /** @var OrderEntity $order
         * @var UserEntity $user
         * @var InformationEntity $billinginfo
         * @var LocationEntity $locationinfo
         */
        $order = $this->OrderModel->findOrderById($idOrder);
        $user  =  $this->UserModel->getUserById($order->getIduser());
        $billinginfo = $this->InformationModel->getInformationByUserId($user->getId());
        $locationinfo = $this->LocationModel->getLocationByUserId($user->getId(),$order->getIdlocation());
        $productsid = explode(',',$order->getIdProducts());
        $quantities = explode(',',$order->getQuantity());

        $products = array();
        foreach ($productsid as $productid) {
            $products[] = $this->ProductModel->findById($productid);
        }

        $invoice->setLogo("static/image/casporama.png");
        $invoice->setColor("#000000");
        $invoice->setType("Facture d'achat");
        $invoice->setReference($order->getIdorder());
        $invoice->setDate("     ".$order->getDateorder());
        $invoice->setFrom(array("Casporama","Casporama","Iut Nontes","44444") );
        //var_dump( $locationinfo->getCodePostal() . $locationinfo->getCity() );
        $invoice->setTo(array( ($billinginfo->getPrenom() ." ". $billinginfo->getNom()), (($billinginfo->getPrenom() ." " .$billinginfo->getNom())),
           implode(" ",$locationinfo->getAdresse()) , $locationinfo->getCodePostal() ." ". $locationinfo->getCity()));
        $total = 0;
        for($i = 0; $i < sizeof($products);$i ++){
            $keyi = strval($i);

            $invoice->addItem($products[$keyi]->getName(),$products[$keyi]->getDescription(),$quantities[$keyi],0,
                $products[$keyi]->getPrice(),0,$products[$keyi]->getPrice()*$quantities[$keyi]);
            $total += $products[$keyi]->getPrice()*$quantities[$keyi];
        }

        $invoice->addTotal('Total TTC',$total);


        $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");
        $invoice->setFooternote("Casporama SA");

        $invoice->render('Facture.pdf','I');



    }


}