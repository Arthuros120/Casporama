<!-- admin/product/content -->

<h1>Gerer les produits</h1>

<div>

    <h2>Filtre</h2>

    <div>

        <h3>Sport</h3>

        <input class="sportFilter filter" type="checkbox" name="AllSport" id="AllSport">Tous</input>

        <input class="sportFilter filter" type="checkbox" name="Football">Football</input>
        <input class="sportFilter filter" type="checkbox" name="Volleyball">Volleyball</input>
        <input class="sportFilter filter" type="checkbox" name="Arts-martiaux">Arts-martiaux</input>
        <input class="sportFilter filter" type="checkbox" name="Badminton">Badminton</input>

    </div>

    <div>

        <h3>Categorie</h3>

        <input class="catFilter filter" type="checkbox" name="AllCat" id="AllCat">Tous</input>

        <input class="catFilter filter" type="checkbox" name="Vetement">Vêtement</input>
        <input class="catFilter filter" type="checkbox" name="Chaussure">Chaussure</input>
        <input class="catFilter filter" type="checkbox" name="Equipement">Equipement</input>

    </div>

    <div>

        <h3>Marque</h3>

        <input class="brandFilter filter"  type="checkbox" name="AllBrand" id="AllBrand">Tous</input>

        <?php foreach ($brands as $brand): ?>

            <input class="brandFilter filter" type="checkbox" name="<?= $brand ?>"><?= $brand ?></input>

        <?php endforeach ?>

    </div>

    <div>

        <h3>Prix</h3>

        <p>Entre</p>
        <input class="priceFilter filter" type="number" name="minPrice" id="minPrice" placeholder="Prix min">€</input>

        <p>et</p>

        <input class="priceFilter filter" type="number" name="maxPrice" id="maxPrice" placeholder="Prix max">€</input>

        <input class="filter" type="button" id="supprPriceFilter" name="supprPriceFilter" value="Supprimer le filtre">

    </div>


    <div>

        <h3>Recherche</h3>

        <input class="searchFilter filter" id="searchFilter" type="text" name="search" placeholder="Recherche"></input>

        <input class="filter" type="button" id="supprSearchFilter" name="supprSearchFilter" value="Supprimer le filtre">

    </div>

    <div>
        <input type="button", id="supprFilter" value="Supprimer tous les filtres" >
    </div>

</div>

<a href="<?php echo site_url('Admin/AddProduct')  ?>">Ajouter un produit</a>

<br>

<h1> Liste des produits </h1>

<h2> Trier : <?= $title ?> </h2>

<h3> Produit en ligne </h3>

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

            <a href="<?= site_url('Admin/StockProduct/' . $product->getId()) ?>">Stock</a>

            <a href="<?= site_url('Admin/EditProduct/' . $product->getId()) ?>">Modifier</a>

            <a href="<?= site_url('Admin/DeleteProduct/' . $product->getId()) ?>">Supprimer</a>

        </td>

    </tr>

<?php endforeach ?>

</table>

</form>

<form action="<?php echo site_url('Admin/ReviveProducts') ?>" method="post">

    <input type="submit" value="Supprimer les produits selectionnés">
    <input type="checkbox" id="selectAllNotAlive">Tous selectionner</input>

<h3> Produit hors-ligne </h3>

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

<?php foreach ($productsNotAlive as $product): ?>

    <tr>

        <td><input class="selectProductNotAlive" type="checkbox" name="product<?= $product->getId() ?>"></td>

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

            <a href="<?= site_url('Admin/ReviveProduct/' . $product->getId()) ?>">Resuciter</a>

        </td>

    </tr>

<?php endforeach ?>

</table>

</form>

<!-- admin/product/content -->
