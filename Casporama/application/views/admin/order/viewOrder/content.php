<form action="<?php echo site_url('Admin/changeStatusOrder') ?>" method="post">

<div class="view_order">
    <div class="view_order_header">
        <div class="view_order_logo">
            <a href="<?= base_url() ?>Admin/Order"><img src="<?= base_url() ?>static/image/icon/arrow.svg" alt="arrow"></a>
            <a href="<?= base_url() ?>"><img src="<?= base_url() ?>static/image/casporama" alt="logo"></a>
        </div>
        <div class="view_order_title">
            <h1>Détail de la commandes n° <?= $order->getId() ?></h1>
        </div>
    </div>
    <div class="view_order_content">
        <div class="order_content_desc">
            <p>Date Commande : <?= $order->getDate() ?></p>
            <p>Client : <?= $user->getNom(). " " .$user->getPrenom() ?></p>
            <p>Adresse : <?= $order->getLocation()->getAdresse()['number'] . " " . $order->getLocation()->getAdresse()['street'] . ", " . $order->getLocation()->getCodePostal() . " " . $order->getLocation()->getCity() . ", " . $order->getLocation()->getCountry() ?></p>
            <p>Status : <?= $order->getState() ?></p>
        </div>
        
        <div class="order_content_grid">
            <?php if ($order->getProducts() != null) {
            foreach ($order->getProducts() as $product) {
                foreach ($order->getVariants() as $variant) {
                    if ($product->getVariant($variant->getId())== $variant) {  ?>
                    <div class="box">
                        <div class="box_img" style="background-color:<?= $colors[$product->getSportName()] ?>;">
                            <div class="box_cover">
                                <img src=<?= $product->getCover() ?> alt="image">
                            </div>
                            <div class="box_title">
                                <h3><?= $product->getName() ?> <p><?= $product->getBrand() ?></h3>
                            </div>
                        </div>

                        <div class="box_desc">
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
            <?php }}}} ?>
        </div>

        <div class="order_footer">
            
            <div class="order_status">
                <p>Nouveau Status : </p>
                <div class="input">
                    <?php echo form_dropdown($order->getId(),$options,$order->getState()); ?>
                    <input type="submit" value="Modifier Status" />
                </div>
            </div>
            <div class="order_submit">
                <a href="<?=site_url('Admin/cancelOrderConfirm?idorder='.$order->getId())?>">Annuler la commande</a>
            </div> 
        </div>
    </div>
</div>