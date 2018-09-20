<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_model extends CI_Model
{
  /*****/
  public function __construct() {
      parent::__construct();
  }

  /*****/
  public function get_labreport_by_id($id)
  {
    $this->db->select('*');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gem_memocard', 'tbl_lab_report.reportid = tbl_gem_memocard.reportid', 'left');
    $this->db->where('memoid', $id);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->row();

    $this->db->select('*');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gemstone_report', 'tbl_lab_report.reportid = tbl_gemstone_report.reportid', 'left');
    $this->db->where('gsrid', $id);
    $query = $this->db->get();

    if($query->num_rows() > 0) return $query->row();
  }

  /*****/
  public function auth_report_data($repid, $weight)
  {
    $this->db->select('tbl_lab_report.reportid,tbl_gem_memocard.reportid, memoid, rep_weight');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gem_memocard', 'tbl_lab_report.reportid = tbl_gem_memocard.reportid', 'left');
    $this->db->where('memoid', $repid);
    $this->db->where('rep_weight', $weight);
    $query = $this->db->get();

    if($query->num_rows() > 0) return true;

    $this->db->select('tbl_lab_report.reportid, tbl_gemstone_report.reportid, gsrid, rep_weight');
    $this->db->from('tbl_lab_report');
    $this->db->join('tbl_gemstone_report', 'tbl_lab_report.reportid = tbl_gemstone_report.reportid', 'left');
    $this->db->where('gsrid', $repid);
    $this->db->where('rep_weight', $weight);
    $query = $this->db->get();

    if($query->num_rows() > 0) return true;

    return false;
  }
}
?>
