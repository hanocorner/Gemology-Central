<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Id
{
  /**
   * CodeIgniter Instance
   *
   * @var object
   */
  private $CI;

  /**
   * Constructor for this class & module initialization
   *
   * @param $config layoutManager must be admin or public | String
   * @return none
   */
  public function __construct()
  {
    $this->CI =& get_instance();
  }

}
?>
