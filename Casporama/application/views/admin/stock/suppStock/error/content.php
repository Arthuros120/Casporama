<!-- admin/stock/suppStock/error/content --->

<h1> La référence n'a pas été supprimé du produit suivant: </h1>

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

<p> la référence est la suivante:</p>

<div class="reference">
    <div class="reference-info">
        <p> <?php echo $catalog->getReference() ?> </p>
        <p> <?php echo $catalog->getColor() ?> </p>
        <p> <?php echo $catalog->getSize() ?> </p>
        <p> <?php echo $catalog->getQuantity() ?> </p>
    </div>
</div>

<!-- admin/stock/suppStock/error/content --->
