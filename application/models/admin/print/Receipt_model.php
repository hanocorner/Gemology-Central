<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Receipt_model extends CI_Model
{
    /** */
    public function __construct()
    {
        parent::__construct();
    }

    /** */
    public function all()
    {
        $query = $this->db->get('receipt_data');
        return $query->result_array();
    }
}
?>