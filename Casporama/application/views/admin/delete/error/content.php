<!-- admin/delete/error/content -->

<h1> Le produit n'a pas été détruit </h1>

<div class="product">
    <div class="product-image">
        <img src="<?= $product->getCover() ?>" alt="<?php echo $product->getName() ?>">
    </div>
    <div class="product-info">
        <h3> <?php echo $product->getName() ?> </h3>
        <p> <?php echo $product->getDescription() ?> </p>
        <p> <?php echo $product->getPrice() ?> € </p>
    </div>
</div>

<!-- admin/delete/error/content -->
