<!-- admin/stock/delete/request/content --->

<h1> Supprimé une référence </h1>

<p> Vous vous apprêtez à supprimer la référence du produit suivant : </p>

<div class="product">
  <div class="product-image">
    <img src="<?= $product->getCover() ?>" alt="<?php echo $product->getName() ?>">
  </div>
  <div class="product-info">
    <h3> <?php echo $product->getName() ?> </h3>
    <p> <?php echo $product->getDescription() ?> </p>
    <p> <?php echo $product->getPrice() ?> € </p>
  </div>

<p> la référence est la suivante:</p>

<div class="ref">
    <h3> <?php echo $catalog->getReference() ?> </h3>
    <p> <?php echo $catalog->getColor() ?> </p>
    <p> <?php echo $catalog->getSize() ?> </p>
    <p> <?php echo $catalog->getQuantity() ?> </p>
</div>

<p> Êtes-vous sûr de vouloir supprimer cette référence ? </p>
<?php echo form_open('Admin/suppStock/' . $catalog->getId()); ?>
<p> Non </p>
<label class="switch">
  <input id="switch" type="checkbox" name="switch">
  <span class="slider round"></span>
</label>
<p> Oui </p>

<input type="submit" id="submitButton" value="Ne pas supprimer la référence">

<?php echo form_close(); ?>

<!-- admin/stock/delete/request/content --->
