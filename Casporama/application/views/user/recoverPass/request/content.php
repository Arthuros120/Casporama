<!-- user/recoverPass/request/content -->

<div class="request_password_content">
    <div class="request_password_backward">
        <a href="<?php base_url() ?>/User/login">
        <img alt="fleche arriere" src="<?php base_url() ?>/static/image/icon/arrow.svg"></a>
    </div>
    <div class="request_password_title">
        <h1><span class="keyword_title">O</span><span class="keyword_title">o</span><span class="keyword_title">p</span><span class="keyword_title">s</span>, mot de passe oublié</h1>
    </div>
    <div class="request_password">
        <h3>Entrez votre email pour recevoir un mail afin de réinitialiser votre mot de passe</h3>
        <?php echo form_open('User/recoverPass'); ?>
            <input type="email" name="email" placeholder="Email" />
            <input type="submit" value="Validé" />
        <?php echo form_close(); ?>
    </div>

    <div class="request_password_error" <?php if ($error == null) {echo " style='display:none'";}?>>
        <h3><?= $error ?></h3>
        <img src="<?= base_url() ?>static/image/icon/error_white.svg" alt="error_white" >
    </div>
</div>

<!-- user/recoverPass/request/content -->
