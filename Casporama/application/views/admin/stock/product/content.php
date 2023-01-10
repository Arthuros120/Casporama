<!-- admin/stock/product/content --->

<a href="<?= base_url('shop/product/' . $product->getId()) ?>">
    <h1>Stock (<?= $product->getName() ?>)</h1>
</a>

<div>
    <img id="photo" alt="Image du produit" src=<?= base_url($product->getImages()[0]) ?>>
</div>

<?php for ($i = 1; $i < count($product->getImages()); $i++) : ?>

    <img id="photo" alt="Image du produit" src=<?= base_url($product->getImages()[$i]) ?>>

<?php endfor ?>

<p><?= $product->getName() ?></p>
<p><?= $product->getBrand() ?></p>
<p><?= $product->getGenre() ?></p>
<p><?= $product->getDescription() ?></p>
<p><?= $product->getPrice() ?> €</p>

<h1> Stock </h1>

<?php if (empty($catalogs)) { ?>

    <p>Il n'y a pas de catalogue pour ce produit</p>

    <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
        Ajouter une référence
    </a>

<?php } else { ?>

    <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
        Ajouter une référence
    </a>

    <?php foreach ($catalogs as $color => $catalogsBySize) { ?>

        <h3><?= $color ?></h3>

        <table>

            <tr>
                <th> ✓ </th>
                <th> Taille </th>
                <th> Référence </th>
                <th> Quantité </th>
            </tr>

            <form action="<?php echo site_url('Admin/suppStocks') ?>" method="post">

                <input type="submit" value="Supprimer les produits selectionnés">
                <input type="checkbox"
                class="selectAll"
                id="selectAll-<?=$product->getId() . "-" . $color?>">Tous selectionner</input>

                <?php foreach ($catalogsBySize as $catalog) { ?>

                    <tr>
                        <td>
                            <input
                            class="selectCatalog selectCatalog-<?=$product->getId() . "-" . $color?>"
                            type="checkbox" name="catalogs-<?= $catalog->getId() ?>">
                        </td>
                        <td><?= $catalog->getSize() ?></td>
                        <td><?= $catalog->getReference() ?></td>
                        <td><?= $catalog->getQuantity() ?></td>
                        <td>
                            <a href="<?= base_url("admin/editQuantite/" . $catalog->getId()) ?>">
                                Changer la quantité
                            </a>
                            <a href="<?= base_url("admin/suppStock/" . $catalog->getId()) ?>">
                                Supprimé
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </form>
        </table>

    <?php } ?>

<?php } ?>

<!-- admin/stock/product/content --->
