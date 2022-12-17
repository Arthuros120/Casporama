<!-- user/card -->

<p>Test</p>

<?php if ($carts != null) {foreach ($carts as $cart) { ?>
    <p>Id cart : <?= $cart->getIdcart() ?></p>
    <p><?= $cart->getProduct()->getSport() ?></p>
    <p><?= $cart->getProduct()->getBrand() ?></p>
    <p><?= $cart->getProduct()->getName() ?></p>
    <p><?= $cart->getProduct()->getGenre() ?></p>
    <p><?= $cart->getProduct()->getPrice() ?></p>
    <p><?= $cart->getQuantity() ?></p>
<?php }} ?>
