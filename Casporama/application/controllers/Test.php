<?php

/*

    * Test Controller

    * C'est ici que je teste les fonctions de mon site
    * a terme elle ne sera pas accessible par l'utilisateur

*/
class Test extends CI_Controller
{

    public function index()
    {

        $this->LoaderView->load('Test/index');

    }

}
