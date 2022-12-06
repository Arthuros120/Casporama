<!-- user/home/modale/supprUser/content -->

<h1>Suppresion de votre compte  ?></h1>

<h2>Veuillez entrer votre login pour supprimer votre compte</h2>

<p>Votre login : <?= $user->getLogin() ?></p>

<form id="supprUser" accept-charset="utf-8">

    <input type="text" id="sameLogin" placeholder="Votre login" required />

    <button type="submit">Valider</button>

    <a class="close-button" href="javascript:history.back()">
        <p>Annuler</p>
    </a>

</form>

<!-- user/home/modale/supprUser/content -->
