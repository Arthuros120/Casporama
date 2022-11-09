<?php

defined('BASEPATH') || exit('No direct script access allowed');

//TODO: Prévoir une redirection automatique au bout de 10 secondes

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>404 Page non trouvée</title>
    <style type="text/css">
        ::selection {
            background-color: #E13300;
            color: white;
        }

        ::-moz-selection {
            background-color: #E13300;
            color: white;
        }

        body {
            background-color: #fff;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }

        p {
            margin: 12px 15px 12px 15px;
        }
    </style>

</head>

<body>

    <div id="container">

        <h1><?php echo $heading; ?></h1>

        <?php echo $message; ?>

        <h3>Vous allez être automatique redirigé vers la page d'accueil dans <span id='time'>10 secondes</span></h3>

    </div>

    <script type="text/javascript">

        let decompte = 10;
        let prefixe = '';

        let timer = setInterval(

            function() {

                decompte--;

                if (decompte > 1) {

                    prefixe = ' secondes';

                } else {

                    prefixe = ' seconde';

                }

                document.getElementById('time').textContent = decompte + prefixe;

                if (decompte === 0) {

                    clearInterval(timer);
                    window.location.href = "/"; // URL de redirection

                }
            },

            1000

        );
    </script>

</body>

</html>