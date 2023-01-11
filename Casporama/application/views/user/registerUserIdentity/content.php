<!-- user/registerUserIdentity/Content -->

<?php echo form_open('User/registerUserIdentity'); ?>

<div class="register_content">

    <div class="register_box2">
        <div class="logo">
            <a href="<?= base_url() ?>">
                <img
                src="<?= base_url() . "static/image/icon/casporama.svg" ?>"
                alt="Casporama" />
            </a>
        </div>
        <div class="title">
            <h2>Confirmer l'inscription</h2>
        </div>
        <div class="form">
            <div class="name">
                <input class="input" type="text" name="prenom" placeholder="Votre prénom*" />
                <input class="input" type="text" name="nom" placeholder="Votre nom*" />
            </div>
            <div class="phone">
                <input class="input" type="phone" name="mobilePhone" placeholder="Votre téléphone mobile*" />
                <input class="input" type="phone" name="fixePhone" placeholder="Votre téléphone fixe" />
            </div>
            <button class="submit" type="submit">Créer le compte</button>
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

<!-- user/registerUserIdentity/Content -->
