<!-- admin/stock/all/content --->

<h1>Stock des produits</h1>
<h2><?= $type ?> de <?= $sport ?> de <?= $minRange ?> à <?= $maxRange ?></h2>

<?php foreach ($products as $product) { ?>

    <a href="<?= base_url("shop/product/" . $product->getId()) ?>">
        <h2><?= $product->getName() ?></h2>
    </a>
    <p><?= $product->getBrand() ?></p>
    <p><?= $product->getPrice() ?> €</p>

    <?php foreach ($catalogs[$product->getId()] as $color => $catalogsBySize) { ?>

        <h3><?= $color ?></h3>

        <table>

            <tr>
                <th> ✓ </th>
                <th> Taille </th>
                <th> Référence </th>
                <th> Quantité </th>
            </tr>

            <?php foreach ($catalogsBySize as $catalog) { ?>

                <tr>
                    <td>
                        <input type="checkbox" name="catalogs<?=$catalog->getId()?>">
                    </td>
                    <td><?= $catalog->getSize() ?></td>
                    <td><?= $catalog->getReference() ?></td>
                    <td><?= $catalog->getQuantity() ?></td>
                </tr>
            <?php } ?>
        </table>

<?php

    }
}

?>

<!-- admin/stock/all/content --->
