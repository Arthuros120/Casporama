<!-- order/index -->

<?php if (isset($resultat)) { ?>
    
    <p style='color:red'><?= $resultat ?></p>

<?php } if (isset($orders)) { foreach ($orders as $order) { ?>
    <h3>Commande n° <?= $order->getId() ?></h3>
    <p>Date Commande : <?= $order->getDate() ?></p>
    <p>Adresse : <?= $order->getLocation()->getAdresse()['number'] . " " . $order->getLocation()->getAdresse()['street'] . ", " . $order->getLocation()->getCodePostal() . " " . $order->getLocation()->getCity() . ", " . $order->getLocation()->getCountry() ?></p>
    <h3>Produit(s) :</h3>
    
    <?php 
    foreach ($order->getProducts() as $product) {
        foreach ($order->getVariants() as $variant) {
            if ($product->getVariant($variant->getId())== $variant) {  ?>
                <img src=<?= $product->getCover() ?> alt="image" width="250" height="250">
                <p><?= $product->getBrand() ?></p>
                <p><?= $product->getName() ?></p>
                <p><?= $product->getGenre() ?></p>
                <p>Prix (à l'unité) : <?= $product->getPrice() ?> €</p>
                <p>Prix (total) : <?= $product->getPrice()*$order->getQuantities()[$variant->getId()] ?> €</p>
                <p>Reférence : <?= $variant->getReference() ?></p>
                <p><?= $variant->getColor() ?></p>
                <p><?= $variant->getSize() ?></p>
                <p>Quantité : <?= $order->getQuantities()[$variant->getId()] ?></p>


    <?php }}} ?>

    <p>Status : <?= $order->getState() ?></p>

    <p>Total : <?= $total[$order->getId()] ?></p>

    <a href=<?= base_url("InvoicePDF/getinvoice/".$order->getId()) ?>>Facture</a>
    
    <?php if ($order->getState() == 'Non preparer') { ?>

    <a href=<?= base_url('Order/cancelOrder?idorder='.$order->getId()) ?>>Annuler la commande</a>

<?php }}} else { ?>

    <p>Pas de commande</p>

<?php } ?>