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
}
?>
