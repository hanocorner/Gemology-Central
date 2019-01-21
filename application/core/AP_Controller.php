<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AP_Controller extends CI_Controller
{

  /**
   * Data from controller to view
   *
   * @var array
   */
  protected $_data = array();

  /**
   * Application datetime 
   * 
   * @var datetime
   */
  protected $_datetime = null;

  /**
   * Application date
   * 
   * @var date
   */
  protected $_date = null;

  /**
   * Default Controller
   *
   * @param null
   * @return void
   */
  public function __construct(){
    parent::__construct();

    $this->_datetime = date($this->config->item('datetime_format'));
    $this->_date = date($this->config->item('date_format'));
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
