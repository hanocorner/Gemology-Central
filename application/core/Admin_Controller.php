<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Controller extends CI_Controller
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
    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }

    $this->set_layout('admin');
  }


}
?>
