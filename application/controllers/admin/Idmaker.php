<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Idmaker extends CI_Controller
{
  /**
   * ID from DB
   *
   * @var string
   */
  private $_id = '';

  /**
   * ID format according to type
   *
   * @var array
   */
  private $_format = array();

  /**
   * Constructor initializing  all the the required classes
   *
   * @param null
   * @return void
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('id', 'session'));

    $this->load->model('Id_model');

    if (!$this->session->has_userdata('logged_in'))
    {
      redirect('admin/home');
    }
  }

  /**
   * Setting id according to report type selected by user
   *
   * @param null
   * @return null
   */
  public function id()
  {
    $report_type = $this->input->get('type');

    if($report_type === 'memo')
    {
      $this->Id_model->set_table('tbl_gem_memocard');
      $this->_id = $this->Id_model->get_id('memoid');
      $this->_format = array('separator'=>'-');
    }
    elseif ($report_type === 'repo')
    {
      $this->Id_model->set_table('tbl_gemstone_report');
      $this->_id = $this->Id_model->get_id('gsrid');
      $this->_format = array('identifier'=>date('Y'), 'separator'=>'-', 'month'=>date('m'))
    }
    elseif ($report_type === 'verb')
    {
      $this->Id_model->set_table('tbl_gem_verbal');
      $this->_id = $this->Id_model->get_id('verbid');
      $this->_format = array('identifier'=>'V', 'separator'=>'-');
    }
    else {
      return;
    }
    $this->id->set_lastid($this->_id);
    $this->id->set_format($this->_format);
    echo $this->id->create_id();
  }
}
?>
