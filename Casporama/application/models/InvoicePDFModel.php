<?php

require_once(APPPATH . "libraries/pdf-invoice/src/InvoicePrinter.php");

class InvoicePDFModel extends CI_Model
{

/**
     * @param $idOrder
     * @param UserEntity $user
     * @param \Konekt\PdfInvoice\InvoicePrinter $invoice
     * @return \Konekt\PdfInvoice\InvoicePrinter
 */
    public function GenerateInvoice($idOrder, UserEntity $user): ?\Konekt\PdfInvoice\InvoicePrinter
    {
        /** @var OrderEntity $order
         * @var UserEntity $user
         * @var InformationEntity $billinginfo
         * @var LocationEntity $locationinfo
         * @var StockEntity $variante
         *
         * Ici : design patern Facade
         */
        $order = $this->OrderModel->findOrderById($idOrder, $user->getId());
        if (isset($order)) {
            $invoice = new Konekt\PdfInvoice\InvoicePrinter("A4", "€", "en");
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
                $invoice->addItem($product->getName() . ' ' . $variante->getColor() . ' ' . $variante->getSize(), $product->getDescription(), $quantities[$variante->getId()], $product->getPrice()*0.20,
                    $product->getPrice(), 0, $product->getPrice() * $quantities[$variante->getId()]);
                $total += $product->getPrice() * $quantities[$variante->getId()];
            }

            $total += 5;

            $invoice->addTotal('Frais de Port : ', 5);
            $invoice->addTotal('Total TTC', $total);


            $invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you.");
            $invoice->setFooternote("Casporama SA");
            return $invoice;


        } else {
            return null;
        }
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
}