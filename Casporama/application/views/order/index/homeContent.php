<!-- order/index -->

<div class="order">
    <div class="order_header">
        <div class="order_logo">
            <a href="<?= base_url() ?>User/home" ><img src="<?= base_url() ?>static/image/icon/arrow.svg"></a>
            <a href="<?= base_url() ?>" ><img src="<?= base_url() ?>static/image/casporama.png" ></a>
        </div>
        <div class="order_title">
            <h1>Commandes</h1>
        </div>
    </div>

    <div class="order_content">
    <?php if (isset($orders)) { foreach ($orders as $order) { ?>
        <div class="order_content_title">
            <h3>Commande n° <?= $order->getId() ?></h3>
        </div>
        <hr>
        <div class="order_content_desc">
            <p>Date Commande : <?= $order->getDate() ?></p>
            <p>Adresse : <?= $order->getLocation()->getAdresse()['number'] . " " . $order->getLocation()->getAdresse()['street'] . ", " . $order->getLocation()->getCodePostal() . " " . $order->getLocation()->getCity() . ", " . $order->getLocation()->getCountry() ?></p>
        </div>
        
        <div class="order_content_grid">
        <?php 
        foreach ($order->getProducts() as $product) {
            foreach ($order->getVariants() as $variant) {
                if ($product->getVariant($variant->getId())== $variant) {  ?>
                <div class="box">
                    <div class="box_img" style="background-color:<?= $colors[$product->getSportName()] ?>;">
                        <div class="box_cover">
                            <img src=<?= $product->getCover() ?> alt="image">
                        </div>
                        <div class="box_title">
                            <h3><?= $product->getName() ?> <p><?= $product->getBrand() ?></p></h3>
                        </div>
                    </div>

                    <div class="box_desc">
                        <div class="box_desc_part">
                            <p>Prix (à l'unité) : <?= $product->getPrice() ?> €</p>
                            <p>Prix (total) : <?= $product->getPrice()*$order->getQuantities()[$variant->getId()] ?> €</p>
                        </div>
                        <div class="box_desc_part">

                            <p>Taille : <?= $variant->getSize() ?></p>
                            <p>Couleur : <?= $variant->getColor() ?></p>
                        </div>
                        <div class="box_desc_part">
                            <p>Quantité : <?= $order->getQuantities()[$variant->getId()] ?></p>
                            <p>Reférence : <?= $variant->getReference() ?></p>
                        </div>
                    </div>
                </div>                                     
        <?php }}} ?>
        </div>
        
    <div class="order_footer">
        <div class="order_info">
            <p>Status : <?= $order->getState() ?></p>
            <p>Total : <?= $total[$order->getId()] ?></p>
        </div>
        <?php if ($order->getState() == 'Non preparer') { ?>
            <div class="order_remove">
                <a href=<?= base_url('Order/cancelOrderConfirm?idorder='.$order->getId()) ?>>Annuler la commande</a>
            </div>
        <?php } ?>

        <div class="order_facture">
            <a href=<?= base_url("InvoicePDF/getinvoice/".$order->getId()) ?>>Facture</a>
        </div>
    </div>

    <?php }} else { ?>
        <div class="no_order">
            <img src="<?= base_url() ?>static/image/icon/error.svg">
            <h1>Vous n'avez pas encore de commandes</h1>
        </div>
    <?php } ?>
    </div>
</div>

<?php if (isset($resultat)) { ?>
    
    <p style='color:red'><?= $resultat ?></p>

<?php } ?>

