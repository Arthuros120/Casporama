<?php
defined('BASEPATH') || exit('No direct script access allowed');

/*

    * Api/v1/Location Controller

*/
class Location extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('LocationModel');
    }

    public function AllCountry()
    {
        if ($this->input->is_ajax_request()) {

            echo json_encode($this->LocationModel->allCountryList());

        } else {

            show_404();

        }
    }

    public function AllDep(string $country = "")
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

    public function ZipDep(string $codePostal = "")
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

    public function cityDep(string $depZip = "")
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

    public function postalCodeDepCity(string $depZip = "", string $cityName = "")
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

    public function cityNameByPostalCode(string $postalCode = "")
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

    //number;address;postalCode
    public function latLongByAddressPostalCode(int $number = -1, string $street = "", string $postalCode = "")
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
