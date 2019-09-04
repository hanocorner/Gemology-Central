<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_model extends CI_Model
{
    /*** */
    private $_main_table = "tbl_lab_report";

    /*** */
    public $_result_count = null;
    
    /*** */
    public function __construct()
    {
        parent::__construct();
    }

    /** */
    public function get_draft_data($rows_per_page, $start)
    {
        $this->db->trans_begin();

        $query = $this->db->query('SELECT SQL_CALC_FOUND_ROWS * FROM admin_draft_reports LIMIT '.$start.', '.$rows_per_page.'');
        $result_count = $this->db->query('SELECT FOUND_ROWS() AS total_rows');
        
        $this->db->trans_complete();
        $result_count = $result_count->result('object');
        $this->_result_count = (int) $result_count[0]->total_rows;

        return $query->result_array();
    }

    /** */
    public function search_draft($key)
    {
        $key = trim($key);
        $query = $this->db->query("SELECT * FROM `admin_draft_reports` WHERE reportid LIKE '%".$key."' OR customer LIKE '%".$key."%' ESCAPE '!' ");
        return $query->result_array();
    }

    /*** */
    public function insert_draft($data)
    {
        $query = $this->db->query('CALL insert_draft_report(
        "'.$data['reportid'].'",
        "'.$data['customer'].'",
        "'.$data['repotype'].'",
        "'.$data['weight'].'",
        "'.$data['shapecut'].'",
        "'.$data['color'].'",
        "'.$data['qrtoken'].'",
        "'.$data['status'].'"
        )');

        return $query;
    }

    /** */
    public function update_payment($data)
    {
        $query = $this->db->query('CALL update_payment(
            "'.$data['p_repid'].'",
            "'.$data['p_reptype'].'",
            "'.$data['p_status'].'",
            "'.$data['price'].'",
            "'.$data['advance'].'"
            )');
    
            return $query;
    }

    /**
     * Delete Report 
     * 
     * @param int report id 
     */
    public function delete_draft($data)
    {
        $query = $this->db->query('CALL delete_draft_report(
            "'.$data['repid'].'",
            "'.$data['type'].'"
            )');
    
            return $query;
    }

    /** */
    public function get_receipt_count()
    {
        return $this->db->count_all('receipts');
    }

    /** */
    public function get_published_data($rows_per_page, $start)
    {
        $this->db->trans_begin();

        $query = $this->db->query('SELECT SQL_CALC_FOUND_ROWS * FROM admin_published_reports LIMIT '.$start.', '.$rows_per_page.'');
        $result_count = $this->db->query('SELECT FOUND_ROWS() AS total_rows');
        
        $this->db->trans_complete();
        $result_count = $result_count->result('object');
        $this->_result_count = (int) $result_count[0]->total_rows;

        return $query->result_array();
    }

    /** */
    public function search_published($string_array)
    {
        $sql = '';

        $sql .= "SELECT * FROM admin_published_reports";

        $sql .= " WHERE reportid IS NOT NULL ";

        if($string_array['customer'] != '')
        {
        $customer = $string_array['customer'];
        $sql .= " AND customer LIKE '%$customer%' ";
        }

        if($string_array['color'] != '')
        {
        $color = $string_array['color'];
        $sql .= " AND color LIKE '%$color%' ";
        }

        if($string_array['shape'] != '')
        {
        $shape = $string_array['shape'];
        $sql .= " AND shapecut LIKE '%$shape%' ";
        }

        if($string_array['reportid'] != '')
        {
        $reportid = $string_array['reportid'];
        $sql .= " AND reportid LIKE '%$reportid%' ";
        }

        if($string_array['shape'] != '')
        {
        $width = $string_array['width'];
        $sql .= " AND gemWidth LIKE '%$width%' ";
        }

        if($string_array['weight'] != '')
        {
        $weight = $string_array['weight'];
        $sql .= " AND weight LIKE '%$weight%' ";
        }

        $query = $this->db->query($sql);

        return $query->result('array');
    }

    /**
     * Populate lab report byreport id
     *
     * @param $id report id | string
     *
     * @return object
     */
    public function get_lab_report($id)
    {
        $id = (int) $id;
        $sql = "SELECT reportid, date, object, variety, spgroup, dimensions, weight, shapecut, color, comment, gemstone, imgpath, repoid FROM admin_print_populate_frep WHERE reportid = '".$id."' ";
        $query = $this->db->query($sql);
        return $query->row();
    }
}
?>