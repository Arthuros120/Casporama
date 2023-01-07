<?php



require_once(APPPATH . "libraries/pdf-invoice/src/InvoicePrinter.php");
use Konekt\PdfInvoice\InvoicePrinter;

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
    }


    /**
     * @param $idOrder
     * @return void
     */
    public function getInvoice($idOrder)
    {
        $invoice = new Konekt\PdfInvoice\InvoicePrinter("A4", "€", "en");

        $this->UserModel->durabilityConnection();

        $user = $this->UserModel->getUserBySession();
        if (isset($user)) {
            $this->GenerateInvoice($idOrder, $user, $invoice);
        }else {
            redirect('/');
        }
        $invoice->render('Facture.pdf', 'I');


    }

    public function saveInvoice($idOrder, $iduser) : string {
        $invoice = new Konekt\PdfInvoice\InvoicePrinter("A4", "€", "en");
        $user = $this->UserModel->getUserById($iduser);
        $this->GenerateInvoice($idOrder,$user,$invoice);
        $invoice->render(APPPATH.'../upload/pdf/Facture'. $idOrder. '.pdf', 'F');
        
        return APPPATH.'../upload/pdf/Facture'. $idOrder. '.pdf';
    }

    private function search_product(array $products, int $id) : ?ProductEntity{

        foreach ($products as $product) {
            if ($id == $product->getId()) {
                return $product;
            }
        }

        return null;

    }

    /**
     * @param $idOrder
     * @param UserEntity $user
     * @param InvoicePrinter $invoice
     * @return void
     */
    public function GenerateInvoice($idOrder, UserEntity $user, InvoicePrinter $invoice): void
    {
        /** @var OrderEntity $order
         * @var UserEntity $user
         * @var InformationEntity $billinginfo
         * @var LocationEntity $locationinfo
         * @var StockEntity $variante
         */
        $order = $this->OrderModel->findOrderById($idOrder, $user->getId());
        if (isset($order)) {
            $billinginfo = $this->InformationModel->getInformationByUserId($user->getId());
            $locationinfo = $this->LocationModel->getLocationByUserId($user->getId(), $order->getLocation()->getId());

            $products = $order->getProducts();
            $variantes = $order->getVariants();
            $quantities = $order->getQuantities();


            $invoice->setLogo("static/image/casporama.png");
            $invoice->setColor("#000000");
            $invoice->setType("Facture d'achat");
            $invoice->setReference($order->getId());
            $invoice->setDate("     " . $order->getDate());
            $invoice->setFrom(array("Casporama", "Casporama", "Iut Nontes", "44444"));
            //var_dump( $locationinfo->getCodePostal() . $locationinfo->getCity() );
            $invoice->setTo(array(($billinginfo->getPrenom() . " " . $billinginfo->getNom()), (($billinginfo->getPrenom() . " " . $billinginfo->getNom())),
                implode(" ", $locationinfo->getAdresse()), $locationinfo->getCodePostal() . " " . $locationinfo->getCity()));
            $total = 0;
            foreach ($variantes as $variante) {
                $product = $this->search_product($products, $variante->getNuproduct());
                if (!isset($product)) {
                    echo "nope";
                }
                $invoice->addItem($product->getName() . ' ' . $variante->getColor() . ' ' . $variante->getSize(), $product->getDescription(), $quantities[$variante->getId()], 0,
                    $product->getPrice(), 0, $product->getPrice() * $quantities[$variante->getId()]);
                $total += $product->getPrice() * $quantities[$variante->getId()];
            }

            $invoice->addTotal('Total TTC', $total);


            $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");
            $invoice->setFooternote("Casporama SA");


        } else {
            redirect('/');
        }
    }


}
