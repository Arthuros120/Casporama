// Fonction d'initialisation de la carte
function initMapWithOneMarker(latitude, longitude, id) {

    let macarte = null;

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

    L.marker([latitude, longitude]).addTo(macarte);

}