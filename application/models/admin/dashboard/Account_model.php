<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account_model extends CI_Model
{
    /** */
    public function __construct()
    {
        parent::__construct();
    }

    /*** */
    public function get_log($admin_id)
    {
        $this->db->select("timestamp, user_agent, ip_address, platform");
        $this->db->from('tbl_administrator_log');
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->get();
        return $query->row_array();
    }
}   
?>