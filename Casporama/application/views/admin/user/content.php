<!-- admin/user/content -->

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
        <div class="admin_list_user">
            <div class="admin_list_user_title">
                <h2>Liste des Utilisateurs</h2>
                <h3> Utilisateurs de <?= $minRange + 1 ?> à <?= $maxRange ?></h3>
                <a href="<?= base_url('admin/User') ?>"> Retour aux filtre </a>
                <?php if ($minRange > 0) { ?>

                    <input class="previousButton" type="button" name="precedent" value="Page precedente">

                <?php } ?>

                <?php if ($nextIsPosible) { ?>

                    <input class="nextButton" type="button" name="suivant" value="Page suivante">

                <?php } ?>
            </div>
            <a href="<?= base_url('admin/AddUser') ?>">Ajouter un utilisateur</a>
            <hr>
            <div class="admin_list_user_content">

                <?= form_open('admin/deleteUsers') ?>
                <input type="submit" value="Supprimer les utilisateurs selectionnés">
                <input type="checkbox" id="selectAll">Tous selectionner</input>
                <table>
                    <tr>
                        <th> ✓ </th>
                        <th>Id</th>
                        <th> Login </th>
                        <th> Nom </th>
                        <th> Prénom </th>
                        <th> Email </th>
                        <th> Statut </th>
                        <th> Vérifié</th>
                        <th> En Vie
                        <th>
                    </tr>

                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><input class="selectProduct" type="checkbox" name="product-<?= $user->getId() ?>"></td>
                            <td><?= $user->getId() ?></td>
                            <td><a
                            href="<?= base_url('admin/user/' . $user->getId()) ?>"><?= $user->getLogin() ?></a></td>
                            <td><?= $user->getCoordonnees()->getNom() ?></td>
                            <td><?= $user->getCoordonnees()->getPrenom() ?></td>
                            <td><?= $user->getCoordonnees()->getEmail() ?></td>
                            <td><?= $user->getStatus() ?></td>
                            <td><?php if ($user->getIsVerified()) {
                                    echo "✅";
                                } else {
                                    echo "❌";
                                } ?></td>
                            <td><?php if ($user->getIsALive()) {
                                    echo "✅";
                                } else {
                                    echo "❌";
                                } ?></td>
                            <td>
                                <a href="<?= base_url('Admin/EditUser/') . $user->getId() ?>"> Modifier </a>
                                <a href="<?= base_url('Admin/DeleteUser/' . $user->getId()) ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?= form_close() ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- admin/user/content -->
