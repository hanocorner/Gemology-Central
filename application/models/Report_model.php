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
   * Inserting Lab Report Basic data
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert_verbal($data)
  {
    $this->db->insert('tbl_gem_verbal', $data);
    return $this->db->affected_rows();
  }

  /**
   * Inserting Lab Report Basic data
   *
   * @param $data Post values | array
   * @return Last insert id
   */
  public function insert_image($data)
  {
    $this->db->insert('tbl_gem_image', $data);
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

  /**
   * Ftech data by custom id and append to edit
   *
   * @param $id memoid | srid | string
   * @return result
   */
  public function get_data_by_mrid($id)
  {
    $this->db->select('memoid AS `repid`');
    $this->db->from('tbl_gem_memocard');
    $this->db->where('memoid', $id);
    $query1 = $this->db->get_compiled_select();

    $this->db->select('gsrid AS `repid`');
    $this->db->from('tbl_gemstone_report');
    $this->db->where('gsrid', $id);
    $query2 = $this->db->get_compiled_select();

    $query = $this->db->query($query1 . ' UNION ' . $query2);
    $row = $query->result();

    $this->db->select('*');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gem_memocard', 'tbl_lab_report.reportid = tbl_gem_memocard.reportid', 'left');
    $this->db->join('tbl_gem_image', 'tbl_lab_report.reportid = tbl_gem_image.reportid', 'left');
    $this->db->where('memoid', $row[0]->repid);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->row();

    $this->db->select('*');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gemstone_report', 'tbl_lab_report.reportid = tbl_gemstone_report.reportid', 'left');
    $this->db->join('tbl_gem_image', 'tbl_lab_report.reportid = tbl_gem_image.reportid', 'left');
    $this->db->where('gsrid', $row[0]->repid);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->row();
  }

  /****/
  public function get_imagepath($labrepoid)
  {
    $this->db->select('t1.reportid, t1.img_path, t1.img_qrcode');
    $this->db->from('tbl_gem_image AS t1');
    $this->db->where('reportid', $labrepoid);
    $query = $this->db->get();
    if($query->num_rows() > 0) return $query->result();
  }
}
?>
