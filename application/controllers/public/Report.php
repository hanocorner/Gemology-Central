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

    $this->load->model(array('Article_model','Base_model'));

    $config = array('layoutManager'=>'public');
    $this->load->library('layout', $config);
    $this->load->library(array('session', 'encrypt'));

    $this->load->helper(array('captcha', 'url', 'form'));
  }
}
?>
