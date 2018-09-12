<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Print extends CI_Controller
{
  /**
   * Constructor (loading the important classes)
   *
   * @param none
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('session', 'pagination', 'table'));

    $config = array('layoutManager'=>'admin');
    $this->load->library('layout', $config);

    $this->load->helper(array('url', 'form'));
    $this->load->model(array('Customer_model', 'Lab_model'));

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
  }

  public function index()
  {
    // code...
  }
}
?>
