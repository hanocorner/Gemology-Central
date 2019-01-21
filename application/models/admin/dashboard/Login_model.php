<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model
{
    /** */
    public function __construct()
    {
        parent::__construct();
    }

    /** */
    public function validate_credentials($data)
    {
        $query = $this->db->query('CALL authenticate_admin(
            "'.$data['username'].'",
            @admin_exists,
            @admin_id,
            @admin_password)'
        );
        
        $result = $query->result();

        $query->next_result(); 
        $query->free_result();  

        return $result;
    }

}
?>