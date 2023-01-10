<!-- admin/stock/editQuantite/content --->

<h1> Changement de la quantité </h1>
<p> Vous pouvez modifier la quantité de l'article "<?= $product->getName() ?>" </p>
<p> Quantité actuelle : <?= $catalog->getQuantity() ?> </p>

<?php if (isset($error)): ?>
  <p> <?= $error ?> </p>
<?php endif; ?>

<?php echo form_open('admin/editQuantite/'. $catalog->getId()); ?>

<input type="number" name="quantite" value="<?= $catalog->getQuantity() ?>">

<input type="submit" value="Modifier">

<?php echo form_close(); ?>

<!-- admin/stock/editQuantite/content --->
