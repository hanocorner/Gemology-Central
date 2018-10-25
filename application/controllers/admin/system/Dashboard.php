<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends Admin_Controller
{
  /**
   * Constructor (loading the important classes)
   *
   * @param null
   * @return void
   */
   public function __construct()
   {
     parent::__construct();
     $this->check_login_status();

     $this->load->model(array('admin/system/Dashboard_model'));
   }

   /**
   * Default view for the user
   *
   * @param null
   * @return void
   */
  public function index()
  {
    $this->layout->set_title('Dashboard');
    $this->layout->view('admin/system/dashboard/index', '', 'admin/layouts/admin');
  }

  /****/
  public function profile()
  {
    $this->layout->set_title('Profile');
    $this->data['username'] = $this->session->username;
    $this->layout->view('admin/system/dashboard/profile', $this->data, 'admin/layouts/admin');
  }

  /***/
  public function dashboard_stats()
  {
    $this->data['totalcustomers'] = $this->Dashboard_model->count_all_customers();
    echo json_encode($this->data);
  }
}
?>
