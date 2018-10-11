<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_model extends CI_Model
{
  /**
   * DB result set
   *
   * @var array
   */
  private $_result = array();

  /**
   * Selected columns to be outputed
   *
   * @var string
   */
  private $_columns = '';

  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  /*****/
  public function get_data($id)
  {
    $this->db->select('reportid, rep_customerid, rep_type');
    $this->db->from('tbl_lab_report');
    $this->db->where('reportid', $id);
    $query = $this->db->get();

    $this->_result = $query->result();

    $this->db->select('custid, cus_firstname, cus_lastname');
    $this->db->from('tbl_customer');
    $this->db->where('custid', $this->_result[0]->rep_customerid);

    switch ($this->_result[0]->rep_type) {
      case 'memo':
        $this->_columns = 't1.*, t2.memoid, t2.reportid, t2.mem_paymentStatus, t2.mem_amount, t3.reportid, t3.img_gemstone, t3.img_path';
        $this->db->select($this->_columns);
        $this->db->from('tbl_lab_report AS t1');
        $this->db->join('tbl_gem_memocard AS t2', 't1.reportid = t2.reportid', 'left');
        $this->db->join('tbl_gem_image AS t3', 't1.reportid = t3.reportid', 'left');
        $this->db->where('t1.reportid', $this->_result[0]->reportid);

        $query = $this->db->get();
        return $this->_result = $query->row();
        break;

      case 'repo':
        $this->_columns = 't1.*, t2.gsrid, t2.reportid, t2.gsr_paymentStatus, t2.gsr_amount, t3.reportid, t3.img_gemstone, t3.img_path';
        $this->db->select($this->_columns);
        $this->db->from('tbl_lab_report AS t1');
        $this->db->join('tbl_gemstone_report AS t2', 't1.reportid = t2.reportid', 'left');
        $this->db->join('tbl_gem_image AS t3', 't1.reportid = t3.reportid', 'left');
        $this->db->where('t1.reportid', $this->_result[0]->reportid);

        $query = $this->db->get();
        return $this->_result = $query->row();
        break;

      case 'verb':
        $this->_columns = 't1.*, t2.verbid, t2.reportid, t3.reportid, t3.img_gemstone, t3.img_path';
        $this->db->select($this->_columns);
        $this->db->from('tbl_lab_report AS t1');
        $this->db->join('tbl_gem_verbal AS t2', 't1.reportid = t2.reportid', 'left');
        $this->db->join('tbl_gem_image AS t3', 't1.reportid = t3.reportid', 'left');
        $this->db->where('t1.reportid', $this->_result[0]->reportid);

        $query = $this->db->get();
        return $this->_result = $query->row();
        break;
    }
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
  public function update_lab_report($data, $customerid, $labrepoid)
  {
    $this->db->where('rep_customerID', $customerid);
    $this->db->where('reportid', $labrepoid);
    return $this->db->update('tbl_lab_report', $data);
  }

  /****/
  public function update_memo($data, $reportid)
  {
    $this->db->where('reportid', $reportid);
    return $this->db->update('tbl_gem_memocard', $data);
  }

  /****/
  public function update_repo($data, $reportid)
  {
    $this->db->where('reportid', $reportid);
    return $this->db->update('tbl_gemstone_report', $data);
  }

  /****/
  public function update_verbal($data, $reportid)
  {
    $this->db->where('reportid', $reportid);
    return $this->db->update('tbl_gem_verbal', $data);
  }

  public function update_image($data, $labrepoid)
  {
    $this->db->where('reportid', $labrepoid);
    return $this->db->update('tbl_gem_image', $data);
  }
}
?>
