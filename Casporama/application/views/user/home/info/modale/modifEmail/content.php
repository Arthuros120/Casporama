<!--- user/home/modale/modifEmail/content -->


<h1>Changement de votre email</h1>

<h2>Veuillez entrer la nouvelle addresse email</h2>

<p>Votre email actuel: <?= $user->getCoordonnees()->getEmail() ?></p>

<form id="modifForm" accept-charset="utf-8">

    <input type="email" id="newEmail" placeholder="Nouvelle email" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="javascript:history.back()">
        <p>Annuler</p>
    </a>

</form>

<!-- user/home/modale/modifEmail/content -->
