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

    $this->load->library('session');
    $this->load->helper('url');
    $this->load->model('Print_model');

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
    $id = $this->uri->segment(4);

    if(is_null($id)) redirect('admin/customer');

    $data['data'] = $this->Print_model->get_certificate_by_id($id);
    $data['img_url'] = $this->qr_generator($id);
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
    $id = $this->uri->segment(4);

    if(is_null($id)) redirect('admin/customer');

    $data['data'] = $this->Print_model->get_certificate_by_id($id);
    $data['img_url'] = $this->qr_generator($id);
    return $this->load->view('admin/lab/print/certificate_report', $data);
  }

  /**
   * QR Code generator
   *
   * @param $gemid
   * @return qr image url
   */
  public function qr_generator($gemid)
  {
    $this->load->library('ciqrcode');

    $img_url="";

    $qr_image=$gemid.'.png';
    $params['data'] = base_url()."report";
    $params['level'] = 'H';
    $params['size'] = 8;
    $params['savename'] ="assets/admin/images/qr/".$qr_image;

    if($this->ciqrcode->generate($params))
    {
      return $qr_image;
    }
    return false;
  }
}
?>
