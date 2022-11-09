<?php

    defined('BASEPATH') || exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://casporama.live/static/css/fonts.css">
<link rel="stylesheet" href="https://casporama.live/static/css/global/color.css">
<link rel="icon" type="image/svg" sizes="16x16" href="https://casporama.live/static/image/icon/favicon.svg">

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
            gap: 6vh;
        }

        .title {
            display: flex;
            flex-direction: column;
        }

        .content > .title > h1 {
            font-size: 12vw;
            font-weight: 600;

        }

        .p {
            display: flex;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            gap: 1vh;
        }

        .p > h3 {
            color: #b3b5ba;
        }

        .vert {
            color:#399B39;
        }

        .bleu {
            color: #3284E4;
        }

        .jaune {
            color: #E0C323;
        }

        .rouge {
            color: #E94138;
        }

    </style>

</head>

<body>

    <div  class="error_content" id="container">


        <div class="logo">
            <a href="/"><img src="https://casporama.live/static/image/icon/casporama.svg"></a>
        </div>

        <div class="content">
            <div class="title">
                <h1><span class="vert">O</span><span class="bleu">o</span><span class="jaune">p</span><span class="rouge">s</span></h1>
            </div>
            <div class="p">
                <h2>Erreur 404 Page Introuvable</h2>
                <h2>La page que vous avez demandée est introuvable.</h2>
                <h3>Vous allez être automatique redirigé vers la page d'accueil dans <span id='time'>10 secondes</span></h3>
            </div>
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