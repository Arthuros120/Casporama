<!-- user/login/loginContent -->

<div class="error"><?= $error ?></div>

<?php echo form_open('User/login'); ?>

<h5>Login :</h5>
<input type="text" name="login" value="" size="20" />

<h5>Password :</h5>
<input type="text" name="password" value="" size="20" />

<h5>Rester connecté :</h5>
<input type="checkbox" name="conPersistance"/>

<div><input type="submit" value="Se connecter" /></div>

<!-- user/login/loginContent -->