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
        $this->UserModel->adminOnly();

        $this->LoaderView->load('Dao/index');

    }

    public function import()
    {

        $this->UserModel->adminOnly();

        $config['upload_path'] = './upload/DaoFile/import/';
        $config['allowed_types'] = 'json|xml|csv|yaml';
        $config['max_size'] = 0;
        
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
            $dataContent['msgSucces'] = 'Succes importation';
        } else {
            $dataContent['msg'] = $err;
        }

        $data = array('content' => $dataContent);

        $this->LoaderView->load('Dao/index',$data);
        
    }

    public function select() {

        $table = $this->input->post("export-Table");
        $ext = $this->input->post("export-Ext");

        $dataContent['table'] = $table;
        $dataContent['ext'] = $ext;

        $dataContent['colonnes'] = $this->DaoModel->colonnes($table);

        $data = array('content' => $dataContent);

        $this->LoaderView->load('Dao/index',$data);
    }

    public function export() {

        $user = $this->UserModel->adminOnly();

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        if ($this->UserModel->isConnected()) {

            $id = $user->getId(); 


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

            if ($file != null) {
                force_download($file, null);
            } else {
                $err = "Aucune donnée a exporter";
            }

        } else {

            $err = errorFile("User not connected",'import');

        }

        if (isset($err)) {
            $dataContent['msg'] = $err;

            $data = array('content' => $dataContent);

            $this->LoaderView->load('Dao/index',$data);
        }

    }

}
