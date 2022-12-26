<!-- user/card -->
<?php if ($carts != null) {foreach ($carts as $cart) { ?>
    <h3>Id cart : <?= $cart[0]->getIdcart() ?></h3>
    <?php foreach ($cart as $product) { ?>
        <img src=<?= $product->getProduct()->getCover() ?> alt="image" width="250" height="250">
        <p><?= $product->getProduct()->getSportName() ?></p>
        <p><?= $product->getProduct()->getBrand() ?></p>
        <p><?= $product->getProduct()->getName() ?></p>
        <p><?= $product->getProduct()->getGenre() ?></p>
        <p>Prix : <?= $product->getProduct()->getPrice() ?> €</p>
        <p>Reférence : <?= $product->getVariant()->getReference() ?></p>
        <p><?= $product->getVariant()->getColor() ?></p>
        <p><?= $product->getVariant()->getSize() ?></p>
        <p>Quantité : </p>
        <?php form_open('Cart/modify'); $quantity = array_combine(range(1,$product->getVariant()->getQuantity()),range(1,$product->getVariant()->getQuantity()));
            echo form_dropdown('quantity',$quantity,$product->getQuantity()); ?>
        <input type="submit" value="Modify"/> 
        </form>
        <br>
    <?php } ?>
    <button>Payer</button>
<?php if ($cart[0]->getIdcart() == 0) { ?>
    <a href="/Cart/saveCart">Enregistrer</a>
<?php } } } else { ?>

    <p>Panier vide</p>

<?php } ?>
