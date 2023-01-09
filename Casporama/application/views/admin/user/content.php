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
                    </tr>
                <?php endforeach ?>
                </table>

                <input type="submit" formaction="/Admin/User" value="NextPage">
                <input type="hidden" name="currentPage" value="<?= $currentPage ?>">
                <input type="submit" formaction="/Admin/User" value="PreviousPage" onclick="do {
                        document.getElementsByName('currentPage')[0].value = <?= $currentPage - 2 ?>;
                        } while (false)">

            </form>

            </div>
        </div>
    </div>
</div>
