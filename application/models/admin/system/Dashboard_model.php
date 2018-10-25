<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{
  /****/
  public function count_all_customers()
  {
    return $this->db->count_all_results('tbl_customer');
  }
}
?>
