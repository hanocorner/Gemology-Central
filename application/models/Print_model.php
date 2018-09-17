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
  public function get_certificate_by_id($id)
  {
    $sql = "SELECT * FROM `tbl_lab_report` AS t1 INNER JOIN `tbl_gemstone_report` as t2 ON t1.reportid = t2.reportid WHERE t2.gsrid = '$id'";
    $query = $this->db->query($sql);

    $query = $this->db->query($sql);
    return $query->result();
  }
}
?>
