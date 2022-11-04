<?php

/*

    * Test Controller

    * C'est ici que je teste les fonctions de mon site
    * a terme elle ne sera pas accessible par l'utilisateur

*/
class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(true);
    }

    public function index()
    {
        $strLogin = "arthuros222@gmail.com";
        var_dump($strLogin);
        var_dump((stristr($strLogin, '@')));
        var_dump((stristr($strLogin, '@') && stristr($strLogin, '.')));

        $this->LoaderView->load('Test/index');

    }

}
