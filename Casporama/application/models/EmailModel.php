<?php

/*

    * Class UserModel

    * Cette classe permet de gérer les utilisateurs

*/
class EmailModel extends CI_Model
{

    public function sendEmail(array $fromEmail, string $toEmail, string $subject, string $viewLink, array $viewData)
    {

        $this->load->library('email');

        $this->email->from($fromEmail['email'], $fromEmail['name']);
        $this->email->to($toEmail);

        $this->email->subject($subject);
        $this->email->message($this->load->view($viewLink, $viewData, true));

        $this->email->send();

    }
}
