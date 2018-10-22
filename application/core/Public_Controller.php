<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Public_Controller extends LB_Controller
{
  /**
   * Default Controller
   *
   * @param null
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $this->set_layout('public');
  }
}
?>
