<!-- admin/delete/request/content -->

<h1> Le produit a bien été détruit </h1>
<p> ça destruction mettra 1 mois à être effective </p>

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

<!-- admin/delete/request/content -->
