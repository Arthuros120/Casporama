<!-- admin/product/content -->

<div class="admin_content">
    <div class="menu">
        <ul>
            <li><a href="<?= site_url('Admin/Product')  ?>">Gerer les Produit</a></li>
            <li><a href="<?= site_url('Admin/User') ?>">Gerer les utilisateurs</a></li>
            <li><a href="<?= site_url('Admin/Order') ?>">Gerer les commandes</a></li>
            <li><a href="<?= site_url('Admin/Stock') ?>">Gerer le stock</a></li>
            <li><a href="<?= site_url('Dao') ?>">Import / Export les données</a></li>
        </ul>
    </div>
    <div class="admin_user">
        <div class="admin_list_user">
            <div class="admin_list_user_title">
                <h2>Liste des Utilisateurs</h2>
            </div>
            <hr>

            <div class="admin_edit_user">
                <form action="<?= site_url('Admin/EditUser') ?>" method="post">

                    <p> Id :  <?= $user->getId() ?></p>
                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                    <label>
                        Nom :
                        <input type="text" name="nom">
                    </label>
                    <label>
                        Prénom :
                        <input type="text" name="prenom">
                    </label>
                    <label>
                        Email :
                        <input type="text" name="email">
                    </label>
                    <label>
                        numéro de téléphone :
                        <input type="text" name="numTel">

                    </label>
                    Adresse de livraison :
                    <label>
                        Adresse :
                        <input type="text" name="adresse">
                    </label>
                    <label>
                        Code Postal :
                        <input type="text" name="codePostal">
                    </label>
                    <label>
                        Ville :
                        <input type="text" name="ville">
                    </label>


                </form>


            </div>
        </div>
    </div>
</div>
