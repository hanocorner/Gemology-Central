<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller
{
  /**
   * Constructor (loading the important class)
   */
  public function __construct()
  {
    parent::__construct();
    $this->check_login_status();
  }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {
    $this->layout->set_title('Dashboard');
    $this->data['username'] = $this->session->username;
    $this->layout->view('admin/profile', $this->data, 'admin/layouts/admin');
  }
}
?>
