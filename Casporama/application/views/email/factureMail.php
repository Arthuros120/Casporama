<!-- email/factureMail -->
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
                        </td>
                    </tr>
                    <tr align="center">
                       <td style="line-height:1 ;" align="center">
                           <p style="color:lightgrey;"> Voici ci-joint votre Facture correspondant à
                           <p style="color:lightgrey;">La commande n° <?= $idorder ?></p>
                           <p style="color:lightgrey;">Vous pouvez également la retrouver dans vos commandes, dans votre panneau utilisateur</p>
                           </p>
                       </td>
                   </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!-- email/factureMail -->
