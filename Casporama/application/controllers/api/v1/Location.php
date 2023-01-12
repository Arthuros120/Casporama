<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Api/v1/Location Controller

    @method: AllCountry
    @method: AllDep
    @method: ZipDep
    @method: CityDep
    @method: PostalCodeDepCity
    @method: CityNameByPostalCode
    @method: LatLongByAddressPostalCode

    * Ce controlleur permet de créer une interface entre le backend et le frontent,
    * cela permet au js de communiquer avec le php et de faire des requêtes ajax
    * pour récupérer des données en base de données ou sur une api externe.

*/
class Location extends CI_Controller
{

    /*

        * Constructeur

        @param: void

        @return: void

        * Ce controleur charge le Model Location pour toutes les pages

    */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('LocationModel');
    }

    /*

        * AllCountry

        @param: void

        * Cette fonction permet de génerer une liste de tous les pays
        * en requete ajax seulement

    */
    public function AllCountry() : void
    {
        if ($this->input->is_ajax_request()) {

            echo json_encode($this->LocationModel->allCountryList());

        } else {

            show_404();

        }
    }

    /*

        * AllDep

        @param: string $country

        * Cette fonction permet de génerer une liste de tous les départements
        * en fonction du pays en requete ajax seulement

    */
    public function AllDep(string $country = "") : void
    {
        if ($this->input->is_ajax_request()) {

            if (strtolower($country) == "france") {

                echo json_encode($this->LocationModel->allDepartementList());

            } else {

                header("HTTP/1.0 404 Not Found");
                echo json_encode("404: Departement of #$country not found");
    
            }
            
        } else {

            show_404();

        }
    }

    /*

        * ZipDep

        @param: string $codePostal

        * Cette fonction retourne le numéro du département en fonction du code postal
        * en requete ajax seulement

    */
    public function ZipDep(string $codePostal = "") : void
    {
        if ($this->input->is_ajax_request()) {

            if (strlen($codePostal) == 5) {

                echo json_encode($this->LocationModel->getZipDepByZip($codePostal));

            } else {

                header("HTTP/1.0 404 Not Found");
                echo json_encode("404: Zip code #$codePostal not found");
    
            }
            
        } else {

            show_404();

        }
    }

    /*

        * CityDep

        @param: string $depZip

        * Cette fonction retourne la liste des villes en fonction du département
        * en requete ajax seulement

    */
    public function cityDep(string $depZip = "") : void
    {
        if ($this->input->is_ajax_request()) {

            if (strlen($depZip) == 2) {

                echo json_encode($this->LocationModel->allCityListWithCode($depZip));

            } else {

                header("HTTP/1.0 404 Not Found");
                echo json_encode("404: Zip code #$depZip not found");
    
            }
            
        } else {

            show_404();

        }
    }

    /*

        * PostalCodeDepCity

        @param: string $depZip

        @param: string $cityName

        * Cette fonction retourne la liste des codes postaux des départements et de la ville
        * en requete ajax seulement

    */
    public function postalCodeDepCity(string $depZip = "", string $cityName = "") : void
    {
        if ($this->input->is_ajax_request()) {

            if (strlen($depZip) == 2 && $cityName != "") {

                echo json_encode($this->LocationModel->allPostalCodeListWithCodeAndCity($depZip, $cityName));

            } else {

                header("HTTP/1.0 404 Not Found");
                echo json_encode("404: Zip code #$depZip or CityName #$cityName not found");
    
            }
            
        } else {

            show_404();

        }
    }

    /*

        * CityNameByPostalCode

        @param: string $postalCode

        * Cette fonction retourne le nom de la ville en fonction du code postal
        * en requete ajax seulement

    */
    public function cityNameByPostalCode(string $postalCode = "") : void
    {

        if ($this->input->is_ajax_request()) {

            if (strlen($postalCode) == 5) {

                echo json_encode($this->LocationModel->cityNameByPostalCode($postalCode));

            } else {

                header("HTTP/1.0 404 Not Found");
                echo json_encode("404: Postal code #$postalCode not found");

            }

        } else {

            show_404();

        }
    }

    /*

        * LatLongByAddressPostalCode

        @param: int $number

        @param: string $street

        @param: string $postalCode

        * Cette fonction retourne les coordonnées GPS en fonction de l'adresse
        * en requete ajax seulement

    */
    public function latLongByAddressPostalCode(int $number = -1, string $street = "", string $postalCode = "") : void
    {

        if ($this->input->is_ajax_request()) {

            if ($street != "" && $postalCode != "" && $number > 0) {

                $dataApi = array(
                    "number" => $number,
                    "street" => $street,
                );

                $resApi = $this->LocationModel->searchLatLong($dataApi, $postalCode);

                if ($resApi != null) {

                    echo json_encode($resApi);

                } else {

                    header("HTTP/1.0 404 Not Found");
                    echo json_encode("404: Address #$number #$street #$postalCode not found");

                }

            } else {

                header("HTTP/1.0 404 Not Found");
                echo json_encode("404: Address Address #$number #$street #$postalCode not found");

            }

        } else {

            show_404();

        }
    }

}
