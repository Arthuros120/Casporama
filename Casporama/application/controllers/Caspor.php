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
        } else {
            redirect('User/login');
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
        } else {
            redirect('User/login');
        }
    }

    public function myCaspor() {

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();
            $user = $this->UserModel->getUserById($id);
            $status = $user->getStatus();

            if ($status == "Caspor") {

                $dateLastUpdate = $this->UserModel->getDateLastUpdateById($id);
                $dateLastUpdate = explode("-",$dateLastUpdate);
                $dateLastUpdate[2] = explode(" ",$dateLastUpdate[2])[0];

                $dateSince = $this->dateSince($user);

                $nextPayment = $this->nextPayment($user);

                $data = array(

                    'user' => $user,
                    'dateLastUpdate' => $dateLastUpdate,
                    'dateSince' => $dateSince,
                    'nextPayment' => $nextPayment

                );

                $dataArray = array(

                    'content' => $data

                );

                $this->LoaderView->load("Caspor/myCaspor",$dataArray);
            } else {

                if ($status == "Client") {
                    redirect("Caspor/myCaspor");
                } else {
                    redirect("User/home");
                }

            }
        } else {
            redirect('User/login');
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

    public function dateSince($user) {

        $id = $user->getId();
        $dateLastUpdate = $this->UserModel->getDateLastUpdateById($id);

        $dateStart = new DateTime($dateLastUpdate);
        $dateCurrent = new DateTime(date('y-m-d h:i:sa'));

        $interval = $dateStart->diff($dateCurrent);
        $interval = $interval->format("%y ans %m mois et %d jours");

        return $interval;
    }

    public function nextPayment($user) {
        $id = $user->getId();
        $dateLastUpdate = $this->UserModel->getDateLastUpdateById($id);
        $dayStart = explode("-",$dateLastUpdate)[2];
        $dayStart = explode(" ",$dayStart)[0];

        if ($dayStart >= date('d')) {

            $currentDate = date('m-Y',strtotime('+1 month'));

            $currentDate = explode("-",$currentDate);

            $currentmonth = $currentDate[0];
            $currentYear = $currentDate[1];

            $nextPayment = $dayStart . "/" . $currentmonth . "/" . $currentYear;

            return $nextPayment;
            
        } else {

            $currentDate = date('m') . "/" . date('Y');

            $nextPayment = $dayStart . "/" . $currentDate;
    
            return $nextPayment;

        }

       
    }

}