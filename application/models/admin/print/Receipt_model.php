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
    public function all($ids)
    {
        $this->db->select('*, SUM(unit_price) as total_amount, count(reportno) as quantity');
        $this->db->where_in('reportno', $ids);
        $this->db->from('admin_draft_print_preview');
        $this->db->group_by('repotype');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>