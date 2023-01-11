<!-- admin/user/reviveUser/request/content -->
<h1> Résucité l'utilisateur</h1>
<h2> Vous vous apprêtez à résucité l'utilisateur suivant : </h2>

<p> Login: <?= $user->getLogin() ?></p>

<p> Nom: <?= $user->getCoordonnees()->getNom() ?></p>
<p> Prénom: <?= $user->getCoordonnees()->getPrenom() ?></p>
<p> Email: <?= $user->getCoordonnees()->getEmail() ?></p>

<p> Êtes-vous sûr de vouloir résucité cette utilisateur ? </p>
<?php echo form_open('Admin/reviveUser/' . $user->getId()); ?>
<p> Non </p>
<label class="switch">
  <input id="switch" type="checkbox" name="switch">
  <span class="slider round"></span>
</label>
<p> Oui </p>

<input type="submit" id="submitButton" value="Ne pas résucité l'utilisateur'">

<?php echo form_close(); ?>



<!-- admin/user/reviveUser/request/content -->
