<!-- user/login/loginContent -->

<?php echo form_open('User/login'); ?>

<div class="login-card">
    <a href="<?= base_url() ?>"><img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" /></a>

    <h2>Connexion</h2>

    <div class="login-form">
        <input type="text" name="login" placeholder="Login ou Email" />
        <input type="password" name="password" placeholder="Mots de passe" />

        <a href="<?= base_url("/User/recoverPass") ?>">Mots de passe oublié ?</a>
        
        <h4>Rester connecté :<input id="checkBox" type="checkbox" name="conPersistance" /></h4>
        <button type="submit">Se connecter</button>
        <a id="registerLink" href="<?= base_url("/User/register") ?>">Créer un compte</a>
    </div>
</div>

    <?php if ($error == null) {
            echo "hidden";
        }?>>
    <?= $error ?>


<!-- user/login/loginContent -->
