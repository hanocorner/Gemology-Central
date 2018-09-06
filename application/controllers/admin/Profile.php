<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
  /**
   * Constructor (loading the important class)
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library('session');

    $this->load->model('System_model');

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home','location');
    }

  }

  /**
   * Default view for the user
   *
   * @return void
   */
  public function index()
  {
    $this->layout->set_title('Dashboard');

    $counts = $this->System_model->counts();

    if($counts == 0)
    {
      $data['total_unpaid_certificates'] = 0;
      $data['noOfComments'] = 0;      
    }
    else
    {
      $data['total_unpaid_certificates'] = $counts[0]->totalCertificates;
      $data['noOfComments'] = $counts[0]->totalComments;
    }

    $admin_log = $this->System_model->log_data($_SESSION['user_id']);

    $data = array(
      "username"=>$_SESSION['username'],
      "lastLogin"=>date("F jS, Y", strtotime($admin_log->log_timestamp)),
      "lastUpdated"=>date("F jS, Y", strtotime($admin_log->log_userModified)),
      "ipAddress"=>$admin_log->log_ipAddress
    );

    $this->layout->add_include('assets/admin/js/notify.js');

    $this->layout->view('admin/profile', $data, 'admin/layouts/admin');
  }


}

?>
