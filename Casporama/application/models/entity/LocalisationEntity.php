<?php

/*
    
        * LocalisationEntity
    
        * Cette classe représente une entité de la table localisation
    
*/
class LocalisationEntity
{

    private int $id;

    private string $adresse;
    private string $codePostal;
    private string $ville;
    private string $pays;
    private string $departement;

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
    
        * Function getAdresse
    
        @return string
    
        * Cette fonction retourne l'adresse de l'entité
    
    */
    public function getAdresse() : string
    {

        return $this->adresse;

    }

    /*
    
        * Function setAdresse
    
        @param string $adresse
    
        * Cette fonction modifie l'adresse de l'entité
    
    */
    public function setAdresse(string $adresse)
    {

        $this->adresse = $adresse;

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
    
        * Cette fonction retourne la ville de l'entité
    
    */
    public function getVille() : string
    {

        return $this->ville;

    }

    /*
    
        * Function setVille
    
        @param string $ville
    
        * Cette fonction modifie la ville de l'entité
    
    */
    public function setVille(string $ville)
    {

        $this->ville = $ville;

    }

    /*
    
        * Function getPays
    
        @return string
    
        * Cette fonction retourne le pays de l'entité
    
    */
    public function getPays() : string
    {

        return $this->pays;

    }

    /*
    
        * Function setPays
    
        @param string $pays
    
        * Cette fonction modifie le pays de l'entité
    
    */
    public function setPays(string $pays)
    {

        $this->pays = $pays;

    }

    /*
    
        * Function getDepartement
    
        @return string
    
        * Cette fonction retourne le département de l'entité
    
    */
    public function getDepartement() : string
    {

        return $this->departement;

    }

    /*
    
        * Function setDepartement
    
        @param string $departement
    
        * Cette fonction modifie le département de l'entité
    
        TODO: Rajouter l'autocomplétion des départements
    
    */
    public function setDepartement(string $departement)
    {

        $this->departement = $departement;

    }
}
