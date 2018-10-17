<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller
{
  /**
   * Qr Image with data
   *
   * @var string
   */
  private $_qrcode = '';

  /****/
  private $_img_path = '';

  /**
   * Constructor initializing  all the the required classes
   *
   * @param none
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library('layout', array('layoutManager'=>'admin'));
    $this->load->library(array('session', 'encrypt', 'ciqrcode'));
    $this->load->helper('download');
    $this->load->model('Report_model');

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
    $this->set_path();
  }

  /****/
  public function set_path()
  {

  }
  /**
   * Setting admin view so that user can download QR
   *
   * @param null
   * @return void
   */
  public function index()
  {
    $result = $this->Report_model->get_imagepath($this->uri->segment(4));
    $this->_qrcode = $result[0]->img_qrcode;
    $this->_img_path = $result[0]->img_path;
    $data['qrwithpath'] = $this->_img_path.'/'.$this->_qrcode;
    $data['qrwithoutpath'] = $this->uri->segment(4);

    $this->layout->set_title('Download QR');
    $this->layout->add_include('assets/admin/js/download.js');
    $this->layout->view('admin/lab/report/download', $data, 'admin/layouts/admin');
  }

  /**
   * AJAX Request to download Qr
   *
   * @param null
   * @return void
   */
  public function get()
  {
    $result = $this->Report_model->get_imagepath($this->uri->segment(5));
    $this->_qrcode = $result[0]->img_qrcode;
    $this->_img_path = $result[0]->img_path;
    $data = file_get_contents(base_url().$this->_img_path.'/'.$this->_qrcode);
    force_download($this->_qrcode, $data);
  }

}
?>
