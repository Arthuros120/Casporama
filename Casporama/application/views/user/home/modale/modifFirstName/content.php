<!--- user/home/modale/modifFirstName/content -->


<h1>Changement de votre prénom</h1>

<h2>Veuillez entrer le nouveau prénom</h2>

<p>Votre prénom actuel: <?= $user->getCoordonnees()->getPrenom() ?></p>

<form id="modifForm" accept-charset="utf-8">

    <input type="text" id="newFirstName" placeholder="Nouveau prénom" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="<?= base_url('User/home/info'); ?>">
        <p>Annuler</p>
    </a>

</form>

<div class="error" <?php

                    if ($error == null) {
                        echo "hidden";
                    }

                    ?>><?= $error ?>
</div>


<!-- user/home/modale/modifFirstName/content -->
