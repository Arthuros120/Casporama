<!-- user/register/Content -->

<?php echo form_open('User/register'); ?>
<a href="<?= base_url() ?>">

    <img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" />

</a>

<h2>Creation de compte</h2>

<input type="text" name="login" placeholder="Votre login" />

<input type="email" name="email" placeholder="Votre email" />

<input type="email" name="emailConf" autocomplete="off" placeholder="Comfirmation de l'email" />

<input type="password" name="password" placeholder="Mots de passe" />

<input type="password" name="passConf" autocomplete="off" placeholder="Comfiramtion du Mots de passe" />

<?php
if ($captcha_form) {
?>
    <p>Captcha : <input name="not_robot" id="not_robot" type="text" /></p>
    <p><?php echo $captcha_html; ?></p>
<?php
}
?>

<button type="submit">Se connecter</button>

<div class="error" <?php

                    if ($error == null) {
                        echo "hidden";
                    }

                    ?>><?= $error ?>
</div>

<!-- user/register/Content -->