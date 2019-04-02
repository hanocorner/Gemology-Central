<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_model extends CI_Model
{
  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  public function insert_report($data)
  {
    $query = $this->db->query('CALL insert_report(
      "'.$data['reportid'].'",
      "'.$data['customerid'].'",
      "'.$data['gemid'].'",
      "'.$data['repotype'].'",
      "'.$data['object'].'",
      "'.$data['weight'].'",
      "'.$data['gemWidth'].'",
      "'.$data['gemHeight'].'",
      "'.$data['gemLength'].'",
      "'.$data['spgroup'].'",
      "'.$data['shapecut'].'",
      "'.$data['color'].'",
      "'.$data['comment'].'",
      "'.$data['other'].'",
      "'.$data['imgname'].'",
      "'.$data['imgpath'].'",
      "'.$data['qrtoken'].'",
      "'.$data['amount'].'",
      "'.$data['payment_status'].'",
      "'.$data['status'].'"
       )');

    return $query;
  }

  /*****/
  public function get_species_group($name)
  {
    $sql = "SELECT distinct spgroup FROM tbl_lab_report WHERE spgroup LIKE '$name%' ORDER BY spgroup ASC LIMIT 5";
    $query = $this->db->query($sql);
    return $query->result('array');
  }

  /*****/
  public function get_shapecut($name)
  { 
    $sql = "SELECT distinct shapecut FROM tbl_lab_report WHERE shapecut LIKE '$name%' ORDER BY shapecut ASC LIMIT 5";
    $query = $this->db->query($sql);
    return $query->result('array');
  }

  /*****/
  public function get_color($name)
  {
    $sql = "SELECT distinct color FROM tbl_lab_report WHERE color LIKE '$name%' ORDER BY color ASC LIMIT 5";
    $query = $this->db->query($sql);
    return $query->result('array');
  }

  public function get_imagepath($labrepoid)
  {
    $this->db->select('reportid, qrcode');
    $this->db->from('tbl_gem_image');
    $this->db->where('reportid', $labrepoid);
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
  }

  /** */
  public function fetch_all_report_data($rows_per_page, $start)
  {
    $query = $this->db->query('SELECT * FROM admin_all_reports LIMIT '.$start.', '.$rows_per_page.'');

    return $query->result_array();
  }

  /** */
  public function get_total_rows()
  {
    return $this->db->count_all_results('admin_all_reports');
  }

  /** */
  public function search_data($string_array)
  {
    $sql = '';

    $sql .= "SELECT * FROM admin_all_reports";

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

    return $query->result_array();
  }

  /*** */
  public function get_report_edit($data)
  {
    $query = $this->db->query("SELECT * FROM admin_populate_edit WHERE type = '".$data['type']."' AND reportno = '".$data['id']."' ");

    return $query->row();
  }

  /*** */
  public function update_report($data)
  {
     $query = $this->db->query('CALL update_report(
       "'.$data['reportno'].'",
       "'.$data['gemid'].'",
       "'.$data['repotype'].'",
       "'.$data['object'].'",
       "'.$data['weight'].'",
       "'.$data['gemWidth'].'",
       "'.$data['gemHeight'].'",
       "'.$data['gemLength'].'",
       "'.$data['spgroup'].'",
       "'.$data['shapecut'].'",
       "'.$data['color'].'",
       "'.$data['comment'].'",
       "'.$data['other'].'",
       "'.$data['imgname'].'",
       "'.$data['imgpath'].'",
       "'.$data['amount'].'",
       "'.$data['payment_status'].'"
        )');

     return $query;
  }
}
?>
