<!-- admin/user/resetPass/error/content -->

<h1> Le mots de passe de l'utilisateur suivant:</h1>

<p> Login: <?= $user->getLogin() ?></p>

<p> Nom: <?= $user->getCoordonnees()->getNom() ?></p>
<p> Prénom: <?= $user->getCoordonnees()->getPrenom() ?></p>
<p> Email: <?= $user->getCoordonnees()->getEmail() ?></p>

<h1> n'a pas été reset </h1>

<!-- admin/user/resetPass/error/content -->
