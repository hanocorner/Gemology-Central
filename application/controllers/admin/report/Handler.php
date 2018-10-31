<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends Admin_Controller
{

  /**
   * Constructor initializing  all the the required classes
   *
   * @param none
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->check_login_status();

    $this->load->helper('directory');
    $this->load->model(array('Lab_model', 'Report_model'));
  }

  /**
   *
   *
   */
  public function index()
  {
    $this->layout->set_title('My Reports');
    $this->layout->view('admin/lab/report/index', '', 'admin/layouts/admin');
  }

  /****/
  public function add()
  {
    if($this->customer() == FALSE) redirect('admin/report');
    $this->_title = 'Add Report';
    $this->form_report();
  }

  /*****/
  public function edit()
  {
    if($this->customer() == FALSE) redirect('admin/report');
    $this->_title = 'Edit Report';
    $this->form_report();
  }

  /****/
  public function FunctionName($value='')
  {
    // code...
  }
}
?>
