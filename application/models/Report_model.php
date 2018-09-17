<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_model extends CI_Model
{
  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Inserting Lab Report Basic data
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert_lab_report($data)
  {
    $this->db->insert('tbl_lab_report', $data);
    return $this->db->insert_id();
  }

  /**
   * Inserting Lab Report Basic data
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert_memocard($data)
  {
    $this->db->insert('tbl_gem_memocard', $data);
    return $this->db->affected_rows();
  }

  /**
   * Inserting Lab Report Basic data
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert_certificate($data)
  {
    $this->db->insert('tbl_gemstone_report', $data);
    return $this->db->affected_rows();
  }

  /**
   * This will return no.of affected rows after
   * insert/update/delete/select
   *
   * @param none
   * @return value | int
   */
  public function get_affected_rows()
  {
    return $this->db->affected_rows();
  }
}
?>
