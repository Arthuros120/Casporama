<?php

// * On importe les classes nécessaires
require_once APPPATH . 'models/entity/LocationEntity.php';

/*

    * Class LocationModel

    * Cette classe permet de gérer les données de la table localisation

*/
class LocationModel extends CI_Model
{

    /*

        * Fonction getLocationsByUserId

        @param $id : l'id de l'utilisateur
        @param $selectALive : si on veut récupérer les adresses en cours de vie ou non

        @return array : un tableau contenant toutes les localisations de l'utilisateur
        en fonction de si il sont en cours de vie ou non

        * Cette fonction permet de récupérer toutes les localisations d'un utilisateur

    */
    public function getLocationsByUserId(int $id, bool $selectALive) : array
    {

        $addressList = [];

        $queryAdress = $this->db->query("Call getUserLocationById('" . $id . "')");

        $addressResult = $queryAdress->result();

        foreach ($addressResult as &$address) {

            if (($selectALive && $address->isALive) || !$selectALive) {

                $addressEntity = new LocationEntity();

                // * On hydrate l'objet
                $addressEntity->setId($address->idlocation);
                $addressEntity->setName($address->name);
                $addressEntity->setAdresse($address->location);
                $addressEntity->setCodePostal($address->codepostal);
                $addressEntity->setCity($address->city);
                $addressEntity->setCountry($address->country);
                $addressEntity->setDepartment($address->department);
                $addressEntity->setLatitude($address->latitude);
                $addressEntity->setLongitude($address->longitude);
                $addressEntity->setIsAlive($address->isALive);
                $addressEntity->setIsDefault($address->isDefault);
            
                array_push($addressList, $addressEntity);

            }
        }

        // * On attend un résultat
        $queryAdress->next_result();
        $queryAdress->free_result();
    
        return $addressList;

    }

        /*

        * Fonction getLocationByUserId

        @param $idUser : l'id de l'utilisateur
        @param $locationId : l'id de la localisation

        @return LocationEntity : retourne l'objet localisation demandé si il existe

        * Cette fonction permet de récupérer la localisations d'un utilisateur avec son id et l'id de la localisation

    */
    public function getLocationByUserId(int $idUser, int $locationId) : ?LocationEntity
    {

        $query = $this->db->query("Call getLocationByIdAndUserId('" . $idUser . "', '". $locationId . "')");

        $resutl = $query->result();

        if (count($resutl) != 1) {

            return null;

        } else {

            $resutl = $resutl[0];

        }

        $addressEntity = new LocationEntity();

        // * On hydrate l'objet
        $addressEntity->setId($resutl->idlocation);
        $addressEntity->setName($resutl->name);
        $addressEntity->setAdresse($resutl->location);
        $addressEntity->setCodePostal($resutl->codepostal);
        $addressEntity->setCity($resutl->city);
        $addressEntity->setCountry($resutl->country);
        $addressEntity->setDepartment($resutl->department);
        $addressEntity->setLatitude($resutl->latitude);
        $addressEntity->setLongitude($resutl->longitude);
        $addressEntity->setIsAlive($resutl->isALive);
        $addressEntity->setIsDefault($resutl->isDefault);

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        return $addressEntity;

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
