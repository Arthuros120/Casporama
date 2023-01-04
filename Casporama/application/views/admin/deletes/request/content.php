<!-- admin/deletes/request/content -->

<h1> Supprimer les produits </h1>

<h2> Vous vous apprêtez à supprimer les produits suivant : </h2>

<table>

<tr>

    <th>Id</th>

    <th> Sport </th>

    <th> Categories </th>

    <th>Marque</th>

    <th>Nom</th>

    <th>Prix(€)</th>

    <th>Describtion</th>

</tr>

<?php foreach($products as $product): ?>

    <tr>

        <td>

            <td><?= $product->getId() ?></td>

            <td><?php echo $product->getSportName() ?></td>

            <td><?php echo $product->getType() ?></td>

            <td><?php echo $product->getBrand() ?></td>

            <td>
                <a href="<?= site_url('shop/product/' . $product->getId()) ?>">
                    <?php echo $product->getName() ?>
                </a>
            </td>

            <td><?php echo $product->getPrice() ?></td>

            <td><?php echo $product->getTinyDescription(50) ?>
        </td>

    </tr>

<?php endforeach ?>

</table>

<p> Êtes-vous sûr de vouloir supprimer ces produits ? </p>

<?php echo form_open('Admin/deleteProductsComf/'); ?>

<input type="hidden" name="products" value="<?= $listProducts ?>">

<p> Non </p>
<label class="switch">
  <input id="switch" type="checkbox" name="switch">
  <span class="slider round"></span>
</label>
<p> Oui </p>

<input type="submit" id="submitButton" value="Ne pas supprimer les produits">

<?php echo form_close(); ?>

<!-- admin/deletes/request/content -->
