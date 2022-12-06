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

        echo "Bienvenue sur la page de test";


    }

    public function progress()
    {

        $this->LoaderView->load('Test/progress');

    }

    public function modale()
    {

        $this->LoaderView->load('Test/modale');

    }

    public function DAO() {
        $this->load->model('DAO/DAO_CSV');

        $test = new DAO_CSV;

        $test->getAllData(1,'user');
    }

    public function map()
    {

        $this->load->model('LocationModel');

        $addr1 = new LocationEntity();

        // * On hydrate l'objet
        $addr1->setId(18900);
        $addr1->setAdresse("11;Rue des ecachoirs");
        $addr1->setCodePostal("44000");
        $addr1->setCity("Nantes");
        $addr1->setCountry("France");
        $addr1->setDepartment("Loire Atlantique");

        $addr2 = new LocationEntity();

        // * On hydrate l'objet
        $addr2->setId(18901);
        $addr2->setAdresse("190;Boulevard Jules Vernes");
        $addr2->setCodePostal("44300");
        $addr2->setCity("Nantes");
        $addr2->setCountry("France");
        $addr2->setDepartment("Loire Atlantique");

        $addr3 = new LocationEntity();

        // * On hydrate l'objet
        $addr3->setId(18789);
        $addr3->setAdresse("22;Rue Des Bergeronettes");
        $addr3->setCodePostal("44210");
        $addr3->setCity("Pornic");
        $addr3->setCountry("France");
        $addr3->setDepartment("Loire Atlantique");

        $locations = $this->LocationModel->searchLatLong($addr3->getAdresse(), $addr3->getCodePostal());

        var_dump($locations);

        $listAddrr = array($addr1, $addr2, $addr3);

        $dataMap = [];

        foreach ($listAddrr as $value) {
            
            $linkGouvApi = "https://api-adresse.data.gouv.fr/search/?q=";

            $addresse = $value->getAdresse();
            $numero = $addresse['number'];
            $rue = explode(" ", $addresse['street']);

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

            $countRemember = 0;
            $objRemember = null;

            foreach ($jsonObj->features as $objValue) {

                if ($objValue->properties->score > 0.8 && $objValue->properties->score > $countRemember) {

                    $countRemember = $objValue->properties->score;
                    $objRemember = $objValue;

                }

            }

            if ($objRemember != null) {

                $dataMap[$value->getId()] = array (

                    "lat" => $objRemember->geometry->coordinates[1],
                    "lng" => $objRemember->geometry->coordinates[0]

                );

            } else {

                $dataMap[$value->getId()] = null;
            
            }
        }

        $dataContent = array(
            'dataMap' => $dataMap,
        );

        $data = array(
            'content' => $dataContent
        );

        $this->LoaderView->load('Test/map', $data);
    }

}
