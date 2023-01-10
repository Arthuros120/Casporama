<!-- admin/stock/view/content --->

<h1> Gestion de l'utilisateur </h1>

<h3> Information de connexion </h3>

<p> Login : <?= $user->getLogin(); ?> </p>
<p> Mot de passe : <a href="admin/reserPass/" . <?= $user->getId() ?>>Réinitialiser</a></p>

<h3> Information personnelles </h3>
<p> Nom : <?= $user->getCoordonnees()->getNom() ?> </p>
<p> Prénom : <?= $user->getCoordonnees()->getPrenom() ?> </p>
<p> Email: <?= $user->getCoordonnees()->getEmail() ?> </p>
<p> Téléphone : <?= $user->getCoordonnees()->getTelephone() ?> </p>
<p> Téléphone Fixe: <?= $user->getCoordonnees()->getFixe() ?> </p>

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
    
        <a href="admin/modifAddress/<?= $loc->getId() ?>">Modifier</a>
        <a href="admin/supprAddress/<?= $loc->getId() ?>">Supprimer</a>
    
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

<a href="<?= base_url('Admin/DeleteUser/' . $user->getId()) ?>">Supprimer l'utilisateur</a>


<!-- admin/stock/view/content --->
