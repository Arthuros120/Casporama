<?php

    defined('BASEPATH') || exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://casporama.live/static/css/fonts.css">
<link rel="stylesheet" href="https://casporama.live/static/css/global/color.css">

<head>
    <meta charset="utf-8">
    <title>404 Page non trouvée</title>
    <style type="text/css">
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;

            font-family: Poppins, Arial, sans-serif;
        }

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
        }

        p {
            margin: 12px 15px 12px 15px;
        }

        .error_content {
            width: 100vw;
            height: 100vh;
        }

        .logo {
            width: 100vw;
            height: 10vh;

            display: flex;
            justify-content: flex-start;
            align-items: center;

            padding-left: 2vw;
        }

        .content {
            width: 100%;
            height: 90vh;

            display: flex;
            flex-direction: column;
            align-items: center;

            padding-top: 10vh;
        }

        .content > h1 {
            font-size: 12vw;
            font-weight: 600;

        }

        .vert {
            color: var(--green2)
        }

    </style>

</head>

<body>

    <div  class="error_content" id="container">


        <div class="logo">
            <img src="https://casporama.live/static/image/icon/casporama.svg">
        </div>

        <div class="content">
            <h1><span class="vert">O</span><span class="bleu">o</span><span class="jaune">p</span><span class="rouge">s</span></h1>
            <h2><?php echo $heading; ?></h2>
            <h2><?php echo $message; ?></h2>
            <h3>Vous allez être automatique redirigé vers la page d'accueil dans <span id='time'>10 secondes</span></h3>
        </div>

        

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