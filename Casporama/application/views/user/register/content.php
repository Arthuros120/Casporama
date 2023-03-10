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
        <div class="title">
            <h2>Inscription</h2>
        </div>
        <div class="form">
            <div class="login">
                <input class="input" type="text" name="login" placeholder="Votre login" />
            </div>
            <div class="email">
                <input class="input" type="email" name="email" placeholder="Votre email" />
            </div>
            <div class="pass">
                <input class="input" type="password" name="password" placeholder="Mots de passe" />
                <input class="input" type="password" name="passConf" autocomplete="off" placeholder="Comfiramtion du Mots de passe" />
            </div>
            <?php if ($captcha_form) { ?>
                <div class="captcha">
                    <p><?php echo $captcha_html; ?></p>
                </div>
                <input class="input" name="not_robot" id="not_robot" type="text" placeholder="Rentrer le captcha" />
            <?php } ?>
            <button class="submit" type="submit">Suivant</button>
        </div>

    </div>

    <div class="register_error_content" 
        <?php
            if ($error == null) {
                echo "hidden";
            }?>>
        <?php foreach ($error as $msg_error) { ?>
            <div class="register_error">
                <div class="img_error">
                    <img src="<?= base_url() . "static/image/icon/error_white.svg"?>">
                </div>
                <div class="msg_error">
                    <h3><?= $msg_error ?></h3>
                </div>
            </div>
        <?php }?>
    </div>

</div>



<!-- user/register/Content -->
