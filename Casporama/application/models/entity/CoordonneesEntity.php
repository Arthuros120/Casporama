<?php

/*

    * CoordonneesEntity

    * Cette classe représente une entité de la table coordonnees

*/
class CoordonneesEntity {

    private int $id;

    private string $prenom;
    private string $nom;

    private string $telephone;
    private string $email;
    private string $fixe;

    /*

        * Function get_id

        @return int

        * Cette fonction retourne l'id de l'entité

    */
    public function get_id() : int {

        return $this->id;

    }

    /*

        * Function set_id

        @param int $id

        * Cette fonction modifie l'id de l'entité

    */
    public function set_id(int $id){

        $this->id = $id;

    }

    /*

        * Function get_prenom

        @return string

        * Cette fonction retourne le prénom de l'entité

    */
    public function get_prenom() : string {

        return $this->prenom;

    }

    /*

        * Function set_prenom

        @param string $prenom

        * Cette fonction modifie le prénom de l'entité 
        * en ajoutant automatiquement une majuscule au début

    */
    public function set_prenom(string $prenom){

        $this->prenom = ucfirst($prenom);

    }

    /*

        * Function get_nom

        @return string

        * Cette fonction retourne le nom de l'entité

    */
    public function get_nom() : string {

        return $this->nom;

    }

    /*

        * Function set_nom

        @param string $nom

        * Cette fonction modifie le nom de l'entité
        * en ajoutant automatiquement une majuscule au début

    */
    public function set_nom(string $nom){

        $this->nom = ucfirst($nom);

    }

    /*

        * Function get_telephone

        @return string

        * Cette fonction retourne le téléphone de l'entité

    */
    public function get_telephone() : string {

        return $this->telephone;

    }

    /*

        * Function set_telephone

        @param string $telephone

        * Cette fonction modifie le téléphone de l'entité
        * en ajoutant automatiquement un 0 au début

    */
    public function set_telephone(string $telephone){

        $this->telephone = "0" . $telephone;

    }

    /*

        * Function get_email

        @return string

        * Cette fonction retourne l'email de l'entité

    */
    public function get_email() : string {

        return $this->email;

    }

    /*

        * Function set_email

        @param string $email

        * Cette fonction modifie l'email de l'entité

    */
    public function set_email(string $email){

        $this->email = $email;

    }

    /*

        * Function get_fixe

        @return string

        * Cette fonction retourne le fixe de l'entité

    */
    public function get_fixe() : string {

        return $this->fixe;

    }

    /*

        * Function set_fixe

        @param string $fixe

        * Cette fonction modifie le fixe de l'entité
        * en ajoutant automatiquement un 0 au début

    */
    public function set_fixe(int $fixe){

        $this->fixe = "0" . (string) $fixe;

    }

}