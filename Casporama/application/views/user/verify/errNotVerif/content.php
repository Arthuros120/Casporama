<!-- user/verify/errNotVerif/content -->

<h1> Votre compte n'est pas encore vérifié </h1>

<p> Bonjour <?= $user->getCoordonnees()->getPrenom(); ?> <?= $user->getCoordonnees()->getNom() ?>, </p>

<p>Vous avez reçu un email de confirmation d'inscription à l'email suivant: <?=$user->getCoordonnees()->getEmail()?></p>

<p> Veuillez cliquer sur le lien de confirmation et entrer le code pour activer votre compte. </p>

<p> Si vous n'avez pas reçu cet email, vous pouvez le demander à nouveau en cliquant sur le lien ci-dessous. </p>


<p> <a href="<?php echo site_url('User/sendVerify'); ?>"> Renvoyer l'email de confirmation </a> </p>

<!-- user/verify/errNotVerif/con<tent -->
