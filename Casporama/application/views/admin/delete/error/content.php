<!-- admin/delete/error/content -->

<div class="stock_delete">

  <div class="stock_delte_title">
    <div class="main_title">
      <a href="javascript:history.back()"></a>
      <h1> Supprimé un produit </h1>
    </div>
    <h3> Le produit n'a pas été détruit : <?php echo $product->getName() ?> </h3>
  </div>

  <div class="stock_delete_grid">
    <div class="cover">
      <img src="<?= $product->getCover() ?>" alt="<?php echo $product->getName() ?>">
    </div>
    <div class="desc">
      <h3> <?php echo $product->getName() ?> </h3>
      <p> <?= $product->getDescription() ?> </p>
      <p> <?= $product->getPrice() ?> € </p>
    </div>
  </div>

</div>


<!-- 
<div class="product">
    <div class="product-image">
        <img src="<?= $product->getCover() ?>" alt="<?php echo $product->getName() ?>">
    </div>
    <div class="product-info">
        <h3> <?php echo $product->getName() ?> </h3>
        <p> <?php echo $product->getDescription() ?> </p>
        <p> <?php echo $product->getPrice() ?> € </p>
    </div>
</div> -->

<!-- admin/delete/error/content -->
