<!-- admin/stock/delete/request/content --->

<div class="stock_delete">

  <div class="stock_delte_title">
    <div class="main_title">
      <a href="javascript:history.back()"></a>
      <h1> Supprimé une référence </h1>
    </div>
    <h3> Vous vous apprêtez à supprimer la référence du produit suivant : <?php echo $product->getName() ?> </h3>
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

    <div class="content_confirm">
    <h3> Êtes-vous sûr de vouloir supprimer cette référence ? </h3>
    <?php echo form_open('Admin/suppStock/' . $catalog->getId()); ?>
    <div class="box_switch">
      <p> Non </p>
      <label class="switch">
        <input id="switch" type="checkbox" name="switch">
        <span class="slider round"></span>
      </label>
      <p> Oui </p>
      </div>
    </div>

    <div class="content_submit">
      <input type="submit" id="submitButton" value="Ne pas supprimer la référence">
    </div>

    <?php echo form_close(); ?>

  </div>

</div>





<!-- admin/stock/delete/request/content --->
