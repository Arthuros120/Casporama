<!-- admin/stock/view/content --->
<div class="edit_user">
    <div class="edit_user_title">
        <a href="javascript:history.back()"><img src="<?= base_url() ?>static/image/icon/arrow.svg" alt=""></a>
        <h1> Gestion de l'utilisateur </h1>
    </div>

    <div class="edit_user_info">
        <div class="info_title">
            <h3> Information de connexion </h3>
        </div>
        <hr>

        <?= form_open('admin/editUser/' . $user->getId()) ?>
        <div class="info_log">
            <p> Login : <?= $user->getLogin(); ?> </p>
            <p> Mot de passe : <a href="admin/reserPass/" . <?= $user->getId() ?>>Réinitialiser</a></p>
        </div>
        
        <div class="info_perso">
            <h3> Information personnelles </h3>
            <div class="info_perso_input">

                <div class="box">
                    <p> Nom : </p>
                    <input type="text" name="nom" value="<?= $user->getCoordonnees()->getNom() ?>">
                </div>

                <div class="box">
                    <p> Prénom : </p>
                    <input type="text" name="prenom" value="<?= $user->getCoordonnees()->getPrenom() ?>">
                </div>
                <div class="box">
                    <p> Email : </p>
                    <input type="email" name="newEmail" value="<?= $user->getCoordonnees()->getEmail() ?>">
                </div>
                <div class="box">
                    <p> Téléphone : </p>
                    <input type="tel" name="mobilePhone" value="<?= $user->getCoordonnees()->getTelephone() ?>">
                </div>
                <div class="box">
                    <p> Téléphone Fixe : </p>
                    <input type="tel" name="fixePhone" value="<?= $user->getCoordonnees()->getFixe() ?>">
                </div>       
                              
            </div>

            <div class="info_submit">
                <input type="submit" value="Modifier">
            </div>

        </div>

        

        <?php if (isset($error) && $error != "") { ?>

            <div class="error">
                <h2><?= $error ?></h2>
                <img src="<?= base_url() . "static/image/icon/error.svg" ?>" alt="error">
            </div>

        <?php } ?>

        <?= form_close() ?>
    </div>

    <div class="edit_user_addr">
        <div class="addr_title">
            <h3> Adresse <?= $nbrAddr ?></h3>
        </div>
        <hr>

        <div class="addr_grid">
            <?php if (!empty($user->getLocalisation())) {
                foreach ($user->getLocalisation() as $loc) { ?>
                    <div class="addr_box">

                        <div class="box_title">
                            <h2><?= $loc->getName()?></h2>
                            <?php if ($loc->getIsDefault()) { ?>
                                <h2>(Par défaut)</h2>
                            <?php } ?>
                        </div>

                        <hr>

                        <div class="box_info">
                            <p>Adresse: <?= $loc->getAdresse()['number'] ?> <?= $loc->getAdresse()['street'] ?></p>
                            <p>Code postal: <?= $loc->getCodePostal() ?></p>
                            <p>Ville: <?= $loc->getCity() ?></p>
                            <p>Département: <?= $loc->getDepartment() ?></p>
                            <p>Pays: <?= $loc->getCountry() ?></p>
                        </div>

                        <div class="box_btn">
                            <a href="<?= base_url('admin/modifAddress/' . $loc->getId()) ?>">Modifier</a>
                            <a href="<?= base_url('admin/supprAddress/' . $loc->getId()) ?>">Supprimer</a>
                        </div>
                    
                        <div class="map_all">
                            <div class="card-map">
                                <?php
                                    if ($loc->getLatitude() != null && $loc->getLongitude() != null) { ?>
                                        <div id="map<?= $loc->getId() ?>" class="map"></div>
                                    <?php } else { ?>
                                        <div class="map_error">
                                            <h2>Aucune localisation n'a été trouvé pour cette adresse</h2>
                                        <img src="<?= base_url() . "static/image/icon/error.svg" ?>" alt="error">
                                        </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Il n'y a pas d'addresse enregisté</p>
            <?php }

            if (!$addAddIsPos) { ?>
                <div class="card_add_address">
                    <a
                    href="<?= base_url('User/admin/addAddress/' . $user->getId())?>" >
                    <img src="<?= base_url() . "static/image/icon/add.svg" ?>"
                    alt="Add" ></a>
                </div>
            <?php } ?>
        </div>

        <div class="edit_user_order">
            <div class="order_title">
                <h3> Commandes </h3>
            </div>
            <hr>

            <div class="order_content">
            <?php if ($commands != null) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Numéro de commande</th>
                            <th>Date de commande</th>
                            <th>Addresse de livraison</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commands as $command) {
                            $loc = $command->getLocation(); ?>
                            <tr>
                                <td>
                                    <a href="<?= base_url('Admin/viewOrder?idorder=' . $command->getId()) ?>">
                                        <?= $command->getId() ?>
                                    </a>
                                </td>
                                <td><?= $command->getDate() ?></td>
                                <td>
                                <?= $loc->getName() ?>
                                (
                                <?= $loc->getAdresse()['number'] ?>
                                <?= $loc->getAdresse()['street'] ?>
                                )
                            </td>
                                <td><?= $command->getState() ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>Il n'y a pas de commande enregistré</p>
            <?php } ?>
            </div>
        </div>

        <div class="edit_user_del">
            <a href="<?= base_url('Admin/DeleteUser/' . $user->getId()) ?>">Supprimer l'utilisateur</a>
        </div>
    </div>
</div>


















<!-- admin/stock/view/content --->
