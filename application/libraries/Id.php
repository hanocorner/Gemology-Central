<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Id
{
  /**
   * CodeIgniter Instance
   *
   * @var instance
   */
  private $CI;

  /**
   * Prefix to identify the company
   *
   * @var string
   */
  private $_prefix = '';

  /**
   * Six digit number for unique identification
   *
   * @var int
   */
  private $_suffix = (int)100000;

  /**
   * Id format
   *
   * @var string
   */
  private $_template = '';

  /**
   * Constructor for this class & module initialization
   *
   * @param $config layoutManager must be admin or public | String
   * @return none
   */
  public function __construct()
  {
    $this->CI =& get_instance();
    $this->config->load('report');
  }

  /****/
  public function set_template($template = array())
  {
    if(!is_array($template)) return;
    $this->_template = $template;

    $this->_prefix.$this->_suffix;


  }
  /*****/
  public function create_id($report_type)
  {
    $this->config->item('item_name');

    $prefix = "VEB";
    $number = 000000;

    $verbalid = $this->Lab_model->get_memo_id();

    if(is_null($verbalid))
    {
      $number += 1;
      $numb = str_pad($number, 6, '0', STR_PAD_LEFT);
      echo $prefix."-".$numb;
    }
    else
    {
      $verbalid = preg_replace('/[^0-9]/', '', $verbalid);
      $verbalid += 1;
      $verbalid = str_pad($verbalid, 6, '0', STR_PAD_LEFT);
      echo $prefix."-".$verbalid;
    }
  }

}
?>
