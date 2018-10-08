<?php
/**
 * Project Gemology Central Laboratory Report Verifcation System
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Public Sub class for End user Report verification
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 *
 */
class Report extends CI_Controller
{

  /**
   * Constructor initializing the object and its Methods
   *
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->model(array('Article_model','public/Report_model'));

    $config = array('layoutManager'=>'public');
    $this->load->library('layout', $config);
    $this->load->library(array('session', 'encrypt'));

    $this->load->helper(array('captcha', 'url', 'form'));
  }

  /**
   * Form Verification
   *
   * Function where customer input data in order to verify
   * his/her report.
   *
   * @param none
   * @return layout
   */
  public function index()
  {
    $data['captcha'] = $this->captcha();

    $this->layout->set_title('GCL Report Verfication');
    $this->layout->add_include('assets/public/js/base.js');
    return $this->layout->view('public/report/form_verification', $data, 'public/layouts/report');
  }

  /**
   * Authenticating customer form
   *
   * Data submission via ajax, authenticated and retruning the response via json
   *
   * @param none
   * @return bool
   */
  public function form_authentication()
  {
    $time = time() - 7200;
    $repono = $this->input->post('reportno');
    $weight = $this->input->post('repweight');

    $this->form_validation->set_rules('reportno','Report No.','trim|required|alpha_dash');
    $this->form_validation->set_rules('repweight','Weight','trim|required|numeric');
    $this->form_validation->set_rules('captcha','Captcha','trim|required|numeric');

    if ($this->form_validation->run() == FALSE)
    {
      $json = array('valid'=>false, 'message'=>validation_errors());
      echo json_encode($json);
    }

    if($this->Report_model->get_captcha($this->input->post('captcha'), $time, $this->input->ip_address()) == 0)
    {
      $json = array('valid'=>false, 'message'=>'<p>Incorrect captcha combination</p>');
      echo json_encode($json);
    }

    if($this->Report_model->auth_report_data($repono, $weight))
    {
      $url = 'report/'.$repono;
      $json = array('valid'=>true, 'url'=>$url);
      echo json_encode($json);
    }
    else
    {
      $json = array('valid'=>false, 'message'=>'<p>Report you submit does not exist, Please try again...</p>');
      echo json_encode($json);
    }
  }

  /**
   * CodeIgniter Captcha Helper
   *
   * Creating a captcha to prevent from bots and spammers
   *
   * @param none
   * @return captcha
   */
  private function captcha()
  {
    $vals = array(
        'word'          => rand(10, 10000),
        'img_path'      => './assets/public/images/captcha/',
        'img_url'       =>  base_url().'/assets/public/images/captcha/',
        'img_width'     => '150',
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 8,
        'font_size'     => 16,

        // White background and border, black text and red grid
        'colors'=> array(
          'background' => array(255, 255, 255),
          'border' => array(255, 255, 255),
          'text' => array(0, 0, 0),
          'grid' => array(255, 40, 40)
        )
    );

    $cap = create_captcha($vals);
    $data = array(
      'captcha_time'  => $cap['time'],
      'ip_address'    => $this->input->ip_address(),
      'word'          => $cap['word']
    );

    $this->Report_model->insert_captcha($data);
    return $cap['image'];
  }

  /**
   * Setting public view of the report
   *
   * @param none
   * @return layout
   */
  public function display()
  {
    $data['reportno'] = $this->uri->segment(2);
    $data['csrfname'] = $this->security->get_csrf_token_name();
    $data['csrfhash'] = $this->security->get_csrf_hash();

    $this->layout->set_title('GCL Report Verfication');
    $this->layout->add_include('assets/public/js/base.js');
    return $this->layout->view('public/report/index', $data, 'public/layouts/report');
  }

  /**
   * Parsing json data to the report
   *
   * @param none
   * @return void
   */
  public function data()
  {
    $id = $this->input->post('reportno');
    $data = $this->Report_model->get_labreport_by_id($id);
    echo json_encode($data);
  }

  /**
   * Creating csrf token fro form resubmission
   *
   * @param none
   * @return none
   */
  public function set_csrf()
  {
    $csrf = array('name'=>$this->security->get_csrf_token_name(), 'hash'=>$this->security->get_csrf_hash());
    echo json_encode($csrf);
  }
}
?>
