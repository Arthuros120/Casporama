<!-- admin/delete/request/content -->
<h1> Supprimer un produit </h1>

<h2> Vous vous apprêtez à supprimer le produit suivant : </h2>

<div class="product">
  <div class="product-image">
    <img src="<?= $product->getCover() ?>" alt="<?php echo $product->getName() ?>">
  </div>
  <div class="product-info">
    <h3> <?php echo $product->getName() ?> </h3>
    <p> <?php echo $product->getDescription() ?> </p>
    <p> <?php echo $product->getPrice() ?> € </p>
  </div>

<p> Êtes-vous sûr de vouloir supprimer ce produit ? </p>
<?php echo form_open('Admin/DeleteProduct/' . $product->getId()); ?>
<p> Non </p>
<label class="switch">
  <input id="switch" type="checkbox" name="switch">
  <span class="slider round"></span>
</label>
<p> Oui </p>

<input type="submit" id="submitButton" value="Ne pas supprimer le produit">

<?php echo form_close(); ?>



<!-- admin/delete/request/content -->
