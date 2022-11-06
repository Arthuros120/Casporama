<?php

/*

    * Class UserModel

    * Cette classe permet de gérer les utilisateurs

*/
class CaptchaModel extends CI_Model
{
    /*
    
        * _create_captcha
    
        * Cette méthode permet créer un captcha et de l'enregistrer dans la base de données
    
        @param: $cap array
        @return: string
    
    */
    public function _create_captcha(array $cap) : string
    {

        // * On recupère les données du captcha pour les enregistrer dans la base de données
        $data = array(
            'captcha_time' => (int) $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']
        );

        // * On insère les données du capchat dans la base de données
        $query = $this->db->query(

            "Call addCaptchat(" . $data['captcha_time'] . ",'" . $data['ip_address'] . "','" . $data['word'] . "')"

        );

        // * On envoie la requête
        $query->next_result();
        
        // * On retourne l'url de l'image du captcha
        return $cap['image'];

    }

    /*
    
        * check_captcha
    
        * Cette méthode permet de vérifier si le captcha est valide et de supprimer les captcha expirés
    
        @param: $code string
        @return: string
    
    */
    public function check_captcha(string $code) : int
    {

        // * On calcule le temps d'expiration en fonction de la date actuelle et du temps d'expiration du captcha
        $expiration = time() - $this->config->item('captcha_expire');
        
        // * On supprime les captcha expirés
        $query = $this->db->query(

            "Call cleanCaptchat(" . $expiration . ")"

        );

        // * On envoie la requête et attends la fin de l'exécution
        $query->next_result();
        $query->free_result();

        // * On recupére le nombre de captcha correspondant à l'ip et au code
        $query = $this->db->query(

            "Call countWordCapchat('" . $code .  "', '" . $this->input->ip_address() . "' , " . $expiration . ")"

        );

        $row = $query->row();

        // * On envoie la requête et attends la fin de l'exécution
        $query->next_result();
        $query->free_result();

        // * On retourne le nombre de captcha correspondant à l'ip et au code
        return $row->count;
    }
}
