<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Handler extends GCL_Report
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

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);
    $this->load->library(array('session', 'pagination', 'table'));

    $this->load->helper(array('form'));
    $this->load->model(array('Customer_model', 'Lab_model', 'Report_model'));

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
  }

  /*****/
  public function index()
  {
    // code...
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
