<!-- admin/user/supprAddress/request/content -->
<h1> Supprimer une addresse </h1>
<h2> Vous vous apprêtez à supprimer l'addresse de l'utilisateur suivant : </h2>

<p> Login: <?= $user->getLogin() ?></p>

<p> Nom: <?= $user->getCoordonnees()->getNom() ?></p>
<p> Prénom: <?= $user->getCoordonnees()->getPrenom() ?></p>
<p> Email: <?= $user->getCoordonnees()->getEmail() ?></p>

<h2> L'addresse en question: </h2>

<p>Adresse: <?= $location->getAdresse()['number'] ?> <?= $location->getAdresse()['street'] ?></p>
<p>Code postal: <?= $location->getCodePostal() ?></p>
<p>Ville: <?= $location->getCity() ?></p>
<p>Département: <?= $location->getDepartment() ?></p>
<p>Pays: <?= $location->getCountry() ?></p>

<p> Êtes-vous sûr de vouloir supprimer cette addresse ? </p>
<?php echo form_open('Admin/supprAddress/' . $location->getId()); ?>
<p> Non </p>
<label class="switch">
  <input id="switch" type="checkbox" name="switch">
  <span class="slider round"></span>
</label>
<p> Oui </p>

<input type="submit" id="submitButton" value="Ne pas supprimer l'addresse'">

<?php echo form_close(); ?>



<!-- admin/user/supprAddress/request/content -->
