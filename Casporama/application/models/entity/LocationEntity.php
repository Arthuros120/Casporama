<?php

/*
    
        * LocationEntity
    
        * Cette classe représente une entité de la table localisation
    
*/
class LocationEntity
{

    private int $id;
    private string $name;

    private array $location;
    private string $codePostal;
    private string $city;
    private string $country;
    private string $department;

    private ?float $latitude;
    private ?float $longitude;

    private bool $isDefault;
    private bool $isAlive;

    /*
    
        * Function getId
    
        @return int
    
        * Cette fonction retourne l'id de l'entité
    
    */
    public function getId() : int
    {

        return $this->id;

    }

    /*
    
        * Function setId
    
        @param int $id
    
        * Cette fonction modifie l'id de l'entité
    
    */
    public function setId(int $id)
    {

        $this->id = $id;

    }

    /*
    
        * Function getName
    
        @return int
    
        * Cette fonction retourne le name de l'entité
    
    */
    public function getName() : string
    {

        return $this->name;

    }

    /*
    
        * Function setName
    
        @param string $name
    
        * Cette fonction modifie le name de l'entité
    
    */
    public function setName(string $name)
    {

        $this->name = $name;

    }
    
    /*
    
        * Function getAdresse
    
        @return array
    
        * Cette fonction retourne l'location de l'entité
    
    */
    public function getAdresse() : array
    {

        return $this->location;

    }

    /*
    
        * Function setAdresse
    
        @param string $location
    
        * Cette fonction modifie l'location de l'entité
    
    */
    public function setAdresse(string $location)
    {

        $tab = explode(";", $location);

        $this->location =  array(
            "number" => $tab[0],
            "street" => $tab[1],
        );


    }

    /*
    
        * Function getCodePostal
    
        @return int
    
        * Cette fonction retourne le code postal de l'entité
    
    */
    public function getCodePostal() : string
    {

        return $this->codePostal;

    }

    /*
    
        * Function setCodePostal
    
        @param int $codePostal
    
        * Cette fonction modifie le code postal de l'entité
        * rajout un 0 si le codePostal est inférieur à 10000
    
    */
    public function setCodePostal(int $codePostal)
    {

        $codePostal = (string) $codePostal;

        if (strlen($codePostal) < 5) {

            $this->codePostal = "0" . $codePostal;

        } else {

            $this->codePostal = $codePostal;

        }

        $this->codePostal = $codePostal;

    }

    /*
    
        * Function getVille
    
        @return string
    
        * Cette fonction retourne la city de l'entité
    
    */
    public function getCity() : string
    {

        return $this->city;

    }

    /*
    
        * Function setVille
    
        @param string $city
    
        * Cette fonction modifie la city de l'entité
    
    */
    public function setCity(string $city)
    {

        $this->city = $city;

    }

    /*
    
        * Function getCountry
    
        @return string
    
        * Cette fonction retourne le country de l'entité
    
    */
    public function getCountry() : string
    {

        return $this->country;

    }

    /*
    
        * Function setCountry
    
        @param string $country
    
        * Cette fonction modifie le country de l'entité
    
    */
    public function setCountry(string $country)
    {

        $this->country = $country;

    }

    /*
    
        * Function getDepartement
    
        @return string
    
        * Cette fonction retourne le département de l'entité
    
    */
    public function getDepartment() : string
    {

        return $this->department;

    }

    /*
    
        * Function setDepartment
    
        @param string $department
    
        * Cette fonction modifie le département de l'entité
    
        TODO: Rajouter l'autocomplétion des départements
    
    */
    public function setDepartment(string $department)
    {

        $this->department = $department;

    }

    /*
    
        * Function getLatitude
    
        @return float
    
        * Cette fonction retourne la latitude de l'entité
    
    */
    public function getLatitude() : ?float
    {

        return $this->latitude;

    }

    /*
    
        * Function setLatitude
    
        @param float $latitude
    
        * Cette fonction modifie la latitude de l'entité
    
    */
    public function setLatitude(?float $latitude)
    {

        $this->latitude = $latitude;

    }

    /*
    
        * Function getLongitude
    
        @return float
    
        * Cette fonction retourne la longitude de l'entité
    
    */
    public function getLongitude() : ?float
    {

        return $this->longitude;

    }

    /*
    
        * Function setLongitude
    
        @param float $longitude
    
        * Cette fonction modifie la longitude de l'entité
    
    */
    public function setLongitude(?float $longitude)
    {

        $this->longitude = $longitude;

    }

    /*
    
        * Function getIsDefault
    
        @param bool $isDefault
    
        * Cette fonction modifie la valeur de isDefault de l'entité
    
    */
    public function getIsDefault() : bool
    {

        return $this->isDefault;

    }

    /*
    
        * Function setIsDefault
    
        @param bool $isDefault
    
        * Cette fonction modifie la valeur de isDefault de l'entité
    
    */
    public function setIsDefault(string $isDefault)
    {

        if ($isDefault == "1" || $isDefault == "true") {

            $this->isDefault = true;

        } else {

            $this->isDefault = false;

        }

    }

    /*
    
        * Function getIsAlive
    
        @return bool
    
        * Cette fonction retourne la valeur de isAlive de l'entité
    
    */
    public function getIsAlive() : bool
    {

        return $this->isAlive;

    }

    /*
    
        * Function setIsAlive
    
        @param bool $isAlive
    
        * Cette fonction modifie la valeur de isAlive de l'entité
    
    */
    public function setIsAlive(string $isAlive)
    {

        if ($isAlive == "1" || $isAlive == "true") {

            $this->isAlive = true;

        } else {

            $this->isAlive = false;

        }

    }
}
