<!-- admin/product/content -->

<h1>Gerer les produits</h1>

<a href="<?php echo site_url('Admin/AddProduct')  ?>">Ajouter un produit</a>

<br>

<form action="<?php echo site_url('Admin/DeleteProducts') ?>" method="post">

    <input type="submit" value="Supprimer les produits selectionnés">

<table>

<tr>

    <th> ✓ </th>

    <th>Id</th>

    <th> Sport </th>

    <th> Categories </th>

    <th>Marque</th>

    <th>Nom</th>

    <th>Prix(€)</th>

    <th>Describtion</th>

</tr>

<caption><?= $title ?></caption>

<?php foreach ($products as $product): ?>

    <tr>

        <td><input type="checkbox" name="product<?= $product->getId() ?>"></td>

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

        <td><?php echo $product->getTinyDescription(50) ?></td>

        <td>

            <a href="<?= site_url('Admin/StockProduct/' . $product->getId()) ?>">Stock</a>

            <a href="<?= site_url('Admin/EditProduct/' . $product->getId()) ?>">Modifier</a>

            <a href="<?= site_url('Admin/DeleteProduct/' . $product->getId()) ?>">Supprimer</a>

        </td>

    </tr>

<?php endforeach ?>

</table>

</form>

<!-- admin/product/content -->
