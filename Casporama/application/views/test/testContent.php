<!-- test/testContent -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <!-- Nous chargeons les fichiers CDN de Leaflet. Le CSS AVANT le JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin="" />
    <style type="text/css">
        .map {
            /* la carte DOIT avoir une hauteur sinon elle n'apparaît pas */
            height: 400px;
            width: 400px;
        }
    </style>
    <title>Carte</title>
</head>

<body>
    <?php foreach ($dataMap as $key => $value) { if ($value != null) { ?>

        <div class="map" id="map<?= $key ?>"></div>

    <?php
    
        } else {

            echo "<p> L'adresse n'a pas été validé par l'API </p>";
            
        }
    }
    
    ?>

    <!-- Fichiers Javascript -->
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

    <script type="text/javascript">
        // Fonction d'initialisation de la carte
        function initMap(latitude, longitude, id) {

            var macarte = null;

            // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            macarte = L.map(id).setView([latitude, longitude], 16);

            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut.
            //Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 10,
                maxZoom: 20
            }).addTo(macarte);

            var marker = L.marker([latitude, longitude]).addTo(macarte);

        }

        window.onload = function() {

        <?php foreach ($dataMap as $key => $value) { if ($value != null) { ?>

            initMap(<?= $value['lat']; ?>, <?= $value['lng']; ?>, 'map<?= $key ?>');
        
        <?php
 
            }
        }

        ?>

        };
    </script>
</body>

</html>

<!-- test/testContent -->
