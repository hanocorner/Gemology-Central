<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Lab_model extends CI_Model
{
  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Inserting a new Lab Report
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function add_gemstone($data)
  {
    $this->db->insert('tbl_certificate', $data);
    return $this->db->insert_id();
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

  /**
   * Fetcing existing gem report id to generate a new id
   *
   * @param none
   * @return id | string
   */
  public function get_certificate_id()
  {
    $this->db->select("gsrid");
    $this->db->from('tbl_gemstoneReport');
    $this->db->order_by("gsrid", "DESC");
    $this->db->limit(1);

    return $this->db->get()->row()->gsrid;
  }

  /**
   * Fetcing existing memo card id to generate a new id
   *
   * @param none
   * @return id | string
   */
  public function get_memo_id()
  {
    $this->db->select("memoid");
    $this->db->from('tbl_gemMemoCard');
    $this->db->order_by("memoid", "DESC");
    $this->db->limit(1);

    return $this->db->get()->row()->memoid;
  }

  /**
   * Fetcing existing lab report id
   *
   * @param $customerid | string
   * @return id | string
   */
  public function get_labreport_id($customerid)
  {
    $this->db->select("reportid");
    $this->db->from('tbl_lab_report');
    $this->db->where('rep_customerID', $customerid);

    $query = $this->db->get();
    $row = $query->row();

    if(isset($row->reportid)) return $row->reportid;

    return null;
  }

  /****/
  public function memo_data($cid)
  {
    $sql = "SELECT * FROM `tbl_lab_report` AS t1 INNER JOIN `tbl_gem_memocard` as t2 ON t1.reportid = t2.reportid WHERE t1.rep_customerID = '$cid' AND t1.rep_type = 'memo'";
    $query = $this->db->query($sql);

    $query = $this->db->query($sql);
    return $query->result();
  }

  /****/
  public function certificate_data($cid)
  {
    $sql = "SELECT * FROM `tbl_lab_report` AS t1 INNER JOIN `tbl_gemstone_report` as t2 ON t1.reportid = t2.reportid WHERE t1.rep_customerID = '$cid' AND t1.rep_type = 'repo'";
    $query = $this->db->query($sql);

    $query = $this->db->query($sql);
    return $query->result();
  }

}
?>
