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
    $this->db->query('CALL insertReport(
      "'.$data['rmid'].'",
      "'.$data['custid'].'",
      "'.$data['gemid'].'",
      "'.$data['cdate'].'",
      "'.$data['repotype'].'",
      "'.$data['object'].'",
      "'.$data['variety'].'",
      "'.$data['weight'].'",
      "'.$data['gemWidth'].'",
      "'.$data['gemHeight'].'",
      "'.$data['gemLength'].'",
      "'.$data['spgroup'].'",
      "'.$data['shapecut'].'",
      "'.$data['color'].'",
      "'.$data['comment'].'",
      "'.$data['other'].'",
      "'.$data['img_gem'].'",
      "'.$data['qrcode'].'",
      "'.$data['amount'].'",
      @result
       )');

    return $this->db->affected_rows();
  }
}
?>