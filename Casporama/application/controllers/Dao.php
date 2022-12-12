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
        $this->load->view('test/testDAO');
    }

    public function import() {

        $config['upload_path'] = './DaoFile/import/';
        $config['allowed_types'] = 'json|xml|csv|yaml';

        $this->upload->initialize($config);

        if ($this->upload->do_upload('userfile')) {

            $ext = substr($this->upload->data()["file_ext"],1);
            $file = $this->upload->data()["file_name"];
            $table = $this->input->post("import");

            if ($ext == 'csv') {
                $this->Dao_csv->addData("./DaoFile/import/$file",$table);
            } else if ($ext == 'json') {
                $this->Dao_json->addData("./DaoFile/import/$file",$table);
            } else if ($ext == 'xml') {
                $this->Dao_xml->addData("./DaoFile/import/$file",$table);
            } else if ($ext == 'yaml') {
                $this->Dao_yaml->addData("./DaoFile/import/$file",$table);
            }

        } else {

            errorFile($this->upload->display_errors(),'import');

        }

        unlink("./DaoFile/import/$file");
        
    } 

    public function export() {

        // * On rend la connexion peréne pour toutes les pages
        $this->UserModel->durabilityConnection();

        $table = $this->input->post("export-Table");
        $ext = $this->input->post("export-Ext");

        if ($this->UserModel->isConnected()) {

            $id = $this->UserModel->getUserBySession()->getId();

            if ($ext == 'csv') {
                $file = $this->Dao_csv->getData($id,$table);
            } else if ($ext == 'json') {
                $file = $this->Dao_json->getData($id,$table);
            } else if ($ext == 'xml') {
                $file = $this->Dao_xml->getData($id,$table);
            } else if ($ext == 'yaml') {
                $file = $this->Dao_yaml->getData($id,$table);
            }
            force_download($file, null);

        } else {

            errorFile("User not connected",'import');
            
        }

    }

}
