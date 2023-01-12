<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Contact Controller
    
    @methode index

    * Ce controlleur permet de gérer le formulaire de contact

*/
class Contact extends CI_Controller
{

    /*

        * Methode index

        * On charge la vue du formulaire de contact
        
        @return void

    */
    public function index(): void
    {

        $this->UserModel->durabilityConnection();

        $configRules = array(

            array(
                'field' => 'firstname',
                'label' => 'Prénom',
                'rules' => 'trim|required|min_length[3]|max_length[255]|alpha',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s,',
                    "min_length" => "Le %s doit faire au moins 3 caractères,",
                    "max_length" => "Le %s doit faire au plus 255 caractères,",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin,',
                    'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques,',
                ),
            ),

            array(
                'field' => 'name',
                'label' => 'Nom',
                'rules' => 'trim|required|min_length[3]|max_length[255]|alpha',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.,',
                    "min_length" => "Le %s doit faire au moins 3 caractères,",
                    "max_length" => "Le %s doit faire au plus 255 caractères,",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin,',
                    'alpha' => 'Le %s ne doit contenir que des caractères alphabétiques,',
                ),
            ),

            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'trim|required|min_length[5]|max_length[255]|valid_email',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.,',
                    "min_length" => "Le %s doit faire au moins 5 caractères,",
                    "max_length" => "Le %s doit faire au plus 255 caractères,",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin,',
                    'valid_email' => 'Le %s n\'est pas valide,',
                ),
            ),

            array(
                'field' => 'object',
                'label' => 'object',
                'rules' => 'trim|required|min_length[5]|max_length[255]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.,',
                    "min_length" => "Le %s doit faire au moins 5 caractères,",
                    "max_length" => "Le %s doit faire au plus 255 caractères,",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin,',
                ),
            ),

            array(
                'field' => 'message',
                'label' => 'message',
                'rules' => 'trim|required|min_length[10]|max_length[5000]',
                'errors' => array( // * On définit les messages d'erreurs
                    'required' => 'Vous avez oublié %s.,',
                    "min_length" => "Le %s doit faire au moins 10 caractères,",
                    "max_length" => "Le %s doit faire au plus 5000 caractères,",
                    'trim' => 'Le %s ne doit pas contenir d\'espace au début ou à la fin,',
                ),
            ),

        );

        $this->form_validation->set_rules($configRules);

        if (!$this->form_validation->run()) {

            $error = explode(',', validation_errors());

            $dataContent = array(

                'error' => $error

            );

            $data = array(

                'content' => $dataContent

            );

            $this->LoaderView->load('contact/index', $data);

        } else {

            $this->load->model('EmailModel');

            $post = $this->input->post();

            $name = $post['name'];
            $firstname = $post['firstname'];
            $email = $post['email'];
            $object = $post['object'];
            $message = $post['message'];

            $dataContent = array(

                'name' => $name,
                'firstname' => $firstname,
                'email' => $email,
                'object' => $object,
                'message' => $message

            );

            $data = array(

                'content' => $dataContent

            );

            $fromEmail = array(

                'email' => 'no_reply@casporama.live',
                'name' => 'Casporama - No Reply'

            );

            $this->EmailModel->sendEmail(
                $fromEmail,
                $email,
                'Casporama - Demande de contact',
                'email/contact/toClient',
                $dataContent
            );

            $fromEmail = array(

                'email' => 'livecasporama@gmail.com',
                'name' => 'Casporama - MailBox'

            );

            $this->EmailModel->sendEmail(

                $fromEmail,
                $fromEmail['email'],
                'Casporama - Demande de contact de ' . $name . ' ' . $firstname,
                'email/contact/toAdmin',
                $dataContent
            );

            $this->LoaderView->load('contact/index/comfirm', $data);

        }
    }
}
