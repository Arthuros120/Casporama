<!-- order/index -->

<?php if (isset($orders)) { foreach ($orders as $order) { ?>
    
    <h3>Commande n° <?= $order[0]->getIdorder() ?></h3>
    <p>Date Commande : <?= $order[0]->getDate() ?></p>
    <p>Adresse : <?= $order[0]->getLocation()->getAdresse()['number'] . " " . $order[0]->getLocation()->getAdresse()['street'] . ", " . $order[0]->getLocation()->getCodePostal() . " " . $order[0]->getLocation()->getCity() . ", " . $order[0]->getLocation()->getCountry() ?></p>
    <h3>Produit(s) :</h3>
    
    <?php $res=0; foreach ($order as $product) { $total = $product->getProduct()->getPrice()*$product->getQuantity(); $res += $total;  ?>
        <img src=<?= $product->getProduct()->getCover() ?> alt="image" width="250" height="250">
        <p><?= $product->getProduct()->getBrand() ?></p>
        <p><?= $product->getProduct()->getName() ?></p>
        <p><?= $product->getProduct()->getGenre() ?></p>
        <p>Prix (à l'unité) : <?= $product->getProduct()->getPrice() ?> €</p>
        <p>Prix (total) : <?= $total ?> €</p>
        <p>Reférence : <?= $product->getVariant()->getReference() ?></p>
        <p><?= $product->getVariant()->getColor() ?></p>
        <p><?= $product->getVariant()->getSize() ?></p>        
        <p>Quantité : <?= $product->getQuantity() ?></p>
    <?php } ?>

    <p>Status : <?= $order[0]->getState() ?></p>

    <p>Total : <?= $res ?></p>

<?php }} else { ?>

    <p>Pas de commande</p>

<?php } ?>