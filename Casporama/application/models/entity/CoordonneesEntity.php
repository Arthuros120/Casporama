<?php

class CoordonneesEntity {

    private int $id;

    private string $prenom;
    private string $nom;

    private string $telephone;
    private string $email;
    private string $fixe;

    public function get_id(){

        return $this->id;

    }

    public function set_id(int $id){

        $this->id = $id;

    }

    public function get_prenom(){

        return $this->prenom;

    }

    public function set_prenom(string $prenom){

        $this->prenom = ucfirst($prenom);

    }

    public function get_nom(){

        return $this->nom;

    }

    public function set_nom(string $nom){

        $this->nom = ucfirst($nom);

    }

    public function get_telephone(){

        return $this->telephone;

    }

    public function set_telephone(string $telephone){

        $this->telephone = "0" . (string) $telephone;

    }

    public function get_email(){

        return $this->email;

    }

    public function set_email(string $email){

        $this->email = $email;

    }

    public function get_fixe(){

        return $this->fixe;

    }

    public function set_fixe(int $fixe){

        $this->fixe = "0" . (string) $fixe;

    }

}