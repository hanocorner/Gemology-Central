<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Printp extends CI_Controller
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

    $this->load->library(array('session', 'encrypt'));
    $this->load->helper('url');
    $this->load->model('Print_model');

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
  }

  /*****/
  public function index()
  {
    echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='".base_url()."admin/report/customer'>click here to go Back to customer page</a> ";
  }

  /**
   * public view for the admin to print the Gemstone report
   *
   * @param none
   * @return void
   */
  public function memocard()
  {
    if(!$this->uri->segment(4)) redirect('admin/customer');
    $id = $this->uri->segment(4);

    $data['data'] = $this->Print_model->get_memocard_by_id($id);
    $data['qrcode'] = $this->qr_generator($id);
    return $this->load->view('admin/lab/print/memo_card', $data);
  }

  /**
   * public view for the admin to print the Gemstone report
   *
   * @param none
   * @return void
   */
  public function certificate()
  {
    if(!$this->uri->segment(4)) redirect('admin/customer');
    $id = $this->uri->segment(4);

    $data['data'] = $this->Print_model->get_certificate_by_id($id);
    $data['qrcode'] = $this->qr_generator($id);
    return $this->load->view('admin/lab/print/certificate_report', $data);
  }

  
}
?>
