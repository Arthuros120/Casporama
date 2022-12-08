<!-- user/verify/content -->

<h1>Veuillez entrez le code de verification </h1>

<?php echo form_open('User/verify?idKey=' . $idKey); ?>

<input type="text" name="code" value="" placeholder="Code d'activation" />
<input type="submit" name="submit" value="Valider" />

<?php echo form_close(); ?>

<?= $error ?>

<!-- user/verify/content -->
