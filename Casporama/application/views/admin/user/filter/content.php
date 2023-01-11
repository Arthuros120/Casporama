<!-- admin/stock/filter/content --->

<div class="user_filter"> 

    <div class="menu">
        <ul>
            <li><a href="<?php echo site_url('Admin/Product')  ?>">Gerer les Produit</a></li>
            <li><a href="<?php echo site_url('Admin/User') ?>">Gerer les utilisateurs</a></li>
            <li><a href="<?php echo site_url('Admin/Order') ?>">Gerer les commandes</a></li>
            <li><a href="<?php echo site_url('Admin/Stock') ?>">Gerer le stock</a></li>
            <li><a href="<?php echo site_url('Dao') ?>">Import / Export les données</a></li>
        </ul>
    </div>

    <div class="user_filter_content">
        <div class="user_filter_title">
            <h1> Selectionnez les filtres pour voir apparaitre les utilisateurs</h1>
        </div>
        <div class="user_filter_input">

        <h3> Séléctionner le nombre d'utilisateurs à afficher par page </h3>

        <div class="input">
            <select name="step" id="step">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20" selected>20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
            </select>

            <input id='submit' type="submit" value="Filtrer">
        </div>

        </div>
    </div>
</div>





<!-- admin/stock/filter/content --->
