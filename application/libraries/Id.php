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
  private $_prefix = 'DEF';

  /**
   * Six digit number for unique identification
   *
   * @var int
   */
  private $_suffix = 100000;

  /**
   * Is template set
   *
   * @var bool
   */
  private $_templated = false;

  /**
   * Template Options
   *
   * @var string
   */
  private $_options = '';

  /**
   * Last Id from DB
   *
   * @var mixed
   */
  private $_lastid = null;

  /**
   * Constructor for this class & module initialization
   *
   * @param $config layoutManager must be admin or public | String
   * @return none
   */
  public function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->config->load('report');

    if($this->CI->config->item('default_prefix') && $this->CI->config->item('default_suffix'))
    {
      $this->_prefix = $this->CI->config->item('default_prefix');
      $this->_suffix = $this->CI->config->item('default_suffix');
    }
  }

  /*****/
  public function create_id()
  {
    $this->_suffix = $this->increment_id();

    if($this->_templated)
    {
      return $this->_prefix.$this->_options.$this->_suffix;
    }
    else
    {
      return $this->default_id();
    }

  }

  /****/
  public function set_lastid($lastid = null)
  {
    $this->_lastid = $lastid;
  }

  /*****/
  public function set_format($format = array())
  {
    foreach ($format as $key => $value) {
      if(isset($format[$key]))
      {
        $this->_options .= $value;
        $this->_templated = true;
      }
      else
      {
        $this->_templated = false;
      }
    }
    return $this->_options;
  }

  /*****/
  private function increment_id()
  {
    if(is_null($this->_lastid))
    {
      $this->_suffix += 1;
      return $this->_suffix;
    }
    else
    {
      $this->_suffix = preg_replace('/[^0-9]/', '', $this->_lastid);
      $this->_suffix = substr($this->_suffix, -6);
      $this->_suffix += 1;
      return $this->_suffix;
    }
  }

  /*****/
  private function default_id()
  {
    return $this->_prefix.$this->_suffix;
  }
}
?>
