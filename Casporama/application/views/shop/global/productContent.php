<h1>Product Content</h1>

<?php foreach ($listProduct as $product):?>

    <?= $product->get_Name() ?>
    <img src=<?= $product->get_image() ?>>

<?php endforeach;?>