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

  
}
?>
