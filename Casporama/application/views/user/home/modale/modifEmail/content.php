<!--- user/home/modale/modifEmail/content -->


<h1>Changement de votre email</h1>

<h2>Veuillez entrer la nouvelle addresse email</h2>

<p>Votre email actuel: <?= $user->getCoordonnees()->getEmail() ?></p>

<form id="modifForm" accept-charset="utf-8">

    <input type="text" id="newEmail" placeholder="Nouvelle email" required />

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


<!-- user/home/modale/modifEmail/content -->
