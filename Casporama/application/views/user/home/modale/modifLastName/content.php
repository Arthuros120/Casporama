<!--- user/home/modale/modifLastName/content -->


<h1>Changement du nom de famille</h1>

<h2>Veuillez entrer le nouveau nom de famille</h2>

<p>Votre nom actuel: <?= $user->getCoordonnees()->getNom() ?></p>

<form id="modifForm" accept-charset="utf-8">

    <input type="text" id="newLastName" placeholder="Nouveau nom de famille" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="<?= base_url('User/home/info'); ?>">
        <p>Annuler</p>
    </a>

</form>

<!-- user/home/modale/modifLastName/content -->
