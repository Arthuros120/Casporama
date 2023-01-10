<!-- admin/stock/all/content --->

<div class="stock_all">
    <div class="stock_all_header">
        <div class="stock_all_logo">
            <a href="<?= base_url() ?>Admin/Stock" ><img src="<?= base_url() ?>static/image/icon/arrow.svg"></a>
            <a href="<?= base_url() ?>" ><img src="<?= base_url() ?>static/image/casporama.png"></a>
        </div>
        <div class="stock_all_title">
            <h1>Stock des produits</h1>
            <h2><?= $type ?> de <?= $sport ?> de <?= $minRange + 1 ?> à <?= $maxRange ?></h2>
        </div>
    </div>

    <div class="stock_nav">

        <div class="left">
        <?php if ($minRange > 0) {?>
            <div class="box">
                <img src="<?= base_url() ?>static/image/icon/arrow_white.svg" alt="arrow">
                <input class="previousButton" type="button" name="precedent" value="Page precedente">
            </div>
        <?php } ?>
        </div>

        <div class="right">
        <?php if ($nextIsPosible) {?>
            <div class="box">
                <input class="nextButton" type="button" name="suivant" value="Page suivante">
                <img src="<?= base_url() ?>static/image/icon/arrow_white.svg" alt="arrow">
            </div> 
        <?php } ?>
        </div>

    </div>

    <div class="stock_content">

    <?php foreach ($products as $product) { ?>
        <div class="stock_content_title">
            <a href="<?= base_url("admin/stock/" . $product->getId()) ?>">
                <h2><?= $product->getName() ?></h2>
            </a>
        </div>

        <hr>

        <div class="stock_content_grid">
            <div class="desc">
            <div class="stock_content_desc">
                <div class="desc_brand">
                    <h2>Marque :</h3>
                    <h3><?= $product->getBrand() ?></h3>
                </div>
                <div class="desc_price">
                    <h2>Prix :</h2>
                    <h3><?= $product->getPrice() ?> €</h3>
                </div>
                
                <div class="desc_btn">
                    <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
                        Ajouter une référence
                    </a>
                </div>
             
            </div>
            </div>      
        <div class="products">
        <?php if (!empty($catalogs[$product->getId()])) {
            foreach ($catalogs[$product->getId()] as $color => $catalogsBySize) { ?>
            
            <div class="stock_content_product">

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
                                <input type="checkbox" class="selectAll" id="selectAll-<?=$product->getId() . "-" . $color?>"></input>
                                <p>Tous selectionner</p>
                            </div>
                        </div>
                        

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

            </div>
            <?php } ?>
        </div>
        
        </div>
        <?php } else { ?>

            <p>Il n'y a pas de catalogue pour ce produit</p>

            <a href="<?= base_url("admin/addStock/" . $product->getId()) ?>">
                Ajouter une référence
            </a>

        <?php

        }
        }
        ?>
            
        
    </div>

    <div class="stock_nav">

        <div class="left">
        <?php if ($minRange > 0) {?>
            <div class="box">
                <img src="<?= base_url() ?>static/image/icon/arrow_white.svg" alt="arrow">
                <input class="previousButton" type="button" name="precedent" value="Page precedente">
            </div>
        <?php } ?>
        </div>

        <div class="right">
        <?php if ($nextIsPosible) {?>
            <div class="box">
                <input class="nextButton" type="button" name="suivant" value="Page suivante">
                <img src="<?= base_url() ?>static/image/icon/arrow_white.svg" alt="arrow">
            </div> 
        <?php } ?>
        </div>

    </div>

</div>





<!-- admin/stock/all/content --->
