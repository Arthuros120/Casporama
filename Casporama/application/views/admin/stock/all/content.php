<!-- admin/stock/all/content --->

<h1>Stock des produits</h1>
<h2><?= $type ?> de <?= $sport ?> de <?= $minRange ?> à <?= $maxRange ?></h2>

<?php foreach ($products as $product) { ?>

    <a href="<?= base_url("shop/product/" . $product->getId()) ?>">
        <h2><?= $product->getName() ?></h2>
    </a>
    <p><?= $product->getBrand() ?></p>
    <p><?= $product->getPrice() ?> €</p>

    <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
        Ajouter une référence
    </a>

    <?php

    if (!empty($catalogs[$product->getId()])) {

        foreach ($catalogs[$product->getId()] as $color => $catalogsBySize) { ?>

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
                                type="checkbox" name="catalog<?= $catalog->getId() ?>">
                            </td>
                            <td><?= $catalog->getSize() ?></td>
                            <td><?= $catalog->getReference() ?></td>
                            <td><?= $catalog->getQuantity() ?></td>
                            <td>
                                <a href="<?= base_url("admin/editQuantité/" . $catalog->getId()) ?>">
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

        <?php

        }
    } else { ?>

        <p>Il n'y a pas de catalogue pour ce produit</p>

        <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
            Ajouter une référence
        </a>

<?php

    }
}
?>

<!-- admin/stock/all/content --->
