<?php
class System_model extends CI_Model
{
  /**
   * Default Constructor for DB class
   *
   * @param none
   * @return none
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  /**
   * Analytics data for tbl_administrator
   *
   * @param none
   * @return none
   */
  public function counts()
  {
    $sql = '';

    $sql = "SELECT COUNT(*) AS total FROM tbl_postComments, tbl_lab_report";
    $query = $this->db->query($sql);
    $row = $query->row();

    if($row->total != 0)
    {
      $sql = "SELECT
              (SELECT COUNT(*) FROM tbl_postComments WHERE cmnt_status = 1) AS totalComments,
              (SELECT COUNT(*) FROM tbl_lab_report WHERE cer_paymentStatus = 0) AS totalCertificates";

      $query = $this->db->query($sql);
      $row = $query->row();
      return $row;
    }
    elseif($row->total == 0) {
      return 0;
    }

  }

  /**
   * Administrator log data
   *
   * @param $key admin id | string
   * @return none
   */
  public function log_data($key)
  {
    $this->db->select('*');
    $this->db->from('tbl_administrator_log');
    $this->db->where('admID', $key);

    $query = $this->db->get();
    return $query->row();
  }
}
?>
