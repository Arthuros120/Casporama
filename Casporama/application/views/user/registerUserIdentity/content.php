<!-- user/registerUserIdentity/Content -->

<?php echo form_open('User/registerUserIdentity'); ?>

<a href="<?= base_url() ?>">

    <img src="<?= base_url() . "static/image/icon/casporama.svg" ?>" alt="Casporama" />

</a>

<h2>Finalisation de la création du compte</h2>

<input type="text" name="prenom" placeholder="Votre prénom" />

<input type="text" name="nom" placeholder="Votre nom" />

<input type="phone" name="mobilePhone" placeholder="Votre téléphone mobile" />

<input type="phone" name="fixePhone" placeholder="Votre téléphone fixe" />

<button type="submit">Créer le compte</button>

<div class="error" <?php

                    if ($error == null) {
                        echo "hidden";
                    }

                    ?>><?= $error ?>
</div>

<!-- user/registerUserIdentity/Content -->
