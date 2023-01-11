<!-- admin/delete/request/content -->

<div class="stock_delete">

  <div class="stock_delte_title">
    <div class="main_title">
      <a href="javascript:history.back()"></a>
      <h1> Supprimer un produit </h1>
    </div>
    <h3> Vous vous apprêtez à supprimer le produit suivant : <?php echo $product->getName() ?> </h3>
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
      <h3> <span>Le produit est le suivant : </span> <?php echo $product->getName() ?> </h3>
    </div>

    <hr>

    <div class="content_confirm">
    <h3> Êtes-vous sûr de vouloir supprimer ce produit ? </h3>
    <?php echo form_open('Admin/DeleteProduct/' . $product->getId()); ?>
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
      <input type="submit" id="submitButton" value="Ne pas supprimer le produit">
    </div>

    <?php echo form_close(); ?>

  </div>

</div>



<!-- admin/delete/request/content -->
