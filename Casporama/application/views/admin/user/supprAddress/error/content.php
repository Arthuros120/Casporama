<!-- admin/user/supprAddress/error/content -->

<h1> L'addresse de l'utilisateur suivant:</h1>

<p> Login: <?= $user->getLogin() ?></p>

<p> Nom: <?= $user->getCoordonnees()->getNom() ?></p>
<p> Prénom: <?= $user->getCoordonnees()->getPrenom() ?></p>
<p> Email: <?= $user->getCoordonnees()->getEmail() ?></p>

<h1> L'addresse en question: </h1>

<p>Adresse: <?= $location->getAdresse()['number'] ?> <?= $location->getAdresse()['street'] ?></p>
<p>Code postal: <?= $location->getCodePostal() ?></p>
<p>Ville: <?= $location->getCity() ?></p>
<p>Département: <?= $location->getDepartment() ?></p>
<p>Pays: <?= $location->getCountry() ?></p>

<h1> n'a pas pu être supprimée </h1>

<!-- admin/user/supprAddress/error/content -->
