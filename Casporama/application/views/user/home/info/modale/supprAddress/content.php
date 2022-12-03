<!-- user/home/modale/supprAddress/content -->

<h1>Suppresion de l'addresse: <?= $address->getName()  ?></h1>

<h2>Veuillez entrer le nom de l'addresse pour supprimé celle ci</h2>

<p>Nom de l'addresse actuel: <?= $address->getName() ?></p>

<form id="supprAddress" accept-charset="utf-8">

    <input type="text" id="sameName" placeholder="Nom de l'addresse" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="javascript:history.back()">
        <p>Annuler</p>
    </a>

</form>

<!-- user/home/modale/supprAddress/content -->
