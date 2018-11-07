<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_model extends CI_Model
{
  /**
   * Default Constructor init Database
   */
  public function __construct()
  {
    parent::__construct();
  }

  public function insert_report($data)
  {
    $this->db->query('CALL insertReport()');
    $result = $this->db->get();
    $result->result();
  }
}
?>
