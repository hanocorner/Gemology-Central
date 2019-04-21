<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_model extends CI_Model
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
   * Table Captcha
   *
   * @var string
   */
  protected $tbl_captcha = 'tbl_captcha';

  /**
   * Default Constructor
   *
   * @param none
   */
  public function __construct() {
      parent::__construct();
  }

  /**
   * Function to insert captcha
   *
   * @param $data values | array
   * @return bool
   */
  public function insert_captcha($data)
  {
    $query = $this->db->insert_string($this->tbl_captcha, $data);
    $this->db->query($query);
  }

  /**
   * Querying the captcha to validate user input captcha
   *
   * @param $word word | string
   * @param $time | string
   * @param $ip | int
   *
   * @return count
   */
  public function get_captcha($word, $time, $ip)
  {
    $this->db->where('captcha_time < ', $time)->delete($this->tbl_captcha);

    $sql = 'SELECT COUNT(*) AS count FROM tbl_captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';

    $binds = array($word, $ip, $time);
    $query = $this->db->query($sql, $binds);
    $row = $query->row();

    return $row->count;
  }

  /**
   * Fetch lab report byreport id
   *
   * @param $id report id | string
   *
   * @return object
   */
  public function get_labreport($token)
  {
    $token = (string) $token;
    $sql = "SELECT qrtoken, date, object, variety, spgroup, dimensions, weight, shapecut, color, comment, gemstone, imgpath, repoid FROM public_fetch_report WHERE qrtoken = '".$token."' ";
    $query = $this->db->query($sql);
    return $query->row();
  }

  /**
   * Authenticating userinputed report data
   *
   * @param $repid report id | string
   * @param $weight weight of the stone | int
   *
   * @return result
   */
  public function auth_report_data($repid, $weight)
  {
    $this->db->select('*');
    $this->db->from('public_fetch_report');
    $this->db->where('repoid', $repid);
    $this->db->where('weight', $weight);
    $query = $this->db->get();

    if($query->num_rows() > 0) 
    {
      return $query->row()->qrtoken;
    }
    else {
      return false;
    }
    //$query->num_rows()
    
  }
}
?>
