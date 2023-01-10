<!-- admin/stock/addStock/content -->

<h1> Ajout d'une nouvelle référence </h1>

<h2> Produits concerné: </h2>

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

<h2> Ajouter une nouvelle référence: </h2>

<?php if(isset($error)): ?>

  <p class="error"> <?= $error ?> </p>

<?php endif; ?>

<?= form_open('admin/addStock/' . $product->getId()) ?>

<p>Référence :</p>
<input type="number" name="reference" placeholder="6973727422377">

<p>Color</p>
<input type="text" name="color" placeholder="Rouge">

<p>Size</p>
<select name="size" id="size">

  <?php foreach($sizes as $size): ?>
    <option value="<?= $size ?>"><?= $size ?></option>
  <?php endforeach; ?>

</select>

<p>Quantité</p>
<input type="number" name="quantity" placeholder="15">

<input type="submit" value="Ajouter la référence">

<?= form_close() ?>

<!-- admin/stock/addStock/content -->
