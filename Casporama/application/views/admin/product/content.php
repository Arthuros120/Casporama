<!-- admin/product/content -->

<div class="admin_content">
    <div class="menu">
        <ul>
            <li><a href="<?php echo site_url('Admin/Product')  ?>">Gerer les Produit</a></li>
            <li><a href="<?php echo site_url('Admin/User') ?>">Gerer les utilisateurs</a></li>
            <li><a href="<?php echo site_url('Admin/Order') ?>">Gerer les commandes</a></li>
            <li><a href="<?php echo site_url('Admin/Stock') ?>">Gerer le stock</a></li>
            <li><a href="<?php echo site_url('Dao') ?>">Import / Export les données</a></li>
        </ul>
    </div>
    <div class="admin_product">
        <div class="admin_product_filter">
            <div class="admin_product_filter_title">
                <h2>Filtre</h2>
            </div>
            <hr>
            <div class="admin_product_filter_sport_cat">
                <div class="filter_sport">

                    <div class="sport_cat_title">
                        <h3>Sport</h3>
                    </div>

                    <div class="sport_cat_input">
                        <input class="sportFilter filter" type="checkbox" name="AllSport" id="AllSport">Tous</input>
                        <input class="sportFilter filter" type="checkbox" name="Football">Football</input>
                        <input class="sportFilter filter" type="checkbox" name="Volleyball">Volleyball</input>
                        <input class="sportFilter filter" type="checkbox" name="Arts-martiaux">Arts-martiaux</input>
                        <input class="sportFilter filter" type="checkbox" name="Badminton">Badminton</input>
                    </div>
                    
                </div>
                <div class="filter_cat">
                    <div class="sport_cat_title">
                        <h3>Categorie</h3>
                    </div>

                    <div class="sport_cat_input">
                        <input class="catFilter filter" type="checkbox" name="AllCat" id="AllCat">Tous</input>
                        <input class="catFilter filter" type="checkbox" name="Vetement">Vêtement</input>
                        <input class="catFilter filter" type="checkbox" name="Chaussure">Chaussure</input>
                        <input class="catFilter filter" type="checkbox" name="Equipement">Equipement</input>
                    </div>
                </div>
            </div>

            <div class="admin_product_filter_brand">
                <div class="brand_title">
                    <h3>Marque</h3>
                </div>
                <div class="brand_input">
                    <input class="brandFilter filter"  type="checkbox" name="AllBrand" id="AllBrand">Tous</input>
                    <?php foreach ($brands as $brand): ?>
                        <input class="brandFilter filter" type="checkbox" name="<?= $brand ?>"><?= $brand ?></input>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="admin_product_filter_price_search">

                <div class="filter_price">
                    <div class="price_title">
                        <h3>Prix</h3>
                    </div>

                    <div class="price_input">
                        <p>Entre  <input class="priceFilter filter" type="number" name="minPrice" id="minPrice" placeholder="Prix min"></input>€</p>
                        
                        <p>et<input class="priceFilter filter" type="number" name="maxPrice" id="maxPrice" placeholder="Prix max"></input>€</p>
                        
                    </div>

                    <div class="price_delete">
                        <input class="filter" type="button" id="supprPriceFilter" name="supprPriceFilter" value="Supprimer le filtre">
                    </div>
                </div>
                <div class="filter_search">
                    <div class="search_title">
                        <h3>Recherche</h3>
                    </div>
                    
                    <div class="search_input">
                        <input class="searchFilter filter" id="searchFilter" type="text" name="search" placeholder="Recherche"></input>
                    </div>

                    <div class="search_delete">
                    <input class="filter" type="button" id="supprSearchFilter" name="supprSearchFilter" value="Supprimer le filtre">
                    </div>

                </div>
            </div>
        </div>
        <div class="admin_product_manage">
            <div class="admin_product_manage_title">
                <h2>Gérer les produits</h2>
            </div>
            <hr>
            <div class="admin_product_manage_content">
                <div class="delete_filter">
                    <input type="button", id="supprFilter" value="Supprimer tous les filtres" >
                </div>
                <div class="add_product">
                    <a href="<?php echo site_url('Admin/AddProduct')  ?>">Ajouter un produit</a>
                </div>
            </div>
        </div>
        <div class="admin_list_product">
            <div class="admin_list_product_title">
                <h2>Liste des produits</h2>
            </div>
            <hr>
            <div class="active_filter">
                <h2> Filtre Actifs : <?= $title ?> </h2>
            </div>

            <div class="admin_list_product_content">
            <form action="<?php echo site_url('Admin/DeleteProducts') ?>" method="post">

                <input type="submit" value="Supprimer les produits selectionnés">
                <input type="checkbox" id="selectAll">Tous selectionner</input>

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
                <?php foreach ($productsAlive as $product): ?>
                    <tr>
                        <td><input class="selectProduct" type="checkbox" name="product<?= $product->getId() ?>"></td>
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
                        <a href="<?= site_url('Admin/Stock/' . $product->getId()) ?>">Stock</a>
                        <a href="<?= site_url('Admin/EditProduct/' . $product->getId()) ?>">Modifier</a>
                        <a href="<?= site_url('Admin/DeleteProduct/' . $product->getId()) ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </table>
            </form>
            </div>
        </div>

        <div class="admin_list_product">
            <div class="admin_list_product_title">
                <h2>Produit hors-ligne</h2>
            </div>
            <hr>
            <div class="active_filter">
                <h2> Filtre Actifs : <?= $title ?> </h2>
            </div>

            <div class="admin_list_product_content">
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
                    <?php foreach ($productsNotAlive as $product): ?>
                    <tr>
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
                            <a href="<?= site_url('Admin/Stock/' . $product->getId()) ?>">Stock</a>
                            <a href="<?= site_url('Admin/ReviveProduct/' . $product->getId()) ?>">Resuciter</a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </table>
            </div>
        </div>


    </div>
</div>


<!-- admin/product/content -->
