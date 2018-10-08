<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Download extends CI_Controller
{
  /**
   * Report id parsed as qr data
   *
   * @var string
   */
  private $_id = '';

  /**
   * Qr Image with data
   *
   * @var string
   */
  private $_qrcode = '';

  /**
   * Qr image extension
   *
   * @var string
   */
  private $_extension = 'png';

  /**
   * Qr Library parameters
   *
   * @var array
   */
  private $_params = array();

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

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }

    $this->qr();
  }

  /**
   * Setting admin view so that user can download QR
   *
   * @param null
   * @return void
   */
  public function index()
  {
    $data['qr'] = $this->_qrcode;

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
  public function download()
  {
    $data = file_get_contents(base_url().'assets/admin/images/qr/'.$this->_qrcode);
    force_download($this->_qrcode, $data);
  }

  /**
   * QR Code generator
   *
   * @param $gemid
   * @return qr image url
   */
  private function qr()
  {
    $this->_id = $this->encrypt->decode($this->session->qrid);
    $this->_qrcode = $this->_id.'.'.$this->_extension;
    $this->_params['data'] = base_url()."report/".$this->_id;
    $this->_params['level'] = 'H';
    $this->_params['size'] = 8;
    $this->_params['savename'] = "assets/admin/images/qr/".$this->_qrcode;

    if($this->ciqrcode->generate($this->_params)) return $this->_qrcode;

    return null;
  }
}
?>
