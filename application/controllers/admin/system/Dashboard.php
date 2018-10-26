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
    $this->layout->view('admin/system/dashboard/profile', '', 'admin/layouts/admin');
  }

  /*****/
  public function profile_stats()
  {
    $result = $this->Dashboard_model->get_user_log($this->session->user_id);
    $this->data['username'] = ucwords($this->session->username);
    $this->data['timestamp'] = $result[0]->log_timestamp;
    $this->data['useragent'] = $result[0]->log_userBrowser;
    $this->data['ipaddress'] = $result[0]->log_ipAddress;
    $this->data['platform'] = $result[0]->log_platform;
    echo json_encode($this->data);
  }

  /***/
  public function dashboard_stats()
  {
    $this->data['totalcustomers'] = $this->Dashboard_model->count_all_customers();
    echo json_encode($this->data);
  }
}
?>
