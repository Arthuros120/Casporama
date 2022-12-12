<!-- user/recoverPass/modif/content -->

<h1>Recover your password</h1>

<p> Veuillez entrez le code de vérification que vous avez reçu par mail et changer votre mots de passe</p>

<?php echo form_open('User/recoverPass?idKey=' . $idKey); ?>

<input type="text" name="code" placeholder="Code de vérification" <?php if (isset($idKey)) {
    echo "value='" . $code . "'";
} ?>
/>

<input type="password" name="password" placeholder="Nouveau mot de passe" />

<input type="password" name="passConf" placeholder="Confirmer le mot de passe" />

<input type="submit" value="Validé" />

<?php echo form_close(); ?>

<div class="error" <?php

                    if ($error == null) {
                        echo "hidden";
                    }

                    ?>><?= $error ?>
</div>

<!-- user/recoverPass/modif/content -->
