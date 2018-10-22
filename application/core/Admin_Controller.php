<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends LB_Controller
{
  /****/
  protected $_json_reponse = array();

  /**
   * Default Controller
   *
   * @param null
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('session'));
  }

  /*****/
  protected function check_login_status()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true)
    {
      redirect('admin/home');
    }
    else {
      $this->set_layout('admin');
    }
  }

  /****/
  protected function ajax_login_status()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true) return false;
    return true;
  }

  /****/
  protected function regenerate_csrf()
  {
    return $this->security->get_csrf_hash();
  }
}
?>
