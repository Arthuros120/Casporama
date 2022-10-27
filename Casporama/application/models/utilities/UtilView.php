<?php

/*

    * Class UtilView

    * Cette classe permet de charger les vues en fonction
    * des données et des vues à charger
    * Directement sans avoir besoin du LoaderView.yml

*/
class UtilView extends CI_Model
{

    /*

        * Function generateLoadView

        @param array $var
        @param array $data

        * Cette fonction permet de charger les vues en fonction
        * des données et des vues à charger
        * Directement sans avoir besoin du LoaderView.yml

    */
    public function generateLoadView(array $var = null, array $data = null) : array
    {

        // * On initialise le tableau de retour
        $loadView = array();
        
        // * On verifie si les vues et les données sont initialisées
        if (is_array($var) && is_array($data)) {

            // * On parcours les vues
            foreach ($var as $key => $value) {

                // * On verifie si la vue est une vue avec des données
                if (isset($data[$key])) {
                    
                    // * On charge la vue avec les données
                    $loadView[$key] = $this->load->view($value, $data[$key], true);

                }else{

                    // * On charge la vue sans données
                    $loadView[$key] = $this->load->view($value, null, true);
                }
            }
        }elseif (is_array($var) && !is_array($data)) { // * On verifie si les vues sont initialisées et les données non

            // * On parcours les vues
            foreach ($var as $key => $value) {

                // * On charge la vue sans données
                $loadView[$key] = $this->load->view($value, $data, true);

            }

        } else {

            // * On retourne un tableau de vue par défaut si les données ne sont pas initialisées
            $loadView = array(
                
                'head' => $this->load->view('templates/head', null, true),
                'header' => $this->load->view('templates/header', null, true),
                'content' => $this->load->view('templates/content', null, true),
                'footer' => $this->load->view('templates/footer', null, true)

            );
        }

        // * On retourne le tableau de vue
        return $loadView;
    }
}
