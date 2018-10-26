<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
  /****/
  public function count_all_customers()
  {
    return $this->db->count_all_results('tbl_customer');
  }

  /*****/
  public function get_user_log($id)
  {
    $this->db->select("log_timestamp, log_userBrowser, log_userModified, log_ipAddress, log_platform, admID");
    $this->db->from('tbl_administrator_log');
    $this->db->where("admID", $id);

    $query = $this->db->get();
    return $query->result();
  }
}
?>
