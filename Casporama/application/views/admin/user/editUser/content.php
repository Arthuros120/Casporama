<!-- admin/product/content -->

<div class="admin_content">
    <div class="menu">
        <ul>
            <li><a href="<?= site_url('Admin/Product') ?>">Gerer les Produit</a></li>
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
                <form action="<?= site_url('Admin/updateUser') ?>" method="post">

                    <p> Id : <?= /** @var UserEntity $user */
                        $user->getId() ?></p>
                    <input type="hidden" name="id" value="<?= $user->getId() ?>">
                    <label>
                        Login :
                        <input type="text" name="login" value="<?= $user->getLogin() ?>">
                    </label>
                    <label>
                        Nom :
                        <input type="text" name="name" value="<?= $user->getCoordonnees()->getNom() ?>">
                    </label>
                    <label>
                        Prénom :
                        <input type="text" name="firstname" value="<?= $user->getCoordonnees()->getPrenom() ?>">
                    </label>
                    <label>
                        Email :
                        <input type="text" name="email" value="<?= $user->getCoordonnees()->getEmail() ?>">
                    </label>
                    <label>
                        numéro de téléphone :
                        <input type="text" name="numTel" value="<?= $user->getCoordonnees()->getTelephone() ?>">

                    </label>
                    <input type="submit" value="Update">

                <div class = "admin_edit_user_localisation">
                    Adresse de livraisons :

                    <table>
                        <tr>
                            <th>Id</th>
                            <th> Nom </th>
                            <th> Adresse </th>
                            <th> code Postal </th>
                            <th> Ville</th>
                            <th> Pays </th>
                            <th> Modifier </th>
                            <th> Supprimer </th>
                        </tr>

                        <?php foreach ($user->getLocalisation() as $localisation) {
                            /** @var LocationEntity $localisation */ ?>
                            <tr>
                                <td><?= $localisation->getId() ?></td>
                                <td><?= $localisation->getName() ?></td>
                                <td><?= $localisation->getStringAdresse() ?></td>
                                <td><?= $localisation->getCodePostal() ?></td>
                                <td><?= $localisation->getCity() ?></td>
                                <td><?= $localisation->getCountry() ?></td>
                                <td><a href="<?= site_url('Admin/editLocalisation/' . $localisation->getId()) ?>">Modifier</a></td>
                                <td><a href="<?= site_url('Admin/deleteLocalisation/' . $localisation->getId()) ?>">Supprimer</a></td>
                            </tr>

                        <?php } ?>

                    </table>


                </div>
                </form>


            </div>
        </div>
    </div>
</div>
