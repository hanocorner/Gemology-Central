<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Print_model extends CI_Model
{
  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Fetcing Certificate by id
   *
   * @param $id | string
   * @return result
   */
  public function get_memocard_by_id($id)
  {
    $sql = "SELECT * FROM `tbl_lab_report` AS t1 INNER JOIN `tbl_gemstone_report` as t2 ON t1.reportid = t2.reportid WHERE t2.gsrid = '$id'";
    $this->db->select('*');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gem_memocard', 'tbl_lab_report.reportid = tbl_gem_memocard.reportid', 'left');
    $this->db->where('memoid', $id);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->result();

    return false;
  }

  /**
   * Fetcing Certificate by id
   *
   * @param $id | string
   * @return result
   */
  public function get_certificate_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gemstone_report', 'tbl_lab_report.reportid = tbl_gemstone_report.reportid', 'left');
    $this->db->where('gsrid', $id);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->result();

    return false;
  }
}
?>
