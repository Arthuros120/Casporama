<!-- admin/stock/suppStock/error/content --->

<div class="stock_delete">

  <div class="stock_delte_title">
    <div class="main_title">
      <a href="javascript:history.back()"></a>
      <h1> Supprimé une référence </h1>
    </div>
    <h3> La référence du produit suivant n'a pas été supprimé : <?php echo $product->getName() ?> </h3>
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

  <div class="stock_delete_content">
    <div class="content_title">
      <h3> <span>La référence est la suivante :</span> <?php echo $catalog->getReference() ?> </h3>
    </div>
    <hr>

    <div class="content_desc">
      <p> Couleur : <?php echo $catalog->getColor() ?> </p>
      <p> Taille :  <?php echo $catalog->getSize() ?> </p>
      <p> Quantité : <?php echo $catalog->getQuantity() ?> </p>
    </div>

</div>
<!-- admin/stock/suppStock/error/content --->
