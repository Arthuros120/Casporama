<!-- admin/stock/product/content --->

<div class="stock_product">
    <div class="stock_product_title">
        <a href="javascript:history.back()"><img src="<?= base_url() ?>static/image/icon/arrow.svg" alt="arrow"></a>
        <a href="<?= base_url('shop/product/' . $product->getId()) ?>">
            <h1>Stock de "<?= $product->getName() ?>"</h1>
        </a>
    </div>

    <div class="stock_product_content">
        <div class="stock_product_images">
            <div class="second_img">
            <?php for ($i = 1; $i < count($product->getImages()); $i++) : ?>
                <div class="img">
                    <img id="photo" alt="Image du produit" src=<?= base_url($product->getImages()[$i]) ?>>
                </div>
            <?php endfor ?>
            </div>

            <div class="main_img">
                <img id="photo" alt="Image du produit" src=<?= base_url($product->getImages()[0]) ?>>
            </div>
        </div>
        <div class="stock_product_desc">
            <div class="desc_brand">
                <h2><?= $product->getBrand() ?></h2>
            </div>
            <div class="desc_title">
                <h1><?= $product->getName() ?></h1>
            </div>
            <div class="desc_genre">
                <h2>Genre</h2>
                <h3><?= $product->getGenre() ?></h3>
            </div>
            <div class="desc">
                <h2>Description</h2>
                <p><?= $product->getDescription() ?></p>
            </div>
            <div class="desc_price">
                <h2><?= $product->getPrice() ?> €</h2>
            </div>
        </div>
    </div>

    <div class="stock_quantity">
        <div class="stock_quantity_title">
            <h1> Stock </h1>
        </div>
        <hr>
        
        <?php if (empty($catalogs)) { ?>

        <div class="stock_empty">
            <p>Il n'y a pas de catalogue pour ce produit</p>
            <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
                Ajouter une référence
            </a>
        </div>

        <?php } else { ?>
        <div class="add_ref_btn">
            <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
                Ajouter une référence
            </a>
        </div>

        <div class="stock_quantity_grid">
        <?php foreach ($catalogs as $color => $catalogsBySize) { ?>
            <div class="product">
            <div class="product_title">
                <h3><?= $color ?></h3>
            </div>

            <table>
                <tr>
                    <th> ✓ </th>
                    <th> Taille </th>
                    <th> Référence </th>
                    <th> Quantité </th>
                </tr>
                <form action="<?php echo site_url('Admin/suppStocks') ?>" method="post">

                    <div class="product_input">
                        <input type="submit" value="Supprimer les produits selectionnés">
                        <div class="product_checkbox">
                            <input type="checkbox"
                            class="selectAll"
                            id="selectAll-<?=$product->getId() . "-" . $color?>"></input>
                            <p>Tous selectionner</p>
                        </div>
                        
                    </div>
                    

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

        </div>
        <?php } ?>
        <?php } ?>
        </div>


    </div>
</div>


<!-- admin/stock/product/content --->
