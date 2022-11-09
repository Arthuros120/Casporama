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
        $this->output->enable_profiler(false);
    }

    public function index()
    {
        
        $data['heading'] = "Erreur lors de la création de l'utilisateur";
        $data['message'] = "Il y a une erreur lors de la création de votre compte,
        veuillez nous excuser pour la gêne occasionnée.";

        $this->load->view('errors/html/error_general', $data);

    }

}
