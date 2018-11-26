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
    $this->db->query('CALL insertReport(
      "'.$data['rmid'].'",
      "'.$data['customer'].'",
      "'.$data['gemid'].'",
      "'.$data['cdate'].'",
      "'.$data['repotype'].'",
      "'.$data['object'].'",
      "'.$data['variety'].'",
      "'.$data['weight'].'",
      "'.$data['gemWidth'].'",
      "'.$data['gemHeight'].'",
      "'.$data['gemLength'].'",
      "'.$data['spgroup'].'",
      "'.$data['shapecut'].'",
      "'.$data['color'].'",
      "'.$data['editor1'].'",
      "'.$data['other'].'",
      "'.$data['img_gem'].'",
      "'.$data['qrcode'].'",
      "'.$data['amount'].'",
      "'.$data['paymentstatus'].'",
      "'.$data['reportStatus'].'"
       )');

    return $this->db->affected_rows();
  }

  /*****/
  public function get_species_group($name)
  {
    $this->db->distinct();
    $this->db->select("spgroup");
    $this->db->like('spgroup', $name);
    $query = $this->db->get('tbl_lab_report');
    return $query->result_array();
  }

  /*****/
  public function get_shapecut($name)
  {
    $this->db->distinct();
    $this->db->select("shapecut");
    $this->db->like('shapecut', $name);
    $query = $this->db->get('tbl_lab_report');
    return $query->result_array();
  }

  /*****/
  public function get_color($name)
  {
    $this->db->distinct();
    $this->db->select("color");
    $this->db->like('color', $name);
    $query = $this->db->get('tbl_lab_report');
    return $query->result_array();
  }

  public function get_imagepath($labrepoid)
  {
    $this->db->select('reportid, qrcode');
    $this->db->from('tbl_gem_image');
    $this->db->where('reportid', $labrepoid);
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
  }
}
?>
