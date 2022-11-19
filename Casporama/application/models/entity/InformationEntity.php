<?php

/*

    * InformationEntity

    * Cette classe représente une entité de la table coordonnees

*/
class InformationEntity
{

    private int $id;

    private string $prenom;
    private string $nom;

    private string $telephone;
    private string $email;
    private string $fixe;

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

        * Function getPrenom

        @return string

        * Cette fonction retourne le prénom de l'entité

    */
    public function getPrenom() : string
    {

        return $this->prenom;

    }

    /*

        * Function setPrenom

        @param string $prenom

        * Cette fonction modifie le prénom de l'entité
        * en ajoutant automatiquement une majuscule au début

    */
    public function setPrenom(string $prenom)
    {

        $this->prenom = ucfirst($prenom);

    }

    /*

        * Function getNom

        @return string

        * Cette fonction retourne le nom de l'entité

    */
    public function getNom() : string
    {

        return $this->nom;

    }

    /*

        * Function setNom

        @param string $nom

        * Cette fonction modifie le nom de l'entité
        * en ajoutant automatiquement une majuscule au début

    */
    public function setNom(string $nom)
    {

        $this->nom = ucfirst($nom);

    }

    /*

        * Function getTelephone

        @return string

        * Cette fonction retourne le téléphone de l'entité

    */
    public function getTelephone() : string
    {

        return $this->telephone;

    }

    /*

        * Function setTelephone

        @param string $telephone

        * Cette fonction modifie le téléphone de l'entité
        * en ajoutant automatiquement un 0 au début

    */
    public function setTelephone(string $telephone)
    {

        $this->telephone = $telephone;

    }

    /*

        * Function getEmail

        @return string

        * Cette fonction retourne l'email de l'entité

    */
    public function getEmail() : string
    {

        return $this->email;

    }

    /*

        * Function setEmail

        @param string $email

        * Cette fonction modifie l'email de l'entité

    */
    public function setEmail(string $email)
    {

        $this->email = $email;

    }

    /*

        * Function getFixe

        @return string

        * Cette fonction retourne le fixe de l'entité

    */
    public function getFixe() : string
    {

        return $this->fixe;

    }

    /*

        * Function setFixe

        @param string $fixe

        * Cette fonction modifie le fixe de l'entité
        * en ajoutant automatiquement un 0 au début

    */
    public function setFixe($fixe)
    {
        if ($fixe != "") {

            $this->fixe = $fixe;

        } else {

            $this->fixe = "Non renseigné";

        }
    }

}
