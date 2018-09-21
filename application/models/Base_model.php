<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_model extends CI_Model
{
  /**
   * Master Table for this model
   *
   * @var string
   */
  protected $tbl_lab = 'tbl_lab_report';

  /**
   * Table Memocard | child table
   *
   * @var string
   */
  protected $tbl_memocard = 'tbl_gem_memocard';

  /**
   * Table Gemstone Report | child table
   *
   * @var string
   */
  protected $tbl_report = 'tbl_gemstone_report';

  /**
   * Default Constructor
   *
   * @param none
   */
  public function __construct() {
      parent::__construct();
  }

  /*****/
  public function get_labreport_by_id($id)
  {
    $this->db->select('*');
    $this->db->from($this->tbl_lab.' AS t1 ');
    $this->db->join($this->tbl_memocard.' AS t2 ', 't1.reportid = t2.reportid', 'left');
    $this->db->where('memoid', $id);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->row();

    $this->db->select('*');
    $this->db->from($this->tbl_lab.' AS t1 ');
    $this->db->join($this->tbl_report.' AS t2 ', 't1.reportid = t2.reportid', 'left');
    $this->db->where('gsrid', $id);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->row();
  }

  /*****/
  public function auth_report_data($repid, $weight)
  {
    $this->db->select('t1.reportid, t2.reportid, memoid, rep_weight');
    $this->db->from($this->tbl_lab.' AS t1 ');
    $this->db->join($this->tbl_memocard.' As t2 ', 't1.reportid = t2.reportid', 'left');
    $this->db->where('memoid', $repid);
    $this->db->where('rep_weight', $weight);
    $query = $this->db->get();

    if($query->num_rows() > 0) return true;

    $this->db->select('t1.reportid, t2.reportid, gsrid, rep_weight');
    $this->db->from($this->tbl_lab.' AS t1 ');
    $this->db->join($this->tbl_report.' AS t2 ', 't1.reportid = t2.reportid', 'left');
    $this->db->where('gsrid', $repid);
    $this->db->where('rep_weight', $weight);
    $query = $this->db->get();

    if($query->num_rows() > 0) return true;

    return false;
  }
}
?>
