<!-- admin/stock/editQuantite/content --->

<div class="edit_quantity">
  <div class="edit_quantity_title">
    <div class="title">
      <a href="javascript:history.back()"><img src="<?= base_url() ?>static/image/icon/arrow.svg" alt="arrow"></a>
      <h1> Changement de la quantité </h1>
    </div>
    <div class="edit_quantity_desc">
      <p> Vous pouvez modifier la quantité de l'article "<?= $product->getName() ?>" </p>
      <p> Quantité actuelle : <?= $catalog->getQuantity() ?> </p>
    </div>
  </div>
  <div class="edit_quantity_content">
    <?php echo form_open('admin/editQuantite/'. $catalog->getId()); ?>
      <input type="number" name="quantite" value="<?= $catalog->getQuantity() ?>">
      <input type="submit" value="Modifier">
    <?php echo form_close(); ?>
  </div>
</div>




<?php if (isset($error)) : ?>
  <p> <?= $error ?> </p>
<?php endif; ?>



<!-- admin/stock/editQuantite/content --->