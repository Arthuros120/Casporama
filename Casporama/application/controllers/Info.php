<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Info Controller
    
    @methode index

    * Ce controller est le controller de la page d'accueil du site.
    * Il est chargé de charger les vues de la page d'accueil.
    * C'est sur ce controleur sur lequel l'utilisateur est redirigé
    * lorsqu'il cherche a accéder au site avec le nom de dommaine.

*/
class Info extends CI_Controller
{

    /*

        * Methode index
        
        @return void

        * Cette methode affiche les rgpd
        

    */
    public function index() : void
    {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);

            $data = array(

                'user' => $user

            );

            $dataArray = array(
                
                'header' => $data,

            );

            $this->LoaderView->load("Information/rgpd", $dataArray);

        } else {

            $this->LoaderView->load("Information/rgpd");

        }

        
    }

    /*

        * Methode cgv
        
        @return void

        * Cette methode affiche les cgv
        

    */
    public function cgv() : void
    {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);

            $data = array(

                'user' => $user

            );

            $dataArray = array(

                'header' => $data

            );

            $this->LoaderView->load("Information/cgv", $dataArray);

        } else {

            $this->LoaderView->load("Information/cgv");

        }
    }


}
