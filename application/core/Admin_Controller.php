<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends LB_Controller
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
    $this->load->library(array('session'));
  }

  /**
   * User login status and set layout as admin
   *
   * @param null
   * @return void
   */
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

  /**
   * User login check via ajax
   *
   * @param null
   * @return bool
   */
  protected function ajax_login_status()
  {
    if (!$this->session->has_userdata('logged_in') && $this->session->logged_in != true) return false;
    return true;
  }

  /**
   * Regenerate CSRF token
   *
   * @param null
   * @return string
   */
  protected function regenerate_csrf()
  {
    return $this->security->get_csrf_hash();
  }
}
?>
