<!-- user/cart -->
<?php echo form_open('Cart/modifyQuantity');
    if ($carts != null) {foreach ($carts as $cart) {

        if ($cart[0]->getIdcart() == 0) { ?>

            <h3>Panier principal : </h3>
        
        <?php } else { ?>
        
            <h3>Panier enregistrer numéro <?= $cart[0]->getIdcart() ?> </h3>
        
        <?php } foreach ($cart as $product) { ?>
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
        <p>Quantité : <?php if ($product->getIdcart() != 0) {echo $product->getQuantity();} else {
            $quantity = array_combine(range(1,$product->getVariant()->getQuantity()),range(1,$product->getVariant()->getQuantity()));
            echo form_dropdown($product->getVariant()->getId(),$quantity,$product->getQuantity()); ?>
        </p>
        <a href="/Cart/deleteProduct?idproduit=<?= $product->getProduct()->getId()?>&idvariant=<?= $product->getVariant()->getId()?>">Supprimer</a>
        <?php } ?> 
        <br>
    <?php } ?>
<?php if ($cart[0]->getIdcart() == 0) { ?>
    <input type="submit" value="Modifier"/> 
    </form>
    <a href="/Cart/saveCart">Enregistrer</a>
<?php } else { ?>
    <a href="/Cart/deleteCart?idcart=<?= $cart[0]->getIdcart() ?>">Supprimer</a>
    <br>
    <a href="/Cart/modifyCart?idcart=<?= $cart[0]->getIdcart() ?>">Modifier</a>
    <?php } ?>
    <br>
    <p>Total : <?= $total[$cart[0]->getIdcart()] ?></p>
    <a href="/Order/chooseLocation?idcart=<?= $cart[0]->getIdcart() ?>">Payer</a> 
    <br>
    <?php } } else { ?>

    <p>Panier vide</p>

<?php } ?>
