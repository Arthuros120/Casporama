<?php

//check si il est connecte avec fonction dans user -> home()
// Utiliser le model de User

class Caspor extends CI_Controller{

    // La fonction constructeur de la classe
    public function __construct() {
       parent::__construct();
    }

    // La fonction d'index du contrôleur Caspor
    public function index() {

        // Redirige vers la fonction home du contrôleur Caspor
        redirect('Caspor/home');

    }

    // La fonction home du contrôleur Caspor
    public function home() {

        // Vérifie la durée de validité de la connexion de l'utilisateur
        $this->UserModel->durabilityConnection();

        // Si l'utilisateur est connecté
        if ($this->UserModel->isConnected()) {

            // Récupère l'ID de l'utilisateur connecté
            $id = $this->UserModel->getUserBySession()->getId();
            // Récupère l'utilisateur en question grâce à son ID
            $user = $this->UserModel->getUserById($id);
            // Récupère le statut de l'utilisateur (Client ou Caspor)
            $status = $user->getStatus();

            // Si l'utilisateur est un client
            if ($status == "Client") {
    
                // Redirige vers la fonction becomeCaspor du contrôleur Caspor
                redirect('Caspor/becomeCaspor');

            // Si l'utilisateur est un Caspor
            } else if ($status == "Caspor") {
    
                // Redirige vers la fonction myCaspor du contrôleur Caspor
                redirect('Caspor/myCaspor');

            // Si aucun des deux précédents cas n'est vrai
            } else {

                // Redirige vers la fonction home du contrôleur User
                redirect('User/home');

            } 

        // Si l'utilisateur n'est pas connecté
        } else {

            // Redirige vers la fonction login du contrôleur User
            redirect('User/login');
        }
    }


    public function becomeCaspor() {

        // Si l'utilisateur est connecté
        if ($this->UserModel->isConnected()) {
    
            // Récupère l'ID de l'utilisateur connecté
            $id = $this->UserModel->getUserBySession()->getId();
            // Récupère l'utilisateur en question grâce à son ID
            $user = $this->UserModel->getUserById($id);
            // Récupère le statut de l'utilisateur (Client ou Caspor)
            $status = $user->getStatus();
    
            // Si l'utilisateur est un client
            if ($status == "Client") {
                // Charge la vue du formulaire de demande de devenir Caspor
                $this->LoaderView->load("Caspor/becomeCaspor");
            } else {
    
                // Si l'utilisateur est un Caspor
                if ($status == "Caspor") {
                    // Redirige vers la fonction myCaspor
                    redirect("Caspor/myCaspor");
                } else {
                    // Redirige vers la fonction home du contrôleur User
                    redirect("User/home");
                }
    
            }
        } else {
            // Redirige vers la fonction login du contrôleur User
            redirect('User/login');
        }
    
    }
    
    public function deleteCaspor() {
    
        // Si l'utilisateur est connecté
        if ($this->UserModel->isConnected()) {
    
            // Récupère l'ID de l'utilisateur connecté
            $id = $this->UserModel->getUserBySession()->getId();
            // Récupère l'utilisateur en question grâce à son ID
            $user = $this->UserModel->getUserById($id);
            // Récupère le statut de l'utilisateur (Client ou Caspor)
            $status = $user->getStatus();
    
            // Si l'utilisateur est un Caspor
            if ($status == "Caspor") {
                // Charge la vue du formulaire de suppression de compte Caspor
                $this->LoaderView->load("Caspor/deleteCaspor");
            } else {
    
                // Si l'utilisateur est un client
                if ($status == "Client") {
                    // Redirige vers la fonction becomeCaspor
                    redirect("Caspor/becomeCaspor");
                } else {
                    // Redirige vers la fonction home du contrôleur User
                    redirect("User/home");
                }
    
            }
        } else {
            // Redirige vers la fonction login du contrôleur User
            redirect('User/login');
        }
    }
    

    public function myCaspor() {

        // Si l'utilisateur est connecté
        if ($this->UserModel->isConnected()) {
    
            // Récupère l'ID de l'utilisateur connecté
            $id = $this->UserModel->getUserBySession()->getId();
            // Récupère l'utilisateur en question grâce à son ID
            $user = $this->UserModel->getUserById($id);
            // Récupère le statut de l'utilisateur (Client ou Caspor)
            $status = $user->getStatus();
    
            // Si l'utilisateur est un Caspor
            if ($status == "Caspor") {
    
                // Récupère la date de la dernière mise à jour du profil de l'utilisateur
                $dateLastUpdate = $this->UserModel->getDateLastUpdateById($id);
                // Sépare la date en jour, mois et année
                $dateLastUpdate = explode("-",$dateLastUpdate);
                // Sépare l'heure de la date
                $dateLastUpdate[2] = explode(" ",$dateLastUpdate[2])[0];
    
                // Calcule le temps écoulé depuis la dernière mise à jour du profil
                $dateSince = $this->dateSince($user);
    
                // Calcule la date du prochain paiement pour l'utilisateur
                $nextPayment = $this->nextPayment($user);
    
                // Prépare les données à passer à la vue
                $data = array(
                    'user' => $user,
                    'dateLastUpdate' => $dateLastUpdate,
                    'dateSince' => $dateSince,
                    'nextPayment' => $nextPayment
                );
    
                // Ajoute les données à un tableau pour être passées à la vue
                $dataArray = array(
                    'content' => $data
                );
    
                // Charge la vue myCaspor avec les données préparées
                $this->LoaderView->load("Caspor/myCaspor",$dataArray);
            } else {
    
                // Si l'utilisateur est un client
                if ($status == "Client") {
                    // Redirige vers la fonction becomeCaspor
                    redirect("Caspor/myCaspor");
                } else {
                    // Redirige vers la fonction home du contrôleur User
                    redirect("User/home");
                }
    
            }
        } else {
            // Redirige vers la fonction login du contrôleur User
            redirect('User/login');
        }
            
    }  

