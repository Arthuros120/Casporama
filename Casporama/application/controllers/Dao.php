<?php

use function PHPSTORM_META\type;

defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Dao Controller

    
*/
class Dao extends CI_Controller
{

    public function __construct()
    {
        // Chargement des modèles nécessaires
        parent::__construct();
        $this->load->model('DAO/Dao_csv');
        $this->load->model('DAO/Dao_json');
        $this->load->model('DAO/Dao_xml');
        $this->load->model('DAO/Dao_yaml');
        $this->load->model('DAO/DaoModel');
        $this->load->model('OrderModel');
        $this->load->helper('download');

    }

    public function index()
    {
        // Vérifie que l'utilisateur est administrateur
        $this->UserModel->adminOnly();

        // Charge la vue pour l'affichage de l'index
        $this->LoaderView->load('Dao/index');
    }

    public function import()
    {

        // Vérifie que l'utilisateur est administrateur
        $this->UserModel->adminOnly();


        // Configuration pour l'upload de fichier
        $config['upload_path'] = './upload/DaoFile/import/';
        $config['allowed_types'] = 'json|xml|csv|yaml';
        $config['max_size'] = 0;
        
        $this->upload->initialize($config);

        // Vérifie si le fichier a été uploadé
        if ($this->upload->do_upload('userfile')) {

            // Récupère l'extension du fichier uploadé
            $ext = substr($this->upload->data()["file_ext"],1);
            $file = $this->upload->data()["file_name"];

            // Récupère le nom de la table pour l'importation
            $table = $this->input->post("import");

            // Vérifie l'extension du fichier pour déterminer quel modèle utiliser pour l'importation
            if ($ext == 'csv') {
                $err = $this->Dao_csv->addData($config['upload_path'].$file,$table);
            } else if ($ext == 'json') {
                $err = $this->Dao_json->addData($config['upload_path'].$file,$table);
            } else if ($ext == 'xml') {
                $err = $this->Dao_xml->addData($config['upload_path'].$file,$table);
            } else if ($ext == 'yaml') {
                $err = $this->Dao_yaml->addData($config['upload_path'].$file,$table);
            }

            // Supprime le fichier uploadé
            unlink($config['upload_path'].$file);

        } else {

            // Gère les erreurs si l'upload n'a pas réussi
            $err = errorFile($this->upload->display_errors(),'import');

        }

        // Vérifie si il y a eu une erreur lors de l'importation
        if (!isset($err)) {
            $dataContent['msgSucces'] = 'Succes importation';
        } else {
            $dataContent['msg'] = $err;
        }

        // Prépare les données à envoyer à la vue
        $data = array('content' => $dataContent);

        // Charge la vue pour l'affichage de l'index
        $this->LoaderView->load('Dao/index',$data);
        
    }

    public function select() {

        // Récupère le nom de la table et l'extension choisie pour l'export
        $table = $this->input->post("export-Table");
        $ext = $this->input->post("export-Ext");

        // Prépare les données à envoyer à la vue
        $dataContent['table'] = $table;
        $dataContent['ext'] = $ext;


        // Récupère les colonnes de la table choisie
        $dataContent['colonnes'] = $this->DaoModel->colonnes($table);

        $data = array('content' => $dataContent);

        // Charge la vue pour l'affichage de l'index
        $this->LoaderView->load('Dao/index',$data);
    }

    public function export() {

        $user = $this->UserModel->adminOnly();

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        // Vérifie si l'utilisateur est connecté
        if ($this->UserModel->isConnected()) {

            // Récupère l'id de l'utilisateur connecté
            $id = $user->getId(); 

            // Récupère le nom de la table, l'extension et les filtres choisis pour l'export
            $table = $this->input->post("table");
            $ext = $this->input->post("ext");
            $filter = $this->input->post("export-Filter");

            // Vérifie l'extension choisie pour déterminer quel modèle utiliser pour l'export
            if ($ext == 'csv') {
                $file = $this->Dao_csv->getData($id,$table,$filter);
            } else if ($ext == 'json') {
                $file = $this->Dao_json->getData($id,$table, $filter);
            } else if ($ext == 'xml') {
                $file = $this->Dao_xml->getData($id,$table, $filter);
            } else if ($ext == 'yaml') {
                $file = $this->Dao_yaml->getData($id,$table, $filter);
            }

            if ($file != null) {
                // Permet le téléchargement du fichier exporté
                force_download($file, null);
            } else {
                $err = "Aucune donnée a exporter";
            }

        } else {

            $err = errorFile("User not connected",'import');

        }

        // Envoie le message d'erreur à la vue si existant
        if (isset($err)) {
            $dataContent['msg'] = $err;

            $data = array('content' => $dataContent);

            $this->LoaderView->load('Dao/index',$data);
        }

    }

}
