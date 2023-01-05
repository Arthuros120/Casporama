<!-- user/cart -->


<div class="cart_content">
    <div class="cart_header">
        <a href="<?php base_url() ?>../"><img src="<?php base_url() ?>../static/image/casporama.png"></a>
    </div>

    <div class="cart_grid">
        <div class="cart_left">
            <?php echo form_open('Cart/modifyQuantity'); ?>
            <div class="cart_left_title">
                <h1>Votre Panier</h1>
            </div>
            <hr>

            <div class="product">
                <div>Article</div>
                <div>Quantité</div>
                <div>Prix</div>
                <div>Sous-Total</div>

                <?php if (isset($mainCart)) {
                    foreach ($mainCart as $product) {
                ?>
                        <div class="product_content">
                            <div class="product_img" style="background-color:<?= $colors[$product->getProduct()->getSportName()] ?>">
                                <img src=<?= $product->getProduct()->getCover() ?> alt="product_image">
                            </div>
                            <div class="product_desc">
                                <p><?= $product->getProduct()->getName() ?></p>
                                <p><?= $product->getProduct()->getBrand() ?></p>
                                <p>Taille : <?= $product->getVariant()->getSize() ?></p>
                            </div>
                        </div>
                        <div class="product_quantity">
                            <?php echo form_dropdown($product->getVariant()->getId(), $quantity[$product->getVariant()->getId()], $product->getQuantity()); ?>
                            <input type="submit" value="Modifier" />
                            <a href="/Cart/deleteProduct?idproduit=<?= $product->getProduct()->getId() ?>&idvariant=<?= $product->getVariant()->getId() ?>">Supprimer</a>

                        </div>
                        <div class="product_price">
                            <p><?= $product->getProduct()->getPrice() ?> €</p>
                        </div>
                        <div class="product_total">
                            <p><?= $product->getProduct()->getPrice() * $product->getQuantity() ?> €</p>
                        </div>
                <?php }
                } ?>
            </div>

            <?php if (isset($savedCart)) {
                foreach ($savedCart as $cart) {
            ?>
                    <div class="cart_left_title">
                        <h1>Panier Enregistré <?= $cart[0]->getIdCart() ?></h1>
                    </div>
                    <hr>
                    <div class="product">

                        <div>Article</div>
                        <div>Quantité</div>
                        <div>Prix</div>
                        <div>Sous-Total</div>

                        <?php foreach ($cart as $product) {  ?>

                            <div class="product_content">
                                <div class="product_img" style="background-color:<?= $colors[$product->getProduct()->getSportName()] ?>">
                                    <img src=<?= $product->getProduct()->getCover() ?> alt="product_image">
                                </div>
                                <div class="product_desc">
                                    <p><?= $product->getProduct()->getName() ?></p>
                                    <p><?= $product->getProduct()->getBrand() ?></p>
                                    <p>Taille : <?= $product->getVariant()->getSize() ?></p>
                                </div>
                            </div>

                            <div class="product_quantity">
                                <p><?= $product->getQuantity() ?></p>
                            </div>

                            <div class="product_price">
                                <p><?= $product->getProduct()->getPrice() ?> €</p>
                            </div>

                            <div class="product_total">
                                <p><?= $product->getProduct()->getPrice() * $product->getQuantity() ?> €</p>
                            </div>
                    <?php }?>
                    </div>
                    <div class="product_btn">
                        <p>Total : <?= $totals[$cart[0]->getIdcart()] ?> €</p>
                        <a href="/Cart/deleteCart?idcart=<?= $cart[0]->getIdcart() ?>">Supprimer</a>
                        <a href="/Cart/modifyCart?idcart=<?= $cart[0]->getIdcart() ?>">Modifier</a>
                        <a href="/Order/chooseLocation?idcart=<?= $cart[0]->getIdcart() ?>">Payer</a>
                    </div>
                <?php } }?>
                </form>
        </div>
        <div class="cart_right">
            <div class="cart_recap">
                <div class="cart_recap_title">
                    <h3>Récapitulatif</h3>
                </div>
                <hr>
                <div class="cart_recap_desc">
                    <p>Sous-total :</p>
                    <p><?= $total ?>€</p>
                    <p>TVA (20%) :</p>
                    <p><?= $TVA ?>€</p>
                    <p>Frais de ports :</p>
                    <p><?= $fraisdeport ?>€</p>
                </div>
                <hr>
                <div class="cart_recap_total">
                    <p>Total :</p>
                    <p><?=$total + $TVA + $fraisdeport ?>€</p>
                </div>
                <div class="cart_recap_btn">
                    <a href="/Cart/saveCart">Enregistrer</a>
                    <a href="/Order/chooseLocation?idcart=0">Payer</a>
                </div>
            </div>
        </div>
    </div>
</div>