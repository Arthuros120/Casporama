<!-- admin/delete/request/content -->

<div class="stock_delete">

  <div class="stock_delte_title">
    <div class="main_title">
      <a href="javascript:history.back()"></a>
      <h1> Supprimé un produit </h1>
    </div>
    <div class="scnd_title">
        <h3> Le produit a été détruit : <?php echo $product->getName() ?> </h3>
        <p> ça destruction mettra 1 mois à être effective </p>
    </div>
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

<!-- admin/delete/request/content -->
