<!-- email/contact/toAdmin -->
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
                            <h1 style="font-size:2em ;">Demande de contact</h1>
                        </td>
                    </tr>
                    <tr align="center">
                       <td style="line-height:1 ;" align="center">
                           <p style="color:black;">une demande de contact a été demandé par <?= $name ?> <?= $firstname ?></p>
                           <p style="color:black;">a l'addresse suivant <a href="mailto:<?= $email ?>"><?= $email ?></a></p>
                           <p style="color:black;">L'object de la demande: <?= $object ?></p>
                           <p style="color:black;">Le message: <?= $message ?></p>
                           </p>
                       </td>
                   </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!-- email/contact/toAdmin -->
