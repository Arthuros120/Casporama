<!-- user/cart -->
<?php echo form_open('Cart/modifyCartDB'); if ($cart != null) { ?>

    <h3>Panier enregistrer numéro <?= $cart[0]->getIdcart() ?> </h3>

    <?php foreach ($cart as $product) { ?>
        <img src=<?= $product->getProduct()->getCover() ?> alt="image" width="250" height="250">
        <p><?= $product->getProduct()->getSportName() ?></p>
        <p><?= $product->getProduct()->getBrand() ?></p>
        <p><?= $product->getProduct()->getName() ?></p>
        <p><?= $product->getProduct()->getGenre() ?></p>
        <p>Prix (à l'unité) : <?= $product->getProduct()->getPrice() ?> €</p>
        <p>Prix (total) : <?= $product->getProduct()->getPrice()*$product->getQuantity() ?> €</p>
        <p>Reférence : <?= $product->getVariant()->getReference() ?></p>
        <p><?= $product->getVariant()->getColor() ?></p>
        <p><?= $product->getVariant()->getSize() ?></p>
        <p>Quantité : <?php echo form_dropdown($product->getVariant()->getId(),$quantity[$product->getVariant()->getId()],$product->getQuantity()); ?> 
        </p>
        <a href="/Cart/deleteProductDB?idcart=<?=$cart[0]->getIdcart()?>&id=<?= $product->getId() ?>">Supprimer</a>
        <br>
        <?php } ?>
        <input type="hidden" name="iduser" value=<?= $cart[0]->getIduser() ?> />
        <input type="hidden" name="idcart" value=<?= $cart[0]->getIdcart() ?> />
        <input type="submit" value="Confirmer"/> 
        </form>
        
    <?php } else { ?>

    <p>Panier vide</p>

<?php } ?>
