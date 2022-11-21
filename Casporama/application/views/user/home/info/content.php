<!-- user/home/info/content -->

<a href="<?= base_url() ?>">

    <img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" />

</a></br>

<h1>Information de connexion</h1>

<?php

$status = $user->getStatus();

if ($status == "Administrateur") {

    echo '<img src="' . base_url() . 'static/image/icon/castor/AdminCastor.svg" alt="Administrateur" />';
} elseif ($status == "Caspor") {

    echo '<img src="' . base_url() . 'static/image/icon/castor/Caspor.svg" alt="Caspor" />';
} elseif ($status == "Client") {

    echo '<img src="' . base_url() . 'static/image/icon/castor/castor.png" alt="Castor" />';
} else {

    // Todo: Voir ce cas
    echo "Votre compte est en attente de validation";
}

?>

<p>

    <span class="label">Login :</span>

    <span class="value"><?= $user->getLogin() ?></span>

    <br>

    <span class="label">Mots de passe : ●●●●●●●●●</span>

    <a href="<?= base_url('User/home/modifPass'); ?>">Modifier</a></br>

</p>

<!-- Todo: Faire le logo du castor pour le status -->

<h1>Information de l'utilisateur</h1>

<p>

    <span class="label">Nom :</span>

    <span class="value"><?= $user->getCoordonnees()->getNom() ?></span>
    <a href="<?= base_url('User/home/modifLastName'); ?>">Modifier</a>

    <br>

    <span class="label">Prénom :</span>

    <span class="value"><?= $user->getCoordonnees()->getPrenom() ?></span>
    <a href="<?= base_url('User/home/modifFirstName'); ?>">Modifier</a>

    <br>

    <span class="label">Email :</span>

    <span class="value"><?= $user->getCoordonnees()->getEmail() ?></span>
    <a href="<?= base_url('User/home/modifEmail'); ?>">Modifier</a>

    <br>

    <span class="label">Téléphone mobile :</span>

    <span class="value"><?= $user->getCoordonnees()->getTelephone() ?></span>
    <a href="<?= base_url('User/home/modifMobile'); ?>">Modifier</a>

    <br>

    <span class="label">Téléphone fixe :</span>

    <span class="value"><?= $user->getCoordonnees()->getFixe() ?></span>
    <a href="<?= base_url('User/home/modifFixe'); ?>">Modifier</a>


</p>

<h1>Vos address</h1>

<div class="cards">

    <?php

    if (isset($listLoc)) {

        foreach ($listLoc as $localisation) {  ?>

            <div class="card">

                <p>

                    <span class="label">Adresse :</span>

                    <span class="value"><?=

                        $localisation->getAdresse()['number'] . " " . $localisation->getAdresse()['street']

                    ?></span>

                    <br>

                    <span class="label">Code postal :</span>

                    <span class="value"><?= $localisation->getCodePostal() ?></span>

                    <br>

                    <span class="label">Ville :</span>

                    <span class="value"><?= $localisation->getCity() ?></span>

                    <br>

                    <span class="label">Département :</span>

                    <span class="value"><?= $localisation->getDepartment() ?></span>

                    <br>

                    <span class="label">Pays :</span>

                    <span class="value"><?= $localisation->getCountry() ?></span>

                    <br>

                    <a href="<?= base_url('User/home/modifAddress/') . $localisation->getId(); ?>">Modifier</a>

                    <a href="<?= base_url('User/home/supprAddress/') . $localisation->getId(); ?>">Supprimer</a>

                </p>

                <div class="card-map">

                    <?php

                    if ($localisation->getLatitude() != null && $localisation->getLongitude() != null) { ?>

                        <div id="map<?= $localisation->getId() ?>" class="map"></div>

                    <?php } else { ?>

                        <p> Aucune localisation n'a été trouvé pour cette adresse </p>

                    <?php } ?>

                </div>

            </div>

    <?php }
    } else {

        echo ' <div class="card"><p>Vous n\'avez pas d\'adresse enregistré<p></div>';
    }

    ?>

    <div class="card">

        <a href="<?= base_url('User/home/addAddress'); ?>">Ajouter une adresse</a>
    
    </div>

</div>

</div>

<!-- user/home/info/content -->
