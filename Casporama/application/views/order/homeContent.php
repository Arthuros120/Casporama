<!-- order/index -->

<?php if (isset($orders)) { foreach ($orders as $order) { ?>
    <h3>Commande n° <?= $order->getId() ?></h3>
    <p>Date Commande : <?= $order->getDate() ?></p>
    <p>Adresse : <?= $order->getLocation()->getAdresse()['number'] . " " . $order->getLocation()->getAdresse()['street'] . ", " . $order->getLocation()->getCodePostal() . " " . $order->getLocation()->getCity() . ", " . $order->getLocation()->getCountry() ?></p>
    <h3>Produit(s) :</h3>
    
    <?php $res=0;

    foreach ($order->getProducts() as $product) {
        foreach ($order->getVariants() as $variant) {
            if ($product->getVariant($variant->getId())== $variant) {
                $total = $product->getPrice()*$order->getQuantities()[$variant->getId()]; $res += $total;  ?>
                <img src=<?= $product->getCover() ?> alt="image" width="250" height="250">
                <p><?= $product->getBrand() ?></p>
                <p><?= $product->getName() ?></p>
                <p><?= $product->getGenre() ?></p>
                <p>Prix (à l'unité) : <?= $product->getPrice() ?> €</p>
                <p>Prix (total) : <?= $total ?> €</p>
                <p>Reférence : <?= $variant->getReference() ?></p>
                <p><?= $variant->getColor() ?></p>
                <p><?= $variant->getSize() ?></p>
                <p>Quantité : <?= $order->getQuantities()[$variant->getId()] ?></p>


    <?php }}} ?>

    <p>Status : <?= $order->getState() ?></p>

    <p>Total : <?= $res ?></p>

<?php }} else { ?>

    <p>Pas de commande</p>

<?php } ?>