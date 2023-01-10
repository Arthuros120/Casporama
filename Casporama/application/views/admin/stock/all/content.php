<!-- admin/stock/all/content --->

<h1>Stock des produits</h1>
<h2><?= $type ?> de <?= $sport ?> de <?= $minRange + 1 ?> à <?= $maxRange ?></h2>

<a href="<?= base_url('admin/stock')?>"> Retour aux filtre </a>

<br>

<?php if ($minRange > 0) {?>

<input class="previousButton" type="button" name="precedent" value="Page precedente">

<?php } ?>

<?php if ($nextIsPosible) {?>

<input class="nextButton" type="button" name="suivant" value="Page suivante">

<?php } ?>


<?php foreach ($products as $product) { ?>

    <a href="<?= base_url("admin/stock/" . $product->getId()) ?>">
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
                                type="checkbox" name="catalog-<?= $catalog->getId() ?>">
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

<?php if ($minRange > 0) {?>

    <input class="previousButton" type="button" name="precedent" value="Page precedente">

<?php } ?>

<?php if ($nextIsPosible) {?>

    <input class="nextButton" type="button" name="suivant" value="Page suivante">

<?php } ?>

<!-- admin/stock/all/content --->
