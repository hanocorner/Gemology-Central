<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LB_Controller extends CI_Controller
{

  /**
   * Data from controller to view
   *
   * @var array
   */
  protected $_data = array();

  /**
   * Layout setting
   *
   * @var array
   */
  protected $_layout = null;

  /**
   * Default Controller
   *
   * @param null
   * @return void
   */
  public function __construct(){
    parent::__construct();
  }

  /**
   * Set Layout
   *
   * @param string $layout default | admin | public
   * @return void
   */
  public function set_layout($layout = 'default')
  {
    $this->load->library('layout', array('layoutManager'=>$layout));
  }

}
?>
