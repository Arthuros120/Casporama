<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/LocationEntity.php';

/*

    * Class LocationModel

    * Cette classe permet de gérer les localisation

*/
class LocationModel extends CI_Model
{

    public function getLocationsByUserId(int $id) : array
    {

        $addressList = [];

        $queryAdress = $this->db->query("Call getUserLocationById('" . $id . "')");

        $addressResult = $queryAdress->result();

        foreach ($addressResult as &$address) {

            $addressEntity = new LocationEntity();

            // * On hydrate l'objet
            $addressEntity->setId($address->id);
            $addressEntity->setName($address->name);
            $addressEntity->setAdresse($address->location);
            $addressEntity->setCodePostal($address->codepostal);
            $addressEntity->setCity($address->city);
            $addressEntity->setCountry($address->country);
            $addressEntity->setDepartment($address->department);
            $addressEntity->setLatitude($address->latitude);
            $addressEntity->setLongitude($address->longitude);
            
            array_push($addressList, $addressEntity);
        }

        // * On attend un résultat
        $queryAdress->next_result();
        $queryAdress->free_result();
    
        return $addressList;

    }

    public function searchLatLong(array $address, string $codePostal) : ?array
    {

        $linkGouvApi = "https://api-adresse.data.gouv.fr/search/?q=";

        $street = explode(" ", $address['street']);

        $linkGouvApi = $linkGouvApi . $address['number'] . "+";

        foreach ($street as $streetValue) {

            $linkGouvApi = $linkGouvApi . $streetValue . "+";

        }

        $linkGouvApi = substr($linkGouvApi, 0, -1);

        $linkGouvApi = $linkGouvApi . "&postcode=" . $codePostal;

        $json = file_get_contents($linkGouvApi);
        if (!isset($json)) {

            return null;
    
        }

        $jsonObj = json_decode($json);

        $countRemember = 0;
        $objRemember = null;

        foreach ($jsonObj->features as $objValue) {

            if ($objValue->properties->score > 0.8 && $objValue->properties->score > $countRemember) {

                $countRemember = $objValue->properties->score;
                $objRemember = $objValue;

            }
        }

        if ($objRemember != null) {

            return array(
                "latitude" => $objRemember->geometry->coordinates[1],
                "longitude" => $objRemember->geometry->coordinates[0]
            );
        }

        return null;

    }
}
