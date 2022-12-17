<?php

//check si il est connecte avec fonction dans user -> home()
// Utiliser le model de User

class Caspor extends CI_Controller{

    public function __construct() {
       parent::__construct();
    }

    public function index() {

        redirect('Caspor/home');

    }

    public function home() {

        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);
            $status = $user->getStatus();

            if ($status == "Client") {
    
                redirect('Caspor/becomeCaspor');

            } else if ($status == "Caspor") {
    
                redirect('Caspor/myCaspor');

            } else {

                redirect('User/home');

            } 

        } else {

            redirect('User/login');
        }
    }

    public function becomeCaspor() {

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);
            $status = $user->getStatus();

            if ($status == "Client") {
                $this->LoaderView->load("Caspor/becomeCaspor");
            } else {

                if ($status == "Caspor") {
                    redirect("Caspor/myCaspor");
                } else {
                    redirect("User/home");
                }

            }
        }

    }

    public function deleteCaspor() {

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);
            $status = $user->getStatus();

            if ($status == "Caspor") {
                $this->LoaderView->load("Caspor/deleteCaspor");
            } else {

                if ($status == "Client") {
                    redirect("Caspor/becomeCaspor");
                } else {
                    redirect("User/home");
                }

            }
        }
    }

    public function myCaspor() {

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);
            $status = $user->getStatus();

            if ($status == "Caspor") {
                $this->LoaderView->load("Caspor/myCaspor");
            } else {

                if ($status == "Client") {
                    redirect("Caspor/myCaspor");
                } else {
                    redirect("User/home");
                }

            }
        }
        
    }
    

    //Change le status d'un user pour passer d'un Client à un Caspor
    public function getCaspor() {

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);
            $status = $user->getStatus();

            if ($status == "Client") {
                
                $this->UserModel->changeStatus($id,"Caspor");

                redirect('Caspor/home');                

            } else {

                show_404('Vous êtes déjà Caspor');
            }
            
        } else {
            redirect('User/login');
        }

    }

    //Change le status d'un user pour passer d'un Caspor à un client
    public function supprCaspor() {

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);
            $status = $user->getStatus();

            if ($status == "Caspor") {
                
                $this->UserModel->changeStatus($id,"Client");

                redirect('User/home');

            } else {
                show_404('Vous êtes déjà Client');
            }
            
        } else {
            redirect('User/login');
        }

    }

}