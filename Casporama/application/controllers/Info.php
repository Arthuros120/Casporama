<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Info extends CI_Controller
{

    public function index()
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

            $this->LoaderView->load("Information/rgpd",$dataArray);

        } else {

            $this->LoaderView->load("Information/rgpd");

        }

        
    }

    public function cgv()
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

            $this->LoaderView->load("Information/cgv",$dataArray);

        } else {

            $this->LoaderView->load("Information/cgv");

        }
    }


}
