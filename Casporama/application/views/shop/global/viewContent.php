<h1>Product Content</h1>

<?php foreach ($listProduct as $product):?>

    <h1><?= $product->get_Name() ?></h1>
    <p><?= $product->get_brand() ?></p>
    <p><?= $product->get_price() ?>€</p>
    <img src=<?= $product->get_image() ?>>

<?php endforeach;?>