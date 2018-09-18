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
  public function get_data_by_mrid($id)
  {
    $sql = "SELECT memoid FROM tbl_gem_memocard WHERE memoid = '$id' UNION SELECT gsrid FROM tbl_gemstone_report WHERE gsrid = '$id'";

    $this->db->select('memoid');
    $this->db->from('tbl_gem_memocard');
    $this->db->where('memoid', $id);
    $query1 = $this->db->get_compiled_select();

    $this->db->select('gsrid');
    $this->db->from('tbl_gemstone_report');
    $this->db->where('gsrid', $id);
    $query2 = $this->db->get_compiled_select();

    $query = $this->db->query($query1 . ' UNION ' . $query2);

    $row = $query->result();

    if (!empty($row[0]->memoid))
    {
      $id = $row[0]->memoid;
      $sql = "SELECT * FROM `tbl_lab_report` AS t1 LEFT JOIN `tbl_gem_memocard` as t2 ON t1.reportid = t2.reportid WHERE memoid = '$id' ";
      $query = $this->db->query($sql);
      return $query->row();
    }

    if(!empty($row[0]->memoid))
    {
      $id = $row[0]->memoid;
      $sql = "SELECT * FROM `tbl_lab_report` AS t1 LEFT JOIN `tbl_gemstone_report` as t2 ON t1.reportid = t2.reportid WHERE gsrid = '$id' ";
      $query = $this->db->query($sql);
      return $query->row();
    }

  }

  /****/
  public function update_lab_report($data, $customerid)
  {
    $this->db->where('rep_customerID', $customerid);
    return $this->db->update('tbl_lab_report', $data);
  }

  /****/
  public function update_memo($data, $memid)
  {
    $this->db->where('memoid', $memid);
    return $this->db->update('tbl_gem_memocard', $data);
  }

  /****/
  public function update_repo($data, $repid)
  {
    $this->db->where('gsrid', $repid);
    return $this->db->update('tbl_gemstone_report', $data);
  }
}
?>
