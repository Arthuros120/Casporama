<!-- email/contact/toClient -->
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
                            <h1 style="font-size:2em ;">Bonjour <?= $name ?> <?= $firstname ?></h1>
                        </td>
                    </tr>
                    <tr align="center">
                       <td style="line-height:1 ;" align="center">
                           <p style="color:black;">Votre demande de contact a été traité avec succès</p>
                           <p style="color:black;">L'object de votre demande: <?= $object ?></p>
                           <p style="color:black;">Votre message: <?= $message ?></p>
                           <p style="color:red;">Si vous n'ếtes pas à l'initiative de cette demande, veuillez imédiatement contacté le support !</p>
                           </p>
                       </td>
                   </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!-- email/contact/toClient -->
