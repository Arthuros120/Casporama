<!-- user/verify/errNotVerif/content -->

<h1> Votre compte n'est pas encore vérifié </h1>

<p> Bonjour <?= $user->getCoordonnees()->getPrenom(); ?> <?= $user->getCoordonnees()->getNom() ?>, </p>

<p>Vous avez reçu un email de confirmation d'inscription à l'email suivant: <?=$user->getCoordonnees()->getEmail()?></p>

<p> Veuillez cliquer sur le lien de confirmation pour activer votre compte. </p>

<p> Si vous n'avez pas reçu cet email, vous pouvez le demander à nouveau en cliquant sur le lien ci-dessous. </p>


// TODO: mettre le lien du resend de mail
<p> <a href="<?php echo site_url(''); ?>"> Renvoyer l'email de confirmation </a> </p>

<!-- user/verify/errNotVerif/con<tent -->
