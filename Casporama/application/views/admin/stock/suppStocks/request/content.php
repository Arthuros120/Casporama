<!-- admin/stock/suppStocks/request/content -->

<h1> Supprimer les référence </h1>

<h2> Vous vous apprêtez à supprimer les références du produit suivant : </h2>

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

<p> Les références suivantes seront supprimées : </p>

<table>

<tr>

    <th>Taille</th>

    <th> Référence </th>

    <th> Quantité </th>

</tr>

<?php foreach($catalogs as $catalog): ?>

    <tr>
        <td>
            <td><?= $catalog->getSize() ?></td>

            <td><?= $catalog->getReference() ?></td>

            <td><?= $catalog->getQuantity() ?></td>
        <td>
    </tr>

<?php endforeach ?>

</table>

<p> Êtes-vous sûr de vouloir supprimer ces références ? </p>

<?php echo form_open('Admin/suppStocksComf/'); ?>

<input type="hidden" name="catalogs" value="<?= $listCatalogs ?>">
<input type="hidden" name="product" value="<?= $product->getId() ?>">

<p> Non </p>
<label class="switch">
  <input id="switch" type="checkbox" name="switch">
  <span class="slider round"></span>
</label>
<p> Oui </p>

<input type="submit" id="submitButton" value="Ne pas supprimer les références">

<?php echo form_close(); ?>
<!-- admin/stock/suppStocks/request/content -->
