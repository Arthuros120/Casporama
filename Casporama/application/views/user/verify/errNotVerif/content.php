<!-- user/verify/errNotVerif/conntent -->

<div class="verify_account_content">
    <div class="verify_title">
        <div class="verify_title_main">
            <h1><span class="green">O</span><span class="blue">o</span><span class="yellow">p</span><span class="red">s</span>, </h1>
            <h1> votre compte n'est pas encore vérifié. </h1>
        </div>
    </div>
    <div class="verify_content">
        <div class="verify_content_title">
            <p> Bonjour <span><?= $user->getCoordonnees()->getPrenom(); ?> <?= $user->getCoordonnees()->getNom() ?></span>, </p>
        </div>
        <div class="verify_content_p">
            <p>Vous avez reçu un email de confirmation d'inscription à l'email suivant: <span><?=$user->getCoordonnees()->getEmail()?><span></p>
            <p> Veuillez cliquer sur le lien de confirmation pour activer votre compte. </p>
            <p> Si vous n'avez pas reçu cet email, vous pouvez le demander à nouveau en cliquant sur le lien ci-dessous. </p>
            <p> <a href="<?php echo site_url('User/sendVerify'); ?>"> Renvoyer l'email de confirmation </a> </p>
            <p> Si vous ne valider pas votre compte dans les 24 heures, votre compte sera supprimé. </p>
        </div>
    </div>
    <div class="verify_redirect">
        <p>Vous allez être automatique redirigé vers la page d'accueil dans <span id='time'>30 secondes</span></p>
    </div>
</div>

<!-- user/verify/errNotVerif/conntent -->
