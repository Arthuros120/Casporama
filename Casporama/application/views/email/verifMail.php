<!-- email/verifMail -->
<!DOCTYPE>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:50%;border-collapse:collapse;border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center">
                            <img src="https://casporama.live/static/image/casporama.png" alt="Logo" />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0; line-height:1;">
                            <h1 style="font-size:2em ;">Bonjour <?= $user->getCoordonnees()->getPrenom() ?> <?= $user->getCoordonnees()->getNom() ?></h1>
                            <p>Il est important de vérifier votre adresse mail pour activer votre compte</p>
                            <p>Voici le lien et le code de vérification pour activer vortre compte :</p>
                        </td>
                    </tr>
                    <tr align="center">
                        <table style="width: 30%;">
                            <tr>
                                <td align="center" style="padding:10 ; background:black">
                                    <a style="text-decoration:none ;" href="<?= base_url() ?>user/verify?idKey=<?= $idKey ?>"><p style="color:white; font-weight:600;">Cliquez ici</p></a>
                                </td>
                            </tr>
                        </table>
                    </tr>
                    <tr>
                        <td align="center" style="padding:25;">
                            <h2><?= $key ?></h2>
                        </td>
                    </tr>
                    <tr align="center">
                       <td style="line-height:1 ;" align="center">
                           <p style="color:lightgrey;"> Ce code est valable 6 heures
                           <p style="color:lightgrey;">Le lien expire le : <?= $dateExpiration ?></p>
                           <p style="color:lightgrey;">Si vous n'avez pas demandé à créer un compte sur Casporama, veuillez ignorer ce mail</p>
                           </p>
                       </td>
                   </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!-- email/verifMail -->
