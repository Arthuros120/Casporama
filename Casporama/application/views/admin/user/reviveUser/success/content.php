<!-- admin/user/reviveUser/success/content -->

<h1> L'utilisateur suivant: </h1>

<p> Login: <?= $user->getLogin() ?></p>

<p> Nom: <?= $user->getCoordonnees()->getNom() ?></p>
<p> Prénom: <?= $user->getCoordonnees()->getPrenom() ?></p>
<p> Email: <?= $user->getCoordonnees()->getEmail() ?></p>

<h1> a bien été résucité </h1>

<!-- admin/user/reviveUser/success/content -->
