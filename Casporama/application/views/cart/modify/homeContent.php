<!-- cart/modify/content -->

<div class="modify_cart">

    <div class="modify_cart_title">
        <h1>Panier enregistrer N° <?= $cart[0]->getIdcart() ?> </h1>
    </div>

    <?php echo form_open('Cart/modifyCartDB'); if ($cart != null) { ?>
    <div class="modify_cart_content">
        <?php foreach ($cart as $product) { ?>
            <div class="box">
                <div class="box_img" style="background-color:<?= $colors[$product->getProduct()->getSportName()] ?>;">
                    <img src=<?= $product->getProduct()->getCover() ?> alt="image" width="250" height="250">
                    <div class="box_title">
                        <h3><?= $product->getProduct()->getName()?> <?= $product->getProduct()->getBrand() ?></h3>
                    </div>
                </div>

                <div class="box_desc">
                    <div class="box_desc_part">
                        <p>Prix (à l'unité) : <?= $product->getProduct()->getPrice() ?> €</p>
                        <p>Prix (total) : <?= $product->getProduct()->getPrice()*$product->getQuantity() ?> €</p>
                    </div>
                    <div class="box_desc_part">
                        <p>Taille : <?= $product->getVariant()->getSize() ?></p>
                        <p>Couleur : <?= $product->getVariant()->getColor() ?></p>
                    </div>
                    <div class="box_desc_part">
                        <p>Quantité : <?php echo form_dropdown($product->getVariant()->getId(),$quantity[$product->getVariant()->getId()],$product->getQuantity()); ?></p>
                        <a href="/Cart/deleteProductDB?idcart=<?=$cart[0]->getIdcart()?>&id=<?= $product->getId() ?>">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </form>
        <?php } else { ?>
            <p>Panier vide</p>
        <?php } ?>
    </div>

    <p><?= $totals[$cart[0]->getIdcart()] ?> €</p>
    <input type="hidden" name="iduser" value=<?= $cart[0]->getIduser() ?> />
    <input type="hidden" name="idcart" value=<?= $cart[0]->getIdcart() ?> />
    <input type="submit" value="Confirmer"/> 

</div>


<!-- cart/modify/content -->
