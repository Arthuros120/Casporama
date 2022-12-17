<!-- user/recoverPass/modif/content -->

<div class="modif_password_content">
    <div class="modif_password_title">
        <h1><span class="keyword_title">O</span><span class="keyword_title">o</span><span class="keyword_title">p</span><span class="keyword_title">s</span>, mot de passe oublié</h1>
    </div>
    <div class="modif_password">
        <h3> Veuillez entrez le code de vérification que vous avez reçu par mail et changer votre mots de passe</h3>
        <?php echo form_open('User/recoverPass?idKey=' . $idKey); ?>
                <input type="text" name="code" placeholder="Code de vérification" 
                    <?php if (isset($idKey)) {
                        echo "value='" . $code . "'";
                    } ?>
                />
                <input type="password" name="password" placeholder="Nouveau mot de passe" />
                <input type="password" name="passConf" placeholder="Confirmer le mot de passe" />
                <input type="submit" value="Validé" />
        <?php echo form_close(); ?>
    </div>
    <div class="modif_password_error" <?php if ($error == null) {echo "style='display:none'";}?>>
        <h3><?= $error ?></h3>
        <img src="<?= base_url() ?>static/image/icon/error_white.svg" alt="error_white">
    </div>
</div>










<!-- user/recoverPass/modif/content -->