    //Change le status d'un user pour passer d'un Client à un Caspor
    public function getCaspor() {

        // Vérifier si l'utilisateur est connecté
        if ($this->UserModel->isConnected()) {

            // Récupérer l'ID de l'utilisateur connecté
            $userSession = $this->UserModel->getUserBySession();
            

            // Récupérer le statut de l'utilisateur
            $status = $userSession->getStatus();

            // Vérifier si l'utilisateur a le statut "Client"
            if ($status == "Client") {
                
                // Changer le statut de l'utilisateur en "Caspor"
                $this->UserModel->changeStatus($userSession->getId(),"Caspor");

                // Récupérer l'objet utilisateur correspondant à l'ID
                $user = $this->UserModel->getUserById($userSession->getId());

                // On met à jour la variable session de l'utilisateur
                $this->UserModel->setUserSession($user);

                // Rediriger vers la page d'accueil de Caspor
                redirect('Caspor/home');                

            } else {

                // Afficher une erreur si l'utilisateur a déjà le statut "Caspor"
                show_404('Vous êtes déjà Caspor');
            }
            
        } else {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            redirect('User/login');
        }

    }

    //Change le status d'un user pour passer d'un Caspor à un client
    public function supprCaspor() {

        // Vérifier si l'utilisateur est connecté
        if ($this->UserModel->isConnected()) {

            // Récupérer l'utilisateur par la session
            $userSession = $this->UserModel->getUserBySession();
            
            // Récupérer le statut de l'utilisateur
            $status = $userSession->getStatus();

            // Vérifier si l'utilisateur a le statut "Caspor"
            if ($status == "Caspor") {
                
                // Changer le statut de l'utilisateur en "Client"
                $this->UserModel->changeStatus($userSession->getId(),"Client");

                // Récupérer l'objet utilisateur correspondant à l'ID
                $user = $this->UserModel->getUserById($userSession->getId());

                // On met à jour la variable session de l'utilisateur
                $this->UserModel->setUserSession($user);

                // Rediriger vers la page d'accueil de l'utilisateur
                redirect('User/home');

            } else {
                // Afficher une erreur si l'utilisateur a déjà le statut "Client"
                show_404('Vous êtes déjà Client');
            }
            
        } else {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            redirect('User/login');
        }

    }


    // Calculer le nombre d'années, de mois et de jours écoulés depuis la dernière mise à jour de l'utilisateur
    public function dateSince($user) {

        // Récupérer l'ID de l'utilisateur
        $id = $user->getId();
        // Récupérer la date de la dernière mise à jour de l'utilisateur
        $dateLastUpdate = $this->UserModel->getDateLastUpdateById($id);

        // Créer un objet DateTime à partir de la date de la dernière mise à jour
        $dateStart = new DateTime($dateLastUpdate);
        // Créer un objet DateTime à partir de la date actuelle
        $dateCurrent = new DateTime(date('y-m-d h:i:sa'));

        // Calculer la différence entre les deux dates
        $interval = $dateStart->diff($dateCurrent);
        // Formater la différence sous la forme "x ans y mois et z jours"
        $interval = $interval->format("%y ans %m mois et %d jours");

        // Renvoyer le résultat
        return $interval;
    }

    // Calculer la date du prochain paiement de l'utilisateur
    public function nextPayment($user) {
        // Récupérer l'ID de l'utilisateur
        $id = $user->getId();
        // Récupérer la date de la dernière mise à jour de l'utilisateur
        $dateLastUpdate = $this->UserModel->getDateLastUpdateById($id);
        // Récupérer le jour de la dernière mise à jour
        $dayStart = explode("-",$dateLastUpdate)[2];
        $dayStart = explode(" ",$dayStart)[0];

        // Vérifier si le jour de la dernière mise à jour est supérieur ou égal au jour actuel
        if ($dayStart >= date('d')) {
            // Si oui, calculer la date du prochain paiement en ajoutant un mois à la date actuelle
            $currentDate = date('m-Y',strtotime('+1 month'));

            // Séparer le mois et l'année
            $currentDate = explode("-",$currentDate);

            // Récupérer le mois et l'année
            $currentmonth = $currentDate[0];
            $currentYear = $currentDate[1];

            // Construire la date du prochain paiement
            $nextPayment = $dayStart . "/" . $currentmonth . "/" . $currentYear;

            // Renvoyer la date du prochain paiement
            return $nextPayment;
            
        } else {
            // Si non, calculer la date du prochain paiement en utilisant le mois et l'année actuels
            $currentDate = date('m') . "/" . date('Y');

            // Construire la date du prochain paiement
            $nextPayment = $dayStart . "/" . $currentDate;
        
            // Renvoyer la date du prochain paiement
            return $nextPayment;
        }
    }


}