<!--- user/home/modale/modifFixe/content -->


<h1>Changement de votre numéro de téléphone fixe/h1>

<h2>Veuillez entrer le nouveau numéro de téléphone fixe</h2>

<p>Votre prénom actuel: <?= $user->getCoordonnees()->getFixe() ?></p>

<form id="modifForm" accept-charset="utf-8">

    <input type="tel" id="newFixe" placeholder="Nouveau numéro de téléphone fixe" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="<?= base_url('User/home/info'); ?>">
        <p>Annuler</p>
    </a>

</form>

<!-- user/home/modale/modifFixe/content -->
