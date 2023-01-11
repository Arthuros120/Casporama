<!-- email/resetPass/mail -->

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
                        <td align="center" style="padding:0; line-height:1;">
                            <h1 style="font-size:2em ;">Bonjour <?= $user->getCoordonnees()->getPrenom() ?> <?= $user->getCoordonnees()->getNom() ?></h1>
                        </td>
                    </tr>
                    <tr align="center">
                       <td style="line-height:1 ;" align="center">
                           <p style="color:black;">Votre mots de passe a été reset pas un administrateur</p>
                           <p style="color:black;">Votre nouveau mots de passe: <?= $newPass ?></p>
                           <p style="color:red;">Si vous n'ếtes pas à l'initiative de cette demande, veuillez imédiatement contacté le support !</p>
                           <a style="color:blue;" href="<?= base_url('User/home/info') ?>"><p style="color:white; font-weight:600;">Votre compte</p></a>
                           </p>
                       </td>
                   </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!-- email/resetPass/mail -->
