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

  /****/
  public function get_data_by_memid($id)
  {
    $sql = "SELECT * FROM `tbl_gem_memocard` AS t1 INNER JOIN `tbl_lab_report` AS t2 ON t1.reportid = t2.reportid WHERE t1.memoid = '$id'";

    $query = $this->db->query($sql);
    return $query->row();
  }

  /****/
  public function get_data_by_gsrid($id)
  {
    $sql = "SELECT * FROM `tbl_gemstone_report` AS t1 INNER JOIN `tbl_lab_report` AS t2 ON t1.reportid = t2.reportid WHERE t1.memoid = '$id'";

    $query = $this->db->query($sql);
    return $query->row();
  }

  /****/
  public function update_lab_report($data, $customerid)
  {
    $this->db->where('rep_customerID', $customerid);
    $this->db->update('tbl_lab_report', $data);
  }
}
?>
