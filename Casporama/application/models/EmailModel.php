<?php

/*

    * Class UserModel

    @method sendEmail void
    @method sendEmailWithAttachement void

    * Cette classe permet de gérer les utilisateurs

*/
class EmailModel extends CI_Model
{

    /*

        * Méthode sendEmail

        @param array $fromEmail
        @param string $toEmail
        @param string $subject
        @param string $viewLink
        @param array $viewData

        * Cette méthode permet d'envoyer un email en chargent une view

    */
    public function sendEmail(array $fromEmail, string $toEmail, string $subject, string $viewLink, array $viewData)
    {

        $this->load->library('email');

        $this->email->from($fromEmail['email'], $fromEmail['name']);
        $this->email->to($toEmail);

        $this->email->subject($subject);
        $this->email->message($this->load->view($viewLink, $viewData, true));

        $this->email->send();

    }

    /*

        * Méthode sendEmailWithAttachement

        @param array $fromEmail
        @param string $toEmail
        @param string $subject
        @param string $viewLink
        @param array $viewData
        @param string $attachement

        * Cette méthode permet d'envoyer un email en chargent une view et en joignant un fichier

    */
    public function sendEmailWithAttachement(
        array $fromEmail,
        string $toEmail,
        string $subject,
        string $viewLink,
        array $viewData,
        string $attachement
        )
    {

        $this->load->library('email');

        $this->email->from($fromEmail['email'], $fromEmail['name']);
        $this->email->to($toEmail);

        $this->email->attach($attachement);
        $this->email->subject($subject);
        $this->email->message($this->load->view($viewLink, $viewData, true));

        $this->email->send();

        unlink($attachement);

    }
    
}
