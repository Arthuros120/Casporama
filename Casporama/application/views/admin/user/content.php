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
    <div class="admin_user">
       <!-- <div class="admin_product_filter">
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
                    <?php /*foreach ($brands as $brand): */?>
                        <input class="brandFilter filter" type="checkbox" name="<?php /*= $brand */?>"><?php /*= $brand */?></input>
                    <?php /*endforeach */?>
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
        </div>-->
        <div class="admin_user_manage">
            <div class="admin_user_manage_title">
                <h2>Gérer les Utilisateurs</h2>
            </div>
            <hr>
            <div class="admin_user_manage_content">
                <div class="delete_filter">
                    <input type="button", id="supprFilter" value="Supprimer tous les filtres" >
                </div>
                <div class="add_user">
                    <a href="<?php echo site_url('Admin/AddUser')  ?>">Ajouter un User</a>
                </div>
            </div>
        </div>
        <div class="admin_list_user">
            <div class="admin_list_user_title">
                <h2>Liste des Utilisateurs</h2>
            </div>
            <hr>
           <!-- <div class="active_filter">
                <h2> Filtre Actifs : <?php /*= $title */?> </h2>
            </div>-->
            <div class="admin_list_user_content">
            <form action="<?php echo site_url('Admin/DeleteUser') ?>" method="post">

                <input type="submit" value="Supprimer les produits selectionnés">
                <input type="checkbox" id="selectAll">Tous selectionner</input>

                <table>
                    <tr>
                        <th> ✓ </th>
                        <th>Id</th>
                        <th> Nom </th>
                        <th> Prénom </th>
                        <th> Statut </th>
                        <th> Est Vérifié</th>
                    </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><input class="selectProduct" type="checkbox" name="product<?= $user->getId() ?>"></td>
                        <td><?= $user->getId() ?></td>
                        <td><?php try {
                            echo $user->getCoordonnees()->getNom() ? : "none";
                        } catch (Error $_) {
                            echo "none";
                            } ?></td>
                        <td><?php try {
                                echo $user->getCoordonnees()->getPrenom() ? : "none";
                            } catch (Error $_) {
                                echo "none";
                            }?></td>
                        <td><?php echo $user->getStatus(); ?></td>

                        <td><?php echo $user->getIsVerified() ?></td>
                        <td>
                            <a href = "<?= site_url('Admin/EditUser/').$user->getId()?>"> Modifier </a>
                            <a href="<?= site_url('Admin/DeleteUser/' . $user->getId()) ?>">Supprimer</a>
                        </td>
                        <!--<td>
                        <a href="<?php /*= site_url('Admin/StockProduct/' . $product->getId()) */?>">Stock</a>
                        <a href="<?php /*= site_url('Admin/EditProduct/' . $product->getId()) */?>">Modifier</a>
                        <a href="<?php /*= site_url('Admin/DeleteProduct/' . $product->getId()) */?>">Supprimer</a>
                        </td>-->
                    </tr>
                <?php endforeach ?>
                </table>
            </form>
            </div>
        </div>
    </div>
</div>
