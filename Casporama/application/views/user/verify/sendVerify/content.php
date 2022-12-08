<!-- user/verify/sendVerify/content -->

<div class="verify_account_content">

    <div class="verify_title">
        <div class="verify_title_main">
            <h1> Un email vient de vous être envoyé</h1>
        </div>
        <p>Vous avez reçu un email de confirmation d'inscription à l'email suivant: <?=$user->getCoordonnees()->getEmail()?></p>
    </div>

    <div class="verify_content">
        <p> Veuillez cliquer sur le lien de confirmation et entrer le code pour activer votre compte. </p>
        <p> Si vous n'avez pas reçu cet email, vous pouvez le demander à nouveau en cliquant sur le lien ci-dessous. </p>
        <p> <a href="<?php echo site_url('User/sendVerify'); ?>"> Renvoyer l'email de confirmation </a> </p>
    </div>

</div>

<!-- user/verify/sendVerify/content -->
