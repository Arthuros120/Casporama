<!-- admin/stock/filter/content --->

<div class="stock">
    <div class="menu">
        <ul>
            <li><a href="<?php echo site_url('Admin/Product')  ?>">Gerer les Produit</a></li>
            <li><a href="<?php echo site_url('Admin/User') ?>">Gerer les utilisateurs</a></li>
            <li><a href="<?php echo site_url('Admin/Order') ?>">Gerer les commandes</a></li>
            <li><a href="<?php echo site_url('Admin/Stock') ?>">Gerer le stock</a></li>
            <li><a href="<?php echo site_url('Dao') ?>">Import / Export les données</a></li>
        </ul>
    </div>

    <div class="stock_content">
        <div class="stock_title">
            <h1> Selectionnez les filtres pour voir apparaitre le stock</h1>
        </div>
        <div class="stock_filter">

            <select name="sport" id="sport">
            <?php foreach ($sports as $sport) {?>
                <option value="<?= $sport["id"] ?>"><?= $sport["name"] ?></option>
            <?php } ?>
            </select>

            <select name="type" id="type">
            <?php foreach ($types as $type) {?>
                <option value="<?= $type ?>"><?= $type ?></option>
            <?php } ?>
            </select>

            <select name="step" id="step">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20" selected>20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

        <div class="stock_submit">
            <input id='submit' type="submit" value="Filtrer">
        </div>
        
    </div>
</div>











<!-- admin/stock/filter/content --->
