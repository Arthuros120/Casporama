<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Card Controller

    
*/
class Card extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('CardModel');
    }

    // public function index()
    // {

    //     redirect('user/home');

    // }


    public function add() {
        
    }

}
