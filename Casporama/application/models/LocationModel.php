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
    
        * Méthode newAddress
    
        @param array $dataAddress
        @return ?LocationEntity

        * Cette méthode permet de créer une nouvelle adresse
    
    */
    public function newAddress(array $dataAddress) : ?LocationEntity
    {

        if (
            isset($dataAddress['name']) &&
            isset($dataAddress['number']) &&
            isset($dataAddress['street']) &&
            isset($dataAddress['postalCode']) &&
            isset($dataAddress['city']) &&
            isset($dataAddress['country']) &&
            isset($dataAddress['department'])
            ) {

                if (!isset($dataAddress['isDefault'])) {

                    $dataAddress['isDefault'] = false;

                }

                if (!isset($dataAddress['id'])) {

                        $dataAddress['id'] = $this->generateId();
    
                }

                $address = new LocationEntity();

                $address->setId($dataAddress['id']);
                $address->setName($dataAddress['name']);
                $address->setAdresse($dataAddress['number'] . ";" . $dataAddress['street']);
                $address->setCodePostal((int) $dataAddress['postalCode']);
                $address->setCity($dataAddress['city']);
                $address->setCountry($dataAddress['country']);
                $address->setDepartment($dataAddress['department']);
                $address->setIsDefault($dataAddress['isDefault']);

                return $address;

        } else {

            return null;

        }
    }


    /*
    
        * Méthode addAddressToUser
    
        @param LocationEntity $newAddresse
        @param int $userId

        * Cette méthode ajoute une adresse à un utilisateur
    
    */
    public function addAddressToUser(
        LocationEntity $newAddresse,
        int $userId
        )
    {

        $this->load->helper('date');

        if (strtolower($newAddresse->getCountry()) == 'france') {

            $arrayCoord = $this->searchLatLong(
                $newAddresse->getAdresse(),
                $newAddresse->getCodePostal()
            );

        } else {

            $arrayCoord = null;

        }

        if ($arrayCoord == null) {

            $arrayCoord['latitude'] = null;
            $arrayCoord['longitude'] = null;

        }

        $datestring = 'Y-m-d h:i:s';
        $time = time();
        $dateLastUpdate = date($datestring, $time);

        $strRequest = "CALL user.createLoc(?,?,?,?,?,?,?,?,?,?,?,?)";

        $dataRequest = array(

            $newAddresse->getId(),
            $userId,
            $newAddresse->getName(),
            $newAddresse->getStringAdresse(),
            $newAddresse->getCodePostal(),
            $newAddresse->getCity(),
            $newAddresse->getDepartment(),
            $newAddresse->getCountry(),
            $arrayCoord['latitude'],
            $arrayCoord['longitude'],
            $newAddresse->getIsDefault(),
            $dateLastUpdate

        );

        $this->db->query($strRequest, $dataRequest);
    }

    /*
    
        * Méthode updateAddress
    
        @param LocationEntity $newAddresse
        @param int $lastAddresseId
        @param int $userId

        * Cette méthode met à jour une adresse
    
    */
    public function updateAddress(
        LocationEntity $newAddresse,
        int $lastAddresseId,
        int $userId
        )
    {

        $this->load->helper('date');

         if (strtolower($newAddresse->getCountry()) == 'france') {

            $arrayCoord = $this->searchLatLong(
                $newAddresse->getAdresse(),
                $newAddresse->getCodePostal()
            );

        } else {

            $arrayCoord = null;

        }

        if ($arrayCoord == null) {

            $arrayCoord['latitude'] = null;
            $arrayCoord['longitude'] = null;

        }

        $datestring = 'Y-m-d h:i:s';
        $time = time();
        $dateLastUpdate = date($datestring, $time);

        $strRequest = "CALL user.updateLocById(?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $dataRequest = array(

            $lastAddresseId,
            $newAddresse->getId(),
            $userId,
            $newAddresse->getName(),
            $newAddresse->getStringAdresse(),
            $newAddresse->getCodePostal(),
            $newAddresse->getCity(),
            $newAddresse->getDepartment(),
            $newAddresse->getCountry(),
            $arrayCoord['latitude'],
            $arrayCoord['longitude'],
            $newAddresse->getIsDefault(),
            $dateLastUpdate

        );

        $this->db->query($strRequest, $dataRequest);
    }

    /*
    
        * Méthode addressIsDead
    
        @param int $id

        * Cette méthode permet de tuer l'addresse
    
    */
    public function addressIsDead(int $id)
    {

        $dateLastUpdate = date('Y-m-d h:i:s', time());

        $this->db->query("Call user.addressIsDead('" . $id . "', '" . $dateLastUpdate . "')");

    }

    /*
    
        * Méthode sameNameByUserId
    
        @param int $id
        @param string $name

        @return bool

        * Cette méthode permet de vérifier si l'utilisateur a déjà une adresse avec le même nom
    
    */
    public function sameNameByUserId(int $id, string $name) : bool
    {

        $query = $this->db->query("Call user.countAddressByIdAndName('" . $id . "', '" . $name . "')");

        $result = $query->row()->total;

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if ($result > 0) {

            return true;

        }

        return false;

    }

    /*
    
        * Méthode heHaveAddressById
    
        @param int $id
        @return bool

        * Cette méthode permet de vérifier si l'utilisateur a déjà une adresse avec le même nom
    
    */
    public function heHaveAddressById(int $id): Bool
    {

        // * On récupère l'utilisateur en fonction de son id
        $query = $this->db->query("Call user.verifyLocId('" . $id . "')");

        // * On vérifie si l'utilisateur existe
        $location = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        // * On retourne le résultat
        if (isset($location->name)) {

            return true;
        }

        return false;
    }

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

        $queryAdress = $this->db->query("Call user.getUserLocationById('" . $id . "')");

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

        $query = $this->db->query("Call user.getLocationByIdAndUserId('" . $idUser . "', '". $locationId . "')");

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

    /*

        * Fonction getLocationById

        @param $locationId : l'id de la localisation

        @return LocationEntity : retourne l'objet localisation demandé si il existe

        * Cette fonction permet de récupérer la localisations d'un utilisateur avec son id et l'id de la localisation

    */
    public function getLocationById(int $locationId) : ?LocationEntity
    {

        $query = $this->db->query("Call user.getLocationById('". $locationId . "')");

        $resutl = $query->result();

        if (empty($resutl)) {

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

    /*

        * Fonction allDepartementList

        @return array

        * Cette fonction retourne la list de tout les département français

    */
    public function allDepartementList() : array
    {

        $departmentList = [];

        $jsonFile = file_get_contents(base_url() . "static/json/department/departements-region.json");

        $jsonObject = json_decode($jsonFile);

        foreach ($jsonObject as $department) {

            $departmentList[(int) $department->num_dep] = $department->dep_name;

        }

        return $departmentList;

    }

    /*
    
        * Fonction getDepartment
    
        @param $num : le numéro du département
    
        @return string : le nom du département
    
        * Cette fonction retourne le nom du département
    
    */
    public function getDepartment(int $num) : ?string
    {

        $depList = $this->allDepartementList();

        $depList[1000] = 'Pays étrangé';

        if (isset($depList[$num])) {

            return $depList[$num];

        }

        return null;

    }

    /*

        * Fonction allCountryList

        @return array

        * Cette fonction retourne la list de tout les pays

    */
    public function allCountryList() : array
    {

        $countryList = [];

        $jsonFile = file_get_contents(base_url() . "static/json/country/country.json");

        $jsonObject = json_decode($jsonFile);

        foreach ($jsonObject as $country) {

            array_push($countryList, $country);

        }

        return $countryList;

    }

    /*

        * Fonction allCityListWithCode

        @param $codeDep : le code du département

        @return array

        * Cette fonction retourne la list de tout les ville d'un département

    */
    public function allCityListWithCode(int $codeDep) : array
    {

        if ($codeDep == 0) {

            return [];

        }

        if ($codeDep < 10) {

            $codeDep = "0" . $codeDep;

        }

        $linkGouvApi = 'https://geo.api.gouv.fr/departements/' . $codeDep . '/communes?fields=nom&format=json';

        $jsonFile = file_get_contents($linkGouvApi);

        $jsonObject = json_decode($jsonFile);

        $cityList = [];

        foreach ($jsonObject as $city) {

            array_push($cityList, $city->nom);

        }

        return $cityList;

    }

    /*

        * Fonction allPostalCodeListWithCodeAndCity

        @param $codeDep : le code du département

        @param $cityName : le nom de la ville

        @return array

        * Cette fonction retourne la list de tout les code postal d'une ville d'un département

    */
    public function allPostalCodeListWithCodeAndCity(int $codeDep, string $cityName) : array
    {

        if ($codeDep == 0) {

            return [];

        }

        if ($codeDep < 10) {

            $codeDep = "0" . $codeDep;

        }

        $linkGouvApi = 'https://geo.api.gouv.fr/communes?nom=' . $cityName;
        $linkGouvApi = $linkGouvApi . '&codeDepartement=' . $codeDep . '&fields=codesPostaux&format=json';

        $jsonFile = file_get_contents($linkGouvApi);

        $jsonObject = json_decode($jsonFile);

        $bestScore = 0;
        $bestScoreIndex = 0;

        foreach ($jsonObject as $cityKey => $cityValue) {

            if ($bestScore < $cityValue->_score) {

                $bestScore = $cityValue->_score;
                $bestScoreIndex = $cityKey;

            }

        }

        return $jsonObject[$bestScoreIndex]->codesPostaux;

    }

    /*

        * Fonction cityNameByPostalCode

        @param $postalCode : le code postal

        @return array

        * Cette fonction retourne la list de tout les ville d'un code postal

    */
    public function cityNameByPostalCode(string $postalCode = "")
    {

        $cityNameList = [];

        if ($postalCode == "" || strlen($postalCode) != 5) {

            return [];

        }

        $linkApi = 'https://apicarto.ign.fr/api/codes-postaux/communes/' . $postalCode;

        $jsonFile = file_get_contents($linkApi);

        $jsonObject = json_decode($jsonFile);

        foreach ($jsonObject as $nameCity) {

            array_push($cityNameList, $nameCity->nomCommune);

        }

        return $cityNameList;

    }

    /*

        * Fonction searchLatLong

        @param $address : l'adresse

        @param $codePostal : le code postal

        @return array

        * Cette fonction retourne la latitude et la longitude d'une adresse

    */
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

    /*

        * Fonction getZipDepByZip

        @param int $code : le code postal

        @return int

        * Cette fonction retourne le code postal d'un département
    */
    public function getZipDepByZip(int $code) : int
    {

        $code = (string) $code;

        $code = substr($code, 0, 2);

        $code = (int) $code;

        return $code;

    }

    /*

        * Fonction IsUniqueModifAddressName

        @param string $name : le nom de l'adresse
        @param int $id : l'id de l'adresse

        @return int

        * Cette fonction retourne 1 si le nom de l'adresse est unique, 0 sinon
    */
    public function IsUniqueModifAddressName(string $name, int $id) : int
    {

        $query = $this->db->query("Call user.isUniqueAddressName(?, ?)", array($name, $id));

        $result = (int) $query->row()->count;

        $query->next_result();
        $query->free_result();

        return $result;

    }

    /*

        * Fonction IsCountry

        @param string $country

        @return int

        * Cette fonction retourne true si le pays est valide, false sinon
    */
    public function IsCountry(string $country) : bool
    {

        $allCountry = $this->allCountryList();

        foreach ($allCountry as $countryValue) {

            if ($this->formatStr($countryValue) == $this->formatStr($country)) {

                return true;

            }

        }

        return false;

    }

    /*

        * Fonction IsDepartment

        @param string $dep

        @return int

        * Cette fonction retourne true si le département est valide, false sinon
    */
    public function IsDepartment(string $dep) : bool
    {

        $allDep = $this->allDepartementList();
        
        $allDep[1000] = "Pays étrangé";

        foreach ($allDep as $depValue) {

            if ($this->formatStr($depValue) == $this->formatStr($dep)) {

                return true;

            }

        }

        return false;

    }

    /*

        * Fonction samePostalCodeByDepartment

        @param int $depId
        @param string $postalCode

        @return bool

        * Cette fonction retourne true si le code postal est valide pour le département, false sinon
    */
    public function samePostalCodeByDepartment(int $depId, string $postalCode) : bool
    {

        $postalCode = (int) $postalCode[0] * 10 + $postalCode[1];

        return $postalCode == $depId;

    }

    /*

        * Fonction sameAddresse

        @param int $userId
        @param LocationEntity $newAddresse

        @return bool

        * Cette fonction retourne true si l'adresse est la même que celle de l'utilisateur, false sinon
    */
    public function sameAddresse(int $userId, LocationEntity $newAddresse) : bool
    {

        if (!isset($newAddresse) || $newAddresse->getStringAdresse() == null|| $newAddresse->getCity() == null) {

            return true;

        }

        $addresse = $newAddresse->getStringAdresse();
        $city = $newAddresse->getCity();


        $query = $this->db->query("call user.sameAddresse('" . $userId . "', '" . $addresse . "', '" . $city . "')");

        $result = (int) $query->row()->total;

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if ($result == 0) {

            return false;

        }

        return true;

    }

    /*

        * Fonction sameAddresseModif

        @param int $userId
        @param LocationEntity $newAddresse
        @param int $oldId

        @return bool

        * Cette fonction retourne true si l'adresse est la même que celle de l'utilisateur, false sinon
    */
    public function sameAddresseModif(int $userId, LocationEntity $newAddresse, int $oldId) : bool
    {

        if (!isset($newAddresse) || $newAddresse->getStringAdresse() == null|| $newAddresse->getCity() == null) {

            return true;

        }

        $addresse = $newAddresse->getStringAdresse();
        $city = $newAddresse->getCity();

        $query = $this->db->query(
            "call user.sameAddresseModif('$userId', $oldId, '" . $addresse . "', '" . $city . "')"
        );

        $result = $query->row();

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        if ($result->total == 0 || ($result->total == 1 && $result->id == $oldId)) {

            return false;

        }

        return true;

    }

    /*

        * Fonction countAddressByUserId

        @param int $id

        @return int

        * Cette fonction retourne le nombre d'adresse de l'utilisateur
    */
    public function countAddressByUserId(int $id) : int
    {

        $query = $this->db->query("call user.countAliveAddressByUserId('" . $id . "')");
        
        $result = (int) $query->row()->total;

        // * On attend un résultat
        $query->next_result();
        $query->free_result();

        return $result;

    }

    /*

        * Fonction heHaveMaxAddress

        @param int $id

        @return bool

        * Cette fonction retourne true si l'utilisateur a atteint le nombre maximum d'adresse, false sinon
    */
    public function heHaveMaxAddress(int $id) : bool
    {

        if ($this->countAddressByUserId($id) >=$this->config->item('address_MaxAdd')) {

            return true;

        }

        return false;

    }

    /*

        * Fonction generateId

        @return int

        * Cette fonction genere un id aléatoire
    */
    private function generateId(): Int
    {

        $id = rand(100, 999999999);

        if ($this->heHaveAddressById($id)) {

            $id = $this->generateId();
        }

        return $id;
    }

    /*

        * Fonction formatStr

        @param string $str

        @return string

        * Cette fonction formatte une chaine de caractère, enlève les accents, les espaces,
        * les apostrophes et les tirets et la met en minuscule, pour faciliter les comparaisons
    */
    private function formatStr(string $str) : string
    {

        $str = trim($str);
        
        $str = htmlentities($str, ENT_NOQUOTES, 'utf-8');
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. 'œ'
        $str = preg_replace('#&[^;]+;#', '', $str);
        $str = str_replace('-', '+', $str);
        $str = str_replace('\'', '+', $str);

        $str = strtolower($str);

        return $str;

    }
}
