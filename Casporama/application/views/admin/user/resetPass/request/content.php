<!-- admin/user/resetPass/request/content -->
<h1> Reset le mots de passe d'un utilisateir</h1>
<h2> Vous vous apprêtez à reset le mots de passe de l'utilisateur suivant : </h2>

<p> Login: <?= $user->getLogin() ?></p>

<p> Nom: <?= $user->getCoordonnees()->getNom() ?></p>
<p> Prénom: <?= $user->getCoordonnees()->getPrenom() ?></p>
<p> Email: <?= $user->getCoordonnees()->getEmail() ?></p>

<p> Êtes-vous sûr de vouloir supprimer cette addresse ? </p>
<?php echo form_open('Admin/resetPass/' . $user->getId()); ?>
<p> Non </p>
<label class="switch">
  <input id="switch" type="checkbox" name="switch">
  <span class="slider round"></span>
</label>
<p> Oui </p>

<input type="submit" id="submitButton" value="Ne pas reset le mots de passe'">

<?php echo form_close(); ?>



<!-- admin/user/resetPass/request/content -->
