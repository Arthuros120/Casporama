<!-- user/register/Content -->

<?php echo form_open('User/register'); ?>

<div class="register_content">

    <div class="register_box">
        <div class="logo">
            <a href="<?= base_url() ?>">
                <img 
                src="<?= base_url() . "static/image/icon/casporama.svg" ?>" 
                alt="Casporama" />
            </a>
        </div>
        <div class="form">
            <div class="name">
                <h3>Nom</h3>
                <div class="inName">
                    <input class="input" type="text" name="Surname" placeholder="Name" />
                    <input class="input" type="text" name="Firstname" placeholder="First Name" />
                </div>
            </div>
            <div class="login">
                <input class="input" type="text" name="login" placeholder="Votre login" />
            </div>
            <div class="email">
                <input class="input" type="email" name="email" placeholder="Votre email" />
                <input class="input" type="email" name="emailConf" autocomplete="off" placeholder="Comfirmation de l'email" />
            </div>
            <div class="pass">
                <input class="input" type="password" name="password" placeholder="Mots de passe" />
                <input class="input" type="password" name="passConf" autocomplete="off" placeholder="Comfiramtion du Mots de passe" />
            </div>
        </div>

    </div>

</div>

<!-- 

<h2>Creation de compte</h2>



<?php if ($captcha_form) { ?>
    <p>Captcha : <input name="not_robot" id="not_robot" type="text" /></p>
    <p><?php echo $captcha_html; ?></p>
<?php } ?>

<button type="submit">Suivant</button>

<div class="error" 
    <?php
        if ($error == null) {
            echo "hidden";
        }?>>
    <?= $error ?>
</div> -->

<!-- user/register/Content -->
