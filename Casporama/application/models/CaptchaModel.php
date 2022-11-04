<?php

defined('BASEPATH') || exit('No direct script access allowed');
    
/**
* Description of Captcha_Model
*
* @author https://roytuts.com
*/

class CaptchaModel extends CI_Model
{

    public function _create_captcha($cap)
    {

        // TODO: Create procedure to insert captcha data into database
        // Save captcha params in database
        $data = array(
            'captcha_time' => $cap['time'],
            'ip_address' => $this->input->ip_address(),
            'word' => $cap['word']
        );
        
        $query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);
        
        return $cap['image'];
    }

    public function check_captcha($code)
    {

        log_message('debug', 'check_captcha: ' . $code);

        // First, delete old captchas
        $expiration = time() - $this->config->item('captcha_expire'); // 3 mins limit
        
        $this->db->where('captcha_time < ', $expiration)->delete('captcha');
        
        // Then see if a captcha exists:
        $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
        $binds = array($code, $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        return $row->count;
    }
    
}
