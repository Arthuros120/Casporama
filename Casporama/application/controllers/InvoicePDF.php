<?php

require_once(APPPATH . "libraries/pdf-invoice/src/InvoicePrinter.php");

/**
 * @property UserModel $UserModel
 */
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
        $this->load->model('InvoicePDFModel');
    }


    /**
     * @param $idOrder
     * @return void
     */
    public function getInvoice($idOrder)
    {

        $this->UserModel->durabilityConnection();

        $user = $this->UserModel->getUserBySession();
        if (isset($user)) {
            $invoice = $this->InvoicePDFModel->GenerateInvoice($idOrder, $user);
            if (isset($invoice)) {
                $invoice->render('Facture.pdf', 'I');
            }else {
                redirect('/');
            }
        }else {
            redirect('/');
        }



    }

}
