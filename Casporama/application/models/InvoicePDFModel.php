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
            $invoice = new Konekt\PdfInvoice\InvoicePrinter("A4", "€", "fr");
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
            $invoice->setFrom(array("Casporama", "Casporama", "3 Rue Maréchal Joffre", "44000 Nantes"));

            $invoice->setTo(array(($billinginfo->getPrenom() . " " . $billinginfo->getNom()), (($billinginfo->getPrenom() . " " . $billinginfo->getNom())),
                implode(" ", $locationinfo->getAdresse()), $locationinfo->getCodePostal() . " " . $locationinfo->getCity()));
            $total = 0;
            foreach ($variantes as $variante) {
                $product = $this->search_product($products, $variante->getNuproduct());
                if (!isset($product)) {
                    echo "nope";
                }
                if ($user->getStatus() == 'Caspor') {
                    $discount = $product->getPrice() * 0.05;
                } else {
                    $discount = 0;
                }
                $invoice->addItem($product->getName() . ' ' . $variante->getColor() . ' ' . $variante->getSize(), $product->getDescription(), $quantities[$variante->getId()], $product->getPrice()*0.20,
                    $product->getPrice(), $discount, (($product->getPrice()-$discount)*1.20) * $quantities[$variante->getId()]);
                $total += (($product->getPrice()-$discount)*1.20) * $quantities[$variante->getId()];
            }

            $total += 5;

            $invoice->addTotal('Frais de Port : ', 5);
            $invoice->addTotal('Total TTC', $total);


            $invoice->addParagraph("Aucun article ne sera remplacer ou rembourser si vous n'avez cette facture avec vous");
            $invoice->setFooternote("Casporama SA");
            return $invoice;


        } else {
            return null;
        }
    }

    public function saveInvoice($idOrder, $iduser) : string {
        $user = $this->UserModel->getUserById($iduser);
        $invoice = $this->GenerateInvoice($idOrder,$user);
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