<?php

use function PHPSTORM_META\type;

defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Card Controller

    
*/
class Dao extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('DAO/Dao_csv');
        $this->load->model('DAO/Dao_json');
        $this->load->model('DAO/Dao_xml');
        $this->load->model('DAO/Dao_yaml');
        $this->load->helper('download');

    }

    public function index()
    {
        $user = $this->UserModel->adminOnly();

        $this->load->view('test/testDAO');

    }

    public function import() {

        $user = $this->UserModel->adminOnly();

        $config['upload_path'] = './upload/DaoFile/import/';
        $config['allowed_types'] = 'json|xml|csv|yaml';
        
        $this->upload->initialize($config);

        if ($this->upload->do_upload('userfile')) {

            $ext = substr($this->upload->data()["file_ext"],1);
            $file = $this->upload->data()["file_name"];

            $table = $this->input->post("import");

            if ($ext == 'csv') {
                $err = $this->Dao_csv->addData($config['upload_path'].$file,$table);
            } else if ($ext == 'json') {
                $err = $this->Dao_json->addData($config['upload_path'].$file,$table);
            } else if ($ext == 'xml') {
                $err = $this->Dao_xml->addData($config['upload_path'].$file,$table);
            } else if ($ext == 'yaml') {
                $err = $this->Dao_yaml->addData($config['upload_path'].$file,$table);
            }

            unlink($config['upload_path'].$file);

        } else {

            $err = errorFile($this->upload->display_errors(),'import');

        }

        if (!isset($err)) {
            $data['msg'] = 'Succes importation';
        } else {
            $data['msg'] = $err;
        }

        $this->load->view('test/testDAO', $data);
        
    } 

    public function select() {

        $table = $this->input->post("export-Table");
        $ext = $this->input->post("export-Ext");

        $data['table'] = $table;
        $data['ext'] = $ext;
        $this->db->reconnect();
        $query =  $this->db->query("desc $table")->result_array();
        $colonnes = [];
        foreach ($query as $colonne) {
            array_push($colonnes,$colonne['Field']);
        }
        $data['colonnes'] = $colonnes;

        $this->load->view('test/testDAO', $data);
    }

    public function export() {

        $user = $this->UserModel->adminOnly();

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId(); 


            $table = $this->input->post("table");
            $ext = $this->input->post("ext");
            $filter = $this->input->post("export-Filter");

            if ($ext == 'csv') {
                $file = $this->Dao_csv->getData($id,$table,$filter);
            } else if ($ext == 'json') {
                $file = $this->Dao_json->getData($id,$table, $filter);
            } else if ($ext == 'xml') {
                $file = $this->Dao_xml->getData($id,$table, $filter);
            } else if ($ext == 'yaml') {
                $file = $this->Dao_yaml->getData($id,$table, $filter);
            }

            force_download($file, null);

        } else {

            $err = errorFile("User not connected",'import');

        }

        if (isset($err)) {
            $data['msg'] = $err;
            $this->load->view('test/testDAO', $data);
        }

    }

}
