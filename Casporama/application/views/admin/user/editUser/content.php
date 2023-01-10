<!-- admin/stock/view/content --->

<h1> Gestion de l'utilisateur </h1>

<h3> Information de connexion </h3>

<?= form_open('admin/editUser/' . $user->getId()) ?>

<p> Login : <?= $user->getLogin(); ?> </p>
<p> Mot de passe : <a href="admin/reserPass/" . <?= $user->getId() ?>>Réinitialiser</a></p>

<h3> Information personnelles </h3>

<?php if (isset($error) && $error != "") { ?>

    <div class="error">
        <h2><?= $error ?></h2>
        <img src="<?= base_url() . "static/image/icon/error.svg" ?>" alt="error">
    </div>

<?php } ?>

<p> Nom : <input type="text" name="nom" value="<?= $user->getCoordonnees()->getNom() ?>"></p>
<p> Prénom : <input type="text" name="prenom" value="<?= $user->getCoordonnees()->getPrenom() ?>"></p>
<p> Email: <input type="email" name="newEmail" value="<?= $user->getCoordonnees()->getEmail() ?>"></p>
<p> Téléphone : <input type="tel" name="mobilePhone" value="<?= $user->getCoordonnees()->getTelephone() ?>"></p>
<p> Téléphone Fixe: <input type="tel" name="fixePhone" value="<?= $user->getCoordonnees()->getFixe() ?>"></p>

<input type="submit" value="Modifier">

<?= form_close() ?>

<h3> Adresse <?= $nbrAddr ?></h3>
<?php if (!empty($user->getLocalisation())) {
    foreach ($user->getLocalisation() as $loc) { ?>

        <h2><?= $loc->getName()?></h2>
        <?php if ($loc->getIsDefault()) { ?>
            <h2>(Par défaut)</h2>
        <?php } ?>
        <p>Adresse: <?= $loc->getAdresse()['number'] ?> <?= $loc->getAdresse()['street'] ?></p>
        <p>Code postal: <?= $loc->getCodePostal() ?></p>
        <p>Ville: <?= $loc->getCity() ?></p>
        <p>Département: <?= $loc->getDepartment() ?></p>
        <p>Pays: <?= $loc->getCountry() ?></p>
    
        <a href="<?= base_url('admin/modifAddress/' . $loc->getId()) ?>">Modifier</a>
        <a href="<?= base_url('admin/supprAddress/' . $loc->getId()) ?>">Supprimer</a>
    
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

<h3> Commandes </h3>

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

<a href="<?= base_url('Admin/DeleteUser/' . $user->getId()) ?>">Supprimer l'utilisateur</a>


<!-- admin/stock/view/content --->
