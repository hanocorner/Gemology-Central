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

  /**
   * public view for the admin to print the Gemstone report
   *
   * @param none
   * @return void
   */
  public function memocard()
  {
    $gemid = $this->uri->segment(5);
    $type = $this->uri->segment(4);

    if ($type == 'cert-report')
    {
      $data['data'] = $this->Customer_model->get_gem_data($gemid, 'cerno');
      $data['img_url'] = $this->qr_generator($gemid);
      $this->load->view('admin/report/certificate', $data);
    }

    if ($type == 'memo-card')
    {
      $data['data'] = $this->Customer_model->get_gem_data($gemid, 'cerno');
      $this->load->view('admin/report/memo_card', $data);
    }

  }

  /**
   * public view for the admin to print the Gemstone report
   *
   * @param none
   * @return void
   */
  public function certificate()
  {

  }
}
?>
