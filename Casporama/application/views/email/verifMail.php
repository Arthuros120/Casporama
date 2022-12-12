<!-- email/verifMail -->
<!DOCTYPE>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<h1>Bonjour <?= $user->getCoordonnees()->getNom() ?> <?= $user->getCoordonnees()->getPrenom() ?></h1>

<p> Il est important de vérifier votre adresse mail pour activer votre compte</p>
<p> Voici le lien et le code de vérification pour activer vortre compte :</p>
<p> Lien de vérification : <a href="<?= base_url() ?>user/verify?idKey=<?= $idKey ?>">Cliquez ici</a></p>
<p> Code de vérification : <?= $key ?></p>
<p> Ce code est valable 6 heures</p>
<p> Le lien expire le : <?= $dateExpiration ?></p>
<p> Si vous n'avez pas demandé à créer un compte sur Casporama, veuillez ignorer ce mail</p>


</body>
</html>

<!-- email/verifMail -->
