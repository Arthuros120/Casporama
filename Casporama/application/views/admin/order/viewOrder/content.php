<form action="<?php echo site_url('Admin/changeStatusOrder') ?>" method="post">


<div class="delete_caspor_title">
        <a href="<?= base_url() ?>Admin/order">
            <img src="<?= base_url() ?>static/image/icon/arrow.svg" alt="arrow">
        </a> 
        <img src="<?= base_url() ?>static/image/casporama.png" alt="logo">
    </div>
<div class="order_content_title">
            <h3>Commande n° <?= $order->getId() ?></h3>
        </div>
        <hr>
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
                            <h3><?= $product->getName() ?> <p><?= $product->getBrand() ?></p></h3>
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

<p>Nouveau status : <?php echo form_dropdown($order->getId(),$options,$order->getState()); ?></p>
<input type="submit" value="Modifier Status" />
<a href="<?=site_url('Admin/cancelOrderConfirm?idorder='.$order->getId())?>">Annuler la commande</a>

</form>