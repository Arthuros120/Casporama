<?php

/*

    * Test Controller

    * C'est ici que je teste les fonctions de mon site
    * a terme elle ne sera pas accessible par l'utilisateur

*/
class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(false);
    }

    public function index()
    {
        
        // chemin d'accès à votre fichier JSON
        $linkGouvApi = 'https://api-adresse.data.gouv.fr/search/?q=190+Boulevard+Jules+Vernes&postcode=44300';
        // mettre le contenu du fichier dans une variable
        $data = file_get_contents($linkGouvApi);
        // décoder le flux JSON
        $jsonObj = json_decode($data);
    // accéder à l'élément approprié
        $long = $jsonObj->features[0]->geometry->coordinates[0];
        $lat = $jsonObj->features[0]->geometry->coordinates[1];

        $listLong = array($long, -1.5, 0, 1.5, 2.5);
        $listLat = array($lat, 47.5, 48, 48.5, 49);

        $dataContent = array(
            'latitude' => $listLat,
            'longitude' => $listLong
        );

        $data = array(
            'content' => $dataContent
        );

        $this->LoaderView->load('Test/index', $data);
    }

}
