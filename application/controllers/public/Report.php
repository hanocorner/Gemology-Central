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
class Report extends Public_Controller
{

  /**
   * Constructor initializing the object and its Methods
   *
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->model('public/Report_model', 'report');

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
    $this->_data['captcha'] = $this->captcha();

    $this->layout->title ='GCL Report Verfication';
    return $this->layout->view('public/report/form_verification', $this->_data);
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
    $this->output->set_content_type('application/json', 'utf-8');

    $this->form_validation->set_rules('repono','Report No.','trim|required|alpha_dash');
    $this->form_validation->set_rules('weight','Weight','trim|required|numeric');
    $this->form_validation->set_rules('captcha','Captcha','trim|required|numeric');

    if ($this->form_validation->run() == FALSE)
    {
      $json_response = array('status'=>false, 'message'=>validation_errors());
      
      return $this->output->set_output(json_encode($json_response));
    }

    if($this->report->get_captcha($this->input->post('captcha'), $time, $this->input->ip_address()) == 0)
    {
      $json_response = array('status'=>false, 'message'=>'<p>Incorrect captcha combination</p>');
      return $this->output->set_output(json_encode($json_response));
    }

    $db_response = $this->report->auth_report_data($this->input->post('repono'), $this->input->post('weight'));
    if(!$db_response)
    {
      $json_response = array('status'=>false, 'message'=>'<p>Report you submit does not exist, Please try again...</p>');
      return $this->output->set_output(json_encode($json_response));
    }
    
    $url = 'report/'.$db_response;
    $json_response = array('status'=>true, 'url'=>$url);
    return $this->output->set_output(json_encode($json_response));
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
    $this->load->helper('captcha');
    
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

    $this->report->insert_captcha($data);
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
    $token = $this->uri->segment(2);
    if(!$token || $token == '') redirect('report');

    $this->_data['result'] = $this->report->get_labreport($token);
    $this->layout->title = 'GCL Report Verfication';
    return $this->layout->view('public/report/index', $this->_data);
  }

  /**
   * Parsing json data to the report
   *
   * @param none
   * @return void
   */
  public function data()
  {
    $token = $this->uri->segement(2);
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
