<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Home Controller
    
    @methode index

    * Ce controller est le controller de la page d'accueil du site.
    * Il est chargé de charger les vues de la page d'accueil.
    * C'est sur ce controleur sur lequel l'utilisateur est redirigé
    * lorsqu'il cherche a accéder au site avec le nom de dommaine.

*/
class Home extends CI_Controller
{

    /*

        * Methode index
        
        @return void

        * Affiche la page d'accueil
        * Cette methode est la methode par defaut du controller Home.
        

    */
    public function index()
    {

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);

            $data = array(

                'user' => $user

            );

            $dataArray = array(

                'content' => $data

            );

            $this->LoaderView->load('Home/index',$dataArray);

        } else {

            $this->LoaderView->load('Home/index');

        }

    }
}
