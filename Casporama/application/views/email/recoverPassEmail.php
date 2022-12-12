<!-- email/recoverPassEmail -->
<!DOCTYPE>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<h1>Bonjour <?= $user->getCoordonnees()->getNom() ?> <?= $user->getCoordonnees()->getPrenom() ?></h1>

<p> Voici le lien pour réinitialiser votre mot de passe :
    <a href="<?= base_url() ?>user/recoverPass?idKey=<?= $idKey ?>&code=<?= $key ?>">Cliquez ici</a></p>

<p> Code de vérification : <?= $key ?></p>
<p> Ce code est valable 1 heure</p>
<p> Le lien expire le : <?= $dateExpiration ?></p>
<p> Si vous n'avez pas demandé à réinitialiser votre mot de passe sur Casporama, veuillez ignorer ce mail</p>

</body>
</html>

<!-- email/recoverPassEmail -->
