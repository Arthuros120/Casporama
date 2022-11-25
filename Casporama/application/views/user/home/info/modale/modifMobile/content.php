<!--- user/home/modale/modifMobile/content -->


<h1>Changement de votre numéro de téléphone</h1>

<h2>Veuillez entrer le nouveau numéro de téléphone</h2>

<p>Votre numéro de téléphone actuel: <?= $user->getCoordonnees()->getTelephone() ?></p>

<form id="modifForm" accept-charset="utf-8">

    <input type="tel" id="newMobile" placeholder="Nouveau numéro de téléphone" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="<?= base_url('User/home/info'); ?>">
        <p>Annuler</p>
    </a>

</form>

<!-- user/home/modale/modifMobile/content -->
