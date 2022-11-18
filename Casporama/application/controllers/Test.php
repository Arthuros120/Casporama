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

        $addr1 = new LocalisationEntity();

        // * On hydrate l'objet
        $addr1->setId(18900);
        $addr1->setAdresse("11;Rue des ecachoirs");
        $addr1->setCodePostal("44000");
        $addr1->setVille("Nantes");
        $addr1->setPays("France");
        $addr1->setDepartement("Loire Atlantique");

        $addr2 = new LocalisationEntity();

        // * On hydrate l'objet
        $addr2->setId(18901);
        $addr2->setAdresse("190;Boulevard Jules Vernes");
        $addr2->setCodePostal("44300");
        $addr2->setVille("Nantes");
        $addr2->setPays("France");
        $addr2->setDepartement("Loire Atlantique");

        $addr3 = new LocalisationEntity();

        // * On hydrate l'objet
        $addr3->setId(18789);
        $addr3->setAdresse("22;Rue Des Bergeronette");
        $addr3->setCodePostal("44210");
        $addr3->setVille("Pornic");
        $addr3->setPays("France");
        $addr3->setDepartement("Loire Atlantique");

        $listAddrr = array($addr1, $addr2, $addr3);

        foreach ($listAddrr as $value) {
            
            $linkGouvApi = "https://api-adresse.data.gouv.fr/search/?q=";

            $addresse = explode(";", $value->getAdresse());
            $numero = $addresse[0];
            $rue = explode(" ", $addresse[1]);

            $linkGouvApi = $linkGouvApi . $numero . "+";

            foreach ($rue as $addrValue) {

                $linkGouvApi = $linkGouvApi . strtolower($addrValue) . "+";

            }

            $linkGouvApi = substr($linkGouvApi, 0, -1);

            $linkGouvApi = $linkGouvApi . "&postcode=" . $value->getCodePostal();

            // mettre le contenu du fichier dans une variable
            $data = file_get_contents($linkGouvApi);
            // décoder le flux JSON
            $jsonObj = json_decode($data);

            foreach ($jsonObj->features as $value) {

                if ($value->properties->score > 0.8) {

                    echo "Accept - (";
                    echo $value->properties->score . " - ";
                    echo $value->properties->postcode . " - ";
                    echo ") ";

                } else {

                    echo "Reject - (";
                    echo $value->properties->score . " - ";
                    echo $value->properties->postcode . " - ";
                    echo ") ";

                }
            }
        }
        
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
